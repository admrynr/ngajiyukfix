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
                                    <a class="nav-link active show" data-toggle="tab" href="#home1" role="tab" style="font-size:12pt" aria-selected="true">Basic Setting</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link " data-toggle="tab" href="#profile1" role="tab" style="font-size:12pt" aria-selected="false">shop Information</a>
                                </li> --}}
                                {{-- <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#messages1" role="tab" style="font-size:12pt">Raja Ongkir Setting</a>
                                </li> --}}
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
                                                <b>INFO :</b> Configure your payment's shipping here.
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>What's your shipment method on your payment ? <span class="text-success" id="updatesuccess" style="display:none"><i class="fa fa-check " style="margin-right:10px;margin-left:10px"></i>Updated !</span> <span class="text-info" id="updateprocess" style="display: none"><i class="fa fa-spinner fa-spin " style="margin-right:10px;margin-left:10px"></i>Updating...</span> </label>
                                                <select class="form-control" id="statusshipping" name="statusshipping">
                                                    <option value="free_shipping">Free Shipping</option>
                                                    {{-- <option value="flat_rate">Flat Rate</option> --}}
                                                    <option value="raja_ongkir">Raja Ongkir</option>
                                                </select>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div id="flat_rate" style="display:none">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Price per weight <span class="text-success" id="updatesuccess1" style="display:none"><i class="fa fa-check " style="margin-right:10px;margin-left:10px"></i>Updated !</span> <span class="text-info" id="updateprocess1" style="display: none"><i class="fa fa-spinner fa-spin " style="margin-right:10px;margin-left:10px"></i>Updating...</span> </label></label>
                                                    <input class="form-control" name="price_per_weight" type="number">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="raja_ongkir" style="display:none">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>What is Raja Ongkir ? Raja Ongkir is platform that help us to count how much shipping cost for indonesia's area. Read more about Raja Ongkir <a href="https://rajaongkir.com/" class="text-primary" target="_blank">here</a></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                {{-- <div class="tab-pane p-3" id="messages1" role="tabpanel">
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
                                </div> --}}
                            </div>
                            
                        </div>
                
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
                $('#bankname').select2();
                $('#statusshipping').val('{{ $shop['statusshipping'] }}');
                if($('#statusshipping').val() == "flat_rate"){
                    $('#flat_rate').css('display','block');
                }else{
                    $('#flat_rate').css('display','none');
                }
                if($('#statusshipping').val() == "raja_ongkir"){
                    $('#raja_ongkir').css('display','block');
                }else{
                    $('#raja_ongkir').css('display','none');
                }
                $('#statusshipping').on('change',function(){
                    val = $(this).val();
                    $.ajax({
                        url: baseURL+'/admin/shipping/update',
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
                            if(val == "flat_rate"){
                                $('#flat_rate').css('display','block');
                            }else{
                                $('#flat_rate').css('display','none');
                            }
                            if(val == "raja_ongkir"){
                                $('#raja_ongkir').css('display','block');
                            }else{
                                $('#raja_ongkir').css('display','none');
                            }
                            $('#updateprocess').css('display','none');
                            $('#updatesuccess').css('display','inline-block');
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