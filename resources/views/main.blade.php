<!doctype html>
<html lang="en">
  
  @include('partials._head')

  <body>

    <!-- Default Bootstrap Navbar -->
    @include('partials._nav')

    <!-- Start of container -->
    <div class="container">

      @include('partials._messages')

      @yield('content')

      <hr>

      @include('partials._footer')

    </div> <!-- End of container -->

    <!-- Optional JavaScript -->
    @include('partials._javascript')

  </body>
</html>