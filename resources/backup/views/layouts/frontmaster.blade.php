<!DOCTYPE html>
<html lang="en">

<head>
   @include('includes.fronthead') 
</head>
<body>
    <!-- Page loader start -->
    <div class="page-loader"></div>
    <!-- Page loader end -->
    <!-- Header start -->
    @include('includes.frontheader')
    <!-- Header end -->
    @yield('content')
    <!-- Footer start -->
    @include('includes.frontfooter')
    @yield('extrajs')
</body>

</html>




