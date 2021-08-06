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
                           <h3 class="login-heading mb-4">Update Profile</h3>
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
                                 <input type="email" id="ptext" name="email" class="form-control" placeholder="Email" value="{{$student->email}}">
                                 <label for="ptext">Email</label>
                              </div>


                              <div class="form-label-group">
                                 <select name="school" id="school"  class="form-control select-two form-group">
                                    @if(!$student->school_id)
                                    <option selected="" value="0" disabled="">Select School</option>
                                    @endif
                                    @foreach($schools AS $key=>$school)
                                    <option value="{{$school->id}}"> {{$school->name}}</option>
                                    @endforeach
                                 </select>
                                <!--  <label for="school">Select School</label> -->
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