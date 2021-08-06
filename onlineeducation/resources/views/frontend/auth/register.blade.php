  @extends('layouts.frontmaster')
  @section('content')
      <div class="container-fluid">
         <div class="row no-gutter">
            <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
            <div class="col-md-8 col-lg-6">
               <div class="login d-flex align-items-center py-5">
                  <div class="container">
                     <div class="row">

    @if (count($errors) > 0)
   <!--    <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
          </ul>
      </div> -->
    @endif

                        <div class="col-md-9 col-lg-8 mx-auto pl-5 pr-5">
                           <h3 class="login-heading mb-4">New Buddy!</h3>
                           <form method="POST" action="{{url('/send-otp')}}">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                               <div class="form-label-group">
                                     @php $countrylist=getCountry(); @endphp
                                    <select name="country" id="country"  class="form-control select-two form-group" >
                                      <option value="">Select Country</option>
                                       @foreach($countrylist AS $country)
                                          <option value="{{$country->countries_isd_code}}"> ({{$country->countries_isd_code}}) {{$country->countries_name}}</option>
                                        @endforeach
                                     </select>
                                  @if ($errors->has('country'))
                                    <span class="help-block error" style ="color: red;">
                                    <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                  @endif
                                  </div>

                              <div class="form-label-group">
                                 <input type="tel" id="inputEmail" name="mobile_number" class="form-control" placeholder="Email address">
                                 <label for="inputEmail">Mobile</label>
                                  @if ($errors->has('mobile_number'))
                                    <span class="help-block error" style ="color: red;">
                                    <strong>{{ $errors->first('mobile_number') }}</strong>
                                    </span>
                                  @endif
                              </div>
                             <!--  <div class="form-label-group">
                                 <input type="password" id="inputPassword" class="form-control" placeholder="Password">
                                 <label for="inputPassword">Password</label>
                              </div> -->
                              <div class="form-label-group mb-4">
                                 <input type="text" id="ptext" name="referral_code" class="form-control" placeholder="Promocode">
                                 <label for="ptext">Promocode</label>
                                
                              </div>
                           <!--    <a href="index.html" class="btn btn-lg btn-outline-primary btn-block btn-login text-uppercase font-weight-bold mb-2">Sign Up</a> -->

                           <button type="submit" class="btn btn-lg btn-outline-primary btn-block btn-login text-uppercase font-weight-bold mb-2">Sign Up</button>
                              <div class="text-center pt-3">
                                 Already have an Account? <a class="font-weight-bold" href="{{url('/signin')}}">Sign In</a>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
 @endsection 
@section('extrajs')


@endsection