@extends('layouts-front.master')

@section('content')

     <!-- BLOG -->
     <section class="blog section-padding">
          <div class="container">
               <div class="row">

                    <div class="col-lg-12 col-12 mb-3 text-center">

                      <h1 class="mb-4 " data-aos="fade-up">Our Video Catalog</h1>
                    </div>

                    <div class="row col-2" data-aos="fade-up">
                            <!--<div class="tm-categories-container mb-4">
                                <h3 class="tm-text-primary tm-categories-text video-category">Categories:</h3>
                                <ul class="nav tm-category-list">
                                    <li class="nav-item tm-category-item"><a href="/video/?filter=all" class="tm-category-link {{ empty(Request::get('filter')) || Request::get('filter') == 'all' ? 'active' : '' }}">All</a></li>
                                    @foreach ($categories as $category)
                                    <li class="nav-item tm-category-item"><a href="/video/?filter={{$category->id}}" class="tm-category-link {{ !empty(Request::get('filter')) && Request::get('filter') == $category->id ? 'active' : '' }}">{{$category->name}}</a></li>
                                    <input type="hidden" id="filter" value="{{ empty(Request::get('filter')) ? 'all' : Request::get('filter') }}">
                                    @endforeach
                                </ul>
                            </div>-->
                            <div class="dropdown">
                              <button onclick="myFunction()" class="dropbtn">Categories</button>
                                <div id="myDropdown" class="dropdown-content">
                                  <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
                                  <a href="/video/?filter=all" class="{{ empty(Request::get('filter')) || Request::get('filter') == 'all' ? 'active' : '' }}">All</a>
                                  @foreach ($categories as $category)
                                  <a href="/video/?filter={{$category->id}}" class="{{ !empty(Request::get('filter')) && Request::get('filter') == $category->id ? 'active' : '' }}">{{$category->name}}</a>
                                  @endforeach

                                </div>
                            </div>  
                    </div>
                    <div class="container col-10 pl-0 pr-0">
                    <div class="row">
                      @foreach ($videos as $video)
                      <div class="blog-sidebar col-12 col-lg-4 col-md-6 col-sm-12 d-flex flex-column justify-content-left align-items-left mb-4" data-aos="fade-up" data-aos-delay="200">
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
                  {{$videos->links()}}
                </div>      

                    </div>

               </div>
          </div>
     </section>


@endsection

@section('scripts')

<script type="text/javascript">

/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

function filterFunction() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  div = document.getElementById("myDropdown");
  a = div.getElementsByTagName("a");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}

</script>

@endsection

