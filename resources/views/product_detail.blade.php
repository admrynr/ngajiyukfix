@extends('layouts-front.master')

@section('content')
<!-- breadcrumb start -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title">
                    <h2>register</h2></div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">register</li>
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
                              <div><img src="{{url('images/'.$product->image)}}" alt="" class="img-fluid blur-up lazyload"></div>
                              @foreach ($media as $m)
                                <div><img src="{{url('images/'.$m->src)}}" alt="" class="img-fluid blur-up lazyload"></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-sm-10 col-xs-12 order-up">
                    <div class="product-right-slick">
                      @php $iter=1;@endphp
                      <div><img src="{{url('images/'.$product->image)}}" alt="" class="img-fluid blur-up lazyload image_zoom_cls-0"></div>
                      @foreach ($media as $me)
                        <div><img src="{{url('images/'.$me->src)}}" alt="" class="img-fluid blur-up lazyload image_zoom_cls-{{$iter}}"></div>
                        @php $iter++; @endphp
                      @endforeach
                    </div>
                </div>
                <div class="col-lg-6 rtl-text">
                    <div class="product-right">
                        <h2>{{$product->product_name}}</h2>
                        <h4><del>Rp {{number_format($product->final_price,2,',','.')}}</del><span>0% off</span></h4>
                        <h3>Rp {{number_format($product->final_price,2,',','.')}}</h3>
                        <div class="product-description border-product">
                            <div class="modal fade" id="sizemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Sheer Straight Kurta</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h6 class="product-title">quantity</h6>
                            <div class="qty-box">
                                <div class="input-group"><span class="input-group-prepend"><button type="button" class="btn quantity-left-minus" data-type="minus" data-field=""><i class="ti-angle-left"></i></button> </span>
                                    <input type="text" name="quantity" class="form-control input-number" value="1"> <span class="input-group-prepend"><button type="button" class="btn quantity-right-plus" data-type="plus" data-field=""><i class="ti-angle-right"></i></button></span></div>
                            </div>
                        </div>
                        <div class="product-buttons"><a href="#" data-productid="{{ $product->id }}" data-toggle="modal" data-target="#addtocart" class="btn btn-solid updatecart">add to cart</a> <a href="{{route('cart.viewcart')}}" class="btn btn-solid">buy now</a></div>
                        <div class="border-product">
                            <h6 class="product-title">product details</h6>
                            {!!$product->product_description!!}                        </div>
                        <div class="border-product">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section ends -->

@endsection
@section('scripts')
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
