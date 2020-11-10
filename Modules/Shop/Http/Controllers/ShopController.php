<?php

namespace Modules\Shop\Http\Controllers;

use App\Helpers\RajaOngkir;
use App\Http\Models\CartDetail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Http\Models\Company;
use App\Http\Models\Content;
use App\Http\Models\Product;
use Veritrans_Config;
use Veritrans_Snap;
use Auth;
class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $section = [
            'name',
            'email',
            'province_id',
            'city_id',
            'phone',
            'address',
            'facebook_url',
            'twitter_url',
            'instagram_url',
            'tokopedia_url',
            'shopee_url',
            'bukalapak_url',
        ];

        $dataprovince = RajaOngkir::getprovince([],env('RAJAONGKIR_KEY'))['data']->rajaongkir->results;

        foreach($section as $key){
            $datacontent[$key] = @Content::where('page','shop-information')->where('section',$key)->first()->content;
        }

        return view('shop::index')->withTitle('Shop')->withShop($datacontent)->withProvince($dataprovince);
    }

    public function getcity(Request $request){
        $getcity = RajaOngkir::getcity(['province' => $request->province_id],env('RAJAONGKIR_KEY'))['data']->rajaongkir->results;

        foreach($getcity as $fak){
            $data[] = [
                'id' => $fak->city_id,
                'text' => $fak->type.' '.$fak->city_name
            ];
        }

        echo json_encode($data);
    }

    public function getcost(Request $request){
        $origin = Content::where('page','shop-information')->where('section','city_id')->first()->content;
        $dataongkir = RajaOngkir::getcost([
            'origin' => $origin,
            'destination' => $request->destination,
            'weight' => $request->totalweight,
            'courier' => $request->courier
        ],env('RAJAONGKIR_KEY'))['data']->rajaongkir->results;

        if(!empty($dataongkir)){
            foreach($dataongkir[0]->costs as $key => $val){
                $datas[] = [
                    'id' => $key,
                    'text' => $val->service,
                    'estimate' => $val->cost[0]->etd,
                    'price' => $val->cost[0]->value
                ];
            }
        }

        echo json_encode($datas);
    }

    public function getmidtranstoken(Request $request){
        // dd($request->all());
        $cartdetail = CartDetail::where('cart_id',$request->cart_id)->with('product')->get();
        foreach($cartdetail as $key){
            $itemdetail[] = [
                'id' => $key->product->id,
                'price' => $key->product->final_price,
                'quantity' => $key->qty,
                'name' => $key->product->product_name,
                'category' => $key->product->categories->name
            ];
        }
        $itemdetail[] =[
            'id' => 'shippingcost',
            'price' => $request->shippingcost,
            'quantity' => 1,
            'name' => 'Shipping Cost'
        ];
        $itemdetail[] =[
            'id' => 'tax',
            'price' => $request->tax,
            'quantity' => 1,
            'name' => 'Tax'
        ];
        // Set your Merchant Server Key
        Veritrans_Config::$serverKey = 'SB-Mid-server-YgGEJG-VkmC0UznzfaNmGcTf';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Veritrans_Config::$isProduction = false;
        // Set sanitization on (default)
        Veritrans_Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        Veritrans_Config::$is3ds = true;


        $params = array(
            'transaction_details' => array(
              'order_id' => 'BLI-'.date('myhis',strtotime('now')).Auth::user()->id.$request->cart_id,
              'gross_amount' => (int)$request->valtotalprice,
            ),
            "item_details" => $itemdetail,
            "enabled_payments" => ["credit_card","permata_va", "bca_va", "bni_va", "other_va","mandiri_clickpay", "cimb_clicks",
            "bca_klikbca", "bca_klikpay", "bri_epay", "echannel", "mandiri_ecash"],
            "customer_details" => [
                'first_name' => $request->receiver_name,
                'last_name' => '',
                'email' => Auth::user()->email,
                'phone' => $request->reveiver_phone,
                'billing_address' => [
                    'first_name' => $request->receiver_name,
                    'last_name' => '',
                    'email' => Auth::user()->email,
                    'phone' => $request->reveiver_phone,
                    'address' => $request->address,
                    'postal_code' => $request->postal_code
                ],
                'shipping_address' => [
                    'first_name' => $request->receiver_name,
                    'last_name' => '',
                    'email' => Auth::user()->email,
                    'phone' => $request->reveiver_phone,
                    'address' => $request->address,
                    'postal_code' => $request->postal_code
                ],
            ]
          );

        $snapToken = Veritrans_Snap::getSnapToken($params);

        echo json_encode($snapToken);
    }

    public function setting()
    {
        $section = [
            'name',
            'email',
            'phone',
            'address',
            'facebook_url',
            'twitter_url',
            'instagram_url',
            'tokopedia_url',
            'shopee_url',
            'bukalapak_url',
        ];

        foreach($section as $key){
            $datacontent[$key] = @Content::where('page','shop-information')->where('section',$key)->first()->content;
        }

        return view('shop::setting')->withTitle('Shop Setting')->withCompany($companydetail);
    }



    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('company::create');
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
        return view('company::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('company::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request)
    {
        foreach($request->except('_token', 'page') as $key => $val){
            //cek content
            $content = Content::where('page',$request->page)->where('section',$key);
            if($content->count() == 0){
                //create content
                $createcontent = new Content();
                $createcontent->page = $request->page;
                $createcontent->section = $key;
                $createcontent->content = $val;
                $createcontent->save();
            }else{
                //updatecontent
                $updatecontent = Content::findOrFail($content->first()->id);
                $updatecontent->page = $request->page;
                $updatecontent->section = $key;
                $updatecontent->content = $val;
                $updatecontent->save();
            }
        }

        return redirect()->back()->withErrors(['success' => 'Success Update Shop Information']);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
