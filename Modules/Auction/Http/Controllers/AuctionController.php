<?php

namespace Modules\Auction\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use App\Helpers\Guzzle;
use Yajra\Datatables\Datatables;
use App\User;
use App\Http\Models\Auction;
use App\Http\Models\Product;
use App\Role;
use App\UserRole;


class AuctionController extends Controller
{
    //view page
    public function index()
    {
        $title = 'Auction';
        $product = Product::get();

        return view('auction::index')->withProduct($product)->withTitle($title);
    }

    public function showLoginForm()
    {
        return view('auction:auth.login');
    }


    //get data fot DataTable
    public function data(Request $request)
    {
        //updating auction
        $datenow = date('Y-m-d H:i',strtotime('now'));

        $auctionstart = Auction::where('status',2)->where('bid_end','<',$datenow)->with('participant')->get();
        if($auctionstart->count() != 0){
            foreach($auctionstart as $key){
                if(count($key->participant) == 0){
                    $updateauction = Auction::where('id',$key->id)->update(['status' => 4]);
                }else{
                    $winner = collect($key->participant)->sortBy('bid');
                    $updateauction = Auction::where('id',$key->id)->update(['status' => 3,'winner_id' => $winner[0]->user_id,'winner_bid' => $winner[0]->bid]);
                }
            }
        }
        $auction = Auction::where('status',1)->whereDate('bid_start','<=',$datenow)->update(['status' => 2]);
       

        if ($request->filter == 'all')
        $user = Auction::with('product','winner')->get();
        else if($request->filter == 'active')
        $user = Auction::with('product','winner')->where('is_verified',1)->get();
        else if($request->filter == 'deactive')
        $user = Auction::with('product','winner')->where('is_verified',0)->get();
        else
        $user = Auction::with('product','winner')->onlyTrashed()->get();

        return datatables::of($user)->make(true);
    }

    //store data
    public function store(Request $request)
    {

        $auction = new Auction();
        $auction->product_id = $request->product_id;
        $auction->auction_type = $request->auction_type;
        $auction->max_price = (int)str_replace(".","",str_replace("Rp. ","",$request->max_price));
        $auction->min_price = (int)str_replace(".","",str_replace("Rp. ","",$request->min_price));
        $auction->scale = $request->scale;
        $auction->bid_start = $request->bid_start;
        $auction->bid_end = $request->bid_end;
        $auction->fixed_price = (int)str_replace(".","",str_replace("Rp. ","",$request->fixed_price));

        $auction->save();

        $data = [
            'status' => 1,
            'message' => 'Success Update Data'
        ];

        return json_encode($data);
    }

    //get data for Edit
    public function edit($id, Request $request)
    {
        $data = Auction::where('id', $id)->first();

        return json_encode($data);
    }

    //update data
    public function update($id, Request $request)
    {
        //cek email
        $user = Auction::where('email',$request->email)->where('id','!=',$id)->get();
        if($user->count() != 0){
            $data = [
                'status' => 2,
                'message' => 'Email already exist !'
            ];
            return $data;
        }

        $user = Auction::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if(!empty($request->password)){
            if($request->password != $request->confirmation){
                $data = [
                    'status' => 2,
                    'message' => 'Confirmation Password is not same with password'
                ];
                return $data;
            }
            $user->password = \Hash::make($request->password);
        }


        if(!$user->update()){
            $data = [
                'status' => 2,
                'message' => 'Fail Update Data'
            ];
        }else{
            $data = [
                'status' => 1,
                'message' => 'Success Update Data'
            ];
        }


        return json_encode($data);

    }

    //approve data
    public function approve($id, Request $request)
    {
        $model = Auction::findOrFail($id);
        $model->is_verified = 1;

        if(!$model->update()){
            $data = [
                'status' => 2,
                'message' => 'Fail Approve Data'
            ];
        }else{
            $data = [
                'status' => 1,
                'message' => 'Success Approve Data'
            ];
        }

        return json_encode($data);
    }

    //decline data
    public function decline($id, Request $request)
    {
        $model = Auction::findOrFail($id);
        $model->is_verified = 0;

        if(!$model->update()){
            $data = [
                'status' => 2,
                'message' => 'Fail Update Data'
            ];
        }else{
            $data = [
                'status' => 1,
                'message' => 'Success Update Data'
            ];
        }

        return json_encode($data);
    }

    //delete data
    public function destroy($id, Request $request)
    {
        $user = Auction::where('id', $id);
        $user->delete();

        if(!$user->delete()){
            $data = [
                'status' => 2,
                'message' => 'Fail Update Data'
            ];
        }else{
            $data = [
                'status' => 1,
                'message' => 'Success Update Data'
            ];
        }

        return json_encode($data);
    }

    //bulk data
    public function bulk($data, Request $request)
    {
        $datas = explode(',',$request->id);
        foreach($datas as $key){
            if($data == 'trash')
            $bulk = Auction::where('id',$key)->delete();
            else if($data == 'activate')
            $bulk = Auction::where('id',$key)->update(['is_verified'=>1]);
            else if($data == 'deactivate')
            $bulk = Auction::where('id',$key)->update(['is_verified' => 0]);
            else if($data == 'restore')
            $bulk = Auction::where('id',$key)->restore();
            else
            $bulk = Auction::where('id',$key)->forcedelete();
        }

        $data = [
            'status' => 1,
            'message' => 'Success Update Data'
        ];

        return json_encode($data);
    }

    //get info data
    public function info(Request $request)
    {
        $model = Auction::get();

        // $active = Auction::where('is_verified',1)->count();
        // $deactive = Auction::where('is_verified',0)->count();;
        $total = $model->count();
        $trashed = Auction::onlyTrashed()->count();

        $info = [
            'total' => $total,
            'trashed' => $trashed
        ];

        return json_encode($info);
    }

    //profil
    public function profil()
    {
        $user = Auction::findOrFail(Auth::user()->id);
        // $instansi = Instansi::get();
        $title = 'PROFIL';
        return view('auction::profil')->withData($user)->withTitle($title);
    }

    public function updateprofil(Request $request)
    {
        $user = Auction::findOrFail($request->id);

        if($request->new_password != NULL){
            if($request->new_password == $request->confirm_password)
            {
                $user->username = $request->username;
                $user->email = $request->email;
                $user->password = \Hash::make($request->new_password);
                $user->save();

                $data = [
                    'status' => 1,
                    'message' => 'Success Update Data'
                ];

                return \Redirect::back()->with('status', 'Data Update Success');
            } else {
                $data = [
                    'status' => 2,
                    'message' => 'Fail Update Data'
                ];
                return \Redirect::back()->with('danger', 'Your Password Confirmation is Incorrect');
            }
        } else {
            $user->username = $request->username;
            $user->email = $request->email;
            $user->save();

            $data = [
                'status' => '1',
                'message' => 'Success Update Data'
            ];

            return \Redirect::back()->with('status', 'Data Update Success');
        }
    }

    public function updateprofilpic(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'foto' => 'required|file|max:100000000',
        ]);

        if ($validator->fails()){
            $data = [
                'status' => 2,
                'message' => 'Fail Update Data'
            ];

            return json_encode($data);
        }else{
            $foto = Storage::disk('sftp')->put('foto', $request->file('foto'));
            if ($foto) {
                $model = Auction::findOrFail($request->id);
                $model->image = $foto;
                $model->update();
                $request->session()->regenerate();
                $data = [
                    'status' => 1,
                    'message' => 'Success Update Data'
                ];
                return json_encode($data);
            }else{
                $data = [
                    'status' => 2,
                    'message' => 'Fail Update Data'
                ];
                return json_encode($data);
            }
        }
    }

    public function deletepic(Request $request)
    {
        $model = Auction::findOrFail($request->id);
        $model->image = null;
        $model->update();
        $request->session()->regenerate();
        $data = [
            'status' => 1,
            'message' => 'Success Update Data'
        ];
        return redirect()->route('profil.index');
    }

}
