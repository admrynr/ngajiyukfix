<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Models\Auction;
use App\Http\Models\Categories;
use Illuminate\Routing\Controller;
use Auth;
use App\Http\Models\AuctionParticipant;
use App\Helpers\RajaOngkir;
use App\Http\Models\Transaction;
use App\Http\Models\TransactionDetail;
use Veritrans_Config;
use Veritrans_Snap;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Mail;



class AuctionController extends Controller
{
  public function auction()
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

      $datenow = date('Y-m-d',strtotime('now'));

      $todayauction = Auction::whereDate('bid_end',$datenow)->with('product.categories','winner')->get();
      $allauction = Auction::whereDate('bid_end','!=',$datenow)->with('product.categories','winner')->get();
      $category = Categories::all();
      $auctionpar = AuctionParticipant::with('auction')->get();
      //dd($auction->find(1)->participant->where('auction_id', 1)->last()->bid);

      return view('auction', ['product' => $todayauction, 'allauction' => $allauction, 'category' => $category, 'auctionpar' => $auctionpar]);
  }

  public function auctionorder(Request $request)
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
            $auction = Auction::where('id',$request->auction_id)->with('product')->first();
            $totalbaseprice = $auction->product->base_price;
            $totalfinalprice = $auction->fixed_price;

            $paramdetail = [
                'transaction_id' => $newtransaction->id,
                'product_id' => $auction->product_id,
                'qty' => 1,
                'total_final_price' => $totalfinalprice,
                'total_base_price' => $totalbaseprice,
            ];

            $newtransactiondetail = new TransactionDetail($paramdetail);
            $newtransactiondetail->save();
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

  public function bidend(Request $request)
  {
      $auction = Auction::where('id',$request->id)->with('participant')->first();
      if(count($auction->participant) == 0){
          $updateauction = Auction::where('id',$auction->id)->update(['status' => 4]);
          $status = 4;
      }else{
          $winner = collect($auction->participant)->sortBy('bid');
          $updateauction = Auction::where('id',$auction->id)->update(['status' => 3,'winner_id' => $winner[0]->user_id,'winner_bid' => $winner[0]->bid]);
          $status = 3;
      }
      $data = (object)[
        'winner' => empty($winner[0]) ? '-' : $winner[0]->name,
        'winnerbid' =>  empty($winner[0]) ? '-' : $winner[0]->bid,
        'status' => $status
      ];
      return json_encode($data);
  }

  public function auctiondetail($id)
  {
      $auction = Auction::with('product.categories','product.product_media')->where('id',$id)->first();
      $auctionpar = AuctionParticipant::with('auction','user')->where('auction_id',$id)->orderBy('created_at','desc')->get();
      //dd($auction->find(1)->participant->where('auction_id', 1)->last()->bid);
      return view('auction_detail', ['auction' => $auction, 'auctionpar' => $auctionpar]);
  }

  public function auctioncheckout(Request $request)
  {
      $userid = @Auth::user()->id;
      $auction = Auction::where('id',$request->auction_id)->with('product')->first();
      $dataprovince = RajaOngkir::getprovince([],env('RAJAONGKIR_KEY'))['data']->rajaongkir->results;
      // dd($dataprovince);
      return view('auctioncheckout', ['auction' => $auction,'province' => $dataprovince]);
  }

  public function getmidtranstoken(Request $request){
      // dd($request->all());
      $auction = Auction::where('id',$request->auction_id)->first();
      $itemdetail[] = [
          'id' => $auction->product->id,
          'price' => $auction->fixed_price,
          'quantity' => 1,
          'name' => $auction->product->product_name,
          'category' => $auction->product->categories->name
      ];
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

    public function dobid(Request $request)
    {
      $val = (int)str_replace(".","",str_replace("Rp. ","", $request->bidparam));
      $userid = Auth::user()->id;
      $auction = Auction::with('product.categories')->get();
      if($auction->find($request->auctionid)->participant->where('user_id', $userid)->count() == 0){
        $auctionpart = new AuctionParticipant;
        $auctionpart->user_id = $userid;
        $auctionpart->auction_id = $request->auctionid;
        $auctionpart->bid = (int)str_replace(".","",str_replace("Rp. ","", $request->bidparam));
        $auctionpart->save();
          $data = [
            'status' => "Success",
            'message' => 'Bid placed Successfully'
          ];
      }else if ( $val < $auction->find($request->auctionid)->participant->where('user_id', $userid)->last()->bid)
      {
        $data = [
          'status' => "Warning",
          'message' => 'You can not bid less than your current value.'
        ];
      }else{
      $auctionpart = new AuctionParticipant;
      $auctionpart->user_id = $userid;
      $auctionpart->auction_id = $request->auctionid;
      $auctionpart->bid = (int)str_replace(".","",str_replace("Rp. ","", $request->bidparam));
      $auctionpart->save();
        $data = [
          'status' => "Success",
          'message' => 'Bid placed Successfully'
        ];
    }
    return json_encode($data);
    }

    public function gethighbid(Request $request)
    {
      $userid = Auth::user()->id;
      $auction = Auction::with('product.categories')->get();
      if(!empty(Auction::find($request->id)->with('participant')->get()))
      {
        if(!empty(AuctionParticipant::where('auction_id', $request->id)->where('user_id', $userid)->get()))
        {
          $data = [
            'highbid' => $auction->find($request->id)->participant->sortByDesc('bid')->first()->bid,
            'yourbid' => $auction->find($request->id)->participant->where('user_id', $userid)->last()->bid
          ];
        }else
        {
          $data = [
            'highbid' => $auction->find($request->id)->participant->sortByDesc('bid')->first()->bid,
            'yourbid' => '-'
          ];
        }
      }else
      {
        $data = [
          'highbid' => '-',
          'yourbid' => '-'
        ];
      }
      return json_encode($data);

    }


}
