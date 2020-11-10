<?php

namespace App\Http\Controllers\Cart;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;
use App\Http\Models\Product;
use App\Http\Models\Categories;
use App\Http\Models\Cart;
use App\Http\Models\CartDetail;
use App\Helpers\RajaOngkir;
use App\Http\Models\Transaction;
use App\Http\Models\TransactionDetail;
use Veritrans_Config;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userid = @Auth::user()->id;
        if(!empty($userid)){
            $data = Cart::where('user_id',$userid)->where('is_claim',0)->with('cartdetail')->first();
        }else{
            $data = [];
        }

        return view('topcart')->withCart($data);
    }

    public function order(Request $request)
    {
        //cekinvoicenumber
        $checktransaction = Transaction::where('invoice_number',$request->invoice_number)->count();
        if($checktransaction == 0){
            $paramtransaction = [
                'user_id' => Auth::user()->id,
                'invoice_number' => $request->invoice_number,
                'shipping_type' => strtoupper($request->courier).' '.strtoupper($request->shipping_name),
                'estimate_date' => $request->estimatevalue,
                'address' => $request->address,
                'province_id' => $request->province_id,
                'city_id' => $request->city_id,
                'total_weight' => $request->total_weight,
                'payment_type' => 2,
                'midtrans_payment_type' => $request->midtrans_payment_type,
                'midtrans_transaction_id' => $request->midtrans_transaction_id,
                'midtrans_pdf_url' => $request->midtrans_pdf_url,
                'midtrans_finish_redirect_url' => $request->midtrans_finish_redirect_url,
                'payment_account' => '',
                'payment_number' => '',
                'total_base_price' => 0,
                'total_final_price' => 0,
                'tax' => $request->tax,
                'shipping_price' => $request->shippingcost,
                'total_price' => $request->valtotalprice,
                'status' => $request->midtrans_transaction_status == 'pending' ? 1 : 2
            ];
            $newtransaction = new Transaction($paramtransaction);
            $newtransaction->save();

            //transactiondetail
            $cartdetail = CartDetail::where('cart_id',$request->cart_id)->get();
            $totalbaseprice = 0;
            $totalfinalprice = 0;
            foreach($cartdetail as $key){

                $baseprice = $key->product->base_price*$key->qty;
                $finalprice = $key->product->final_price*$key->qty;
                $totalbaseprice = $totalbaseprice + $baseprice;
                $totalfinalprice = $totalfinalprice + $finalprice;

                $paramdetail = [
                    'transaction_id' => $newtransaction->id,
                    'product_id' => $key->product_id,
                    'qty' => $key->qty,
                    'total_final_price' => $finalprice,
                    'total_base_price' => $baseprice,
                ];

                $newtransactiondetail = new TransactionDetail($paramdetail);
                $newtransactiondetail->save();
            }
            //update total base price and total final price
            $updatetransaction = Transaction::where('id',$newtransaction->id)->update(['total_base_price' => $totalbaseprice,'total_final_price' => $totalfinalprice]);
            //update cart to claimed
            $updatecart = Cart::where('id',$request->cart_id)->update(['is_claim'=>1]);
            $data = [
                'transaction' => Transaction::where('id',$newtransaction->id)->first(),
                'detailtransaction' => TransactionDetail::where('transaction_id',$newtransaction->id)->get()
            ];
            //send Email
            Mail::to(Auth::user()->email)->send(new OrderMail($data));
        }else{
            $transaction = Transaction::where('invoice_number',$request->invoice_number)->first();
            $data = [
                'transaction' => $transaction,
                'detailtransaction' => TransactionDetail::where('transaction_id',$transaction->id)->with('product')->get()
            ];
            Mail::to(Auth::user()->email)->send(new OrderMail($data));
        }

        return view('successcheckout')->withTransaction($data);
    }

    public function create(Request $request)
    {
        $userid = @Auth::user()->id;
        $cekcart = Cart::where('user_id',$userid)->where('is_claim',0)->with('cartdetail.product');
        if($cekcart->count() == 0){
            //create cart
            $createcart = new Cart();
            $createcart->user_id = $userid;
            $createcart->is_claim = 0;
            $createcart->save();
            //create cart detail
            $createdetail = new CartDetail();
            $createdetail->cart_id = $createcart->id;
            $createdetail->product_id = $request->id;
            $createdetail->qty = 1;
            $createdetail->save();
        }else{
            //update cart detail
            //cek product cart
            $cekcartdetail = CartDetail::where('cart_id',$cekcart->first()->id)->where('product_id',$request->id);
            if($cekcartdetail->count() == 0){
                $createdetail = new CartDetail();
                $createdetail->cart_id = $cekcart->first()->id;
                $createdetail->product_id = $request->id;
                $createdetail->qty = 1;
                $createdetail->save();
            }else{
                $cekcartdetail->update(['qty' => $cekcartdetail->first()->qty+1]);
            }
        }

    }

    public function updateqty(Request $request)
    {
        $userid = @Auth::user()->id;
        $cekcart = Cart::where('user_id',$userid)->where('is_claim',0)->with('cartdetail.product');
            //update cart detail
            //cek product cart
            $cekcartdetail = CartDetail::where('cart_id',$cekcart->first()->id)->where('product_id',$request->id);
            $cekcartdetail->update(['qty' => $request->qty]);

    }

    public function addqty(Request $request)
    {
        $userid = @Auth::user()->id;
        $cekcart = Cart::where('user_id',$userid)->where('is_claim',0)->with('cartdetail.product');
        if($cekcart->count() == 0){
            //create cart
            $createcart = new Cart();
            $createcart->user_id = $userid;
            $createcart->is_claim = 0;
            $createcart->save();
            //create cart detail
            $createdetail = new CartDetail();
            $createdetail->cart_id = $createcart->id;
            $createdetail->product_id = $request->productid;
            $createdetail->qty = $request->qty;
            $createdetail->save();
        }else{
            //update cart detail
            //cek product cart
            $cekcartdetail = CartDetail::where('cart_id',$cekcart->first()->id)->where('product_id',$request->productid);
            if($cekcartdetail->count() == 0){
                $createdetail = new CartDetail();
                $createdetail->cart_id = $cekcart->first()->id;
                $createdetail->product_id = $request->productid;
                $createdetail->qty = $request->qty;
                $createdetail->save();
            }else{
                $cekcartdetail->update(['qty' => $cekcartdetail->first()->qty+$request->qty]);
            }
        }

    }

    public function delete(Request $request)
    {
        $deletecartdetail = CartDetail::where('id',$request->id)->delete();

    }

    public function checkout()
    {
        $userid = @Auth::user()->id;
        $cart = Cart::where('user_id',$userid)->where('is_claim',0)->with('cartdetail')->first();
        $cartdetail = CartDetail::where('cart_id', $cart->id)->get();
        $dataprovince = RajaOngkir::getprovince([],env('RAJAONGKIR_KEY'))['data']->rajaongkir->results;
        // dd($dataprovince);
        return view('checkout', ['cart_id' => $cart->id, 'cartdetail' => $cartdetail,'province' => $dataprovince]);
    }

    public function viewcart()
    {
        $userid = @Auth::user()->id;
        $cart = Cart::where('user_id',$userid)->where('is_claim',0)->with('cartdetail')->first();
        $cartdetail = CartDetail::where('cart_id', $cart->id)->get();
        //dd($cartdetail);
        return view('viewcart', ['cartdetail' => $cartdetail]);
    }

    public function gettotalprice()
    {
        $userid = @Auth::user()->id;
        $cekcart = Cart::where('user_id',$userid)->where('is_claim',0)->with('cartdetail.product');
        $cekcartdetail = CartDetail::where('cart_id',$cekcart->first()->id)->get();

        $prices = 0;
        foreach ($cekcartdetail as $cd)
        {
          $price = $cd->product->final_price * $cd->qty;
          $prices += $price;

        }
        return json_encode($prices);
    }

}
