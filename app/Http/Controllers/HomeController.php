<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Models\Product;
use App\Http\Models\ProductMedia;
use App\User;
use App\Http\Models\Categories;
use App\Http\Models\Video;
use App\Http\Models\Blog;
use App\Http\Models\Cart;
use App\Http\Models\Auction;
use App\Http\Models\AuctionParticipant;
use App\Http\Models\CartDetail;
use App\Http\Models\Transaction;
use App\Http\Models\TransactionDetail;
use App\Http\Models\NewsletterSubscriber;
use App\Mail\NewsletterMail;
use Illuminate\Support\Facades\Mail;
use App\Helpers\RajaOngkir;
use Veritrans_Config;
use Veritrans_Snap;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /*index*/
    public function index()
    {
      $video = Video::limit(5)->get();
      //dd($video->thumbnail);

      return view('index')->withVideos($video);
    }

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
    /*public function index()
    {
      $category = Categories::where('is_featured', 1)->get();
      $blog = Blog::all();
      $new = Product::orderBy('id', 'desc')->take(4)->get();
      $feature = Product::where('is_featured', 1)->take(4)->get();
      $bestsell = TransactionDetail::selectRaw('product_id, COUNT(*)')->groupBy('product_id')->orderBy('COUNT(*)', 'desc')->take(4)->get();
      //auction
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

      $todayauction = Auction::whereDate('bid_end',$datenow)->where('status',2)->with('product.categories','winner')->limit(2)->get();

        return view('home', ['auction' => $todayauction, 'blog' => $blog, 'category' => $category, 'new' => $new, 'feature' => $feature, 'bestsell' => $bestsell]);
    }*/

    public function product()
    {
        $product = Product::with('transactiondetail')->paginate(4);
        $category = Categories::all();
        $new = Product::orderBy('id', 'desc')->take(4)->get();
        $feature = Product::where('is_featured', 1)->take(4)->get();
        $besttran = TransactionDetail::selectRaw('product_id, COUNT(*)')->groupBy('product_id')->orderBy('COUNT(*)', 'desc')->get();
        $pro = Product::doesntHave('transactiondetail')->get();
        $products = Product::with('transactiondetail')->paginate(4)->sortBy(function($product)
{
    return $product->transactiondetail->count();
});
        //$products = $product->doesntHave('transactiondetail')->get();

        //$pro = Product::with('transactiondetail')->where('id', $besttran->product_id);
        // dd($products);
        return view('product', ['product' => $product, 'category' => $category]);
    }

    public function sortnew()
    {
        $new = Product::orderBy('id', 'desc')->paginate(4);
        //$besttran = TransactionDetail::selectRaw('product_id, COUNT(*)')->groupBy('product_id')->orderBy('COUNT(*)', 'desc')->take(4)->get();
        $category = Categories::all();

        $returnHTML = view('product', ['product' => $new, 'category' => $category])->render();
        return response()->json(array('success' => true, 'content'=>$returnHTML));
    }

    public function sortpricelow()
    {
        $new = Product::orderBy('final_price', 'asc')->paginate(4);
        //$besttran = TransactionDetail::selectRaw('product_id, COUNT(*)')->groupBy('product_id')->orderBy('COUNT(*)', 'desc')->take(4)->get();
        $category = Categories::all();

        $returnHTML = view('product', ['product' => $new, 'category' => $category])->render();
        return response()->json(array('success' => true, 'content'=>$returnHTML));
    }

    public function sortpricehigh()
    {
        $new = Product::orderBy('final_price', 'desc')->paginate(4);
        //$besttran = TransactionDetail::selectRaw('product_id, COUNT(*)')->groupBy('product_id')->orderBy('COUNT(*)', 'desc')->take(4)->get();
        $category = Categories::all();

        $returnHTML = view('product', ['product' => $new, 'category' => $category])->render();
        return response()->json(array('success' => true, 'content'=>$returnHTML));
    }

    public function sortpopular()
    {
      $products = Product::with('transactiondetail')->paginate(4)->sortBy(function($product)
      {
      return $product->transactiondetail->count();
    });
    $category = Categories::all();

    $returnHTML = view('product', ['product' => $products, 'category' => $category])->render();

        return response()->json(array('success' => true, 'content'=>$returnHTML));
    }

    public function blog()
    {
        $blog = Blog::all();
        //dd($blog->find(1)->categories->name);
        $year = DB::select('select YEAR(date) as year from blog GROUP BY YEAR(date)');
        //dd($year);

        return view('blog', ['blogs' => $blog, 'years' => $year]);
    }

    public function blogdetail($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blogdetail', ['blog' => $blog]);
    }

    public function login()
    {
        return view('login');
    }

    public function registerpage()
    {
        return view('registerpage');
    }

    public function dashboard()
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        $cart = Cart::where('user_id', $id)->limit(5)->get();
        return view('dashboard', ['user' => $user, 'cart' => $cart]);
    }

    public function myauction()
    {
      $id = Auth::user()->id;
      $user = User::findOrFail($id);

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

        //$auctwithid = AuctionParticipant::with('auction')->where('user_id', $id)->get();
        $todayauction = Auction::whereHas('participant', function($q){
          $q->where('user_id', Auth::user()->id);
        })->whereDate('bid_end',$datenow)->with('product.categories','winner')->get();
        $allauction = Auction::whereHas('participant', function($q){
          $q->where('user_id', Auth::user()->id);
        })->whereDate('bid_end','!=',$datenow)->with('product.categories','winner')->get();
        $category = Categories::all();
        $auctionpar = AuctionParticipant::with('auction')->get();

        return view('myauction', ['user' => $user, 'product' => $todayauction, 'allauction' => $allauction, 'category' => $category, 'auctionpar' => $auctionpar]);
    }

    public function myaccount()
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        return view('myaccount', ['user' => $user]);
    }

    public function addressbook()
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        $dataprovince = RajaOngkir::getprovince([],env('RAJAONGKIR_KEY'))['data']->rajaongkir->results;
        return view('addressbook', ['user' => $user,'province' => $dataprovince]);
    }

    public function changepassword()
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        return view('changepassword', ['user' => $user]);
    }

    public function myorder()
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        $tran = Transaction::where('user_id', $id)->get();
        return view('myorder', ['user' => $user, 'tran' => $tran]);
    }

    public function orderhistory()
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        $tran = Transaction::where('user_id', $id)->get();
        return view('orderhistory', ['user' => $user, 'tran' => $tran]);
    }

    public function newsletter()
    {
      $id = Auth::user()->id;
      $user = User::findOrFail($id);
      $ns = NewsletterSubscriber::findOrFail(1);
      return view('newsletter', ['user' => $user, 'newsletter' => $ns]);
    }

    public function mailtemplate()
    {
        return view('mails.forgottemplate', ['name'=>'Bambang'], ['link'=>'link']);
    }

    public function forgot()
    {
        return view('forgot');
    }

    public function video(Request $request)
    {
        $category = Categories::all();
        if ($request->filter == 'all' || empty($request->filter))
        $video = Video::paginate(6);
        else
        $video = Video::where('id_category', $request->filter)->paginate(6);

        return view('video', ['categories' => $category, 'videos' => $video]);
    }

    public function videodetail($id)
    {
      $video = Video::where('id_video', $id)->first();
      //dd($video);

      return view('videodetail')->withVideo($video);
    }

    public function categorydetail($id)
    {
        $category = Categories::findOrFail($id);
        $product = Product::where('categories_id', $id)->get();

        return view('category_detail', ['category' => $category, 'product' => $product]);
    }

    public function product_detail($id)
    {
        $product = Product::findOrFail($id);
        $media = ProductMedia::where('products_id', $product->id)->get();

        return view('product_detail', ['product' => $product, 'media' => $media]);
    }

    public function subscribe(Request $request)
    {
      $ceksub = NewsletterSubscriber::where('email', $request->mail);
      if($ceksub->count() == 0)
      {
        $subscriber = new NewsletterSubscriber();
        $subscriber->email = $request->mail;
        $subscriber->is_active = 1;
        $subscriber->save();
        $var = array(
            'name' => Auth::user()->name,
        );
        Mail::to($request->mail)->send(new NewsletterMail($var));
        $data = [
          'status' => 1,
          'message' => 'Newsletter subscribed successfully. Check your email for more information'
        ];
      }else
        {
          $data = [
            'status' => 2,
            'message' => 'Email has already subscribed'
          ];
        }
        return json_encode($data);
    }

    public function orderdetail($id)
    {
      $tran = Transaction::findOrFail($id);
      $trandetail = TransactionDetail::where('transaction_id', $id)->with('product')->get();

      return view('orderdetail', ['tran' => $tran, 'trandetail' => $trandetail]);

    }

}
