
<!-- latest jquery-->
<script src="/assets-front/js/jquery-3.3.1.min.js"></script>

<!-- fly cart ui jquery-->
<script src="/assets-front/js/jquery-ui.min.js"></script>

<!-- exitintent jquery-->
<script src="/assets-front/js/jquery.exitintent.js"></script>
<script src="/assets-front/js/exit.js"></script>

<!-- popper js-->
<script src="/assets-front/js/popper.min.js"></script>

<!-- slick js-->
<script src="/assets-front/js/slick.js"></script>

<!-- menu js-->
<script src="/assets-front/js/menu.js"></script>

<!-- lazyload js-->
<script src="/assets-front/js/lazysizes.min.js"></script>

<!-- Bootstrap js-->
<script src="/assets-front/js/bootstrap.js"></script>

<!-- Bootstrap Notification js-->
<script src="/assets-front/js/bootstrap-notify.min.js"></script>

<!-- Fly cart js-->
{{-- <script src="/assets-front/js/fly-cart.js"></script> --}}

<!-- Theme js-->
<script src="/assets-front/js/script.js"></script>

<script>
    var baseURL = "{{url('')}}";
    @if(!empty(Auth::user()))
    var sessionuser = 1;
    @else
    var sessionuser = 0;
    @endif
</script>
<!-- cart js -->
<script src="/js/cart.js"></script>

<script>
    
    function openSearch() {
        document.getElementById("search-overlay").style.display = "block";
    }

    function closeSearch() {
        document.getElementById("search-overlay").style.display = "none";
    }

    //     var slideIndex = 1;
    // showSlides(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
    showSlides(slideIndex += n);
    }

    // Thumbnail image controls
    function currentSlide(n) {
    showSlides(slideIndex = n);
    }

     
</script>