@extends('layouts-front.master')

@section('content')
<!-- breadcrumb start -->
<div class="breadcrumb-section">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="page-title">
                                <h2>Dashboard</h2></div>
                        </div>
                        <div class="col-sm-6">
                            <nav aria-label="breadcrumb" class="theme-breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
                            <div class="account-sidebar"><a class="popup-btn">my auction</a></div>
                            <div class="dashboard-left">
                                <div class="collection-mobile-back"><span class="filter-back"><i class="fa fa-angle-left" aria-hidden="true"></i> back</span></div>
                                <div class="block-content">
                                    <ul>
                                        <li><a href="{{route('dashboard')}}">Account Info</a></li>
                                        <li class="active"><a href="{{route('myauction')}}">My Auction</a></li>
                                        <li><a href="{{route('addressbook')}}">Address Book</a></li>
                                        <li><a href="{{route('myorder')}}">My Orders</a></li>
                                        <li><a href="#">My Wishlist</a></li>
                                        <li><a href="{{route('newsletter')}}">Newsletter</a></li>
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
                                        <h2>My Auction</h2></div>
                                    <div class="welcome-msg">
                                        <p>Hello, {{$user->name}} !</p>
                                        <p>From your My Auction Dashboard you can view your current auction an your auction history.</p>
                                    </div>
                                    <div class="box-account box-info">
                                        <div class="box-head">
                                            <h2>Auction Information</h2></div>
                                        <div class="row">
                                          <div class="row ">
                                              <div class="col-xl-2 p-0">
                                                  <ul class="nav nav-tabs nav-material flex-column nav-border" id="top-tab" role="tablist">
                                                      <li class="nav-item" style="text-align:left"><a class="nav-link active show" id="top-home-tab" data-toggle="tab" href="#top-home" role="tab" aria-selected="true">Today's Auction</a></li>
                                                      <li class="nav-item"><a class="nav-link" id="contact-top-tab" data-toggle="tab" href="#top-contact" role="tab" aria-selected="false">All Auction</a></li>
                                                  </ul>
                                              </div>
                                              <div class="col-xl-10">
                                                  <div class="tab-content nav-material" id="top-tabContent">
                                                      <div class="tab-pane fade active show" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                                                          @if($product->count() != 0)
                                                          @foreach($product as $keys)
                                                              <div class="row" style="border: 1px solid #ddd;padding:30px;margin:20px">
                                                              <div class="col-md-3" style="background-image:url('/images/{{ $keys->product->image }}');background-size:contain;height:150px;background-position:center center ;background-repeat:no-repeat">
                                                                  </div>
                                                                  <div class="col-md-1">
                                                                  </div>
                                                                  <div class="col-md-8">
                                                                      <div class="row">
                                                                      <div class="col-md-12">
                                                                      <a href="#"><h3  style="color:black">{{$keys->product->product_name}}</h3></a>
                                                                      </div>
                                                                      <div class="col-md-6">
                                                                      {{-- <h6 style="margin-top:10px;margin-bottom:5px">IDR {{number_format($keys->product->final_price,2,',','.')}}</h6> --}}
                                                                          <h6 class="text-grey" style="font-size:12pt">{{$keys->product->categories->name}}</h6>
                                                                          @if($keys->status == 2)
                                                                      <div class="timer{{ $keys->id }}" >
                                                                                      <h6 class="text-primary" style="font-size:12pt">Auction end in : </h6>
                                                                                      <div class="timer" style="padding:0;margin:0;background-color:#fff">
                                                                                      <p style="color:black;font-size:18px;padding:0;margin-bottom:0px;line-height:1.5" class="countdown{{ $keys->id }}" data-id="{{ $keys->id }}" id="auctiontime{{ $keys->id }}" data-text="
                                                                                          <span>%s <span class='padding-l'>:</span> <span class='timer-cal'>Days</span> </span><span>%s <span class='padding-l'>:</span> <span class='timer-cal'>Hrs</span> </span><span>%s <span class='padding-l'>:</span> <span class='timer-cal'>Min</span> </span><span>%s <span class='timer-cal'>Sec</span></span>
                                                                                      " >{{ $keys->bid_end }}</p>
                                                                                      <div countdown data-text="<input type='hidden' class='auctionvalue' value='%s%s%s%s' data-id='{{ $keys->id }}'>" style="display:none">{{ $keys->bid_end }}</div>

                                                                                      </div>
                                                                              </div>
                                                                              <h4 class="text-success " style="margin-top:15px;display:none" id="auctionfinished{{ $keys->id }}" >AUCTION FINISHED</h4>
                                                                              <h4 class="text-danger " style="margin-top:15px;display:none" id="auctionfailed{{ $keys->id }}" >AUCTION FAILED</h4>
                                                                          @elseif($keys->status == 3)
                                                                              <h4 class="text-success " style="margin-top:15px" id="auctionend{{ $keys->id }}" >AUCTION FINISHED</h4>
                                                                          @elseif($keys->status == 4)
                                                                              <h4 class="text-danger " style="margin-top:15px" id="auctionend{{ $keys->id }}" >AUCTION FAILED</h4>
                                                                          @endif
                                                                      </div>
                                                                      <div class="col-md-6">
                                                                              @if($keys->status == 2)
                                                                      <div class="infobid{{ $keys->id }}">
                                                                              <h6 class="" style="font-size:12pt">Highest Bid : <span class="pull-right text-primary highbid{{$keys->id}}">
                                                                              {{ empty($product->find($keys->id)->participant->sortByDesc('bid')->first()->bid) ? '-' : 'Rp. '.number_format($product->find($keys->id)->participant->sortByDesc('bid')->first()->bid) }}
                                                                              </span>
                                                                              <span class="pull-right text-primary spinload{{$keys->id}}" style="display:none;">
                                                                              <i class="fa fa-spinner fa-spin"></i></span></h6>
                                                                              <h6 class="" style="font-size:12pt">Your Bid : <span class="pull-right text-primary yourbid{{$keys->id}}">
                                                                             @if (Auth::check())
                                                                                @if (!empty($product->find($keys->id)->participant->where('user_id', Auth::user()->id)->last()->bid))
                                                                                  Rp. {{number_format($product->find($keys->id)->participant->where('user_id', Auth::user()->id)->last()->bid)}}
                                                                                @else
                                                                                -
                                                                                @endif
                                                                             @else
                                                                             -
                                                                             @endif
                                                                              </span></h6>
                                                                          </div>
                                                                      <div class="infoendbid{{$keys->id}}" style="display:none">
                                                                          <h6 class="" style="font-size:12pt;" >Winner : <span class="pull-right text-primary" id="winner{{ $keys->id }}"></span></h6>
                                                                          <h6 class="" style="font-size:12pt;" >Winner Bid : <span class="pull-right text-primary" id="winnerbid{{ $keys->id }}"></span></h6>
                                                                      </div>
                                                                          @else
                                                                          <h6 class="" style="font-size:12pt">Winner : <span class="pull-right text-primary">{{ empty($keys->winner->name) ? '-' : @$keys->winner->name }}</span></h6>
                                                                          <h6 class="" style="font-size:12pt">Winner Bid : <span class="pull-right text-primary">{{ empty($keys->winner_bid) ? '-' : 'Rp. '.number_format($keys->winner_bid) }}</span></h6>
                                                                          @endif
                                                                             <span class="pull-right text-primary spinload{{$keys->id}}" style="display:none;">
                                                                             <i class="fa fa-spinner fa-spin"></i></span></h6>
                                                                             @if($keys->status == 2)
                                                                             <div class="formbid{{ $keys->id }}">
                                                                              <div class="form-group">
                                                                                  <label>Put your bid !</label>
                                                                                  <div class="input-group">
                                                                                  <input class="form-control put-your-bid b{{$keys->id}}" >
                                                                                  <span class="input-group-btn"><button data-auctionid="{{$keys->id}}" class="btn btn-solid bid-button" type="button" style="padding:10px;border-radius:0px">BID !</button></span>
                                                                                  </div>
                                                                              </div>

                                                                          <a href="{{ route('auctiondetail',['id' => $keys->id]) }}" class="btn btn-solid pull-right" style="padding:10px;border-radius:0px;margin-left:20px">Detail</a>
                                                                           @if($keys->fixed_price != null)
                                                                           <form action="{{ route('auctioncheckout') }}" id="form{{ $keys->id }}" method="POST">
                                                                                  @csrf
                                                                                  <input type="hidden" name="auction_id" value="{{ $keys->id }}">
                                                                              </form>
                                                                              <button class="btn btn-solid pull-right buynowbutton" data-id="{{ $keys->id }}" type="button" style="padding:10px;border-radius:0px">BUY NOW FOR {{ number_format($keys->fixed_price) }} !</button>
                                                                           @endif
                                                                             </div>
                                                                           @endif
                                                                      </div>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          @endforeach
                                                          @else
                                                          <div class="row">
                                                              <div class="col-md-12 text-center" style="padding-top:30px;padding-bottom:200px">
                                                                  <h4>No auction today</h4>
                                                              </div>
                                                          </div>
                                                          @endif
                                                      </div>
                                                      <div class="tab-pane fade" id="top-contact" role="tabpanel" aria-labelledby="contact-top-tab">
                                                          @foreach($allauction as $row)
                                                              <div class="row" style="border: 1px solid #ddd;padding:30px;margin:20px">
                                                              <div class="col-md-3" style="background-image:url('/images/{{ $row->product->image }}');background-size:contain;height:150px;background-position:center center ;background-repeat:no-repeat">
                                                                  </div>
                                                                  <div class="col-md-1">
                                                                  </div>
                                                                  <div class="col-md-8">
                                                                      <div class="row">
                                                                      <div class="col-md-12">
                                                                      <a href="#"><h3  style="color:black">{{$row->product->product_name}}</h3></a>
                                                                      </div>
                                                                      <div class="col-md-6">
                                                                      {{-- <h6 style="margin-top:10px;margin-bottom:5px">IDR {{number_format($row->product->final_price,2,',','.')}}</h6> --}}
                                                                          <h6 class="text-grey" style="font-size:12pt">{{$row->product->categories->name}}</h6>
                                                                          @php
                                                                              $datetime1 = new DateTime($row->bid_end);
                                                                              $datetime2 = new DateTime(date('Y-m-d H:i',strtotime('now')));
                                                                              $interval = $datetime1->diff($datetime2)->i;

                                                                          @endphp
                                                                          <h6 class="text-primary" style="font-size:12pt">Auction end in : </h6>
                                                                          <div class="timer" style="padding:0;margin:0;background-color:#fff">

                                                                              <p style="color:black;font-size:18px;padding:0;margin-bottom:0px;line-height:1.5" countdown data-text="
                                                                              <span>%s <span class='padding-l'>:</span> <span class='timer-cal'>Days</span> </span><span>%s <span class='padding-l'>:</span> <span class='timer-cal'>Hrs</span> </span><span>%s <span class='padding-l'>:</span> <span class='timer-cal'>Min</span> </span><span>%s <span class='timer-cal'>Sec</span></span>
                                                                             "

                                                                              >{{ $row->bid_end }}</p>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-6">
                                                                              <h6 class="" style="font-size:12pt">Highest Bid : <span class="pull-right text-primary highbid{{$row->id}}">
                                                                              {{ empty($allauction->find($row->id)->participant->sortByDesc('bid')->first()->bid) ? '-' :$allauction->find($row->id)->participant->sortByDesc('bid')->first()->bid }}
                                                                            </span>
                                                                              <span class="pull-right text-primary spinload{{$row->id}}" style="display:none;">
                                                                              <i class="fa fa-spinner fa-spin"></i></span></h6>
                                                                           <h6 class="" style="font-size:12pt">Your Bid : <span class="pull-right text-primary yourbid{{$row->id}}">
                                                                             @if (Auth::check())
                                                                                @if (!empty($allauction->find($row->id)->participant->where('user_id', Auth::user()->id)->last()->bid))
                                                                                  {{$allauction->find($row->id)->participant->where('user_id', Auth::user()->id)->last()->bid}}
                                                                                @else
                                                                                -
                                                                                @endif
                                                                             @else
                                                                             -
                                                                             @endif
                                                                           </span>
                                                                             <span class="pull-right text-primary spinload{{$row->id}}" style="display:none;">
                                                                             <i class="fa fa-spinner fa-spin"></i></span></h6>
                                                                           <div class="form-group">
                                                                               <label>Put your bid !</label>
                                                                               <div class="input-group">
                                                                               <input class="form-control put-your-bid b{{$row->id}}" >
                                                                               <span class="input-group-btn"><button data-auctionid="{{$row->id}}" class="btn btn-solid bid-button" type="button" style="padding:10px;border-radius:0px">BID !</button></span>
                                                                               </div>
                                                                           </div>
                                                                          <a href="{{ route('auctiondetail',['id' => $row->id]) }}" class="btn btn-solid pull-right" style="padding:10px;border-radius:0px;margin-left:20px">Detail</a>
                                                                           @if($row->fixed_price != null)
                                                                              <form action="{{ route('auctioncheckout') }}" id="form{{ $row->id }}" method="POST">
                                                                                  @csrf
                                                                                  <input type="hidden" name="auction_id" value="{{ $row->id }}">
                                                                              </form>
                                                                              <button class="btn btn-solid pull-right buynowbutton" data-id="{{ $row->id }}" type="button" style="padding:10px;border-radius:0px">BUY NOW FOR {{ number_format($row->fixed_price) }} !</button>
                                                                           @endif
                                                                      </div>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          @endforeach
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
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
