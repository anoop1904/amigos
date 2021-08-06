<footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        © 2018 by Subtitle.
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer -->
       
<!-- ///// -->
<div id="popupModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
 <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <span>Alert</span>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
        <!-- <h4 class="modal-title">Alert&nbsp;</h4> -->
      </div>
      <div class="modal-body">
        <div class="form-group" id="popupMessage">
            <!-- <span class="text text-danger">You already have an overlapping booking</span> -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
      </div>
    </div>

  </div>
</div>

<!-- ///// -->

       

       
       
        <!-- jQuery  -->
       <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
       <script src="{{ asset('assets/js/popper.min.js') }}"></script>
       <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
       <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
       <script src="{{ asset('assets/js/waves.js') }}"></script>
       <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
       <script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>
       <script src="{{ asset('assets/js/jquery.scrollTo.min.js') }}"></script>
       <script src="{{ asset('assets/pages/dashborad.js') }}"></script>
        <!-- App js -->
      <script src="{{ asset('assets/js/app.js') }}"></script>
      <script src="{{ asset('assets/js/validate.js') }}"></script>
      <script src="{{ asset('assets/js/form-validation.js') }}"></script>

<style type="text/css">
  .content-active{
background: #9b9a9a !important;
color: #fff  !important;
font-weight: bold;
}
</style>
<script type="text/javascript">
 window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 3000);
    </script>
      <script type="text/javascript">
$(document).ready(function($) {
 $('.content-active').trigger('click'); 
});




function languageChange(obj){
  var language_id =$(obj).val();

  $.ajax({
    url:"{{ URL('admin/get_content') }}"+'/'+language_id+"/language_know",
    method:"GET",
    success: function(data) {
      var obj = JSON.parse(data)
      if(obj.status =='success'){
      
      }
      var translator_data= transcript_data='';
      var trascript_user = obj.results.trascript_user;
      var traslator_user = obj.results.traslator_user;
      console.log('trascript_user.length',trascript_user.length);
      console.log('traslator_user.length',traslator_user.length);
      // for (i = 0; i < trascript_user.length; i++) {
      //   transcript_data+= "<option value='"+trascript_user[i].id+"'>"+trascript_user[i].name+"</option>";
      // }
      $('#translator_user_id').attr('required','required');
      if(traslator_user.length > 0){

        for (i = 0; i < traslator_user.length; i++) {
          translator_data+= "<option value='"+traslator_user[i].id+"'>"+traslator_user[i].name+"</option>";
        }
        $('#assignBtn').prop('disabled',false);
      }else{
        $('#assignBtn').prop('disabled',true);
      }
      // $('#tranlator_language').html(languageData);
      // $('#content_language_id').val(lang.language);
      $('#transcript_user_id').html(transcript_data);
      $('#translator_user_id').html(translator_data);
      $('#transcript_user_id,#translator_user_id').select2({
          width: '100%',
          placeholder: "Select User",
      });
    },
    error: function() {
    //$('#notification-bar').text('An error occurred');
    }
  });
}
        function reopen(assign_id,status,load=''){
          var r = confirm('Are You Sure?')
          console.log(assign_id,status);
          if(r){
            var _token = "{{ csrf_token() }}";
            $.ajax({
              url:"{{ URL('admin/content_status') }}"+'/'+status,
              method:"POST",
              data:{'_token':_token,'assign_id':assign_id},
              success: function(data) {
                console.log(data);
                if(status == 'Reopened for Transcript'){
                  $('#transcript').DataTable().ajax.reload();
                }else if(status == 'Reopened for Translation'){
                  $('#translator').DataTable().ajax.reload();
                }else if(status == 'Reopened for Caption'){
                  $('#caption').DataTable().ajax.reload();
                }else if(status == 'reopen'){
                  window.location.reload();
                }else if(status == 'studio_approve' || status == 'studio_reject'){
                  if(load == 'reload'){
                    window.location.reload();
                  }
                  $('#example').DataTable().ajax.reload();
                  $('#caption').DataTable().ajax.reload();
                }else{
                  $('#example').DataTable().ajax.reload();
                }

                

                
                //$('#transcript').DataTable().ajax.reload();
              },
              error: function() {
                // $('#notification-bar').text('An error occurred');
              }
            });
          }
        }
        function statusChange(obj){
          //alert();
          var user_id = $('#user_id').val();
          var content_id = $('#content_id').val();
          
          //alert(content_id);
          //return false;
          var _token = "{{ csrf_token() }}";
          var r = confirm("Are You Sure?");
          console.log(r);
          if(r){
            var status =$(obj).val();
            $.ajax({
              url:"{{ URL('admin/content_status') }}"+'/'+status,
              method:"POST",
              data:{'_token':_token,'content_id':content_id,'user_id':user_id},
              success: function(data) {
                console.log(data);
                $('.content-active').trigger('click');
                //var obj = JSON.parse(data);
                //if(obj.status == 'success'){
                  //console.log(obj.comment);
                  // var htm=' <div class="comment"><div>'+obj.results.comment+'</div><div class="text text-right">'+obj.results.created_at+'</div></div>';
                  // $('#comment_section').append(htm);
                  // $(that).val('');
                //}
                //$('#list').html(data);
              },
              error: function() {
                // $('#notification-bar').text('An error occurred');
              }
            });
          }
        }
      </script>
      
       