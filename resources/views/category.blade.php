@extends('layouts-front.master')

@section('content')
<!-- breadcrumb start -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title">
                    <h2>category</h2></div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">category</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb end -->


<div class="container mt-5 mb-5">
<!-- category 2 -->
<section class="p-0 ratio2_1">
        <div class="container-fluid">

            <div class="row category-border" style="background-color:transparent;">
                    @foreach ($category as $cat)
                <div class="col-sm-3 cat-slide border-padding">
                    <div class="category-banner" style="margin-bottom:25px;box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);border-radius:0;">
                        <div>
                            <img src="
                            @if ($cat->image != null)
                            {{url('images/'.$cat->image)}}
                            @else {{asset('assets-front/images/cat1.png')}}
                            @endif
                            " class="img-fluid blur-up lazyload bg-img" alt="">
                        </div>
                        <div class="category-box">
                            <a href="{{route('category_detail', ['$id' => $cat->id])}}">
                                <h2 style="font-size:14px;padding:10px 10px">{{$cat->name}}</h2>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            {{$category->links()}}
        </div>
    </section>
</div>
@endsection
