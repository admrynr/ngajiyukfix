@extends('layouts-front.master')

@section('content')
<!-- breadcrumb start -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title">
                    <h2>login</h2></div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">login</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb end -->

<!--section start-->
<section class="login-page section-b-space">
    <div class="container ">
        <div class="row text-center">
            <div class="col-lg-3"></div>
            <div class="col-lg-6 text-left">
                <h3>Login</h3>
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
                    <form  action="{{ route('authenticate') }}" class="theme-form" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        </div>
                        <div class="d-flex justify-content-between">
                        <div class="p-0">
                        <button type="submit" class="btn btn-solid">Login</button>
                        </div>
                        <div class="p-0 align-self-center">
                        <a class="text-right align-middle" href="{{route('forgot')}}">Forgot Password</a>
                        </div>
                        </div>
                    </form>
                    <p class="mt-4 mb-0 text-center">Don't have account yet ? <a href="{{route('registerpage')}}">Register</a></p>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
</section>
<!--Section ends-->

@endsection