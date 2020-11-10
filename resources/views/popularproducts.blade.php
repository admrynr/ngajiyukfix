@extends('layouts-front.master')

@section('content')
<!-- breadcrumb start -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title">
                    <h2>product</h2></div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">product</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb end -->


<!-- section start -->
<section class="section-b-space ratio_asos">
    <div class="collection-wrapper">

        <div class="container">

            <div class="row">
                <div class="col-sm-3 collection-filter">
                    <!-- side-bar colleps block stat -->
                    <div class="collection-filter-block">
                        <!-- brand filter start -->
                    <form action="{{ route('product') }}" method="GET">
                        <input type="hidden" name="filter" value="1">
                        <div class="collection-mobile-back"><span class="filter-back"><i class="fa fa-angle-left" aria-hidden="true"></i> back</span></div>
                        <div class="collection-collapse-block open">
                            <h3 class="collapse-block-title">Category</h3>
                            <div class="collection-collapse-block-content">
                                <div class="collection-brand-filter">
                                    @foreach($category as $cat)
                                        <div class="custom-control custom-checkbox collection-filter-checkbox">
                                        <input type="checkbox" class="custom-control-input filter" name="categories_id[]" id="cat-{{ $cat->id }}" value="{{ $cat->id }}" {{ !empty(Request::get('categories_id')) ? in_array($cat->id, Request::get('categories_id')) ? 'checked' : '' : '' }}>
                                        <label class="custom-control-label" for="cat-{{ $cat->id }}">{{ $cat->name }}</label>
                                        </div>
                                    @endforeach

                                </div>
                            </div>

                        </div>
                        {{-- <div class="collection-collapse-block open">
                                <h3 class="collapse-block-title">harga</h3>
                                <div class="collection-collapse-block-content">
                                    <div class="collection-brand-filter">
                                        <div class="custom-control custom-checkbox collection-filter-checkbox">
                                            <input type="checkbox" class="custom-control-input filter" name="price[]" value="1" id="50000">
                                            <label class="custom-control-label" for="50000">< 50.000</label>
                                        </div>
                                        <div class="custom-control custom-checkbox collection-filter-checkbox">
                                            <input type="checkbox" class="custom-control-input filter" name="price[]" value="2" id="50000-100000">
                                            <label class="custom-control-label" for="50000-100000">50.000 - 100.000</label>
                                        </div>
                                        <div class="custom-control custom-checkbox collection-filter-checkbox">
                                            <input type="checkbox" class="custom-control-input filter" name="price[]" value="3" id="100000">
                                            <label class="custom-control-label" for="100000">> 100.000</label>
                                        </div>
                                    </div>
                                </div>

                            </div> --}}
                        <!-- color filter start here -->

                        <!-- price filter start here -->
                        <div class="collection-collapse-block border-0 open">
                                <button type="button" class="btn btn-secondary btn-block" id="reset-filter" style="margin-bottom:10px">reset filter</button>
                                <button type="submit" class="btn btn-primary btn-block" style="margin-bottom:10px">FIlter</button>

                        </div>
                    </form>
                    </div>
                    <!-- silde-bar colleps block end here -->
                    <!-- side-bar single product slider start -->
                    {{-- <div class="theme-card">
                        <h5 class="title-border">new product</h5>
                        <div class="offer-slider slide-1">
                            <div>
                                <div class="media">
                                    <a href=""><img class="img-fluid blur-up lazyload" src="/assets-front/images/pro/1.jpg" alt=""></a>
                                    <div class="media-body align-self-center">
                                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div><a href="product-page(no-sidebar).html"><h6>Slim Fit Cotton Shirt</h6></a>
                                        <h4>$500.00</h4></div>
                                </div>
                                <div class="media">
                                    <a href=""><img class="img-fluid blur-up lazyload" src="/assets-front/images/pro/1.jpg" alt=""></a>
                                    <div class="media-body align-self-center">
                                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div><a href="product-page(no-sidebar).html"><h6>Slim Fit Cotton Shirt</h6></a>
                                        <h4>$500.00</h4></div>
                                </div>
                                <div class="media">
                                    <a href=""><img class="img-fluid blur-up lazyload" src="/assets-front/images/pro/1.jpg" alt=""></a>
                                    <div class="media-body align-self-center">
                                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div><a href="product-page(no-sidebar).html"><h6>Slim Fit Cotton Shirt</h6></a>
                                        <h4>$500.00</h4></div>
                                </div>
                            </div>
                            <div>
                                <div class="media">
                                    <a href=""><img class="img-fluid blur-up lazyload" src="/assets-front/images/pro/1.jpg" alt=""></a>
                                    <div class="media-body align-self-center">
                                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div><a href="product-page(no-sidebar).html"><h6>Slim Fit Cotton Shirt</h6></a>
                                        <h4>$500.00</h4></div>
                                </div>
                                <div class="media">
                                    <a href=""><img class="img-fluid blur-up lazyload" src="/assets-front/images/pro/1.jpg" alt=""></a>
                                    <div class="media-body align-self-center">
                                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div><a href="product-page(no-sidebar).html"><h6>Slim Fit Cotton Shirt</h6></a>
                                        <h4>$500.00</h4></div>
                                </div>
                                <div class="media">
                                    <a href=""><img class="img-fluid blur-up lazyload" src="/assets-front/images/pro/1.jpg" alt=""></a>
                                    <div class="media-body align-self-center">
                                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div><a href="product-page(no-sidebar).html"><h6>Slim Fit Cotton Shirt</h6></a>
                                        <h4>$500.00</h4></div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!-- side-bar single product slider end -->
                    <!-- side-bar banner start here -->
                    {{-- <div class="collection-sidebar-banner">
                        <a href="#"><img src="/assets-front/images/side-banner.png" class="img-fluid blur-up lazyload" alt=""></a>
                    </div> --}}
                    <!-- side-bar banner end here -->
                </div>
                <div class="collection-content col">
                    <div class="page-main-content">
                        <div class="row">
                            <div class="col-sm-12">
                                {{-- <div class="top-banner-wrapper">
                                    <a href="#"><img src="/assets-front/images/mega-menu/2.jpg" class="img-fluid blur-up lazyload" alt=""></a>
                                    <div class="top-banner-content small-section">
                                        <h4>fashion</h4>
                                        <h5>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h5>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                    </div>
                                </div> --}}
                                <div class="collection-product-wrapper">
                                  <div class="product-top-filter">
  <div class="row">
      <div class="col-xl-12">
          <div class="filter-main-btn"><span class="filter-btn btn btn-theme"><i class="fa fa-filter" aria-hidden="true"></i> Filter</span></div>
      </div>
  </div>
  <div class="row">
      <div class="col-12">
          <div class="product-filter-content">

              <div class="collection-view">
                  <ul>
                      <li><i class="fa fa-th grid-layout-view"></i></li>
                      <li><i class="fa fa-list-ul list-layout-view"></i></li>
                  </ul>
              </div>
              <div class="collection-grid-view">
                  <ul>
                      <li><img src="../assets/images/icon/2.png" alt="" class="product-2-layout-view"></li>
                      <li><img src="../assets/images/icon/3.png" alt="" class="product-3-layout-view"></li>
                      <li><img src="../assets/images/icon/4.png" alt="" class="product-4-layout-view"></li>
                      <li><img src="../assets/images/icon/6.png" alt="" class="product-6-layout-view"></li>
                  </ul>
              </div>
              <div class="product-page-per-view">
                  <h6 style="align-items:center;padding:21px 34px;color:black;">Sort by : </h6>
              </div>
              <div class="product-page-filter">
                  <select id="sort-item">
                      <option value="">Sorting items</option>
                      <option value="new">New Products</option>
                      <option value="lowprice">Price Low to High</option>
                      <option value="highprice">Price High to Low</option>
                      <option value="popular">Popular</option>
                  </select>
              </div>
          </div>
      </div>
  </div>
</div>
                                    <div class="product-wrapper-grid">
                                        <div class="row product-content">
                                            @foreach ($product->has('transactiondetail') as $p)
                                            <div class="col-xl-3 col-md-6 col-grid-box">
                                                <div class="product-box" style="border: 1px solid #ddd; border-radius:10px">
                                                    <div class="img-wrapper" style="height:0;width:100%;padding-bottom:100%">
                                                        <div class="front">
                                                            <a href="{{route("product_detail", ['id' => $p->product->id])}}"><img src="{{url('images/'.$p->product->image)}}" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                                        </div>
                                                        {{-- <div class="cart-info cart-wrap">
                                                        <button data-toggle="modal" data-productid="{{ $p->product->id }}" class="addtocart" data-target="#addtocart" data-price="{{$p->product->final_price}}" data-name="{{$p->product->product_name}}" data-image="{{$p->product->image}}" title="Add to cart"><i class="ti-shopping-cart" ></i></button>
                                                        <a href="javascript:void(0)" title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a>
                                                        <a href="#" data-toggle="modal"  data-target="#quick-view{{ $p->product->id }}" title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
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
                                                                        <a href="#" data-toggle="modal"  data-target="#quick-view{{ $p->product->id }}"><button class="btn btn-sm btn-secondary" data-title="Quick View" data-toggle="tooltip"><i class="ti-search" aria-hidden="true"></i></button></a>
                                                                </div>
                                                                <div class="col-md-6 text-right">
                                                                    <button class="btn btn-sm btn-secondary addtocart"  data-productid="{{ $p->product->id }}" data-title="Add to Cart" data-toggle="tooltip"><i class="ti-shopping-cart" ></i></button>
                                                                    <button class="btn btn-sm btn-secondary" data-title="Add to Wishlist" data-toggle="tooltip"><i class="ti-heart" aria-hidden="true"></i></button>

                                                                </div>
                                                            </div>
                                                            <a href="{{route("product_detail", ['id' => $p->product->id])}}"><h4  style="margin-top:10px">{{$p->product->product_name}}</h4></a>
                                                            <p>{!!$p->product->product_description!!}</p>
                                                            <h6 style="margin-top:10px;margin-bottom:5px">IDR {{number_format($p->product->final_price,2,',','.')}}</h6>
                                                            <h6 class="text-primary" style="font-size:10pt">{{$p->product->categories->name}}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @foreach ()
                                            <div class="col-xl-3 col-md-6 col-grid-box">
                                                <div class="product-box" style="border: 1px solid #ddd; border-radius:10px">
                                                    <div class="img-wrapper" style="height:0;width:100%;padding-bottom:100%">
                                                        <div class="front">
                                                            <a href="{{route("product_detail", ['id' => $p->id])}}"><img src="{{url('images/'.$p->image)}}" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                                        </div>
                                                        {{-- <div class="cart-info cart-wrap">
                                                        <button data-toggle="modal" data-productid="{{ $p->id }}" class="addtocart" data-target="#addtocart" data-price="{{$p->final_price}}" data-name="{{$p->product_name}}" data-image="{{$p->image}}" title="Add to cart"><i class="ti-shopping-cart" ></i></button>
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
                                            </div>
                                            @endif

                                            @endforeach
                                            {{--<div class="col-xl-3 col-md-6 col-grid-box">
                                                <div class="product-box">
                                                    <div class="img-wrapper">
                                                        <div class="front">
                                                            <a href="#"><img src="/assets-front/images/pro3/27.jpg" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                                        </div>
                                                        <div class="back">
                                                            <a href="#"><img src="/assets-front/images/pro3/28.jpg" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                                        </div>
                                                        <div class="cart-info cart-wrap">
                                                            <button data-toggle="modal" data-target="#addtocart"  title="Add to cart"><i class="ti-shopping-cart" ></i></button> <a href="javascript:void(0)" title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a> <a href="#" data-toggle="modal" data-target="#quick-view" title="Quick View"><i class="ti-search" aria-hidden="true"></i></a> <a href="compare.html" title="Compare"><i class="ti-reload" aria-hidden="true"></i></a></div>
                                                    </div>
                                                    <div class="product-detail">
                                                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div><a href="product-page(no-sidebar).html"><h6>Slim Fit Cotton Shirt</h6></a>
                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
                                                        <h4>$500.00</h4>
                                                        <ul class="color-variant">
                                                            <li class="bg-light0"></li>
                                                            <li class="bg-light1"></li>
                                                            <li class="bg-light2"></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            --}}
                                            <div class="col-sm-12" style="padding-top:50px;text-align:center;align-content:center">
                                              @php $produc

                                                    {{ $product->links() }}
                                                </div>
                                        </div>
                                    </div>
                                    @foreach($product as $keys)
                                    <div class="modal fade bd-example-modal-lg theme-modal" id="quick-view{{ $keys->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content quick-view-modal">
                                                <div class="modal-body">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-xs-12">
                                                            <div class="quick-view-img"><img src="{{url('images/'.$keys->image)}}" alt="" class="img-fluid blur-up lazyload"></div>
                                                        </div>
                                                        <div class="col-lg-6 rtl-text">
                                                            <div class="product-right">
                                                            <h2>{{ $keys->product_name }}</h2>
                                                                <h3>IDR {{number_format($keys->final_price,2,',','.')}}</h3>
                                                                <ul class="color-variant">
                                                                    <li class="bg-light0"></li>
                                                                    <li class="bg-light1"></li>
                                                                    <li class="bg-light2"></li>
                                                                </ul>
                                                                <div class="border-product">
                                                                    <h6 class="product-title">product details</h6>
                                                                    <p>Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium</p>
                                                                </div>
                                                                <div class="product-description border-product">
                                                                    <div class="size-box">
                                                                        <ul>
                                                                            <li class="active"><a href="#">s</a></li>
                                                                            <li><a href="#">m</a></li>
                                                                            <li><a href="#">l</a></li>
                                                                            <li><a href="#">xl</a></li>
                                                                        </ul>
                                                                    </div>
                                                                    <h6 class="product-title">quantity</h6>
                                                                    <div class="qty-box">
                                                                        <div class="input-group"><span class="input-group-prepend"><button type="button" class="btn quantity-left-minus" data-type="minus" data-field=""><i class="ti-angle-left"></i></button> </span>
                                                                            <input type="text" name="quantity" class="form-control input-number" value="1"> <span class="input-group-prepend"><button type="button" class="btn quantity-right-plus" data-type="plus" data-field=""><i class="ti-angle-right"></i></button></span></div>
                                                                    </div>
                                                                </div>
                                                                <div class="product-buttons"><a href="#" class="btn btn-solid">add to cart</a> <a href="#" class="btn btn-solid">view detail</a></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="modal fade bd-example-modal-md theme-modal" id="alertcart" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-md " role="document">
                                                <div class="modal-content quick-view-modal">
                                                        <form  action="{{ route('authenticate') }}" class="theme-form" method="POST">
                                                                @csrf
                                                    <div class="modal-body">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <div class="row">
                                                            {{-- <div class="col-lg-12 col-xs-12 text-center">
                                                                <i class="fa fa-user " style="font-size:100pt"></i>
                                                            </div> --}}
                                                            <div class="col-lg-12 col-xs-12 text-center" style="margin-top:20px;margin-bottom:10px">
                                                                <h5>Please login first to continue shopping.</h5>
                                                            </div>

                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                                                                    @if ($errors->has('email'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('email') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                                                                    @if ($errors->has('password'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('password') }}</strong>
                                                                    </span>
                                                                @endif
                                                                </div>

                                                            </div>
                                                            <div class="col-md-12 text-center">
                                                                    <button type="submit" class="btn  btn-sm btn-solid">Login</button>
                                                            <p class="mt-4 mb-0 text-center">Don't have account yet ? <a href="{{route('registerpage')}}">Register</a></p>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                    {{-- <div class="product-pagination">
                                        <div class="theme-paggination-block">
                                            <div class="row">
                                                <div class="col-xl-6 col-md-6 col-sm-12">
                                                    <nav aria-label="Page navigation">
                                                        <ul class="pagination">
                                                            <li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true"><i class="fa fa-chevron-left" aria-hidden="true"></i></span> <span class="sr-only">Previous</span></a></li>
                                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                            <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true"><i class="fa fa-chevron-right" aria-hidden="true"></i></span> <span class="sr-only">Next</span></a></li>
                                                        </ul>
                                                    </nav>
                                                </div>
                                                <div class="col-xl-6 col-md-6 col-sm-12">
                                                    <div class="product-search-count-bottom">
                                                        <h5>Showing Products 1-24 of 10 Result</h5></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- section End -->
@endsection
