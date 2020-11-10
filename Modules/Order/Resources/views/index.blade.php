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
                        <a href="#">Order Management</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Order
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
                            <div class="col-md-6 text-right">
                                <a href="{{ route('order.index') }}" class="btn {{ empty(Request::get('filter')) ? 'btn-primary' : 'btn-secondary' }} text-white">All (<span id="total"></span>)</a>
                                <a href="{{ route('order.index') }}?filter=processed"  class="btn {{ !empty(Request::get('filter')) && Request::get('filter') == 'processed' ? 'btn-primary' : 'btn-secondary' }} text-white">Processed (<span id="processed"></span>)</a>
                                <a href="{{ route('order.index') }}?filter=unprocessed"  class="btn {{ !empty(Request::get('filter')) && Request::get('filter') == 'unprocessed' ? 'btn-primary' : 'btn-secondary' }} text-white">Unprocessed (<span id="unprocessed"></span>)</a>
                                <a href="{{ route('order.index') }}?filter=trashed"  class="btn {{ !empty(Request::get('filter')) && Request::get('filter') == 'trashed' ? 'btn-primary' : 'btn-secondary' }} text-white">Trashed (<span id="trashed"></span>)</a>
                                <input type="hidden" id="filter" value="{{ empty(Request::get('filter')) ? 'all' : Request::get('filter') }}">
                            </div>
                            </div>
                        </div>
                    </div>
            </div>
        <div class="col-xl-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-6 text-left m-b-30">
                            <div class="dropdown mo-mb-2">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Bulk Action
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 33px, 0px);">
                                    <a class="dropdown-item bulk-button" data-title="restore" href="#">Restore</a>
                                    <a class="dropdown-item bulk-button" data-title="activate" href="#">Activate</a>
                                    <a class="dropdown-item bulk-button" data-title="deactivate" href="#">Deactivate</a>
                                    <a class="dropdown-item bulk-button" data-title="trash" href="#">Delete</a>
                                    <a class="dropdown-item bulk-button" data-title="delete" href="#">Permantly Delete</a>
                                    </div>
                                <input type="hidden" id="bulkvalue">
                            </div>
                        </div>

                    </div>
                    {{-- @if(Session::get('user')->level == 1)
                        <div class="row">
                            <div class="col-md-2 text-left form-group">
                                <label class="control-label">Sekolah :</label>
                                <select class="form-control select2" id="selectsekolah">
                                    @foreach($sekolah as $sek)
                                        <option value="{{ $sek->id }}">{{ $sek->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @else
                        <input type="hidden" id="selectsekolah" value="{{ Session::get('user')->sekolah_id }}">
                    @endif --}}
                    <table id="dataTableOrder" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th></th>
                            <th>No.</th>
                            <th>Invoice</th>
                            <th>Shipping Type</th>
                            <th>Payment Type</th>
                            <th>Total Weight</th>
                            <th>Tax</th>
                            <th>Final Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                </div>
            </div>
        </div>

    </div>
    <!-- end row -->

</div> <!-- end container-fluid -->
@endsection
@section('data-content')
    @include('product::form.product')
@endsection
@section('data-bidding')
    @include('product::form.bidding')
@endsection


@section('script-bottom')
        <script type="text/javascript" src="{{ asset("js/order.js") }}"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                // preloader(true, 'black', 'red');
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
                $('#resetfoto').on('click',function(){
                    $('#fotoimage').attr('src', '{{ asset('images/default-user.png') }}');
                    $('#valueresetfoto').val('1');
                    $('#foto').val('');
                });
            });
                $(".rupiah").bind('click keyup', function(event) {
                    format = $(this).val().replace(/[^,\d]/g, "").toString();
                    // $(".price-value").val(format);
                    $(this).val(formatRupiah(this.value, 'Rp. '));
                });
                $(".nomor").bind('click keyup', function(event) {
                    format = $(this).val().replace(/[^,\d]/g, "").toString();
                    // $(".price-value").val(format);
                    $(this).val(formatNumber(this.value));
                });
                $(function () {
                $("#foto").change(function () {
                    var size = this.files[0].size;
                    if(size > 500000){
                        $(this).addClass('is-invalid');
                        $('#submitbutton').attr('disabled', true);
                    }else{
                        $(this).removeClass('is-invalid');
                        $('#submitbutton').attr('disabled', false);
                    }
                    if (this.files && this.files[0]) {
                        var reader = new FileReader();
                        reader.onload = imageIsLoaded;
                        reader.readAsDataURL(this.files[0]);
                    }
                });
            });

            function imageIsLoaded(e) {
                $('#fotoimage').attr('src', e.target.result);
                $('#valueresetfoto').val('');
            };


            function filterFunction() {
            var input, filter, ul, li, a, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            div = document.getElementById("myDropdown");
            a = div.getElementsByTagName("a");
            for (i = 0; i < a.length; i++) {
                txtValue = a[i].textContent || a[i].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                a[i].style.display = "";
                } else {
                a[i].style.display = "none";
                }
            }
            }

            function filterFunctionCats() {
            var input, filter, ul, li, a, i;
            input = document.getElementById("inputCategory");
            filter = input.value.toUpperCase();
            div = document.getElementById("dropdownCategory");
            a = div.getElementsByTagName("a");
            for (i = 0; i < a.length; i++) {
                txtValue = a[i].textContent || a[i].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                a[i].style.display = "";
                } else {
                a[i].style.display = "none";
                }
            }
            }
        </script>
@endsection
