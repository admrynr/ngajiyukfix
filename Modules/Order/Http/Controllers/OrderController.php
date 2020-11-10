<?php

namespace Modules\Order\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Http\Models\Categories;
use App\Http\Models\Transaction;
use App\Http\Models\TransactionDetail;
use App\Helpers\Guzzle;
use Yajra\Datatables\Datatables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
      $title = 'Order Management';

      $category = Categories::all();

      return view('order::index', ['categories' => $category])->withTitle($title);    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('order::create');
    }

    public function detail($id)
    {
        $tran = Transaction::findOrFail($id);
        $trandetail = TransactionDetail::where('transaction_id', $id)->with('product')->get();

        $title = 'Order Invoice : '.$tran->invoice_number;
        //dd($trandetail);


        return view('order::detail', ['tran' => $tran, 'trandetail' => $trandetail])->withTitle($title);
    }

    public function data(Request $request)
    {
      if ($request->filter == 'all')
      $transaction = Transaction::with('transactiondetail')->get();
      else if($request->filter == 'unprocessed')
      $transaction = Transaction::where('status',1)->get();
      else if($request->filter == 'processed')
      $transaction = Transaction::where('status',2)->get();
      else if($request->filter == 'trashed')
      $transaction = Transaction::onlyTrashed()->get();

      return datatables::of($transaction)->make(true);

    }

    public function info(Request $request)
    {
        $model = Transaction::with('transactiondetail')->get();

        $processed = Transaction::where('status',2)->count();
        $unprocessed = Transaction::where('status',1)->count();
        $total = $model->count();
        $trashed = Transaction::onlyTrashed()->count();


        $info = [
            'total' => $total,
            'processed' => $processed,
            'unprocessed' => $unprocessed,
            'trashed' => $trashed,
        ];
        //dd($info);

        return json_encode($info);
    }

    public function bulk($data, Request $request)
    {
        $categories = Categories::all();
        $datas = explode(',',$request->id);
        foreach($datas as $key){
            if($data == 'trash')
            $bulk = Transaction::where('id',$key)->delete();
            else if($data == 'activate')
            $bulk = Transaction::where('id',$key)->update(['status'=>2]);
            else if($data == 'deactivate')
            $bulk = Transaction::where('id',$key)->update(['status' => 1]);
            else if($data == 'restore')
            $bulk = Transaction::where('id',$key)->restore();
            else if($data == 'delete'){
            $bulk = Transaction::withTrashed()->where('id',$key)->forcedelete();
            }
        }

        $data = [
            'status' => 1,
            'message' => 'Success Update Data'
        ];

        return json_encode($data);
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('order::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function approve($id)
    {
        $tran = Transaction::findOrFail($id);
        $tran->status = 2;
        if(!$tran->update()){
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

    public function decline($id)
    {
        $tran = Transaction::findOrFail($id);
        $tran->status = 1;
        if(!$tran->update()){
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

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
     public function destroy($id, Request $request)
     {
         $tran = Transaction::where('id', $id);

         if(!$tran->delete()){
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

     public function restore($id, Request $request)
     {
         $product = Transaction::withTrashed()->where('id', $id)->restore();

             $data = [
                 'status' => 1,
                 'message' => 'Success Update Data'
             ];

         return json_encode($data);
     }

     public function forcedelete($id, Request $request)
     {

         $tran = Transaction::withTrashed()->where('id', $id)->forcedelete();

         $data = [
             'status' => 1,
             'message' => 'Success Update Data'
         ];

         return json_encode($data);
     }
}
