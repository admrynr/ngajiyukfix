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

                              <h2 class="mb-4" data-aos="fade-up">the best <strong>Digital Marketing agency</strong> in Rio de Janeiro</h2>

                              <p class="mb-0" data-aos="fade-up">Total 5 HTML pages are included in this template from TemplateMo website. Please check 2 <a href="blog.html">blog</a> pages, <a href="project-detail.html">project</a> page, and <a href="contact.html">contact</a> page. 
                              <br><br>You are <strong>allowed</strong> to use this template for commercial or non-commercial purpose. You are NOT allowed to redistribute the template ZIP file on template collection websites.</p>
                         </div>                    </div>
               </div>
          </div>
          <div class="container col-12">
               <img src="/images/tentang-kami.jpg" data-aos="fade-up" class="img-fluid mt-5 mx-auto d-block" alt="office">
          </div>
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
                              <div class="item project-wrapper" data-aos="fade-up" data-aos-delay="100">
                                   <img src="images/project/project-image01.jpg" class="img-fluid" alt="project image">

                                   <div class="project-info">
                                        <small>Dakwah</small>

                                        <h3>
                                             <a href="project-detail.html">
                                                  <span>Ngaji</span>
                                                  <i class="fa fa-angle-right project-icon"></i>
                                             </a>
                                        </h3>
                                   </div>
                              </div>

                              <div class="item project-wrapper" data-aos="fade-up">
                                   <img src="images/project/project-image02.jpg" class="img-fluid" alt="project image">

                                   <div class="project-info">
                                        <small>Belajar</small>

                                        <h3>
                                             <a href="project-detail.html">
                                                  <span>Sekolah</span>
                                                  <i class="fa fa-angle-right project-icon"></i>
                                             </a>
                                        </h3>
                                   </div>
                              </div>

                              <div class="item project-wrapper" data-aos="fade-up">
                                   <img src="images/project/project-image03.jpg" class="img-fluid" alt="project image">

                                   <div class="project-info">
                                        <small>Umum</small>

                                        <h3>
                                             <a href="project-detail.html">
                                                  <span>Pengajian Akbar</span>
                                                  <i class="fa fa-angle-right project-icon"></i>
                                             </a>
                                        </h3>
                                   </div>
                              </div>

                              <div class="item project-wrapper" data-aos="fade-up">
                                   <img src="images/project/project-image04.jpg" class="img-fluid" alt="project image">

                                   <div class="project-info">
                                        <small>Social Media</small>

                                        <h3>
                                             <a href="project-detail.html">
                                                  <span>Pengajian</span>
                                                  <i class="fa fa-angle-right project-icon"></i>
                                             </a>
                                        </h3>
                                   </div>
                              </div>

                              <div class="item project-wrapper" data-aos="fade-up">
                                   <img src="images/project/project-image05.jpg" class="img-fluid" alt="project image">

                                   <div class="project-info">
                                        <small>Pariwisata</small>

                                        <h3>
                                             <a href="project-detail.html">
                                                  <span>Rekreasi Iman</span>
                                                  <i class="fa fa-angle-right project-icon"></i>
                                             </a>
                                        </h3>
                                   </div>
                              </div>
                         </div>
                    </div>

               </div>
          </div>
     </section>


@endsection

   