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
                            <div class="tm-categories-container mb-5">
                                <h3 class="tm-text-primary tm-categories-text video-category">Categories:</h3>
                                <ul class="nav tm-category-list">
                                    <li class="nav-item tm-category-item"><a href="#" class="tm-category-link active">All</a></li>
                                    @foreach ($categories as $category)
                                    <li class="nav-item tm-category-item"><a href="#" class="tm-category-link">{{$category->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>        
                        </div>
                    </div>
                    <div class="row">
                      <div class="blog-sidebar col-lg-4 col-md-6 col-sm-12 d-flex flex-column justify-content-left align-items-left mb-5" data-aos="fade-up" data-aos-delay="200">
                        <img src="images/blog/blog-sidebar-image.jpg" class="img-fluid" alt="blog">

                        <div class="blog-info mt-2 mb-2">

                          <h3><a href="blog-detail.html">Why Truly Accessible Design Benefits Everyone</a></h3>
                        </div>
                      </div>

                      <div class="blog-sidebar col-lg-4 col-md-6 col-sm-12 d-flex flex-column justify-content-left align-items-left mb-5" data-aos="fade-up" data-aos-delay="200">
                        <img src="images/blog/blog-sidebar-image01.jpg" class="img-fluid" alt="blog">

                        <div class="blog-info mt-2 mb-2">

                          <h3><a href="blog-detail.html">Be Humble About What You Know</a></h3>
                        </div>
                      </div>

                      <div class="blog-sidebar col-lg-4 col-md-6 col-sm-12 d-flex flex-column justify-content-left align-items-left mb-5" data-aos="fade-up" data-aos-delay="200">
                        <img src="images/blog/blog-sidebar-image02.jpg" class="img-fluid" alt="blog">

                        <div class="blog-info mt-2 mb-2">

                          <h3><a href="blog-detail.html">The Mistakes I Made As a Coding Beginner</a></h3>
                        </div>
                      </div>
                      <div class="blog-sidebar col-lg-4 col-md-6 col-sm-12 d-flex flex-column justify-content-left align-items-left mb-5" data-aos="fade-up" data-aos-delay="200">
                        <img src="images/blog/blog-sidebar-image.jpg" class="img-fluid" alt="blog">

                        <div class="blog-info mt-2 mb-2">

                          <h3><a href="blog-detail.html">Why Truly Accessible Design Benefits Everyone</a></h3>
                        </div>
                      </div>

                      <div class="blog-sidebar col-lg-4 col-md-6 col-sm-12 d-flex flex-column justify-content-left align-items-left mb-5" data-aos="fade-up" data-aos-delay="200">
                        <img src="images/blog/blog-sidebar-image01.jpg" class="img-fluid" alt="blog">

                        <div class="blog-info mt-2 mb-2">

                          <h3><a href="blog-detail.html">Be Humble About What You Know</a></h3>
                        </div>
                      </div>

                      <div class="blog-sidebar col-lg-4 col-md-6 col-sm-12 d-flex flex-column justify-content-left align-items-left mb-5" data-aos="fade-up" data-aos-delay="200">
                        <img src="images/blog/blog-sidebar-image02.jpg" class="img-fluid" alt="blog">

                        <div class="blog-info mt-2 mb-2">

                          <h3><a href="blog-detail.html">The Mistakes I Made As a Coding Beginner</a></h3>
                        </div>
                      </div>
                  </div>

                    </div>

               </div>
          </div>
     </section>


@endsection
