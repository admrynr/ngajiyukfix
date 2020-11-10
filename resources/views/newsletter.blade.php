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
                                        <li ><a href="{{route('dashboard')}}">Account Info</a></li>
                                        <li><a href="{{route('addressbook')}}">Address Book</a></li>
                                        <li><a href="{{route('myorder')}}">My Orders</a></li>
                                        <li><a href="#">My Wishlist</a></li>
                                        <li class="active"><a href="{{route('newsletter')}}">Newsletter</a></li>
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
                                        <h2>Newsletter Subscription</h2></div>
                                    <div class="welcome-msg">
                                        <p>Hello, {{$user->name}} !</p>
                                        <p>This is your newsletter subscription dashboard</p>
                                    </div>
                                    <div class="box-account box-info">
                                        <div class="box-head">
                                            <h2>Subscription</h2></div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="box">
                                                  <div class="box-title">
                                                      <h3>Switch this button to activate/deactivate subscription</h3></div>
                                                  <div class="box-content">
                                                  <label class="switch">
                                                  <input type="checkbox" checked autocomplete="off">
                                                  <span class="slider round"></span>
                                                  </label>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- section end -->
@endsection
