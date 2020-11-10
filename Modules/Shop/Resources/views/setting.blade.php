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
                                    <a href="#">Shop Management</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Shop
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
            @if($errors->has('success'))
            <div class="alert alert-success bg-success text-white font-16 " style="font-weight:bold">
                {{ $errors->first('success') }}
            </div>
            @endif
            <div class="card m-b-20">
                    <div class="card-body">
                        <form action="{{route('shop.update')}}" method="POST">
                                @csrf 
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" data-toggle="tab" href="#home1" role="tab" style="font-size:12pt" aria-selected="true">General Information</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link " data-toggle="tab" href="#profile1" role="tab" style="font-size:12pt" aria-selected="false">Company Information</a>
                                </li> --}}
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#messages1" role="tab" style="font-size:12pt">Social Media</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane p-3 active show" id="home1" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Shop Name</label>
                                            <input class="form-control" type="text" name="name" value="{{ @$company->name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Shop Email</label>
                                            <input class="form-control" type="email" name="email" value="{{ @$company->email }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Shop Phone</label>
                                            <input class="form-control" type="text" name="phone" value="{{ @$company->phone }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Shop Address</label>
                                            <textarea class="form-control" rows="3" type="text" name="address" >{{ @$company->address }}</textarea>
                                            </div>
                                        </div>
                                       
                                       
                                    </div>
                                </div>
                                {{-- <div class="tab-pane p-3 " id="profile1" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>About</label>
                                            <textarea class="form-control" type="text" name="about">{{ $company->about }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Vision</label>
                                            <textarea class="form-control" type="text" name="vision">{{ $company->vision }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Missions</label>
                                            <textarea class="form-control" type="text" name="missions">{{ $company->missions }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="tab-pane p-3" id="messages1" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Website URL</label>
                                            <input class="form-control" type="text" name="website_url" value="{{ @$company->website_url }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Facebook URL</label>
                                            <input class="form-control" type="text" name="facebook_url" value="{{ @$company->facebook_url }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Instagram URL</label>
                                            <input class="form-control" type="text" name="instagram_url" value="{{ @$company->instagram_url }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Twitter URL</label>
                                            <input class="form-control" type="text" name="twitter_url" value="{{ @$company->twitter_url }}">
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary font-weight-bold">UPDATE</button>
                                </div>
                        </div>
                </form>
                </div>
            </div>
        </div>
        
    </div>
    <!-- end row -->

</div> <!-- end container-fluid -->
@endsection
@section('data-content')
    {{-- @include('user::form.user') --}}
@endsection

@section('script-bottom')
        {{-- <script type="text/javascript" src="{{ asset("js/user.js") }}"></script> --}}
        <script type="text/javascript">
            $(document).ready(function() {
                app.init();
                // appuser.handleUserPage();
                // jQuery('#effective_date').datepicker({
                //     autoclose: true,
                //     todayHighlight: true
                // });
                // jQuery('#effective_until').datepicker({
                //     autoclose: true,
                //     todayHighlight: true
                // });
                // $('.select2').select2();
            })
        </script>
@endsection