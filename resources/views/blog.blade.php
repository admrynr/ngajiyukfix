@extends('layouts-front.master')

@section('content')

     <!-- BLOG -->
     <section class="blog section-padding">
          <div class="container">
               <div class="row">

                    <div class="col-lg-12 col-12 mb-3 text-center">

                      <h1 class="mb-4" data-aos="fade-up">Digital Trend Blog</h1>
                    </div>

                      <div class="row col-2" data-aos="fade-up">
                            <div class="dropdown">
                              <button onclick="myFunction()" class="dropbtn">Archive</button>
                                <div id="myDropdown" class="dropdown-content">
                                  <a href="/video/?filter=all" class="{{ empty(Request::get('filter')) || Request::get('filter') == 'all' ? 'active' : '' }}">All</a>
                                  @foreach ($years as $year)
                                  <a href="/video/?filter={{$year->year}}" class="{{ !empty(Request::get('filter')) && Request::get('filter') == $year->year ? 'active' : '' }}">{{$year->year}}</a>
                                  @endforeach

                                </div>
                            </div>  
                    </div>
                    <div class="container col-10 pl-0 pr-0">
                    <div class="row">
                      @foreach ($blogs as $blog)
                      <div class="blog-sidebar col-12 col-lg-4 col-md-6 col-sm-12 d-flex flex-column justify-content-left align-items-left mb-4" data-aos="fade-up" data-aos-delay="200">
                        <img src="{{asset('images/'.$blog->thumbnail)}}" class="img-fluid video-image" alt="blog">

                        <div class="blog-info mt-2 mb-2">
                          <h6 class="blog-category text-primary">{{$blog->categories->name}}</h6>

                          <h3><a href="blog/detail/{{$blog->id}}">{{$blog->title}}</a></h3>
                        </div>
                      </div>
                      @endforeach

                    </div>
                    </div>


                    <div class="col-lg-5 ml-auto mt-5 pt-5 col-md-6 col-12">

                      <img src="images/newsletter.png" data-aos="fade-up" data-aos-delay="100" class="img-fluid blog-image" alt="newsletter">
                    </div>

                    <div class="col-lg-5 mr-auto mt-5 pt-5 col-md-6 col-12 newsletter-form">
                      <h4 data-aos="fade-up" data-aos-delay="200">Email Newsletter</h4>

                      <h2 data-aos="fade-up" data-aos-delay="300">Let’s stay up-to-date. We'll share you all good stuffs.</h2>
                      <form action="#" method="get" enctype="multipart/form-data">
                      <div class="form-group mt-4" data-aos="fade-up" data-aos-delay="400">
                        <input name="email" type="email" class="form-control" 
                            id="email" aria-describedby="emailHelp" placeholder="Please enter your email" required>

                        <small id="emailHelp" class="form-text text-muted">We'll NOT share your email address to anyone else.</small>

                      </div>

                      <div class="form-group form-check" data-aos="fade-up" data-aos-delay="500">
                        <input name="monthly" type="checkbox" class="form-check-input" id="monthly">

                        <label class="form-check-label" for="monthly">Please send me a monthly newsletter.</label>
                      </div>

                        <button type="submit" data-aos="fade-up" data-aos-delay="500" class="btn w-100 mt-3">Sign up</button>
                      </form>
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