@extends('layouts-front.master')

@section('content')
<!-- breadcrumb start -->
<div class="breadcrumb-section">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="page-title">
                                <h2>Address Book</h2></div>
                        </div>
                        <div class="col-sm-6">
                            <nav aria-label="breadcrumb" class="theme-breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Address Book</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- breadcrumb End -->


            <!-- section start -->
            <section class="section-b-space">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="account-sidebar"><a class="popup-btn">my account</a></div>
                            <div class="dashboard-left">
                                <div class="collection-mobile-back"><span class="filter-back"><i class="fa fa-angle-left" aria-hidden="true"></i> back</span></div>
                                <div class="block-content">
                                    <ul>
                                        <li><a href="{{route('dashboard')}}">Account Info</a></li>
                                        <li class="active"><a href="{{route('addressbook')}}">Address Book</a></li>
                                        <li><a href="{{route('myorder')}}">My Orders</a></li>
                                        <li><a href="#">My Wishlist</a></li>
                                        <li><a href="#">Newsletter</a></li>
                                        <li><a href="{{route('myaccount')}}">My Account</a></li>
                                        <li><a href="{{route('changepassword')}}">Change Password</a></li>
                                        <li class="last"><a href="#">Log Out</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="dashboard-right">
                                <div class="dashboard">
                                    <div class="page-title">
                                        <h2>Manage Address</h2></div>
                                    <div style="margin-bottom: 15px;"class="welcome-msg">
                                        <p>Manage your billing and shipping address</p>
                                    </div>
                                    <div class="box-account box-info">
                                      <div class="row">
                                        <div class="col-sm-12">
                                          <form class="theme-form" id="addressform">
                                              <div class="form-row">
                                                  <div class="col-md-6">
                                                      <label for="name">Province</label>
                                                      <select id="province_id" class="form-control" name="province_id" style="margin-bottom: 15px;" >
                                                        @foreach($province as $prov)
                                                    <option value="{{ $prov->province_id }}">{{$prov->province}}</option>
                                                        @endforeach
                                                    </select>
                                                  </div>
                                                  <div class="col-md-6">
                                                        <label for="name">City</label>
                                                        <select id="city_id" class="form-control" name="city_id" style="margin-bottom: 15px;" >
                                            
                                                        </select>
                                                    </div>
                                                  <div class="col-md-12">
                                                      <label for="name">Address</label>
                                                      <input style="margin-bottom: 15px;" type="text" class="form-control" id="address-two" placeholder="Address" required="">
                                                  </div>
                                                  <div class="col-md-6">
                                                      <label for="email">Postal Code</label>
                                                      <input style="margin-bottom: 15px;" type="text" class="form-control" id="zip-code" placeholder="Postal Code" required="">
                                                  </div>
                                              </div>
                                          </form>
                                        </div>
                                        </div>
                                    <div style="padding-left: 0;padding-right: 0;" class="col-md-12 text-right">
                                        <button class="btn btn-sm btn-solid" type="submit">Save setting</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- section end -->
@endsection
@section('scripts')
<script type="text/javascript">
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
    });
</script>
@endsection
