@extends('layouts-front.master')

@section('content')
<!-- Home slider -->
<section class="p-0 " style="margin-right:25px;margin-left:25px;">
    <div class="slide-1 home-slider autostart ">
      @foreach ($category as $cat)
        <div>
            <div class="home  text-center ">
                <img src="{{url('images/'.$cat->image)}}" alt="" class="bg-img blur-up lazyload" style="padding-top:10px;border-radius:10">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="slider-contain">
                                <div class="contain-bliomi">
                                    <h4>welcome to fashion</h4>
                                    <h1>{{$cat->name}}</h1>
                                    <a href="{{route('category_detail', ['$id' => $cat->id])}}" class="btn btn-solid">shop now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
<!-- Home slider end -->

<!-- collection banner -->
<section class="pb-0 ratio2_1">
    <div class="container">
        <div class="row partition2">
          @foreach ($category as $categories)
            <div class="col-md-6">
                <a href="{{route('category_detail', ['$id' => $cat->id])}}">
                    <div class="collection-banner p-right text-center">
                        <div class="img-part">
                            <img src="{{url('images/'.$categories->image)}}" class="img-fluid blur-up lazyload bg-img" alt="">
                        </div>
                        <div class="contain-banner">
                            <div class="contain-bliomi">
                                <h4>save 30%</h4>
                                <h2>{{$categories->name}}</h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- collection banner end -->

<!-- service layout -->
<div class="container">
        <section class="service border-section small-section">
            <div class="row">
                <div class="col-md-4 service-block">
                    <div class="media">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -117 679.99892 679">
                            <path d="m12.347656 378.382812h37.390625c4.371094 37.714844 36.316407 66.164063 74.277344 66.164063 37.96875 0 69.90625-28.449219 74.28125-66.164063h241.789063c4.382812 37.714844 36.316406 66.164063 74.277343 66.164063 37.96875 0 69.902344-28.449219 74.285157-66.164063h78.890624c6.882813 0 12.460938-5.578124 12.460938-12.460937v-352.957031c0-6.882813-5.578125-12.464844-12.460938-12.464844h-432.476562c-6.875 0-12.457031 5.582031-12.457031 12.464844v69.914062h-105.570313c-4.074218.011719-7.890625 2.007813-10.21875 5.363282l-68.171875 97.582031-26.667969 37.390625-9.722656 13.835937c-1.457031 2.082031-2.2421872 4.558594-2.24999975 7.101563v121.398437c-.09765625 3.34375 1.15624975 6.589844 3.47656275 9.003907 2.320312 2.417968 5.519531 3.796874 8.867187 3.828124zm111.417969 37.386719c-27.527344 0-49.851563-22.320312-49.851563-49.847656 0-27.535156 22.324219-49.855469 49.851563-49.855469 27.535156 0 49.855469 22.320313 49.855469 49.855469 0 27.632813-22.21875 50.132813-49.855469 50.472656zm390.347656 0c-27.53125 0-49.855469-22.320312-49.855469-49.847656 0-27.535156 22.324219-49.855469 49.855469-49.855469 27.539063 0 49.855469 22.320313 49.855469 49.855469.003906 27.632813-22.21875 50.132813-49.855469 50.472656zm140.710938-390.34375v223.34375h-338.375c-6.882813 0-12.464844 5.578125-12.464844 12.460938 0 6.882812 5.582031 12.464843 12.464844 12.464843h338.375v79.761719h-66.421875c-4.382813-37.710937-36.320313-66.15625-74.289063-66.15625-37.960937 0-69.898437 28.445313-74.277343 66.15625h-192.308594v-271.324219h89.980468c6.882813 0 12.464844-5.582031 12.464844-12.464843 0-6.882813-5.582031-12.464844-12.464844-12.464844h-89.980468v-31.777344zm-531.304688 82.382813h99.703125v245.648437h-24.925781c-4.375-37.710937-36.3125-66.15625-74.28125-66.15625-37.960937 0-69.90625 28.445313-74.277344 66.15625h-24.929687v-105.316406l3.738281-5.359375h152.054687c6.882813 0 12.460938-5.574219 12.460938-12.457031v-92.226563c0-6.882812-5.578125-12.464844-12.460938-12.464844h-69.796874zm-30.160156 43h74.777344v67.296875h-122.265625zm0 0" fill="#ff4c3b" /> </svg>
                        <div class="media-body">
                            <h4>free shipping</h4>
                            <p>free shipping world wide</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 service-block">
                    <div class="media">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 480 480" style="enable-background:new 0 0 480 480;" xml:space="preserve" width="512px" height="512px">
                                <g>
                                    <g>
                                        <g>
                                            <path d="M472,432h-24V280c-0.003-4.418-3.588-7.997-8.006-7.994c-2.607,0.002-5.05,1.274-6.546,3.41l-112,160 c-2.532,3.621-1.649,8.609,1.972,11.14c1.343,0.939,2.941,1.443,4.58,1.444h104v24c0,4.418,3.582,8,8,8s8-3.582,8-8v-24h24 c4.418,0,8-3.582,8-8S476.418,432,472,432z M432,432h-88.64L432,305.376V432z" fill="#ff4c3b" />
                                            <path d="M328,464h-94.712l88.056-103.688c0.2-0.238,0.387-0.486,0.56-0.744c16.566-24.518,11.048-57.713-12.56-75.552 c-28.705-20.625-68.695-14.074-89.319,14.631C212.204,309.532,207.998,322.597,208,336c0,4.418,3.582,8,8,8s8-3.582,8-8 c-0.003-26.51,21.486-48.002,47.995-48.005c10.048-0.001,19.843,3.151,28.005,9.013c16.537,12.671,20.388,36.007,8.8,53.32 l-98.896,116.496c-2.859,3.369-2.445,8.417,0.924,11.276c1.445,1.226,3.277,1.899,5.172,1.9h112c4.418,0,8-3.582,8-8 S332.418,464,328,464z" fill="#ff4c3b" />
                                            <path d="M216.176,424.152c0.167-4.415-3.278-8.129-7.693-8.296c-0.001,0-0.002,0-0.003,0 C104.11,411.982,20.341,328.363,16.28,224H48c4.418,0,8-3.582,8-8s-3.582-8-8-8H16.28C20.283,103.821,103.82,20.287,208,16.288 V40c0,4.418,3.582,8,8,8s8-3.582,8-8V16.288c102.754,3.974,185.686,85.34,191.616,188l-31.2-31.2 c-3.178-3.07-8.242-2.982-11.312,0.196c-2.994,3.1-2.994,8.015,0,11.116l44.656,44.656c0.841,1.018,1.925,1.807,3.152,2.296 c0.313,0.094,0.631,0.172,0.952,0.232c0.549,0.198,1.117,0.335,1.696,0.408c0.08,0,0.152,0,0.232,0c0.08,0,0.152,0,0.224,0 c0.609-0.046,1.211-0.164,1.792-0.352c0.329-0.04,0.655-0.101,0.976-0.184c1.083-0.385,2.069-1.002,2.888-1.808l45.264-45.248 c3.069-3.178,2.982-8.242-0.196-11.312c-3.1-2.994-8.015-2.994-11.116,0l-31.976,31.952 C425.933,90.37,331.38,0.281,216.568,0.112C216.368,0.104,216.2,0,216,0s-0.368,0.104-0.568,0.112 C96.582,0.275,0.275,96.582,0.112,215.432C0.112,215.632,0,215.8,0,216s0.104,0.368,0.112,0.568 c0.199,115.917,91.939,210.97,207.776,215.28h0.296C212.483,431.847,216.013,428.448,216.176,424.152z" fill="#ff4c3b" />
                                            <path d="M323.48,108.52c-3.124-3.123-8.188-3.123-11.312,0L226.2,194.48c-6.495-2.896-13.914-2.896-20.408,0l-40.704-40.704 c-3.178-3.069-8.243-2.981-11.312,0.197c-2.994,3.1-2.994,8.015,0,11.115l40.624,40.624c-5.704,11.94-0.648,26.244,11.293,31.947 c9.165,4.378,20.095,2.501,27.275-4.683c7.219-7.158,9.078-18.118,4.624-27.256l85.888-85.888 C326.603,116.708,326.603,111.644,323.48,108.52z M221.658,221.654c-0.001,0.001-0.001,0.001-0.002,0.002 c-3.164,3.025-8.148,3.025-11.312,0c-3.125-3.124-3.125-8.189-0.002-11.314c3.124-3.125,8.189-3.125,11.314-0.002 C224.781,213.464,224.781,218.53,221.658,221.654z" fill="#ff4c3b" /> </g>
                                    </g>
                                </g>
                            </svg>
                        <div class="media-body">
                            <h4>24 X 7 service</h4>
                            <p>online service for new customer</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 service-block">
                    <div class="media">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -14 512.00001 512">
                            <path d="m136.964844 308.234375c4.78125-2.757813 6.417968-8.878906 3.660156-13.660156-2.761719-4.777344-8.878906-6.417969-13.660156-3.660157-4.78125 2.761719-6.421875 8.882813-3.660156 13.660157 2.757812 4.78125 8.878906 6.421875 13.660156 3.660156zm0 0" fill="#ff4c3b" />
                            <path d="m95.984375 377.253906 50.359375 87.230469c10.867188 18.84375 35.3125 25.820313 54.644531 14.644531 19.128907-11.054687 25.703125-35.496094 14.636719-54.640625l-30-51.96875 25.980469-15c4.78125-2.765625 6.421875-8.878906 3.660156-13.660156l-13.003906-22.523437c1.550781-.300782 11.746093-2.300782 191.539062-37.570313 22.226563-1.207031 35.542969-25.515625 24.316407-44.949219l-33.234376-57.5625 21.238282-32.167968c2.085937-3.164063 2.210937-7.230469.316406-10.511719l-20-34.640625c-1.894531-3.28125-5.492188-5.203125-9.261719-4.980469l-38.472656 2.308594-36.894531-63.90625c-5.34375-9.257813-14.917969-14.863281-25.605469-14.996094-.128906-.003906-.253906-.003906-.382813-.003906-10.328124 0-19.703124 5.140625-25.257812 13.832031l-130.632812 166.414062-84.925782 49.03125c-33.402344 19.277344-44.972656 62.128907-25.621094 95.621094 17.679688 30.625 54.953126 42.671875 86.601563 30zm102.324219 57.238282c5.523437 9.554687 2.253906 21.78125-7.328125 27.316406-9.613281 5.558594-21.855469 2.144531-27.316407-7.320313l-50-86.613281 34.640626-20c57.867187 100.242188 49.074218 85.011719 50.003906 86.617188zm-22.683594-79.296876-10-17.320312 17.320312-10 10 17.320312zm196.582031-235.910156 13.820313 23.9375-12.324219 18.664063-23.820313-41.261719zm-104.917969-72.132812c2.683594-4.390625 6.941407-4.84375 8.667969-4.796875 1.707031.019531 5.960938.550781 8.527344 4.996093l116.3125 201.464844c3.789063 6.558594-.816406 14.804688-8.414063 14.992188-1.363281.03125-1.992187.277344-5.484374.929687l-123.035157-213.105469c2.582031-3.320312 2.914063-3.640624 3.425781-4.480468zm-16.734374 21.433594 115.597656 200.222656-174.460938 34.21875-53.046875-91.878906zm-223.851563 268.667968c-4.390625-7.597656-6.710937-16.222656-6.710937-24.949218 0-17.835938 9.585937-34.445313 25.011718-43.351563l77.941406-45 50 86.601563-77.941406 45.003906c-23.878906 13.78125-54.515625 5.570312-68.300781-18.304688zm0 0" fill="#ff4c3b" />
                            <path d="m105.984375 314.574219c-2.761719-4.78125-8.878906-6.421875-13.660156-3.660157l-17.320313 10c-4.773437 2.757813-10.902344 1.113282-13.660156-3.660156-2.761719-4.78125-8.878906-6.421875-13.660156-3.660156s-6.421875 8.878906-3.660156 13.660156c8.230468 14.257813 26.589843 19.285156 40.980468 10.980469l17.320313-10c4.78125-2.761719 6.421875-8.875 3.660156-13.660156zm0 0" fill="#ff4c3b" />
                            <path d="m497.136719 43.746094-55.722657 31.007812c-4.824218 2.6875-6.5625 8.777344-3.875 13.601563 2.679688 4.820312 8.765626 6.566406 13.601563 3.875l55.71875-31.007813c4.828125-2.6875 6.5625-8.777344 3.875-13.601562-2.683594-4.828125-8.773437-6.5625-13.597656-3.875zm0 0" fill="#ff4c3b" />
                            <path d="m491.292969 147.316406-38.636719-10.351562c-5.335938-1.429688-10.820312 1.734375-12.25 7.070312-1.429688 5.335938 1.738281 10.816406 7.074219 12.246094l38.640625 10.351562c5.367187 1.441407 10.824218-1.773437 12.246094-7.070312 1.429687-5.335938-1.738282-10.820312-7.074219-12.246094zm0 0" fill="#ff4c3b" />
                            <path d="m394.199219 7.414062-10.363281 38.640626c-1.429688 5.335937 1.734374 10.816406 7.070312 12.25 5.332031 1.425781 10.816406-1.730469 12.25-7.070313l10.359375-38.640625c1.429687-5.335938-1.734375-10.820312-7.070313-12.25-5.332031-1.429688-10.816406 1.734375-12.246093 7.070312zm0 0" fill="#ff4c3b" /> </svg>
                        <div class="media-body">
                            <h4>festival offer</h4>
                            <p>new online special festival offer</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- service layout  end -->

<!-- Paragraph-->
{{-- <div class="title1 section-t-space">
    <h4>special offer</h4>
    <h2 class="title-inner1">top collection</h2>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="product-para">
                <p class="text-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
            </div>
        </div>
    </div>
</div> --}}
<!-- Paragraph end -->




<!-- Parallax banner -->
{{-- <section class="p-0">
    <div class="full-banner parallax text-center p-left">
        <img src="/images/bg-trend.png" alt="" class="bg-img blur-up lazyload">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="banner-contain">
                        <h2>2018</h2>
                        <h3>fashion trends</h3>
                        <h4>special offer</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- Parallax banner end -->
{{-- <div class="title1 section-t-space">
    <h4>exclusive products</h4>
    <h2 class="title-inner1">Today's auction</h2>
</div>
<section class="section-b-space p-t-0 ratio_asos">
    <div class="container">
        <div class="row">
                    @if($auction->count() != 0)

                    @foreach($auction as $keys)
                        <div class="col-md-6" style="border: 1px solid #ddd;padding:30px;margin:20px">
                            <div class="row">
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
                                <h6 style="margin-top:10px;margin-bottom:5px">IDR {{number_format($keys->product->final_price,2,',','.')}}</h6>
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
                                        {{ empty($auction->find($keys->id)->participant->sortByDesc('bid')->first()->bid) ? '-' : 'Rp. '.number_format($auction->find($keys->id)->participant->sortByDesc('bid')->first()->bid) }}
                                        </span>
                                        <span class="pull-right text-primary spinload{{$keys->id}}" style="display:none;">
                                        <i class="fa fa-spinner fa-spin"></i></span></h6>
                                        <h6 class="" style="font-size:12pt">Your Bid : <span class="pull-right text-primary yourbid{{$keys->id}}">
                                       @if (Auth::check())
                                          @if (!empty($auction->find($keys->id)->participant->where('user_id', Auth::user()->id)->last()->bid))
                                            Rp. {{number_format($auction->find($keys->id)->participant->where('user_id', Auth::user()->id)->last()->bid)}}
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
                        </div>
                    @endforeach
                    @else
                        <div class="col-md-12 text-center" style="padding-top:30px;padding-bottom:200px">
                            <h4>No auction today</h4>
                        </div>
                    @endif
        </div>
    </div>
</section> --}}


<!-- Tab product -->
<div class="title1 section-t-space">
    <h4>exclusive products</h4>
    <h2 class="title-inner1">special products</h2>
</div>
<section class="section-b-space p-t-0 ratio_asos">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="theme-tab">
                    <ul class="tabs tab-title">
                        <li class="current"><a href="tab-4">New Products</a></li>
                        <li class=""><a href="tab-5">Featured Products</a></li>
                        <li class=""><a href="tab-6">Best Sellers</a></li>
                    </ul>
                    <div class="tab-content-cls">
                        <div id="tab-4" class="tab-content active default">
                            <div class="no-slider row">
                              @foreach ($new as $p)
                              <div class="product-box" style="border: 1px solid #f5f5f5; border-radius:10px">
                                <a href="{{route("product_detail", ['id' => $p->id])}}" >
                                    <div class="img-wrapper" style="height:0;width:100%;padding-bottom:100%;background-image:url('/images/{{ $p->image }}');background-size:contain;background-position:center center;background-repeat:no-repeat;background-color:white">

                                    </div>
                                </a>
                                  <div class="product-detail" style="padding:10px">
                                      <div>
                                          {{-- <div class="rating">
                                                  <a href="compare.html" title="Compare"><i class="ti-shopping-cart" ></i></a>
                                                  <a id="coba" href="javascript:void(0)" title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a>
                                                  <a href="#" data-toggle="modal" data-target="#quick-view" title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                                  <a href="compare.html" title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                                          </div> --}}
                                          <div class="row" style="margin-top:10px">
                                              <div class="col-md-6">
                                                      <a href="#" data-toggle="modal"  data-target="#quick-view{{ $p->id }}"><button class="btn btn-sm btn-secondary" data-title="Quick View" data-toggle="tooltip"><i class="ti-search" aria-hidden="true"></i></button></a>
                                              </div>
                                              <div class="col-md-6 text-right">
                                                  <button class="btn btn-sm btn-secondary addtocart"  data-productid="{{ $p->id }}" data-title="Add to Cart" data-toggle="tooltip"><i class="ti-shopping-cart" ></i></button>
                                                  <button class="btn btn-sm btn-secondary" data-title="Add to Wishlist" data-toggle="tooltip"><i class="ti-heart" aria-hidden="true"></i></button>

                                              </div>
                                          </div>
                                          <a href="{{route("product_detail", ['id' => $p->id])}}"><h4  style="margin-top:10px">{{$p->product_name}}</h4></a>
                                          <p>{!!$p->product_description!!}</p>
                                          <h6 style="margin-top:10px;margin-bottom:5px">IDR {{number_format($p->final_price,2,',','.')}}</h6>
                                          <h6 class="text-primary" style="font-size:10pt">{{$p->categories->name}}</h6>
                                      </div>
                                  </div>
                              </div>
                                @endforeach
                            </div>
                        </div>
                        <div id="tab-5" class="tab-content">
                                <div class="no-slider row">
                                  @foreach($feature as $f)
                                  <div class="product-box" style="border: 1px solid #f5f5f5; border-radius:10px">
                                      <div class="img-wrapper" style="height:0;width:100%;padding-bottom:100%">
                                          <div class="front">
                                              <a href="{{route("product_detail", ['id' => $f->id])}}"><img src="{{url('images/'.$f->image)}}" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                          </div>
                                          {{-- <div class="cart-info cart-wrap">
                                          <button data-toggle="modal" data-productid="{{ $f->id }}" class="addtocart" data-target="#addtocart" data-price="{{$f->final_price}}" data-name="{{$f->product_name}}" data-image="{{$f->image}}" title="Add to cart"><i class="ti-shopping-cart" ></i></button>
                                          <a href="javascript:void(0)" title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a>
                                          <a href="#" data-toggle="modal"  data-target="#quick-view{{ $p->id }}" title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                          <a href="compare.html" title="Compare"><i class="ti-reload" aria-hidden="true"></i></a></div> --}}
                                      </div>
                                      <div class="product-detail" style="padding:10px">
                                          <div>
                                              {{-- <div class="rating">
                                                      <a href="compare.html" title="Compare"><i class="ti-shopping-cart" ></i></a>
                                                      <a id="coba" href="javascript:void(0)" title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a>
                                                      <a href="#" data-toggle="modal" data-target="#quick-view" title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                                      <a href="compare.html" title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                                              </div> --}}
                                              <div class="row" style="margin-top:10px">
                                                  <div class="col-md-6">
                                                          <a href="#" data-toggle="modal"  data-target="#quick-view{{ $f->id }}"><button class="btn btn-sm btn-secondary" data-title="Quick View" data-toggle="tooltip"><i class="ti-search" aria-hidden="true"></i></button></a>
                                                  </div>
                                                  <div class="col-md-6 text-right">
                                                      <button class="btn btn-sm btn-secondary addtocart"  data-productid="{{ $f->id }}" data-title="Add to Cart" data-toggle="tooltip"><i class="ti-shopping-cart" ></i></button>
                                                      <button class="btn btn-sm btn-secondary" data-title="Add to Wishlist" data-toggle="tooltip"><i class="ti-heart" aria-hidden="true"></i></button>

                                                  </div>
                                              </div>
                                              <a href="{{route("product_detail", ['id' => $f->id])}}"><h4  style="margin-top:10px">{{$f->product_name}}</h4></a>
                                              <p>{!!$f->product_description!!}</p>
                                              <h6 style="margin-top:10px;margin-bottom:5px">IDR {{number_format($f->final_price,2,',','.')}}</h6>
                                              <h6 class="text-primary" style="font-size:10pt">{{$f->categories->name}}</h6>
                                          </div>
                                      </div>
                                  </div>
                                        @endforeach
                                    </div>
                        </div>
                        <div id="tab-6" class="tab-content">
                                <div class="no-slider row">
                                  @foreach ($bestsell as $bs)
                                    <div class="product-box" style="border: 1px solid #f5f5f5; border-radius:10px">
                                      <div class="img-wrapper" style="height:0;width:100%;padding-bottom:100%">
                                          <div class="front">
                                              <a href="{{route("product_detail", ['id' => $bs->product->id])}}"><img src="{{url('images/'.$bs->product->image)}}" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                          </div>
                                          {{-- <div class="cart-info cart-wrap">
                                          <button data-toggle="modal" data-productid="{{ $bs->product->id }}" class="addtocart" data-target="#addtocart" data-price="{{$bs->product->final_price}}" data-name="{{$bs->product->product_name}}" data-image="{{$bs->product->image}}" title="Add to cart"><i class="ti-shopping-cart" ></i></button>
                                          <a href="javascript:void(0)" title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a>
                                          <a href="#" data-toggle="modal"  data-target="#quick-view{{ $bs->product->id }}" title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                          <a href="compare.html" title="Compare"><i class="ti-reload" aria-hidden="true"></i></a></div> --}}
                                      </div>
                                      <div class="product-detail" style="padding:10px">
                                          <div>
                                              {{-- <div class="rating">
                                                      <a href="compare.html" title="Compare"><i class="ti-shopping-cart" ></i></a>
                                                      <a id="coba" href="javascript:void(0)" title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a>
                                                      <a href="#" data-toggle="modal" data-target="#quick-view" title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                                      <a href="compare.html" title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                                              </div> --}}
                                              <div class="row" style="margin-top:10px">
                                                  <div class="col-md-6">
                                                          <a href="#" data-toggle="modal"  data-target="#quick-view{{ $bs->product->id }}"><button class="btn btn-sm btn-secondary" data-title="Quick View" data-toggle="tooltip"><i class="ti-search" aria-hidden="true"></i></button></a>
                                                  </div>
                                                  <div class="col-md-6 text-right">
                                                      <button class="btn btn-sm btn-secondary addtocart"  data-productid="{{ $bs->product->id }}" data-title="Add to Cart" data-toggle="tooltip"><i class="ti-shopping-cart" ></i></button>
                                                      <button class="btn btn-sm btn-secondary" data-title="Add to Wishlist" data-toggle="tooltip"><i class="ti-heart" aria-hidden="true"></i></button>

                                                  </div>
                                              </div>
                                              <a href="{{route("product_detail", ['id' => $bs->id])}}"><h4  style="margin-top:10px">{{$bs->product->product_name}}</h4></a>
                                              <p>{!!$bs->product->product_description!!}</p>
                                              <h6 style="margin-top:10px;margin-bottom:5px">IDR {{number_format($bs->product->final_price,2,',','.')}}</h6>
                                              <h6 class="text-primary" style="font-size:10pt">{{$bs->product->categories->name}}</h6>
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
</section>
<!-- Tab product end -->

<!-- blog section -->
<div class="container">
    <div class="row">
        <div class="col">
            <div class="title1 section-t-space">
                <h4>Recent Story</h4>
                <h2 class="title-inner1">from the blog</h2>
            </div>
        </div>
    </div>
</div>
<section class="section-b-space p-t-0 p-b-50 ratio2_3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="slide-3 no-arrow">
                  @foreach ($blog as $blog)
                    <div class="col-md-12">
                        <a href="{{route('blogdetail', ['id' => $blog->id])}}">
                            <div class="classic-effect">
                                <div>
                                    <img src="{{url('images/'.$blog->thumbnail)}}" class="img-fluid blur-up lazyload bg-img" alt="">
                                </div>
                                <span></span>
                            </div>
                        </a>
                        <div class="blog-details">
                            <h4>{{$blog->date}}</h4>
                            <a href="{{route('blogdetail', ['id' => $blog->id])}}">
                                <p>{{$blog->title}}</p>
                            </a>
                            <h6 class="mt-3">by: {{$blog->user->name}}</h6>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
<!-- blog section end -->


<!-- instagram section -->
{{-- <section class="instagram ratio_square">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 p-0">
                <h2 class="title-borderless"># instagram</h2>
                <div class="slide-7 no-arrow slick-instagram">
                    <div>
                        <a href="#">
                            <div class="instagram-box"> <img src="/assets-front/images/slider/2.jpg" class="bg-img" alt="Avatar" style="width:100%">
                                <div class="overlay"><i class="fa fa-instagram" aria-hidden="true"></i></div>
                            </div>
                        </a>
                    </div>
                    <div>
                        <a href="#">
                            <div class="instagram-box"> <img src="/assets-front/images/slider/3.jpg" class="bg-img" alt="Avatar" style="width:100%">
                                <div class="overlay"><i class="fa fa-instagram" aria-hidden="true"></i></div>
                            </div>
                        </a>
                    </div>
                    <div>
                        <a href="#">
                            <div class="instagram-box"> <img src="/assets-front/images/slider/4.jpg" class="bg-img" alt="Avatar" style="width:100%">
                                <div class="overlay"><i class="fa fa-instagram" aria-hidden="true"></i></div>
                            </div>
                        </a>
                    </div>
                    <div>
                        <a href="#">
                            <div class="instagram-box"> <img src="/assets-front/images/slider/9.jpg" class="bg-img" alt="Avatar" style="width:100%">
                                <div class="overlay"><i class="fa fa-instagram" aria-hidden="true"></i></div>
                            </div>
                        </a>
                    </div>
                    <div>
                        <a href="#">
                            <div class="instagram-box"> <img src="/assets-front/images/slider/6.jpg" class="bg-img" alt="Avatar" style="width:100%">
                                <div class="overlay"><i class="fa fa-instagram" aria-hidden="true"></i></div>
                            </div>
                        </a>
                    </div>
                    <div>
                        <a href="#">
                            <div class="instagram-box"> <img src="/assets-front/images/slider/7.jpg" class="bg-img" alt="Avatar" style="width:100%">
                                <div class="overlay"><i class="fa fa-instagram" aria-hidden="true"></i></div>
                            </div>
                        </a>
                    </div>
                    <div>
                        <a href="#">
                            <div class="instagram-box"> <img src="/assets-front/images/slider/8.jpg" class="bg-img" alt="Avatar" style="width:100%">
                                <div class="overlay"><i class="fa fa-instagram" aria-hidden="true"></i></div>
                            </div>
                        </a>
                    </div>
                    <div>
                        <a href="#">
                            <div class="instagram-box"> <img src="/assets-front/images/slider/9.jpg" class="bg-img" alt="Avatar" style="width:100%">
                                <div class="overlay"><i class="fa fa-instagram" aria-hidden="true"></i></div>
                            </div>
                        </a>
                    </div>
                    <div>
                        <a href="#">
                            <div class="instagram-box"> <img src="/assets-front/images/slider/2.jpg" class="bg-img" alt="Avatar" style="width:100%">
                                <div class="overlay"><i class="fa fa-instagram" aria-hidden="true"></i></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- instagram section end -->


<!--  logo section -->
{{-- <section class="section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="slide-6 no-arrow">
                    <div>
                        <div class="logo-block">
                            <a href="#"><img src="/assets-front/images/logos/1.png" alt=""></a>
                        </div>
                    </div>
                    <div>
                        <div class="logo-block">
                            <a href="#"><img src="/assets-front/images/logos/2.png" alt=""></a>
                        </div>
                    </div>
                    <div>
                        <div class="logo-block">
                            <a href="#"><img src="/assets-front/images/logos/3.png" alt=""></a>
                        </div>
                    </div>
                    <div>
                        <div class="logo-block">
                            <a href="#"><img src="/assets-front/images/logos/4.png" alt=""></a>
                        </div>
                    </div>
                    <div>
                        <div class="logo-block">
                            <a href="#"><img src="/assets-front/images/logos/5.png" alt=""></a>
                        </div>
                    </div>
                    <div>
                        <div class="logo-block">
                            <a href="#"><img src="/assets-front/images/logos/6.png" alt=""></a>
                        </div>
                    </div>
                    <div>
                        <div class="logo-block">
                            <a href="#"><img src="/assets-front/images/logos/7.png" alt=""></a>
                        </div>
                    </div>
                    <div>
                        <div class="logo-block">
                            <a href="#"><img src="/assets-front/images/logos/8.png" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!--  logo section end-->
@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('plugins/countdown-master/dist/countdown.min.js') }}" ></script>
<script src="/js/auction.js"></script>
<script>
$(window).on('load',function(){
        $('#exampleModal').modal('show');
        @foreach($auction as $jav)
            @if($jav->status == 2)
            $('.countdown{{ $jav->id }}').countdown({
                end : function(){
                    id = '{{ $jav->id }}';
                        $.ajax({
                            url: baseURL+'/auctionbidend',
                            data:{
                                id: '{{ $jav->id }}',
                            },
                            dataType: 'json',
                            type: 'GET',
                            success: function(data){
                                $('.timer'+'{{ $jav->id }}').css('display','none');
                                if(data.status == 4){
                                    $('#auctionfailed'+'{{ $jav->id }}').css('display','block');
                                }else{
                                    $('#auctionfinished'+'{{ $jav->id }}').css('display','block');
                                }
                                $('.formbid'+'{{ $jav->id }}').css('display','none');
                                $('.infobid'+'{{ $jav->id }}').css('display','none');
                                $('.infoendbid'+'{{ $jav->id }}').css('display','block');
                                $('#winnerbid'+'{{ $jav->id }}').html(data.winnerbid);
                                $('#winner'+'{{ $jav->id }}').html(data.winner);
                            }
                        });


                }
            });
            @endif
        @endforeach
    });
</script>

@endsection
