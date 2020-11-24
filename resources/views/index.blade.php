@extends('layouts-front.master')

@section('content')


     <!-- HERO -->
     <section>
          <div class="hero header-text">
             <div class="owl-banner owl-carousel">
               <a href="/blog"> 
                  <div class="banner-item-01">
                    <div class="text-content">
                    <h1 class="text-dark" data-aos="fade-up">Lihat Artikel Kami</h1>
                    <h1 class="custom-btn btn-bg btn mt-3">BLOG</h2>
                    </div>
                  </div>
               </a>
               <a href="/video"> 
                  <div class="banner-item-02">
                    <div class="text-content">
                    <h1 class="text-dark" data-aos="fade-up">Lihat Video Dokumentasi Kami</h1>
                    <h2 class="custom-btn btn-bg btn mt-3">VIDEO</h2>
                    </div>
                  </div>
               </a>
               <a href="/livestream">
                  <div class="banner-item-03">
                    <div class="text-content">
                    <h1 class="text-dark" data-aos="fade-up">Lihat Tayangan Langsung yang Kami Siarkan</h1>
                    <h2 class="custom-btn btn-bg btn mt-3">LIVE STREAMING</h2>
                    </div>
                  </div>
               </a>
             </div>
          </div> 
     </section>


    

     <!-- ABOUT -->
     <section class="about section-padding pb-0" id="about">           

          <div class="container">
               <div class="row">

                    <div class="col-lg-7 mx-auto col-md-10 col-12">
                         <div class="about-info">

                              <h2 class="mb-4" data-aos="fade-up">Profil <strong>Moslem Teeny</strong></h2>

                              <p class="mb-0" data-aos="fade-up">Di sini tempat menampilkan profil Moslem Teeny dengan diwakili oleh situs yang terdiri dari tiga konten utama yaitu <a href="/blog">blog</a>, <a href="/video">video</a> , dan <a href="/livestream">livestream</a>. 
                              <br><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                         </div>                    
                    </div>
                    <div class="about-image" data-aos="fade-up" data-aos-delay="200">

                          <img src="images/office.png" class="img-fluid" alt="office">
                    </div>
               </div>
          </div>
          <!--<div class="container col-12">
               <img src="/images/tentang-kami.jpg" data-aos="fade-up" class="img-fluid mt-5 mx-auto d-block" alt="office">
          </div>-->
     </section>
   

     <!-- Video -->
     <section class="project section-padding" id="project">
          <div class="container-fluid">
               <div class="row">

                    <div class="col-lg-12 col-12">

                        <h2 class="mb-5 text-center" data-aos="fade-up">
                            Kumpulan dari Beberapa
                            <strong>Video Kami</strong>
                        </h2>

                         <div class="owl-carousel owl-theme" id="project-slide">
                              @foreach ($videos as $video)
                              <div class="item project-wrapper" data-aos="fade-up" data-aos-delay="100">
                                   <img src="{{$video->thumbnail}}" class="img-fluid" alt="project image">

                                   <div class="project-info">
                                        <small>{{$video->categories->name}}</small>

                                        <h3>
                                             <a href="project-detail.html">
                                                  <span>{{$video->video_title}}</span>
                                                  <i class="fa fa-angle-right project-icon"></i>
                                             </a>
                                        </h3>
                                   </div>
                              </div>
                              @endforeach
                         </div>
                    </div>

               </div>
          </div>
     </section>


@endsection

   