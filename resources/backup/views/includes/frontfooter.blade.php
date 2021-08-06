

<!-- Footer Section -->
<footer class="footer footer-4 p-b-60" id="footer">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-6 text-center m-b-40">
        <div class="font-40 m-b-20">
          <span class="text-green-2 ti-location-pin"></span>
        </div>
        <!-- Address -->
        <h4 class="text-white no-m-b">We are here</h4>
        <p class="text-grey">Bhopal Office 12 Archana Complex ,Zone -2 ,MP Nagar Bhopal.</p>
      </div>

      <div class="col-md-3 col-sm-6 text-center m-b-40">
        <div class="font-40 m-b-20">
          <span class="text-green-2 ti-mobile"></span>
        </div>
        <!-- Phone -->
        <h4 class="text-white no-m-b">24/7 contact</h4>
        <p class="text-grey">9826702123<br> 8770802242</p>
      </div>
      
      <div class="col-md-3 col-sm-6 text-center m-b-40">
        <div class="font-40 m-b-20">
          <span class="text-green-2 ti-email"></span>
        </div>
        <!-- Email -->
        <h4 class="text-white no-m-b">Email</h4>
        <p class="text-grey">
          info@firstaddigital.com
        </p>
      </div>
      
      <div class="col-md-3 col-sm-6 text-center m-b-40">
        <div class="font-40 m-b-20">
          <span class="text-green-2 ti-time"></span>
        </div>
        <!-- Working Hours -->
        <h4 class="text-white no-m-b">Working hours</h4>
        <p class="text-grey">Mon to friday 10 AM to 7 PM</p>
      </div>
    </div>
  </div>
</footer>
<!-- End Footer Section -->





  <!-- Jquery plugins -->
  <script src="{{ asset('assets/frontend/js/jquery-2.2.4.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('assets/frontend/js/bootstrap.min.js') }}" type="text/javascript"></script>  
  <script src="{{ asset('assets/frontend/js/modernizr.custom.js') }}" type="text/javascript"></script>
  <script src="{{ asset('assets/frontend/js/jquery.counterup.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('assets/frontend/js/wow.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('assets/frontend/js/owl.carousel.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('assets/frontend/js/nivo-lightbox.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('assets/frontend/js/jquery.ajaxchimp.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('assets/frontend/js/jquery.countdown.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('assets/frontend/js/jquery.validate.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('assets/frontend/js/waypoints.min.js') }}" type="text/javascript"></script>
  <!-- Custom -->   
  <script src="{{ asset('assets/frontend/js/custom.js') }}" type="text/javascript"></script>
  <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

  <!-- Google Analytics: Change UA-XXXXX-X with your site's ID.
   For Help Go To http://www.google.com/analytics/ -->

  <!-- <script>
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-XXXXX-X']);
    _gaq.push(['_trackPageview']);

    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
  </script> -->


<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Login</h4>
        </div>
        <div class="modal-body">
          
          <form role="form" id="loginSubmit" onsubmit="return loginSubmit(this)" class="form-horizontal">
          	<div id="errorLoginMessage"></div>
            <div class="form-group">
            <div class="col-sm-12">
              <label>Email</label>
              <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
              <input type="text" name="email" placeholder="Email" class="form-control">
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-12">
              <label>Password</label>
              <input type="password" name="password" placeholder="Password"  class="form-control">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-12">
              <input type="submit" name="submit" value="Login" style="min-width: 50px;"  class="btn btn-primary">
              <button type="button" class="btn btn-danger" style="background: #af443c;min-width: 50px;" data-dismiss="modal">Close</button>
            </div>
          </div>
            </form>
          
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	


  function contact(){

   //$('.myform').css('border','1px solid #ccc');
    $.ajax({
      url: "{{ URL('/send') }}",
      type: 'POST',
      data: $('#contact1').serialize(),
      before:function(){
        $('#errorMessage').html('');
      },
      success : function(res){
        console.log(res);
         var obj = JSON.parse(res);
         if(obj.status == 'success'){
           $('#errorMessage').html('<div class="alert alert-success">'+obj.message+'</div>');
           $('#contact1').trigger("reset");
         }
        // if(obj.status == 'failed'){
        //   $('#errorMessage').html('<div class="alert alert-danger" >'+obj.message+'</div>');
        //   //location.reload();
        //   //location.href = "<?php //echo base_url().'User/account' ?>";
        // }
      }
    });
    return false;
  }
	function loginSubmit(){

$('.myform').css('border','1px solid #ccc');
		$.ajax({
			url: "{{ URL('/user_login') }}",
			type: 'POST',
			data: $('#loginSubmit').serialize(),
			success : function(res){
				//console.log(res);
 				var obj = JSON.parse(res);
        //console.log(obj.message);
        if(obj.status == 'success'){
        	location.reload();
        }
				if(obj.status == 'failed'){
//alert(obj.message);
					$('#errorLoginMessage').html('<div class="alert alert-danger" >'+obj.message+'</div>');
					//location.reload();
					//location.href = "<?php //echo base_url().'User/account' ?>";
				}
			}
		});
		return false;
		}
</script>