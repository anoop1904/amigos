@extends('layouts.frontmaster')
  @section('content')

            <div class="container-fluid">
         <div class="row no-gutter">
            <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
            <div class="col-md-8 col-lg-6">
               <div class="login d-flex align-items-center py-5">
                  <div class="container">
                     <div class="row">
                       <div class="col-md-9 col-lg-8 mx-auto pl-5 pr-5">
                           <h3 class="login-heading mb-4">Verify OTP</h3>

                           
                           <form method="post" action="{{url('verify')}}">
                              <input type="hidden" name="user" value="{{$id}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <div class="form-label-group">
                                 <input type="text" id="inputPassword" class="form-control" placeholder="OTP" name="otp" required="">
                                 <label for="inputPassword">OTP</label>
                              </div>
                              
                              
                               <button type="submit" class="btn btn-lg btn-outline-primary btn-block btn-login text-uppercase font-weight-bold mb-2">Verify OTP</button>
                               </form>

                              <form method="post" action="{{url('/resend-otp')}}">
                              <input type="hidden" name="user" value="{{$id}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                               <button type="submit" class="btn btn-lg btn-outline-primary btn-block btn-login text-uppercase font-weight-bold mb-2">Resend OTP</button>
                             </form>
                              <div class="text-center pt-3">
                                 Don’t have an account? <a class="font-weight-bold" href="register.html">Sign Up</a>
                              </div>
                           
                       
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
     
  @endsection 
@section('extrajs')
<!-- <script src="{{ asset('assets/backend') }}/js/pages/widgets.js?v=7.0.6"></script> -->

@endsection