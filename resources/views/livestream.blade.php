@extends('layouts-front.master')

@section('content')


     <!-- BLOG -->
     <section class="blog section-padding">
          <div class="container">
               <div class="row">

                    <div class="col-lg-12 col-12 mb-3 text-center">

                      <h1 class="mb-4 " data-aos="fade-up">Our Livestream</h1>
                    </div>

                    <div class="d-flex flex-row justify-content-center col-12 mb-5" data-aos="fade-up">
                      <div class="container col-8 livestream">
                        <!-- IFRAME YOUTUBE -->
                        <iframe class="livestream-player col-12" width="640" height="360" src="https://www.youtube.com/embed/DDU-rZs-Ic4" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                      </div>
                      <div class="container col-4 livestream-side">
                          <a class="mt-4 ml-4 mr-4 mb-2 navbar-livestream" href="">
                          <i class="fa fa-tag mr-1" aria-hidden="true"></i>
                          Category
                          </a>
                        <h4 class=" ml-4 mr-4 mb-1 text-left" >Judul Livestreaming asdas asdasdas asdasda</h4>
                          <p class="ml-4 mr-4 mb-2 speaker-livestream">
                          Ustadz Fulan
                        </p>
                      </div>
                    </div>
                  
                  </div>

                    </div>
     </section>

     <section class="project section-padding" id="project">
          <div class="container-fluid">
               <div class="row">

                    <div class="col-lg-12 col-12">

                        <h2 class="mb-5 text-center" data-aos="fade-up">
                            Judul Livestream Hari Ini
                            <strong>Bla Bla Bla</strong>
                        </h2>
                         
                    </div>

               </div>
          </div>
     </section>


@endsection