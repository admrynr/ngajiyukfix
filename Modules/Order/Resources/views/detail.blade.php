@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/morris/morris.css')}}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ $title }}</h4>

                <div class="state-information d-none d-sm-block">
                        <ol class="breadcrumb m-t-15">
                                <li class="breadcrumb-item ">
                                    <a href="#">Order Management</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Order Detail
                                </li>
                            </ol>
                    {{-- <div class="state-graph">
                        <div style="font-size: 20pt;margin-bottom: -5px;color:black" id="total"></div>
                        <div class="info">Total {{ $title }}</div>
                    </div> --}}

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            @if($errors->has('success'))
            <div class="alert alert-success bg-success text-white font-16 " style="font-weight:bold">
                {{ $errors->first('success') }}
            </div>
            @endif
            <div class="card m-b-20">
                    <div class="card-body">
                        <form action="{{route('shop.update')}}" method="POST">
                                @csrf
                                <!--<input type="hidden" name="page" value="shop-information">-->
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                              @foreach ($trandetail as $trandetails)
                                <li class="nav-item">
                                    <a class="nav-link active show" data-toggle="tab" href="#home1" role="tab" style="font-size:12pt" aria-selected="true"> {{$trandetails->product->product_name}}</a>
                                </li>
                                @endforeach
                                {{-- <li class="nav-item">
                                    <a class="nav-link " data-toggle="tab" href="#profile1" role="tab" style="font-size:12pt" aria-selected="false">shop Information</a>
                                </li> --}}
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                              @foreach($trandetail as $td)
                                <div class="tab-pane p-3 active show" id="home1" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Product</label>
                                                <div>
                                            <img id="fotoimage" style="width:150px" src="{{url('images/'.$td->product->image)}}">
                                          </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Product Description</label>
                                                <textarea class="form-control" rows="3" type="text" name="description" disabled >{!!$td->product->product_description!!}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Qty</label>
                                            <input class="form-control" type="text" name="qty" value="{{ $td->qty }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Price</label>
                                            <input class="form-control" type="text" name="price" value="IDR {{ number_format($td->product->final_price) }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Products</label>
                                            <input class="form-control" type="text" name="total_price" value="IDR {{ number_format($tran->total_final_price) }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Shipping Price</label>
                                            <input class="form-control" type="text" name="ship_price" value="IDR {{ number_format( $tran->shipping_price) }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tax</label>
                                            <input class="form-control" type="text" name="tax_price" value="IDR {{ number_format( $tran->tax) }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Total Paid</label>
                                            <input class="form-control" type="text" name="total_price" value="IDR {{ number_format($tran->total_price) }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <h4>shipping address</h4>
                                            <ul class="order-detail">
                                            <li>Receiver : {{ $tran->receiver_name }}</li>
                                            <li>Address : {{ $tran->address }}</li>
                                            <li>Courier : {{ $tran->shipping_type }}</li>
                                            <li>Estimate time : {{ $tran->estimate_date }} Days</li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                                @endforeach
                                </div>
                        </div>
                </form>
                </div>
            </div>
        </div>

    </div>
    <!-- end row -->

</div> <!-- end container-fluid -->
@endsection
@section('data-content')
    {{-- @include('user::form.user') --}}
@endsection

@section('script-bottom')

@endsection
