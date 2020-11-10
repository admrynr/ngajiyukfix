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
                                    <a href="#">Website Content</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Pages
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
                <div class="card m-b-20">
                    <div class="card-body">
                        <div class="row">
                        <div class="col-md-6 text-left">
                            <h4 class="header-title">{{ $title }} List</h4>
                        </div>
                        {{-- <div class="col-md-6 text-right">
                            <a href="{{ route('user.index') }}" class="btn {{ empty(Request::get('filter')) ? 'btn-primary' : 'btn-secondary' }} text-white">All (<span id="total"></span>)</a>
                            <a href="{{ route('user.index') }}?filter=active"  class="btn {{ !empty(Request::get('filter')) && Request::get('filter') == 'active' ? 'btn-primary' : 'btn-secondary' }} text-white">Active (<span id="active"></span>)</a>
                            <a href="{{ route('user.index') }}?filter=deactive"  class="btn {{ !empty(Request::get('filter')) && Request::get('filter') == 'deactive' ? 'btn-primary' : 'btn-secondary' }} text-white">Deactive (<span id="deactive"></span>)</a>
                            <a href="{{ route('user.index') }}?filter=trashed"  class="btn {{ !empty(Request::get('filter')) && Request::get('filter') == 'trashed' ? 'btn-primary' : 'btn-secondary' }} text-white">Trashed (<span id="trashed"></span>)</a>
                            <input type="hidden" id="filter" value="{{ empty(Request::get('filter')) ? 'all' : Request::get('filter') }}">
                        </div> --}}
                        </div>
                    </div>
                </div>
        </div>
        <!-- home -->
        <div class="col-xl-12">
            @if($errors->has('success'))
            <div class="alert alert-success bg-success text-white font-16 " style="font-weight:bold">
                {{ $errors->first('success') }}
            </div>
            @endif
            <div class="card m-b-20">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <h4 class="header-title">Home page</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="#" class="btn btn-primary text-white open" data-page="home">Edit Page Information</a>
                            <a href="{{ url('/') }}" target="_blank" class="btn btn-primary text-white">Edit Page Content</a>
                        </div>
                        </div>
                        <div id="drop-home" class="drop" style="display:none">
                        <hr>
                        <form action="{{ route('page.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="page" value="homepage">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-12">
                                            <label>Slider1</label>
                                    </div>
                                <div class="col-md-5">
                                    <img src="/images/slider/homepage-slider1.jpg" id="slider-homepage1" style="width:100%">
                                </div>
                                <div class="col-md-6">
                                    <input type="file" name="slider1" class="form-control slider-file" accept=".jpg" data-page="homepage1">
                                </div>
                                <div class="col-md-12">
                                        <label>Slider2</label>
                                </div>
                            <div class="col-md-5">
                                <img src="/images/slider/homepage-slider2.jpg" id="slider-homepage2" style="width:100%">
                            </div>
                            <div class="col-md-6">
                                <input type="file" name="slider2" class="form-control slider-file" accept=".jpg" data-page="homepage2">
                            </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                            <div class="col-md-12">
                            <p class="text-danger">This information is for meta tag that boosting this page SEO</p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Page Title</label>
                                <input class="form-control" type="text" name="title" value="{{ @$seo['homepage']['title'] }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Page Description</label>
                                    <textarea class="form-control" type="text" name="description">{{ @$seo['homepage']['description'] }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Page Keyword</label>
                                    <input class="form-control" type="text" name="keyword" value="{{ @$seo['homepage']['keyword'] }}">
                                </div>
                            </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-secondary">Update</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <h4 class="header-title">Tentang Kami</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="#" class="btn btn-primary text-white open" data-page="aboutus">Edit Page Information</a>
                            <a href="{{ url('/aboutus') }}" target="_blank" class="btn btn-primary text-white">Edit Page Content</a>
                        </div>
                        </div>
                        <div id="drop-aboutus" class="drop" style="display:none">
                        <hr>
                        <form action="{{ route('page.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="page" value="aboutus">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-12">
                                            <label>Slider</label>
                                    </div>
                                <div class="col-md-5">
                                    <img src="/images/slider/aboutus-slider.jpg" id="slider-aboutus" style="width:100%">
                                </div>
                                <div class="col-md-6">
                                    <input type="file" name="slider" class="form-control slider-file" accept=".jpg" data-page="aboutus">
                                </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                            <div class="col-md-12">
                            <p class="text-danger">This information is for meta tag that boosting this page SEO</p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Page Title</label>
                                <input class="form-control" type="text" name="title" value="{{ @$seo['aboutus']['title'] }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Page Description</label>
                                    <textarea class="form-control" type="text" name="description">{{ @$seo['aboutus']['description'] }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Page Keyword</label>
                                    <input class="form-control" type="text" name="keyword" value="{{ @$seo['aboutus']['keyword'] }}">
                                </div>
                            </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-secondary">Update</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <h4 class="header-title">Hotel</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="#" class="btn btn-primary text-white open" data-page="hotel">Edit Page Information</a>
                            <a href="{{ url('/hotel') }}" target="_blank" class="btn btn-primary text-white">Edit Page Content</a>
                        </div>
                        </div>
                        <div id="drop-hotel" class="drop" style="display:none">
                        <hr>
                        <form action="{{ route('page.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="page" value="hotel">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-12">
                                            <label>Slider</label>
                                    </div>
                                <div class="col-md-5">
                                    <img src="/images/slider/hotel-slider.jpg" id="slider-hotel" style="width:100%">
                                </div>
                                <div class="col-md-6">
                                    <input type="file" name="slider" class="form-control slider-file" accept=".jpg" data-page="hotel">
                                </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                            <div class="col-md-12">
                            <p class="text-danger">This information is for meta tag that boosting this page SEO</p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Page Title</label>
                                <input class="form-control" type="text" name="title" value="{{ @$seo['hotel']['title'] }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Page Description</label>
                                    <textarea class="form-control" type="text" name="description">{{ @$seo['hotel']['description'] }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Page Keyword</label>
                                    <input class="form-control" type="text" name="keyword" value="{{ @$seo['hotel']['keyword'] }}">
                                </div>
                            </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-secondary">Update</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <h4 class="header-title">Penghargaan</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="#" class="btn btn-primary text-white open" data-page="reward">Edit Page Information</a>
                            <a href="{{ url('/reward') }}" target="_blank" class="btn btn-primary text-white">Edit Page Content</a>
                        </div>
                        </div>
                        <div id="drop-reward" class="drop" style="display:none">
                        <hr>
                        <form action="{{ route('page.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="page" value="reward">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-12">
                                            <label>Slider</label>
                                    </div>
                                <div class="col-md-5">
                                    <img src="/images/slider/reward-slider.jpg" id="slider-reward" style="width:100%">
                                </div>
                                <div class="col-md-6">
                                    <input type="file" name="slider" class="form-control slider-file" accept=".jpg" data-page="reward">
                                </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                            <div class="col-md-12">
                            <p class="text-danger">This information is for meta tag that boosting this page SEO</p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Page Title</label>
                                <input class="form-control" type="text" name="title" value="{{ @$seo['reward']['title'] }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Page Description</label>
                                    <textarea class="form-control" type="text" name="description">{{ @$seo['reward']['description'] }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Page Keyword</label>
                                    <input class="form-control" type="text" name="keyword" value="{{ @$seo['reward']['keyword'] }}">
                                </div>
                            </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-secondary">Update</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <h4 class="header-title">Hubungan Investor</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="#" class="btn btn-primary text-white open" data-page="investment">Edit Page Information</a>
                            <a href="{{ url('/investment') }}" target="_blank" class="btn btn-primary text-white">Edit Page Content</a>
                        </div>
                        </div>
                        <div id="drop-investment" class="drop" style="display:none">
                        <hr>
                        <form action="{{ route('page.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="page" value="investment">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-12">
                                            <label>Slider</label>
                                    </div>
                                <div class="col-md-5">
                                    <img src="/images/slider/investment-slider.jpg" id="slider-investment" style="width:100%">
                                </div>
                                <div class="col-md-6">
                                    <input type="file" name="slider" class="form-control slider-file" accept=".jpg" data-page="investment">
                                </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                            <div class="col-md-12">
                            <p class="text-danger">This information is for meta tag that boosting this page SEO</p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Page Title</label>
                                <input class="form-control" type="text" name="title" value="{{ @$seo['investment']['title'] }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Page Description</label>
                                    <textarea class="form-control" type="text" name="description">{{ @$seo['investment']['description'] }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Page Keyword</label>
                                    <input class="form-control" type="text" name="keyword" value="{{ @$seo['investment']['keyword'] }}">
                                </div>
                            </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-secondary">Update</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <h4 class="header-title">CSR</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="#" class="btn btn-primary text-white open" data-page="csr">Edit Page Information</a>
                            <a href="{{ url('/csr') }}" target="_blank" class="btn btn-primary text-white">Edit Page Content</a>
                        </div>
                        </div>
                        <div id="drop-csr" class="drop" style="display:none">
                        <hr>
                        <form action="{{ route('page.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="page" value="csr">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-12">
                                            <label>Slider</label>
                                    </div>
                                <div class="col-md-5">
                                    <img src="/images/slider/csr-slider.jpg" id="slider-csr" style="width:100%">
                                </div>
                                <div class="col-md-6">
                                    <input type="file" name="slider" class="form-control slider-file" accept=".jpg" data-page="csr">
                                </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                            <div class="col-md-12">
                            <p class="text-danger">This information is for meta tag that boosting this page SEO</p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Page Title</label>
                                <input class="form-control" type="text" name="title" value="{{ @$seo['csr']['title'] }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Page Description</label>
                                    <textarea class="form-control" type="text" name="description">{{ @$seo['csr']['description'] }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Page Keyword</label>
                                    <input class="form-control" type="text" name="keyword" value="{{ @$seo['csr']['keyword'] }}">
                                </div>
                            </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-secondary">Update</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <h4 class="header-title">GCG</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="#" class="btn btn-primary text-white open" data-page="gcg">Edit Page Information</a>
                            <a href="{{ url('/gcg') }}" target="_blank" class="btn btn-primary text-white">Edit Page Content</a>
                        </div>
                        </div>
                        <div id="drop-gcg" class="drop" style="display:none">
                        <hr>
                        <form action="{{ route('page.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="page" value="gcg">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-12">
                                            <label>Slider</label>
                                    </div>
                                <div class="col-md-5">
                                    <img src="/images/slider/gcg-slider.jpg" id="slider-gcg" style="width:100%">
                                </div>
                                <div class="col-md-6">
                                    <input type="file" name="slider" class="form-control slider-file" accept=".jpg" data-page="gcg">
                                </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                            <div class="col-md-12">
                            <p class="text-danger">This information is for meta tag that boosting this page SEO</p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Page Title</label>
                                <input class="form-control" type="text" name="title" value="{{ @$seo['gcg']['title'] }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Page Description</label>
                                    <textarea class="form-control" type="text" name="description">{{ @$seo['gcg']['description'] }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Page Keyword</label>
                                    <input class="form-control" type="text" name="keyword" value="{{ @$seo['gcg']['keyword'] }}">
                                </div>
                            </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-secondary">Update</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <h4 class="header-title">Kontak</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="#" class="btn btn-primary text-white open" data-page="contact">Edit Page Information</a>
                            <a href="{{ url('/contact') }}" target="_blank" class="btn btn-primary text-white">Edit Page Content</a>
                        </div>
                        </div>
                        <div id="drop-contact" class="drop" style="display:none">
                        <hr>
                        <form action="{{ route('page.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="page" value="contact">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-12">
                                            <label>Slider</label>
                                    </div>
                                <div class="col-md-5">
                                    <img src="/images/slider/contact-slider.jpg" id="slider-contact" style="width:100%">
                                </div>
                                <div class="col-md-6">
                                    <input type="file" name="slider" class="form-control slider-file" accept=".jpg" data-page="contact">
                                </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                            <div class="col-md-12">
                            <p class="text-danger">This information is for meta tag that boosting this page SEO</p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Page Title</label>
                                <input class="form-control" type="text" name="title" value="{{ @$seo['contact']['title'] }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Page Description</label>
                                    <textarea class="form-control" type="text" name="description">{{ @$seo['contact']['description'] }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Page Keyword</label>
                                    <input class="form-control" type="text" name="keyword" value="{{ @$seo['contact']['keyword'] }}">
                                </div>
                            </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-secondary">Update</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

</div> <!-- end container-fluid -->
@endsection
@section('data-content')
    @include('user::form.user')
@endsection

@section('script-bottom')
        <script type="text/javascript">
            $(document).ready(function() {
                app.init();
                $('.open').on('click',function(){

                    if($('#drop-'+$(this).attr('data-page')).hasClass('active')){
                        $('#drop-'+$(this).attr('data-page')).slideUp();
                        $('#drop-'+$(this).attr('data-page')).removeClass('active');
                        return false;
                    }
                    if($('.drop').hasClass('active')){
                        $('.drop').slideUp();
                        $('.drop').removeClass('active');
                    }
                    $('#drop-'+$(this).attr('data-page')).slideDown();
                    $('#drop-'+$(this).attr('data-page')).addClass('active');
                })
                jQuery('#effective_date').datepicker({
                    autoclose: true,
                    todayHighlight: true
                });
                jQuery('#effective_until').datepicker({
                    autoclose: true,
                    todayHighlight: true
                });
                $('.select2').select2();
                $(function () {
                    $(".slider-file").change(function (e) {
                        var size = this.files[0].size;
                        var page = $(this).attr('data-page');
                        // if(size > 500000){
                        //     $(this).addClass('is-invalid');
                        //     $('#submitbutton').attr('disabled', true);
                        // }else{
                        //     $(this).removeClass('is-invalid');
                        //     $('#submitbutton').attr('disabled', false);
                        // }
                        if (this.files && this.files[0]) {
                            var reader = new FileReader();
                            if (page == 'gcg'){
                                reader.onload = imageIsLoadedgcg;
                            }
                            if (page == 'homepage1'){
                                reader.onload = imageIsLoadedhomepage1;
                            }
                            if (page == 'homepage2'){
                                reader.onload = imageIsLoadedhomepage2;
                            }

                            if (page == 'aboutus'){
                                reader.onload = imageIsLoadedaboutus;
                            }

                            if (page == 'hotel'){
                                reader.onload = imageIsLoadedhotel;
                            }

                            if (page == 'reward'){
                                reader.onload = imageIsLoadedreward;
                            }

                            if (page == 'investment'){
                                reader.onload = imageIsLoadedinvestment;
                            }

                            if (page == 'contact'){
                                reader.onload = imageIsLoadedcontact;
                            }
                            
                            reader.readAsDataURL(this.files[0]);
                        }
                    });
                });

                function imageIsLoadedgcg(e) {
                    $('#slider-gcg').attr('src', e.target.result);
                };

                function imageIsLoadedcsr(e) {
                    $('#slider-csr').attr('src', e.target.result);
                };

                function imageIsLoadedhomepage1(e) {
                    $('#slider-homepage1').attr('src', e.target.result);
                };

                function imageIsLoadedhomepage2(e) {
                    $('#slider-homepage2').attr('src', e.target.result);
                };

                function imageIsLoadedaboutus(e) {
                    $('#slider-aboutus').attr('src', e.target.result);
                };

                function imageIsLoadedhotel(e) {
                    $('#slider-hotel').attr('src', e.target.result);
                };

                function imageIsLoadedreward(e) {
                    $('#slider-reward').attr('src', e.target.result);
                };

                function imageIsLoadedinvestment(e) {
                    $('#slider-investment').attr('src', e.target.result);
                };

                function imageIsLoadedcontact(e) {
                    $('#slider-contact').attr('src', e.target.result);
                };
            })
        </script>
@endsection