<?php

namespace Modules\Shop\Http\Controllers;

use App\Http\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Http\Models\Company;
use App\Http\Models\Content;
use App\Http\Models\PaymentBank;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $section = [
            'statusshipping',
        ];

        foreach($section as $key){
            $datacontent[$key] = @Content::where('page','shop-shipping')->where('section',$key)->first()->content;
        }
        
        $banklist = PaymentBank::get();
        $bank = Bank::get();

        $gateway = Content::where('page','payment-gateway')->get();

        return view('shop::shipping')->withTitle('Shipping')->withShop($datacontent)->withBanklist($banklist)->withBank($bank)->withGateway($gateway);
    }
    
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('company::create');
    }


    public function createbanklist(Request $request)
    {
        $createbank = new PaymentBank();
        $createbank->bank_name = $request->bank_name;
        $createbank->account_name = $request->account_name;
        $createbank->account_number = $request->account_number;
        $createbank->save();

        return redirect()->back()->withErrors(['success' => 'Success Create Bank']);
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
    public function deletebank(Request $request)
    {
        $bank = PaymentBank::where('id',$request->id)->delete();

        return redirect()->back()->withErrors(['success' => 'Success Delete Bank']);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request)
    {
        $statuspayment = Content::where('page','shop-shipping')->where('section', 'statusshipping')->get();
        if($statuspayment->count() == 0){
            $createcontent = new Content();
            $createcontent->page = 'shop-shipping';
            $createcontent->section = 'statusshipping';
            $createcontent->content = $request->status;
            $createcontent->save();
        }else{
            $updatecontent = Content::findOrFail($statuspayment->first()->id);
            $updatecontent->content = $request->status;
            $updatecontent->save();
        }
    }

    public function updatestatusmanual(Request $request)
    {
        //cek status 
        $statuspayment = Content::where('page','shop-payment')->where('section', 'statusmanual')->get();
        if($statuspayment->count() == 0){
            $createcontent = new Content();
            $createcontent->page = 'shop-payment';
            $createcontent->section = 'statusmanual';
            $createcontent->content = $request->status;
            $createcontent->save();
        }else{
            $updatecontent = Content::findOrFail($statuspayment->first()->id);
            $updatecontent->content = $request->status;
            $updatecontent->save();
        }
    }

    public function updatestatusgateway(Request $request)
    {
        //cek status 
        $statuspayment = Content::where('page','shop-payment')->where('section', 'statusgateway')->get();
        if($statuspayment->count() == 0){
            $createcontent = new Content();
            $createcontent->page = 'shop-payment';
            $createcontent->section = 'statusgateway';
            $createcontent->content = $request->status;
            $createcontent->save();
        }else{
            $updatecontent = Content::findOrFail($statuspayment->first()->id);
            $updatecontent->content = $request->status;
            $updatecontent->save();
        }
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