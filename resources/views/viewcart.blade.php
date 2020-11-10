@extends('layouts-front.master')

@section('content')
<!-- breadcrumb start -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title">
                    <h2>checkout</h2></div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">checkout</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb end -->

        @php
            $totalprice = 0;
        @endphp
        @foreach($cartdetail as $dets)
        @php
            $totalprice = (int)$totalprice + ((int)$dets->qty*(int)$dets->product->final_price);
        @endphp
        @endforeach

<!--section start-->
<section class="cart-section section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <table class="table cart-table table-responsive-xs">
                        <thead>
                        <tr class="table-head">
                            <th scope="col">image</th>
                            <th scope="col">product name</th>
                            <th scope="col">price</th>
                            <th scope="col">quantity</th>
                            <th scope="col">action</th>
                            <th scope="col">total</th>
                        </tr>
                        </thead>
                        @foreach($cartdetail as $dets)
                        <tbody>
                            <tr>
                            <td>
                                <a href="{{route("product_detail", ['id' => $dets->product_id])}}"><img src="{{asset('images/'.$dets->product->image)}}" alt=""></a>
                            </td>
                            <td><a href="{{route("product_detail", ['id' => $dets->product_id])}}">{{$dets->product->product_name}}</a>
                                <div class="mobile-cart-content row">
                                    <div class="col-xs-3">
                                        <div class="qty-box">
                                            <div class="input-group">
                                            <input type="text" name="quantity" class="form-control input-number" data-price="{{$dets->product->final_price}}"data-prodid="{{$dets->product_id}}" value="{{$dets->qty}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <h2 class="td-color">IDR {{number_format($dets->product->final_price)}}</h2></div>
                                    <input type="hidden" name="baseprice" id="baseprice{{ $dets->id }}" value="{{ $dets->product->final_price }}">
                                    <div class="col-xs-3">
                                        <h2 class="td-color"><a href="#" class="icon"><i class="ti-close"></i></a></h2></div>
                                </div>
                            </td>
                            <td>
                                <h2>IDR {{number_format($dets->product->final_price)}}</h2></td>
                            <td>
                                <div class="qty-box">
                                    <div class="input-group">
                                    <input type="number"  name="quantity" min="1" class="form-control input-number qty" data-productid="{{ $dets->product_id }}" data-id="{{ $dets->id }}" value="{{$dets->qty}}">
                                    </div>
                                </div>
                            </td>
                            <td><a href="#" class="icon"><i class="ti-close"></i></a></td>
                            <td class="text-left">
                            <h2 class="td-color">IDR <span class="pull-right subtotal" id="finalprice{{ $dets->id }}">{{number_format($dets->product->final_price * $dets->qty)}}</span></h2></td>
                        </tr>
                        @endforeach

                        <tr>
                            <td  class="text-right" colspan="5"><h4 style="padding-top:5px">TOTAL PRICE :</h4></td>
                            <td class="text-left">
                                <h2 class="totalprice ">IDR <span id="totalprice" class="pull-right">{{number_format($totalprice)}}</span></h2>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
            <div class="row cart-buttons">
                <div class="col-6"><a href="{{route('product')}}" class="btn btn-solid">continue shopping</a></div>
                <div class="col-6"><a href="{{route('cart.checkout')}}" class="btn btn-solid">check out</a></div>
            </div>
        </div>
    </section>
    <!--section end-->
@endsection
@section('scripts')
    <script type="text/javascript">
    $(window).on('load',function(){
        $('.qty').on('change',function(){
            id = $(this).data('id');
            productid = $(this).data('productid');
            qty = $(this).val();
            baseprice = $('#baseprice'+id).val();
            finalprice = baseprice*qty;
            $('#finalprice'+id).html(formatNumber(finalprice.toString()));
            updatecart(productid, qty);
            getcart();
            gettotalprice();
        });
    });
    </script>
@endsection
