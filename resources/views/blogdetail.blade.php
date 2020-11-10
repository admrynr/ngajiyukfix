@extends('layouts-front.master')

@section('content')
<!-- breadcrumb start -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title">
                    <h2>Blog Detail</h2></div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('homepage')}}">home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">blog</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb end -->

<!--section start-->
<section class="blog-detail-page section-b-space ratio2_3">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 blog-detail"><img src="{{url('images/'.$blog->thumbnail)}}" class="img-fluid blur-up lazyload mx-auto" alt="">
                <h3>{{$blog->title}}</h3>
                <ul class="post-social">
                    <li>{{$blog->date}}</li>
                    <li>Posted By : {{$blog->user->name}}</li>

                </ul>
                <p>{!!$blog->content!!}</p>
            </div>
        </div>
    </div>
</section>
<!--Section ends-->
<!-- Section ends -->
@endsection
