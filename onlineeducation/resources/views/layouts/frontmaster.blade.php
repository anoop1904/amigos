<!DOCTYPE html>
<html >
   <link href="{{ url('/public/assets/css/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ url('/assets/css/app.css') }}" rel="stylesheet">
   @include('includes.fronthead') 
   <style type="text/css">
   	.osahan-nav .nav-link {
    font-weight: 600;
    padding: 28px 0px !important;
    margin: 0 0 0 31px;
}
.toast.toast-success {
color: #fff;
background-color: #4CAF50;
box-shadow: 0 0 10px 0 rgba(0,0,0,0.2);
}

   </style>
<title>Meal Ticket</title>
</head>
<body>
    
    <!-- Header start -->
    @include('includes.frontheader')
    <!-- Header end -->
    @yield('content')
    <!-- Footer start -->

    
      
        
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script type="text/javascript" src="{{ url('/public/assets/js/toastr.min.js') }}"></script>
<script src="{{url('/public/assets/vendor/jquery/jquery-3.3.1.slim.min.js')}}"></script>
       <script>

    @if(Session::has('message'))


        var type="{{Session::get('alert-type','info')}}";
        switch(type){
            case 'info':
                 toastr.info("{{ Session::get('message') }}");
                 break;
            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;
            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;
            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }

    @endif
</script>

      <!-- Bootstrap core JavaScript-->
      <script src="{{url('/public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
      <!-- Select2 JavaScript-->
      <script src="{{url('/public/assets/vendor/select2/js/select2.min.js')}}"></script>
      <!-- Owl Carousel -->
      <script src="{{url('/public/assets/vendor/owl-carousel/owl.carousel.js')}}"></script>
      
      <script type="text/javascript">
      	$('.select-two').select2();
      </script>
         @yield('extrajs')
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
      </form>   
</body>

</html>






