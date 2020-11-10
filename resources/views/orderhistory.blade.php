@extends('layouts-front.master')

@section('content')
<!-- breadcrumb start -->
<div class="breadcrumb-section">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="page-title">
                                <h2>Dashboard</h2></div>
                        </div>
                        <div class="col-sm-6">
                            <nav aria-label="breadcrumb" class="theme-breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- breadcrumb End -->


            <!-- section start -->
            <section class="section-b-space">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="account-sidebar"><a class="popup-btn">my account</a></div>
                            <div class="dashboard-left">
                                <div class="collection-mobile-back"><span class="filter-back"><i class="fa fa-angle-left" aria-hidden="true"></i> back</span></div>
                                <div class="block-content">
                                    <ul>
                                        <li><a href="{{route('dashboard')}}">Account Info</a></li>
                                        <li><a href="{{route('addressbook')}}">Address Book</a></li>
                                        <li class="active"><a href="{{route('myorder')}}">My Orders</a></li>
                                        <li><a href="#">My Wishlist</a></li>
                                        <li><a href="{{route('newsletter')}}">Newsletter</a></li>
                                        <li><a href="{{route('myaccount')}}">My Account</a></li>
                                        <li><a href="{{route('changepassword')}}">Change Password</a></li>
                                        <li class="last"><a href="#">Log Out</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="dashboard-right">
                                <div class="dashboard">
                                    <div class="page-title">
                                    <h2>Order History </h2>
                                        
                                    </div>
                                    <div class="welcome-msg">
                                        <p>Hello, {{$user->name}} ! Check your order here.</p>
                                        <h6>You have <a href="#">{{$tran->where('status','>',1)->count()}}</a> processed order. Have a look at it.</h6>

                                    </div>
                                    <div class="box-account box-info">

                                        <div class="row">
                                            <div class="col-sm-12">
                                                    @foreach ($tran->where('status','>', 1) as $trans)
                                                <div class="box" style="border : 1px solid #ddd;padding: 15px">
                                                    <div class="box-title" style="padding-top:0px">
                                                        <h3 style="font-size:18pt;">#{{$trans->invoice_number}}</h3>
                                                        
                                                    </div>
                                                    <div class="box-content">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p>Order Date : <br>{{ $trans->created_at }}</p>
                                                                <p>Shipment Address : <br>{{ $trans->address }}</p>
                                                            </div>
                                                            <div class="col-md-6 text-right">
                                                            <p style="font-size:12pt;text-transform:uppercase">STATUS : <b {{ $trans->status == 1 ? 'class=text-info' : 'class:text-success' }}>{{ $trans->status == 1 ? 'Waiting for payment' : 'Transaction Success' }}</b></p>
                                                            <p style="font-size:12pt;text-transform:uppercase">TOTAL : <b class="text-primary">IDR {{number_format($trans->total_price)}}</b></p>
                                                            </div>
                                                            <div class="col-md-12 text-right">
                                                                    <a href="{{route('orderdetail', ['id' => $trans->id])}}" class="btn btn-solid btn-sm">Detail</a>
                                                            </div>
                                                        </div>
                                                       
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            {{-- <div class="col-sm-6">
                                                <div class="box">
                                                    <div class="box-title">
                                                        <h3>Completed Order</h3></div>
                                                    <div class="box-content">
                                                        <h6>Your Complete Order History.</h6>

                                                        <h6><a href="#">See All</a></h6></div>
                                                </div>
                                            </div> --}}
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- section end -->
@endsection
