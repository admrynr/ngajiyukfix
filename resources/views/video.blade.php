@extends('layouts-front.master')

@section('content')

     <!-- BLOG -->
     <section class="blog section-padding">
          <div class="container">
               <div class="row">

                    <div class="col-lg-12 col-12 mb-3 text-center">

                      <h1 class="mb-4 " data-aos="fade-up">Our Video Catalog</h1>
                    </div>

                    <div class="row" data-aos="fade-up">
                        <div class="col-12">
                            <div class="tm-categories-container mb-4">
                                <h3 class="tm-text-primary tm-categories-text video-category">Categories:</h3>
                                <ul class="nav tm-category-list">
                                    <li class="nav-item tm-category-item"><a href="/video/?filter=all" class="tm-category-link {{ empty(Request::get('filter')) || Request::get('filter') == 'all' ? 'active' : '' }}">All</a></li>
                                    @foreach ($categories as $category)
                                    <li class="nav-item tm-category-item"><a href="/video/?filter={{$category->id}}" class="tm-category-link {{ !empty(Request::get('filter')) && Request::get('filter') == $category->id ? 'active' : '' }}">{{$category->name}}</a></li>
                                    <input type="hidden" id="filter" value="{{ empty(Request::get('filter')) ? 'all' : Request::get('filter') }}">
                                    @endforeach
                                </ul>
                            </div>        
                        </div>
                    </div>
                    <div class="container pl-0 pr-0">
                    <div class="row">
                      @foreach ($videos as $video)
                      <div class="blog-sidebar col-lg-4 col-md-6 col-sm-12 d-flex flex-column justify-content-left align-items-left mb-4" data-aos="fade-up" data-aos-delay="200">
                        <img style="z-index: -1; position: relative;" src="{{$video->thumbnail}}" class="img-fluid" alt="blog">
                        <a class="player-link" style="position: absolute; top: 25%; left: 40%" href="/video/detail/{{$video->id_video}}">
                        <i class="fa fa-play-circle fa-5x player-icon"></i>
                        </a>

                        <div class="blog-info mt-2 mb-2">

                          <h3><a href="/video/detail/{{$video->id_video}}">{{$video->video_title}}</a></h3>
                        </div>
                      </div>
                      @endforeach

                  </div>
                </div>

                    </div>

               </div>
          </div>
     </section>


@endsection
