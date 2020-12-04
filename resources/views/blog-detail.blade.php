@extends('layouts-front.master')

@section('content')     

<!-- BLOG DETAIL -->
     <section class="project-detail section-padding-half">
          <div class="container">
               <div class="row">

                    <div class="col-lg-9 mx-auto col-md-10 col-12 mt-lg-5 text-center" data-aos="fade-up">
                      <h4 class="blog-category text-info">{{$blog->categories->name}}</h4>
                      
                      <h1>{{$blog->title}}</h1>

                      <div class="client-info">
                          <div class="d-flex justify-content-center align-items-center mt-3">
                            <p>{{$blog->user->name}} | {{$date}}</p>
                          </div>
                      </div>
                    </div>

               </div>
          </div>
     </section>


     <div class="full-image text-center" data-aos="zoom-in">
       <img src="{{asset('images/'.$blog->thumbnail)}}" class="img-fluid" alt="blog header">
     </div>


     <!-- BLOG DETAIL -->
     <section class="project-detail">
          <div class="container">
               <div class="row">

                  <div class="col-lg-9 mx-auto col-md-11 col-12 my-5 pt-3" data-aos="fade-up">

                    <h2 class="mb-3">Etiam quis metus elementum, tempor risus vel, condimentum orci.</h2>

                    {!!$blog->content!!}

                    </div>
               </div>

              <div class="col-lg-8 mx-auto pt-2 pr-4 pl-4 mb-5 pb-5 col-12 comment-sec" data-aos="fade-up">

                <h3 class="my-3" data-aos="fade-up">X Comments</h3>
                <hr>

                <div class="container">
                <div class="row col-12 mx-auto pl-0 comment-node d-flex flex-row align-items-start">
                  <i class="fa fa-user-circle-o fa-2x mr-2" aria-hidden="true"></i>
                  <div>
                  <span class="mr-1 comment-user"> <b>User</b> </span> 
                  <span class="comment-date">20 Desember 2020 at 05:51</span>
                  <div class="comment-content"> Assalamualaikum, mau nanya soal bla bla bla
                    blb lbslblslbslbsl bslbslba sbalbslslbalsbalb
                  </div>
                  </div>

                </div>
                  </br>
                  <a href="#">Reply</a>
                <hr>
                </div>


                <h3 class="my-3" data-aos="fade-up">Leave a comment</h3>

                <form action="#" method="get"  class="contact-form" data-aos="fade-up" data-aos-delay="300" role="form">
                  <div class="row">
                    <div class="col-lg-6 col-12">
                      <input type="text" class="form-control" name="name" placeholder="Name">
                    </div>

                    <div class="col-lg-6 col-12">
                      <input type="email" class="form-control" name="email" placeholder="Email">
                    </div>

                    <div class="col-lg-12 col-12">
                      <textarea class="form-control" rows="6" name="message" placeholder="Message"></textarea>
                    </div>

                    <div class="col-lg-5 mx-auto col-7">
                      <button type="submit" class="form-control" id="submit-button" name="submit">Submit Comment</button>
                    </div>
                  </div>
                </form>

              </div>
              
          </div>
          
     </section>

@endsection
