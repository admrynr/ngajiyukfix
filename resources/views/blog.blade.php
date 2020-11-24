@extends('layouts-front.master')

@section('content')

     <!-- BLOG -->
     <section class="blog section-padding">
          <div class="container">
               <div class="row">

                    <div class="col-lg-12 col-12 py-5 mt-5 mb-3 text-center">

                      <h1 class="mb-4" data-aos="fade-up">Digital Trend Blog</h1>
                    </div>

                    <div class="col-lg-7 col-md-7 col-12 mb-4">
                      <div class="blog-header" data-aos="fade-up" data-aos-delay="100">
                        <img src="images/blog/blog-header-image.jpg" class="img-fluid" alt="blog header">

                        <div class="blog-header-info">
                          <h4 class="blog-category text-info">Creative</h4>

                          <h3><a href="blog/detail">The Key to Creative Work is Knowing When to Walk Away</a></h3>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-5 col-md-5 col-12 mb-4">
                      <div class="blog-sidebar d-flex justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
                        <img src="images/blog/blog-sidebar-image.jpg" class="img-fluid" alt="blog">

                        <div class="blog-info">
                          <h4 class="blog-category text-danger">Design</h4>

                          <h3><a href="/blog-detail">Why Truly Accessible Design Benefits Everyone</a></h3>
                        </div>
                      </div>

                      <div class="blog-sidebar py-4 d-flex justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
                        <img src="images/blog/blog-sidebar-image01.jpg" class="img-fluid" alt="blog">

                        <div class="blog-info">
                          <h4 class="blog-category text-success">lifestyle</h4>

                          <h3><a href="blog-detail.html">Be Humble About What You Know</a></h3>
                        </div>
                      </div>

                      <div class="blog-sidebar d-flex justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
                        <img src="images/blog/blog-sidebar-image02.jpg" class="img-fluid" alt="blog">

                        <div class="blog-info">
                          <h4 class="blog-category text-primary">Coding</h4>

                          <h3><a href="blog-detail.html">The Mistakes I Made As a Coding Beginner</a></h3>
                        </div>
                      </div>

                    </div>

               </div>
          </div>
     </section>


@endsection