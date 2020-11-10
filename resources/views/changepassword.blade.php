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
                                        <li><a href="{{route('myorder')}}">My Orders</a></li>
                                        <li><a href="#">My Wishlist</a></li>
                                        <li><a href="{{route('newsletter')}}">Newsletter</a></li>
                                        <li><a href="{{route('myaccount')}}">My Account</a></li>
                                        <li class="active"><a href="{{route('changepassword')}}">Change Password</a></li>
                                        <li class="last"><a href="#">Log Out</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="dashboard-right">
                                <div class="dashboard">
                                    <div class="page-title">
                                        <h2>Change Password</h2></div>
                                    <div style="margin-bottom: 15px;"class="welcome-msg">
                                        <p>Edit Your Account Information</p>
                                    </div>
                                    <div class="box-account box-info">
                                            <div class="row">
                                        <div class="col-sm-12">
                                            <form class="theme-form">
                                                <div class="form-row">
                                                    <div class="col-md-12">
                                                      @php
                                                      $name = explode(" ", $user->name)
                                                      @endphp
                                                        <label for="name">Old Password</label>
                                                        <input style="margin-bottom: 15px;" type="password" class="form-control" id="name" placeholder="Insert Old Password" required="">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="email">New Password</label>
                                                        <input style="margin-bottom: 15px;" type="password" class="form-control" id="last-name" placeholder="Insert New Password" required="">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div style="padding-left: 0;padding-right: 0;" class="col-md-12">
                                        <button class="btn btn-sm btn-solid" type="submit">Change Password</button>
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
