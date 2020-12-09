@extends('layouts-front.master')

@section('content')


     <!-- BLOG -->
     <section class="blog section-padding">
          <div class="container">
               <div class="row">

                    <div class="col-lg-12 col-12 mb-3 text-center">

                      <h1 class="mb-4 " data-aos="fade-up">Video Kami</h1>
                    </div>

                    <div class="d-flex flex-row justify-content-center col-12 mb-5" data-aos="fade-up">
                      <div class="container col-8 livestream">
                        <!-- IFRAME YOUTUBE -->
                        <iframe class="livestream-player col-12" width="640" height="360" src="https://www.youtube.com/embed/{{$video->key}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                      </div>
                      <div class="container col-4 livestream-side">
                          <a class="mt-4 ml-4 mr-4 mb-2 navbar-livestream" href="">
                          <i class="fa fa-tag mr-1" aria-hidden="true"></i>
                          {{$video->name}}
                          </a>
                        <h4 class=" ml-4 mr-4 mb-1 text-left" >{{$video->video_title}}</h4>
                          <p class="ml-4 mr-4 mb-2 speaker-livestream">
                          Ustadz Fulan
                        </p>
                      </div>
                    </div>
                  
                  </div>

                    </div>
     </section>

     
<section class="project-detail">
  <div class="container">
              <div class="col-lg-8 mx-auto pt-2 pr-4 pl-4 mb-5 pb-5 col-12 comment-sec" data-aos="fade-up">

                <div class="{{($comments->count() > 0) ? 'displayed' : 'hidden'}}">
                <h3 class="my-3" data-aos="fade-up">{{$comments->count()}} Comments</h3>
                <hr>
              </div>

                @foreach ($comments as $comment)
                <section class="comment-node" id="comment-node-{{$comment->id}}">
                <div class="container">
                <div class="row col-12 mx-auto pl-0 d-flex flex-row align-items-start">
                  <div>
                  <i class="fa fa-user-circle-o fa-2x mr-2" aria-hidden="true"></i>
                  </div>
                  <div>
                  <span class="mr-1 comment-user"> <b>{{$comment->name}}</b> </span> 
                  <span class="comment-date">{{$comment->created_at}}</span>
                  
                  </div>

                </div>
                <div class="mt-1 comment-content"> {{$comment->content}}
                  </div>
                  </br>
                  <a href="#" class="replyComment" data-id="{{$comment->id}}">Reply</a>
                  @if (!empty(Auth::user()))
                  <a href="#" class="ml-2">Delete</a>
                  @endif
                <hr>
                @foreach ($comment->replies as $reply)
                <div class="container ml-2">
                <div class="row col-12 mx-auto pl-0 d-flex flex-row align-items-start">
                  <div>
                  <i class="fa fa-user-circle-o fa-lg mr-2" aria-hidden="true"></i>
                  </div>
                  <div>
                  <span class="mr-1 comment-user"> <b>{{$comment->name}}</b> </span> 
                  <span class="comment-date">{{$comment->created_at}}</span>
                  
                  </div>

                </div>
                <div class="mt-1 comment-content"> {{$comment->content}}
                  </div>
                  </br>
                  @if (!empty(Auth::user()))
                  <a href="#">Delete</a>
                  @endif
                  @endforeach
                </div>
                </section>

                <div class="add-comment" id="add-comment-{{$comment->id}}" style="display: none">
                <h3 class="my-3" data-aos="fade-up">Reply to {{$comment->name}}</h3>

                <form action="{{route('reply.store', ['id' => $video->id_video, 'cid' => $comment->id])}}" method="post"  class="contact-form" data-aos="fade-up" data-aos-delay="300" role="form">
                  @csrf
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

                    <input type="hidden" name="type" value="video">

                    <div class="col-lg-5 mx-auto col-7">
                      <button type="submit" class="form-control" id="submit-button" name="submit">Submit Comment</button>
                    </div>
                  </div>
                </form>

                </div>
                @endforeach

                <div id="add-comment">
                <h3 class="my-3" data-aos="fade-up">Leave a comment</h3>

                <form action="/comment/store/{{$video->id_video}}" method="post"  class="contact-form" data-aos="fade-up" data-aos-delay="300" role="form">
                  @csrf
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

                    <input type="hidden" name="type" value="video">

                    <div class="col-lg-5 mx-auto col-7">
                      <button type="submit" class="form-control" id="submit-button" name="submit">Submit Comment</button>
                    </div>
                  </div>
                </form>

                </div>

              </div>
            </section>
              


@endsection

@section('scripts')
    <script type='text/javascript'>
    $(document).ready(function() {
    $('.replyComment').on('click', function(event){
      event.preventDefault();
      id = $(this).attr('data-id');
      console.log(id);
      document.getElementById("add-comment-"+id).style.display = "block";
      document.getElementById("add-comment").style.display = "none";
    });
  });
    </script>
@endsection