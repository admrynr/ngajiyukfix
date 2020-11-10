@extends('layouts-front.master')

@section('content')
<!-- breadcrumb start -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title">
                    <h2>register</h2></div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">register</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb end -->

<!--section start-->
<section class="register-page section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-6">
                <h3>create account</h3>
                @if ($errors->any())
                     <div class="alert {{ $errors->has('success') ? 'bg-success alert-success' : 'bg-danger alert-danger'}} text-white">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="theme-card">
                    <form action="{{ route('regstore') }}" id="register-form" class="theme-form" method="POST" >
                        {{ csrf_field() }}
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="email">First Name</label>
                                <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name" required="">
                            </div>
                            <div class="col-md-6">
                                <label for="review">Last Name</label>
                                <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" required="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <label for="email">email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required="">
                            </div>
                            <div class="col-md-12">
                                <label for="review">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required="">
                            </div>
                          
                        </div>
                        <button type="submit" class="btn btn-solid ">create Account</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-3">
                </div>
        </div>
    </div>
</section>
<!--Section ends-->

@endsection