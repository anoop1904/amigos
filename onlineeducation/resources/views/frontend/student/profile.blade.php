  @extends('layouts.frontmaster')
  @section('content')

      <section class="section pt-5 pb-5" style="background: white;">
         <div class="container">
            <div class="row profile">
                <div class="col-md-3">
                  <div class="profile-sidebar">
                   
                    <!-- SIDEBAR MENU -->
                    <div class="profile-usermenu">
                     @include('includes.usermenu') 
                    </div>
                    <!-- END MENU -->
                  </div>
                </div>
                <div class="col-md-9">
                        <div class="profile-content">
                          <h2>Profile </h2>
                          <hr>
                            <div class="login ">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-9 col-lg-8">
                         <form method="POST" enctype='multipart/form-data' action="{{url('/student/update-profile')}}">
                              <input type="hidden"  name="_token" value="{{ csrf_token() }}">
                              <input type="hidden"  name="user" value="{{$student->id }}">
                              <div class="form-label-group">
                                 <input type="text" id="inputlname" name="fname" class="form-control" placeholder="First Name" value="{{$student->name}}">
                                 <label for="inputlname">First Name</label>
                              </div>
                            
                               <div class="form-label-group">
                                 <input type="text" id="inputfname" name="lname" class="form-control" placeholder="Last Name" value="{{$student->last_name}}">
                                 <label for="inputfname">Last Name</label>
                              </div>
                               <div class="form-label-group">
                                 <input type="text" id="inputmobile" name="mobile" class="form-control" placeholder="Mobile" value="{{$student->mobile_number}}">
                                 <label for="inputmobile">Mobile</label>
                              </div>
                              <div class="form-label-group">
                                 <input type="email" id="ptext" name="email" class="form-control" placeholder="Email" value="{{$student->email}}">
                                 <label for="ptext">Email</label>
                              </div>


                              <div class="form-label-group">
                                <label style="margin-top: -25px;color:#777" for="school">School</label>
                                 <select name="school" id="school"  class="form-control select-two form-group">
                                    @if(!$student->school_id)
                                    <option selected="" value="0" disabled="">Select School</option>
                                    @endif
                                    @foreach($schools AS $key=>$school)
                                    <option value="{{$school->id}}"> {{$school->name}}</option>
                                    @endforeach
                                 </select>
                                 
                              </div>

                              <div class="form-label-group">
                                 <input type="text" id="school_year" name="school_year" class="form-control" placeholder="School Year" value="{{$student->school_year}}">
                                 <label for="school_year">School Year</label>
                              </div>
                               <div class="form-group"> 
                                 <label for="Language Code" id="code">Profile Picture</label>
                                 <div class="image-upload"> 
                                   <?php
                                       $url = 'assets/images/user.png';
                                     if($student->profile_pic){
                                     $url = 'public/student/'.$student->profile_pic;
                                     }
                                     
                                   ?>
                                   <img id="blah" src="{{asset($url)}}" style="height: 150px;width: 150px;">
                                   <input id="imgInp" type="file" name="file">
                                 </div>
                               </div>
                



                           <button type="submit" class="btn btn-lg btn-outline-primary btn-block btn-login text-uppercase font-weight-bold mb-2">Update Profile</button>
                              
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
                        </div>
                </div>
              </div>

         </div>
      </section>

 @endsection 
@section('extrajs')

<script type="text/javascript">

  function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#imgInp").change(function() {
  readURL(this);
});

</script>
@endsection