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
                                    Payment
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
                        
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" data-toggle="tab" href="#home1" role="tab" style="font-size:12pt" aria-selected="true">Manual Transfer</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link " data-toggle="tab" href="#profile1" role="tab" style="font-size:12pt" aria-selected="false">shop Information</a>
                                </li> --}}
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#messages1" role="tab" style="font-size:12pt">Payment Gateway</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane p-3 active show" id="home1" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert bg-info text-white alert-dismissible fade show" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <b>INFO :</b> Configure your manual transfer payment here.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Use manual transfer on product's payment ? <span class="text-success" id="updatesuccess" style="display:none"><i class="fa fa-check " style="margin-right:10px;margin-left:10px"></i>Updated !</span> <span class="text-info" id="updateprocess" style="display: none"><i class="fa fa-spinner fa-spin " style="margin-right:10px;margin-left:10px"></i>Updating...</span> </label>
                                                <select class="form-control" id="statusmanual" name="statusmanual">
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                        <h5 class="card-title">Bank List</h5>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <button class="-right btn btn-secondary" data-toggle="modal" data-target="#createbankmodal">Create Bank</button>
                                        </div>
                                        <div class="col-md-12">
                                            <br>
                                        </div>
                                        <div class="col-md-12">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Bank Name</th>
                                                        <th>Account Name</th>
                                                        <th>Account Number</th>
                                                        <th class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(count($banklist) == 0)
                                                        <tr>
                                                            <td class="text-center" colspan="5">No data available</td>
                                                        </tr>
                                                    @else
                                                        @php
                                                            $i = 1;
                                                        @endphp
                                                        @foreach($banklist as $key)
                                                            <tr>
                                                                <td>{{ $i++ }}.</td>
                                                            <td>{{ $key->bank_name }}</td>
                                                            <td>{{ $key->account_name }}</td>
                                                            <td>{{ $key->account_number }}</td>
                                                                <td class="text-center">
                                                                <form action="{{ route('payment.deletebank') }}" method="GET" id="deleteform{{ $key->id }}">
                                                                        @csrf
                                                                    <input type="hidden" name="id" value="{{ $key->id }}">
                                                                    </form>
                                                                    <button class="btn btn-danger btn-sm dotip btn-del" data-toggle="modal" data-target="#deleteModal" data-id="{{ $key->id }}" title="Delete Bank"><i class="fa fa-times"></i></button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane p-3" id="messages1" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert bg-info text-white alert-dismissible fade show" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <b>INFO :</b> Payment gateway can make your shop's payment using credit card or virtual account. but you must have midtrans account to use it.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Use payment gateway on product's payment ? <span class="text-success" id="updatesuccess1" style="display:none"><i class="fa fa-check " style="margin-right:10px;margin-left:10px"></i>Updated !</span> <span class="text-info" id="updateprocess1" style="display: none"><i class="fa fa-spinner fa-spin " style="margin-right:10px;margin-left:10px"></i>Updating...</span> </label>
                                                <select class="form-control" id="statusgateway" name="statusgateway">
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                
                </div>
            </div>
        </div>
        
    </div>
    <!-- end row -->
    <!-- create bank modal -->
    <div class="modal fade" id="createbankmodal" tabindex="-1" role="dialog" aria-labelledby="addOrder" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Create Bank</h5> 
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                </div>
            <form action="{{ route('payment.createbanklist') }}" method="post">
                    @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Bank Name</label>
                                <select class="form-control" id="bank_name" name="bank_name" required>
                                    @foreach($bank as $key)
                                        <option value="{{ $key->name }}">{{ $key->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Account Name</label>
                                <input class="form-control" name="account_name" id="account_name" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                                <div class="form-group">
                                    <label>Account Number</label>
                                    <input class="form-control" name="account_number" id="account_number" required>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
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
                $('#bankname').select2();
                $('#statusmanual').val('{{ $shop['statusmanual'] }}');
                $('#statusgateway').val('{{ empty($shop['statusgateway']) ? 0 : $shop['statusgateway'] }}')

                $('#statusmanual').on('change',function(){
                    val = $(this).val();
                    $.ajax({
                        url: baseURL+'/admin/payment/updatestatusmanual',
                        type: 'GET',
                        data: {
                            status: val
                        },
                        beforeSend: function(){
                            $('#updateprocess').css('display','inline-block');
                            $('#updatesuccess').css('display','none');
                            $(this).attr('disabled',true);
                        },
                        success: function(data){
                            $('#updateprocess').css('display','none');
                            $('#updatesuccess').css('display','inline-block');
                            $(this).attr('disabled',false);
                        }
                    });
                });

                $('#statusgateway').on('change',function(){
                    val = $(this).val();
                    $.ajax({
                        url: baseURL+'/admin/payment/updatestatusgateway',
                        type: 'GET',
                        data: {
                            status: val
                        },
                        beforeSend: function(){
                            $('#updateprocess1').css('display','inline-block');
                            $('#updatesuccess1').css('display','none');
                            $(this).attr('disabled',true);
                        },
                        success: function(data){
                            $('#updateprocess1').css('display','none');
                            $('#updatesuccess1').css('display','inline-block');
                            $(this).attr('disabled',false);
                        }
                    });
                });
                $('.btn-del').on('click',function(){
                    id = $(this).data('id');
                });
                $('#btn-hapus').on('click',function(){
                    $('#deleteform'+id).submit();
                });
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