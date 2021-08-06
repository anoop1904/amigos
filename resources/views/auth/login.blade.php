<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <link href="{{url('public/assets/css/toastr.min.css')}}" rel="stylesheet">
   <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="Askbootstrap">
      <meta name="author" content="Askbootstrap">
      <title>Amigos</title>
      <!-- Favicon Icon -->
     <link rel="icon" type="image/png" href="{{url('/public/assets/img/mealtkt.png')}}">
      <!-- Bootstrap core CSS-->
      <link href="{{url('/public/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
      <!-- Font Awesome-->
      <link href="{{url('/public/assets/vendor/fontawesome/css/all.min.css')}}" rel="stylesheet">
      <!-- Font Awesome-->
      <link href="{{url('/public/assets/vendor/icofont/icofont.min.css')}}" rel="stylesheet">
      <!-- Select2 CSS-->
      <link href="{{url('/public/assets/vendor/select2/css/select2.min.css')}}" rel="stylesheet">
      <!-- Custom styles for this template-->
      <link href="{{url('/public/assets/css/osahan.css')}}" rel="stylesheet">
      <!-- Owl Carousel -->
      <link rel="stylesheet" href="{{url('/public/assets/vendor/owl-carousel/owl.carousel.css')}}">
      <link rel="stylesheet" href="{{url('/public/assets/vendor/owl-carousel/owl.theme.css')}}">
 
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

</head>
<body>
    

    
            <div class="container-fluid">
         <div class="row no-gutter">
            {{-- <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div> --}}
            <div class="col-md-12 col-lg-12">
               <div class="login d-flex align-items-center py-5">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-9 col-lg-8 mx-auto pl-5 pr-5">
                           <h3 class="login-heading mb-4">Welcome back!</h3>
                            <!--begin::Form-->
                <form class="form" novalidate="novalidate" id="kt_login_signin_form" method="POST" action="{{ route('login') }}">
                    {{csrf_field()}}
                    <!--begin::Title-->
                    <div class="pb-13 pt-lg-0">
                        <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Welcome to Amigos</h3>
                        <!-- <span class="text-muted font-weight-bold font-size-h4">New Here? <a href="javascript:;" id="kt_login_signup" class="text-primary font-weight-bolder">Create an Account</a></span> -->
                    </div>
                    <!--begin::Title-->

                    <!--begin::Form group-->
                    <div class="form-group">
                        <label class="font-size-h6 font-weight-bolder text-dark">Email</label>
                        <!-- <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="text" name="username" autocomplete="off"/> -->

                        <input type="email" autocomplete="off" name="email" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" placeholder="Email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                        <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif

                    </div>
                    <!--end::Form group-->

                    <!--begin::Form group-->
                    <div class="form-group">
                        <div class="d-flex justify-content-between ">
                            <label class="font-size-h6 font-weight-bolder text-dark">Password</label>

                            <a href="javascript:void(0);" class="text-primary font-size-h6 font-weight-bolder text-hover-primary" id="kt_login_forgot">Forgot Password ?</a>
                        </div>

                        <!-- <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="password" name="password" autocomplete="off"/> -->

                        <input  type="password" autocomplete="off" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" name="password" required placeholder="Password">

                        @if ($errors->has('password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <!--end::Form group-->

                    <!--begin::Action-->
                    <div class="pb-lg-0 pb-5">
                        <button type="submit" class="btn btn-primary font-weight-bolder font-size-h6">Sign In</button>
                        </button>
                    </div>
                    <!--end::Action-->
                </form>
                <!--end::Form-->
                       <!--     <hr class="my-4">
                           <p class="text-center">LOGIN WITH</p>
                           <div class="row">
                              <div class="col pr-2">
                                 <button class="btn pl-1 pr-1 btn-lg btn-google font-weight-normal text-white btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Google</button>
                              </div>
                              <div class="col pl-2">
                                 <button class="btn pl-1 pr-1 btn-lg btn-facebook font-weight-normal text-white btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Facebook</button>
                              </div>
                           </div> -->
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
     
      <!-- Footer start -->

    
      
        
           <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
           <script type="text/javascript" src="{{url('/public/assets/js/toastr.min.js')}}"></script>
           <script src="{{url('/public/assets/vendor/jquery/jquery-3.3.1.slim.min.js')}}"></script>
       <script>

    </script>

      <!-- Bootstrap core JavaScript-->
      <script src="{{url('/public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
      <!-- Select2 JavaScript-->
      <script src="{{url('/public/assets/vendor/select2/js/select2.min.js')}}"></script>
      <!-- Owl Carousel -->
      <script src="{{url('/public/assets/vendor/owl-carousel/owl.carousel.js')}}"></script>
   
</body>

</html>




