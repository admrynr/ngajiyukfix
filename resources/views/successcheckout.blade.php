@extends('layouts-front.master')

@section('content')
<!-- thank-you section start -->
<section class="section-b-space light-layout">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="success-text"><i class="fa fa-check-circle" aria-hidden="true"></i>
                    <h2>thank you</h2>
                    @if($transaction['transaction']->status == 1)
                    <p>Please complete your payment to process your order</p>
                    @else
                    <p>Payment is successfully processsed and your order is on the way</p>
                    @endif
                    <p>Transaction ID : <span class="text-primary">{{ $transaction['transaction']->invoice_number }}</span></p>
                    <p>Transaction Status : <span {{ $transaction['transaction']->status == 1 ? 'class=text-info' : 'class:text-success' }}>{{ $transaction['transaction']->status == 1 ? 'Waiting for payment' : 'Transaction Success' }}</span></p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section ends -->


<!-- order-detail section start -->
<section class="section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="product-order">
                    <h3>your order details</h3>
                    @foreach($transaction['detailtransaction'] as $tran)
                    <div class="row product-order-detail">
                        <div class="col-3"><img src="{{asset('images/'.$tran->product->image)}}" alt="" class="img-fluid blur-up lazyload"></div>
                        <div class="col-3 order_detail">
                            <div>
                                <h4>product name</h4>
                            <h5>{{ $tran->product->product_name }}</h5></div>
                        </div>
                        <div class="col-3 order_detail">
                            <div>
                                <h4>quantity</h4>
                            <h5>{{ $tran->qty }}</h5></div>
                        </div>
                        <div class="col-3 order_detail">
                            <div>
                                <h4>price</h4>
                            <h5>IDR {{ number_format($tran->product->final_price) }}</h5></div>
                        </div>
                    </div>
                    @endforeach
                    <div class="total-sec">
                        <ul>
                        <li>subtotal <span>IDR {{ number_format($transaction['transaction']->total_final_price) }}</span></li>
                            <li>shipping <span>IDR {{ number_format($transaction['transaction']->shipping_price) }}</span></li>
                            <li>tax(GST) <span>IDR {{ number_format($transaction['transaction']->tax) }}</span></li>
                        </ul>
                    </div>
                    <div class="final-total">
                        <h3>total <span>IDR {{ number_format($transaction['transaction']->total_price) }}</span></h3></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row order-success-sec">
                    <div class="col-sm-6">
                        <h4>Summary</h4>
                        <ul class="order-detail">
                            <li>Transaction ID: {{$transaction['transaction']->invoice_number}}</li>
                            <li>Order Date: {{$transaction['transaction']->created_at}}</li>
                        <li>Order Total: IDR {{number_format($transaction['transaction']->total_price)}}</li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <h4>shipping address</h4>
                        <ul class="order-detail">
                        <li>Receiver : {{ $transaction['transaction']->receiver_name }}</li>
                        <li>Address : {{ $transaction['transaction']->address }}</li>
                        <li>Courier : {{ $transaction['transaction']->shipping_type }}</li>
                        <li>Estimate time : {{ $transaction['transaction']->estimate_date }} Days</li>
                        </ul>
                    </div>
                    <div class="col-sm-12 payment-mode" style="margin-top:20px">
                        <h4>payment method</h4>
                    <p>See more instruction <a href="{{ $transaction['transaction']->midtrans_pdf_url }}" target="_blank">here</a>.</p>
                    </div>
                    {{-- <div class="col-md-12">
                        <div class="delivery-sec">
                            <h3>expected date of delivery</h3>
                            <h2>october 22, 2018</h2></div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section ends -->
@endsection
@section('scripts')

@endsection