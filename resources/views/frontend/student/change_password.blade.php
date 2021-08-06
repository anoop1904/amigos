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
                          <h2>Change Password </h2>
                          <hr>
                            <div class="login ">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-9 col-lg-8">
                         <form method="POST" enctype='multipart/form-data' action="{{url('/student/update_password')}}">
                              <input type="hidden"  name="_token" value="{{ csrf_token() }}">
                             
                              <div class="form-label-group">
                                 <input type="password" id="oldpassword" name="oldpassword" class="form-control" placeholder="Old Password" value="" required="required">
                                 <label for="oldpassword">Old Password</label>
                              </div>
                               <div class="form-label-group">
                                 <input type="password" id="newpassword" name="newpassword" class="form-control" placeholder="New Password" required="required">
                                 <label for="newpassword">New Password</label>
                                 <span style="color:red;"></span>
                              </div>
                             <div class="form-label-group">
                                 <input type="password" id="confirmpassword" name="confirmpassword" class="form-control" placeholder="Confirm Password" required="required">
                                 <label for="confirmpassword">Confirm Password</label>
                              </div>
                              
                           <button type="submit" class="btn btn-lg btn-outline-primary btn-block btn-login text-uppercase font-weight-bold mb-2 changepassword">Change Password</button>
                              
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

var minLength = 6;
$(document).ready(function(){
    $('#newpassword').on('keydown keyup change', function(){
        var char = $(this).val();
        var charLength = $(this).val().length;
        if(charLength < minLength){
            $('span').text('Length is short, minimum '+minLength+' required.');
            $('.changepassword').prop('disabled', true); 
        }
        else
        {
          $('.changepassword').prop('disabled', false);
         $('span').text('');
        }
    });
});

var password = document.getElementById("newpassword")
  , confirm_password = document.getElementById("confirmpassword");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}
password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
  
</script>
@endsection