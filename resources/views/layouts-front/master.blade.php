<!DOCTYPE html>
<html lang="en">
@include('layouts-front.head')
<body>

<!-- header start -->
@include('layouts-front.header')
<!-- header end -->

@yield('content')

<!-- footer -->
@include('layouts-front.footer')
<!-- footer end -->


@include('layouts-front.footer-script')
@yield('scripts')
</body>

</html>
