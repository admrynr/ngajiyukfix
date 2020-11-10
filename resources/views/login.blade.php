@extends('layouts-front.master')

@section('content')

     <!-- CONTACT -->
     <section class="contact section-padding">
          <div class="container">
               <div class="row">

                    <div class="col-lg-6 mx-auto col-md-7 col-12 py-5 mt-5 text-center" data-aos="fade-up">

                      <h1 class="mb-4">Login <strong>User</strong></h1>

                      <p>Silahkan masukkan 'Username' dan 'Password' untuk masuk sebagai <strong>User</strong></p>
                    </div>

                    <div class="col-lg-8 mx-auto col-md-10 col-12">
                    
                    <!-- Follow https://templatemo.com/contact page to setup your own contact form -->
                    
                      <form action="#" method="post" class="contact-form" data-aos="fade-up" data-aos-delay="300" role="form">
                        <div class="row">
                          <div class="col-lg-10 col-12">
                            <input type="text" class="form-control" name="username" placeholder="Username">
                          </div>

                          <div class="col-lg-10 col-12">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                          </div>
        
                          <div class="col-lg-5 mx-auto col-7">
                            <a type="submit" class="form-control text-center" id="submit-button" href="/admin" name="submit">Submit</a>
                          </div>
                        </div>
                      </form>

                    </div>

               </div>
          </div>
     </section>

<!-- How to change your own map point
	1. Go to Google Maps
	2. Click on your location point
	3. Click "Share" and choose "Embed map" tab
	4. Copy only URL and paste it within the src="" field below
-->
<!--     <div class="google-map" data-aos="zoom-in">
       <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11196.961132529668!2d-43.38581128725845!3d-23.011063013218724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9bdb695cd967b7%3A0x171cdd035a6a9d84!2sAv.%20L%C3%BAcio%20Costa%20-%20Barra%20da%20Tijuca%2C%20Rio%20de%20Janeiro%20-%20RJ%2C%20Brazil!5e0!3m2!1sen!2sth!4v1568649412152!5m2!1sen!2sth" width="1920" height="600" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
     </div>
-->

@endsection
