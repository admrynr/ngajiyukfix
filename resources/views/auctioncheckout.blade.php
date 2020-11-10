@extends('layouts-front.checkout-master')

@section('content')
<!-- breadcrumb start -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title">
                    <h2>checkout</h2></div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">checkout</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb end -->

        @php
            $totalprice = $auction->fixed_price;
        @endphp

<!-- section start -->
<section class="section-b-space">
    <div class="container">
        <div class="checkout-page">
            <div class="checkout-form">
            <form action="{{ route('auctionorder') }}" id="formorder" method="POST">
                @csrf
                    <input type="hidden" name="auction_id" value="{{ $auction->id }}">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 col-xs-12">
                            <div class="checkout-title">
                                <h3>Billing Details</h3></div>
                            <div class="row check-out">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="field-label">Receiver Name</div>
                                    <input type="text" name="receiver_name" value="" placeholder="">
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="field-label">Phone</div>
                                    <input type="text" name="receiver_phone" value="" placeholder="">
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Province</div>
                                    <select id="province_id" name="province_id">
                                        @foreach($province as $prov)
                                    <option value="{{ $prov->province_id }}">{{$prov->province}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <div class="field-label">City</div>
                                        <select id="city_id" name="city_id">
                                            
                                        </select>
                                    </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="field-label">Address</div>
                                    <input type="text" name="address" value="" placeholder="Street address">
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Postal Code</div>
                                    <input type="text" name="postal_code" value="" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-xs-12">
                            <div class="checkout-title">
                                <h3>Payment Details</h3>
                            </div>
                            <div class="checkout-details">
                                <div class="order-box">
                                    <ul class="sub-total">
                                        <li>Product</li>
                                    </ul>
                                    <ul class="qty">
                                        @php
                                            $totalweight = $auction->product->weight;
                                        @endphp
                                        <li>{{$auction->product->product_name}} x 1<span>IDR {{number_format($auction->fixed_price * 1)}}</span></li>
                                        <li>Weight : {{ $auction->product->weight }} x 1 = {{ $auction->product->weight*1 }} gram</li>
                              
                                    </ul>
                                    <ul class="sub-total" style="border:none">
                                        <li>Subtotal <span class="count">IDR {{number_format($totalprice)}}</span></li>
                                        <input type="hidden" name="subtotal" id="subtotal" value="{{ $totalprice }}">
                                    </ul>
                                    <ul class="sub-total">
                                        <li>Shipment </li>
                                    </ul>
                                    
                                    <ul class="qty">
                                        <li>Total Weight <span class="count">{{number_format($totalweight)}} gram</span></li>
                                        <li>Courier
                                            <span >
                                                <select id="courier" name="courier" class="form-control">
                                                    <option disabled selected>-</option>
                                                    <option value="jne">JNE</option>
                                                    <option value="tiki">TIKI</option>
                                                    <option value="pos">POS INDONESIA</option>
                                                </select>
                                            </span>
                                        </li>
                                        <li>
                                            Shipping Type
                                            <span >
                                                <select id="shipping_type" name="shipping_type" class="form-control">
                                                    <option>-</option>
                                                </select>
                                            </span>
                                        </li>
                                        <li>Estimate Time <span class="count" id="estimate">-</span></li>
                                        <li>Cost <span class="count" id="price">-</span></li>
                                        <input type="hidden" name="shippingcost" id="shippingcost">
                                        <input type="hidden" name="tax" id="taxvalue">
                                        <input type="hidden" name="total_weight" id="total_weight" value="{{ $totalweight }}">
                                        <input type="hidden" name="shipping_name" id="shipping_name">
                                        <input type="hidden" name="estimatevalue" id="estimatevalue">
                                    </ul>
                                    <ul class="sub-total" style="border:none">
                                        <li>Subtotal <span class="count" id="subtotalshipping">-</span></li>
                                        <li>Tax <span class="count" id="tax">-</span></li>
                                        <li>Total <span class="count" id="totalprice">-</span></li>
                                        <input type="hidden" name="valtotalprice" id="valtotalprice">
                                    </ul>
                                    {{-- <ul class="sub-total">
                                            <li>Payment </li>
                                        </ul> --}}
                                </div>
                                <div class="payment-box">
                                    {{-- <div class="upper-box">
                                        <div class="payment-options">
                                            <ul>
                                                <li>
                                                    <div class="radio-option">
                                                        <input type="radio" name="payment_type" value="bank_transfer" id="payment-1" checked="checked">
                                                        <label for="payment-1">Bank Transfer</label>
                                                        
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="radio-option">
                                                        <input type="radio" name="payment_type" value="virtual_account" id="payment-2">
                                                        <label for="payment-2">Virtual Account</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="radio-option paypal">
                                                        <input type="radio" name="payment_type" value="credit_card" id="payment-3">
                                                        <label for="payment-3">Credit Card</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div> --}}
                                    <div class="text-right"><a href="#" class="btn-solid btn disabled" id="btnsubmit">Place Order</a></div>
                                </div>
                            </div>
                        </div>
                        
                    <input type="hidden" name="midtrans_payment_type" id="midtrans_payment_type">
                    <input type="hidden" name="midtrans_transaction_id" id="midtrans_transaction_id">
                    <input type="hidden" name="midtrans_transaction_status" id="midtrans_transaction_status">
                    <input type="hidden" name="midtrans_transaction_time" id="midtrans_transaction_time">
                    <input type="hidden" name="midtrans_pdf_url" id="midtrans_pdf_url">
                    <input type="hidden" name="midtrans_finish_redirect_url" id="midtrans_finish_redirect_url">
                    <input type="hidden" name="invoice_number" id="invoice_number">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- section end -->
@endsection
@section('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-1qjyrcspMpx1qDMt"></script>
<script type="text/javascript">
document.getElementById('btnsubmit').onclick = function(){
    var formData = new FormData($('#formorder')[0]);

    $.ajax({
        url: '{{ route("auction.getmidtranstoken") }}',
        data: formData,
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: "JSON",
        success : function(data){
           console.log(data);
           // SnapToken acquired from previous step
            snap.pay(data, {
            // Optional
            onSuccess: function(result){
                $('#midtrans_payment_type').val(result.payment_type);
                $('#midtrans_transaction_id').val(result.transaction_id);
                $('#midtrans_transaction_status').val(result.transaction_status);
                $('#midtrans_transaction_time').val(result.transaction_time);
                if(result.pdf_url != null){
                    $('#midtrans_pdf_url').val(result.pdf_url);
                }
                $('#midtrans_finish_redirect_url').val(result.finish_redirect_url);
                $('#invoice_number').val(result.order_id);
                $('#formorder').submit();
            },
            // Optional
            onPending: function(result){
                $('#midtrans_payment_type').val(result.payment_type);
                $('#midtrans_transaction_id').val(result.transaction_id);
                $('#midtrans_transaction_status').val(result.transaction_status);
                $('#midtrans_transaction_time').val(result.transaction_time);
                if(result.pdf_url != null){
                    $('#midtrans_pdf_url').val(result.pdf_url);
                }
                $('#midtrans_finish_redirect_url').val(result.finish_redirect_url);
                $('#invoice_number').val(result.order_id);
                $('#formorder').submit();
                /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            },
            // Optional
            onError: function(result){
                /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            }
            });
        }
    });
    
};
</script>
<script type="text/javascript">
    function formatNumber(angka) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? "," : "";
            rupiah += separator + ribuan.join(",");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return rupiah;
    }
    $(document).ready(function() {
        $('#province_id').on('change', function(){
            province_id = $(this).val();
            $.ajax({
                url: '{{ route("shop.getcity") }}',
                type: "GET",
                data: {
                    province_id : province_id
                },
                dataType: "JSON",
                success : function(data){
                    $('#city_id').children('option').remove();
                    $.each(data, function(key, value) {
                        $('#city_id')
                            .append($("<option></option>")
                            .attr("value",value.id)
                            .text(value.text));
                    });
                }
            });
        })
        $('#courier').on('change',function(){
            destination = $('#city_id').val();
            courier = $(this).val();
            $.ajax({
                url: '{{ route("shop.getcost") }}',
                type: "GET",
                data: {
                    destination : destination,
                    totalweight : '{{$totalweight}}',
                    courier : courier
                },
                dataType: "JSON",
                success : function(data){
                    $('#shipping_type').children('option').remove();
                    $.each(data, function(key, value) {
                        $('#shipping_type').attr('data-price'+value.id , value.price);
                        $('#shipping_type').attr('data-estimate'+value.id , value.estimate);
                        $('#shipping_type').attr('data-type'+value.id , value.text);
                        $('#shipping_type')
                            .append($("<option></option>")
                            .attr("value",value.id)
                            .text(value.text));
                    });
                    shippingname = $('#shipping_type').data('type'+0);
                    $('#shipping_name').val(shippingname);
                    estimate = $('#shipping_type').data('estimate'+0);
                    $('#estimate').html(estimate+' Days');
                    $('#estimatevalue').val(estimate);
                    //price
                    price = $('#shipping_type').data('price'+0);
                    $('#price').html('IDR '+formatNumber(price.toString()));
                    $('#shippingcost').val(price);
                    //subtotal
                    subtotal = $('#subtotal').val();
                    subtotalshipping = (+subtotal) + (+price);
                    $('#subtotalshipping').html('IDR '+formatNumber(subtotalshipping.toString()));
                    //tax
                    tax = 10/100*subtotalshipping;
                    $('#tax').html('IDR '+formatNumber(tax.toString()));
                    $('#taxvalue').val(tax);
                    //totalprice
                    final = (+subtotalshipping)+(+tax);
                    $('#totalprice').html('IDR '+formatNumber(final.toString()));
                    $('#valtotalprice').val(final);
                    $('#btnsubmit').removeClass('disabled');
                }
            });
        });
        $('#shipping_type').on('change',function(){
            val = $(this).val();
            //estimate
            estimate = $(this).data('estimate'+val);
            $('#estimate').html(estimate+' Days');
            //price
            price = $(this).data('price'+val);
            $('#price').html('IDR '+formatNumber(price.toString()));
            //subtotal
            subtotal = $('#subtotal').val();
            subtotalshipping = (+subtotal) + (+price);
            $('#subtotalshipping').html('IDR '+formatNumber(subtotalshipping.toString()));
            //tax
            tax = 10/100*subtotalshipping;
            $('#tax').html('IDR '+formatNumber(tax.toString()));
            //totalprice
            final = (+subtotalshipping)+(+tax);
            $('#totalprice').html('IDR '+formatNumber(final.toString()));
            $('#valtotalprice').val(final);
            
        })
    });
</script>
@endsection