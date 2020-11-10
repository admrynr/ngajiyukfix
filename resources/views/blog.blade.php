@extends('layouts-front.master')

@section('content')
<!-- breadcrumb start -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title">
                    <h2>blog</h2></div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">blog</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb end -->

<!-- section start -->
<section class="section-b-space blog-page ratio2_3">
    <div class="container">
        <div class="row">
            <!--Blog sidebar start-->
            <div class="col-xl-3 col-lg-4 col-md-5">
                <div class="blog-sidebar">
                    <div class="theme-card">
                        <h4>Recent Blog</h4>
                        <ul class="recent-blog">
                          @foreach ($blog as $b)
                            <li>
                                <div class="media"><img class="img-fluid blur-up lazyload" src="{{url('images/'.$b->thumbnail)}}" alt="Generic placeholder image">
                                    <div class="media-body align-self-center">
                                        <h6>{{$b->date}}</h6>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <!--
                    <div class="theme-card">
                        <h4>Popular Blog</h4>
                        <ul class="popular-blog">
                          @foreach ($blog as $blogs)
                            <li>
                                <div class="media">
                                    <div class="blog-date"><span>{{ date('d',strtotime($blogs->date)) }} </span><span>{{ date('M',strtotime($blogs->date)) }}</span></div>
                                    <div class="media-body align-self-center">
                                        <h6>{{$blogs->title}}</h6>
                                        <p>0 hits</p>
                                    </div>
                                </div>
                                <p>{!!$blogs->content!!}</p>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                  -->
                </div>
            </div>
            <!--Blog sidebar start-->
            <!--Blog List start-->
            <div class="col-xl-9 col-lg-8 col-md-7 order-sec">
                @foreach ($blog as $bl)
                <div class="row blog-media">
                    <div class="col-xl-6">
                        <div class="blog-left">
                            <a href="{{route('blogdetail', ['id' => $bl->id])}}"><img src="{{url('images/'.$bl->thumbnail)}}" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="blog-right">
                            <div>
                                <h6>{{$bl->date}}</h6><a href="{{route('blogdetail', ['id' => $bl->id])}}"><h4>{{$bl->title}}</h4></a>
                                <ul class="post-social">
                                    <li>Posted By : {{$bl->user->name}}</li>
                                </ul>
                                <p>{!!$bl->content!!}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!--Blog List start-->
        </div>
    </div>
</section>
<!-- Section ends -->
@endsection
