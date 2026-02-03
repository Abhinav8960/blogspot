<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    @include('home.homecss')
</head>

<body>
    <!-- header section start -->
    <div class="header_section">
        @include('home.header')
        <!-- banner section start -->
        @include('home.banner')
        <!-- banner section end -->
    </div>
    <!-- header section end -->
    <!-- services section start -->
      @include('home.posts')
    <!-- services section end -->
    <!-- about section start -->
        @include('home.about')
    <!-- about section end -->
    <!-- blog section start -->
        @include('home.blog')
    <!-- blog section end -->
    <!-- testimonial section start -->
        @include('home.testimonial')
    <!-- testimonial section start -->
    <!-- choose section start -->
        @include('home.whychooseus')
    <!-- choose section end -->
    <!-- footer section start -->
        @include('home.footer')
    <!-- footer section end -->
   
</body>

</html>