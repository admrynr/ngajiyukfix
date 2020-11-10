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
                        <a href="#">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Master Data
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
                            <div class="col-md-12 text-left">
                                <h4 class="header-title">Welcome to Dashboard!</h4>
                            </div>
                            </div>
                        </div>
                    </div>
            </div>
    </div>
    <!-- end row -->

</div> <!-- end container-fluid -->
@endsection


@section('script-bottom')
        <script type="text/javascript" src="{{ asset("js/dashboard.js") }}"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                appuser.handleUserPage($('#filter').val());
                jQuery('#effective_date').datepicker({
                    autoclose: true,
                    todayHighlight: true
                });
                jQuery('#effective_until').datepicker({
                    autoclose: true,
                    todayHighlight: true
                });
                $('.select2').select2();
            });
        </script>
@endsection