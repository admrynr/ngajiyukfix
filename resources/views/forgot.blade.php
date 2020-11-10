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
<section class="pwd-page section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <h2>Forget Your Password</h2>
                    @if ($errors->any())
                     <div class="alert {{ $errors->has('success') ? 'bg-success alert-success' : 'bg-danger alert-danger'}} text-white">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                <form method="post" action="{{route('resetpassword')}}" class="theme-form">
                    @csrf
                        <div class="form-row">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="email" id="email" placeholder="Enter Your Email" required="">
                            </div><button type="submit" class="btn btn-solid">Submit</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--Section ends-->

@endsection