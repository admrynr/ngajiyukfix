@extends('layouts-front.master')

@section('content')
<!-- breadcrumb start -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title">
                    <h2>auction detail</h2></div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('auction') }}">auction</a></li>
                        <li class="breadcrumb-item active" aria-current="page">auction detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb end -->

<!-- section start -->
<section>
    <div class="collection-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-1 col-sm-2 col-xs-12">
                    <div class="row">
                        <div class="col-12 p-0">
                            <div class="slider-right-nav">
                              <div><img src="{{url('images/'.$auction->product->image)}}" alt="" class="img-fluid blur-up lazyload"></div>
                              @foreach ($auction->product->product_media as $m)
                                <div><img src="{{url('images/'.$m->src)}}" alt="" class="img-fluid blur-up lazyload"></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-5 col-sm-10 col-xs-12 order-up">
                    <div class="product-right-slick">
                      @php $iter=1;@endphp
                      <div><img src="{{url('images/'.$auction->product->image)}}" alt="" class="img-fluid blur-up lazyload image_zoom_cls-0"></div>
                      @foreach ($auction->product->product_media as $me)
                        <div><img src="{{url('images/'.$me->src)}}" alt="" class="img-fluid blur-up lazyload image_zoom_cls-{{$iter}}"></div>
                        @php $iter++; @endphp
                      @endforeach
                    </div>
                </div>
                <div class="col-lg-6 rtl-text">
                    <div class="product-right">
                        <h2>{{$auction->product->product_name}}</h2>
                        {{-- <h4><del>Rp {{number_format($auction->product->final_price,2,',','.')}}</del><span>0% off</span></h4> --}}
                        {{-- <h3>Rp {{number_format($auction->product->final_price,2,',','.')}}</h3> --}}
                        <div class="product-description border-product">
                                <h6 class="text-primary" style="font-size:12pt">Auction end in : </h6>
                                <div class="timer" style="padding:0;margin:0;background-color:#fff">

                                    <p style="color:black;font-size:18px;padding:0;margin-bottom:0px;line-height:1.5" countdown data-text="
                                    <span>%s <span class='padding-l'>:</span> <span class='timer-cal'>Days</span> </span><span>%s <span class='padding-l'>:</span> <span class='timer-cal'>Hrs</span> </span><span>%s <span class='padding-l'>:</span> <span class='timer-cal'>Min</span> </span><span>%s <span class='timer-cal'>Sec</span></span>
                                   "

                                    >{{ $auction->bid_end }}</p>
                                </div>
                                <h6 class="text-primary" style="font-size:12pt;margin-top:20px">Highest Bid : <span class="pull-right text-primary highbid{{$auction->id}}">
                                        {{ empty($auction->find($auction->id)->participant->sortByDesc('bid')->first()->bid) ? '-' :$auction->find($auction->id)->participant->sortByDesc('bid')->first()->bid }}
                                      </span>
                                        <span class="pull-right text-primary spinload{{$auction->id}}" style="display:none;">
                                        <i class="fa fa-spinner"></i></span></h6>
                                     <h6 class="text-primary" style="font-size:12pt;margin-top:20px">Your Bid : <span class="pull-right text-primary yourbid{{$auction->id}}">
                                       @if (Auth::check())
                                          @if (!empty($auction->find($auction->id)->participant->where('user_id', Auth::user()->id)->last()->bid))
                                            {{$auction->find($auction->id)->participant->where('user_id', Auth::user()->id)->last()->bid}}
                                          @else
                                          -
                                          @endif
                                       @else
                                       -
                                       @endif
                                     </span>
                                       <span class="pull-right text-primary spinload{{$auction->id}}" style="display:none;">
                                       <i class="fa fa-spinner"></i></span></h6>
                                     <div class="form-group" style="margin-top:20px">
                                         <label>Put your bid !</label>
                                         <div class="input-group">
                                         <input class="form-control put-your-bid b{{$auction->id}}" >
                                         <span class="input-group-btn"><button data-auctionid="{{$auction->id}}" class="btn btn-solid bid-button" type="button" style="padding:10px;border-radius:0px">BID !</button></span>
                                         </div>
                                     </div>
                        </div>
                        <div class="product-buttons">
                            @if($auction->fixed_price != null)
                                <button class="btn btn-solid" type="button" style="padding:10px;border-radius:0px">BUY NOW FOR {{ number_format($auction->fixed_price) }} !</button>
                            @endif
                        </div>
                        <div class="border-product">
                                
                            <h5 class="product-title" style="margin-bottom:10px">product details</h5>
                            {!!$auction->product->product_description!!}                        
                        </div>
                        {{-- <div class="border-product">
                            <h6 class="product-title">share it</h6>
                            <div class="product-icon">
                                <ul class="product-social">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa fa-rss"></i></a></li>
                                </ul>
                                <form class="d-inline-block">
                                    <button class="wishlist-btn"><i class="fa fa-heart"></i><span class="title-font">Add To WishList</span></button>
                                </form>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top:100px;margin-bottom:100px">
                <div class="col-lg-12">
                    <h2 style="font-size:16pt;margin-bottom:30px">Auction Participant</h2>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No </th>
                                    <th>Participant Name </th>
                                    <th>Bid </th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            @php
                                $i = 1;
                            @endphp
                                @foreach($auctionpar as $par)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $par->user->name }}</td>
                                    <td>{{ $par->bid }}</td>
                                    <td>-</td>
                                </tr>
                                @endforeach
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section ends -->

@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('plugins/countdown-master/dist/countdown.min.js') }}" ></script>
    <script type="text/javascript">
    $(window).on('load',function(){
        $('.updatecart').on('click',function(){
            id = $(this).data('id');
            productid = $(this).data('productid');
            qty = $('.input-number').val();
            console.log(qty);
            addqty(productid, qty);
            getcart();

        });
    });
    </script>
@endsection
