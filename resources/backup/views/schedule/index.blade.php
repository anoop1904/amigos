@extends('layouts.master')


@section('content')
<div class="container-fluid">
  <!-- Page-Title -->
  <div class="row">
    <div class="col-sm-12">
      <div class="page-title-box">
        <h4 class="page-title"> </h4>
      </div>
    </div>
  </div>
  @if (count($errors) > 0)
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  @if(Session::has('message'))
  <div class="alert alert-success login-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('message') !!} </div>
  @endif
  <!-- end page title end breadcrumb -->
  <div class="row">
    <div class="col-lg-12">
      <div class="card m-b-30">
        <div class="card-body"> @if(Request::segment(4)==='edit')
          {{ Form::model($adve, array('route' => array('advertise.update', $adve->id), 'method' => 'PUT')) }}
          <?php  
                $client_id = $adve->client_id;
                $location_id = $adve->location_id;
                $advertise_name = $adve->advertise_name;
            ?>
          @else
          {{ Form::open(array('url' => 'admin/advertise')) }}
          
          <?php 
               $advertise_id=$advertise_name=$location_id=$client_id = '';
            ?>
          @endif

         
          <div class="row">
            
            <div class="col-md-12">
             <div class="row">

              <div class="col-md-4">
                <div class="form-group"> 
                  <div> 
                    <label>Start Date : <span class="text text-danger">*</span></label>
                     <input type="text" autocomplete="off" class="form-control datepicker" id="from" name="startDate"> 
                   </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group"> 
                  <div> 
                    <label>End Date : <span class="text text-danger">*</span></label>
                     <input type="text" autocomplete="off" class="form-control datepicker" id="to" name="endDate"> 
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group"> 
                  <label>Client : <span class="text text-danger">*</span></label>
                  <div> 
                    <select class="form-control selectpicker" name="client_id" id="client_id"> 
                      <option value="0" >Select Client</option>
                      @if($clients)
                        @foreach ($clients as $key => $client) 
                          <option value="{{ $client->id }}"
                            <?php if($client_id ==$client->id ){ echo 'selected'; } ?>
                            >{{ $client->fname }}</option>
                        @endforeach
                      @endif
                    </select>
                   </div>
                </div>
              </div>

            

              <div class="col-md-12">
                <div class="form-group" style="display: none"> 
                  <div> 
                    <label>advertisement : <span class="text text-danger">*</span></label>
                     <select class="form-control selectpicker" multiple="" name="advertisement[]" id="advertisement"> 
                      <option>Select advertisement</option>
                      @if($advertises)
                        @foreach ($advertises as $key => $advertise) 
                          <option value="{{ $advertise->id }}"
                 <?php if($advertise_id ==$advertise->id ){ echo 'selected'; } ?>
                            >{{ $advertise->location->screen_name.'=>'.$advertise->advertise_name }}</option>
                        @endforeach
                      @endif
                    </select>
                   </div>
                </div>
              </div>
             



              
              
               <div class="clear-fix"></div>
              {{-- <div class="col-md-12">
                <div class="form-group"> 
                  <button type="submit" class="btn btn-primary waves-effect waves-light"> Submit </button>
                  <button type="reset" class="btn btn-secondary waves-effect m-l-5"> Cancel </button>   
                </div>
              </div> --}}
            </div>

            </div>
              




             

              
             

             

              
            </div>


          </div>
          {!! Form::close() !!}

              <div class="container">
                <div class="row" id="uploadContainer">
                      
                    
                </div>
              </div>
{{-- <div class="container">
    <div class="card">
      <div class="card-header">
      </div>
      <div class="card-body">
            <form id="uploadForm1" method="POST" action="{{ route('fileUploadPost') }}" enctype="multipart/form-data">
               <input type="hidden"  name="_token" id="csrf-token" value="{{ Session::token() }}" />
                <div class="form-group">
                    <input name="file" id="video1" type="file" class="form-control"><br/>

                    <div class="progress">
                        <div id="bar1" class="bar"></div >
                        <div class="percent">0%</div >
                    </div>
                    <div id="percent1"></div>
                    <div id="statusMessage1">aa</div>
                    <input type="submit"  value="Submit" class="btn btn-success" onclick="uploadForm('1')">
                </div>
            </form>    
      </div>
    </div>
</div >--}}

{{-- <form id="myForm" onsubmit="return upload_image(this)"  name="frmupload" enctype="multipart/form-data">
  <input type="hidden"  name="_token" id="csrf-token" value="{{ Session::token() }}" />
  <input type="file" id="upload_file" name="video" />
  <input type="submit" name='submit_image' value="Submit Comment"/>
</form> --}}

  <!-- end page title end breadcrumb -->
  <div class="row">

   <div class="col-lg-12">
      <div class="card m-b-30">
        <div class="card-body">
          <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
               
                <th>SNO</th>
                <th>client name</th>
                <th>Location</th>
                <th>Screen</th>
                <th>Advertise</th>
                <th>From Date</th>
                <th>To Date</th>
                <th>Duration</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
       {{--  <tfoot>
            <tr>
                <th>SNO</th>
                <th>client name</th>
                <th>Location</th>
                <th>Screen</th>
                <th>Advertise</th>
                <th>From Date</th>
                <th>To Date</th>
                <th>Duration</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </tfoot> --}}
    </table>
        </div>
      </div>
    </div>
    <!-- end col -->
  </div>
  <!-- end row -->

          </div>
           </div>




          
      </div>
    </div>
    <!-- end col -->
   
  </div>
  <!-- end row -->
</div>


<div id="editModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header"  style="display: block;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit</h4>
      </div>
      <div class="modal-body">

        <p id="modalContainer">
          <form id="uploadFormEdit" fid="Edit" enctype="multipart/form-data" onsubmit="return editUpload(this)">
          <div class="col-md-12">
            <div id="screen_name"></div>
            <div class="row">
            <div class="col-md-6">
              <div class="form-group"> 
                <div> 
                  <label>Start Date : <span class="text text-danger">*</span></label>
                   <input onchange="dateChange(this)" type="text" class="form-control datepicker" id="fromEdit" name="startDate"> 
                 </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group"> 
                <div> 
                  <label>End Date : <span class="text text-danger">*</span></label>
                   <input type="text" onchange="dateChange(this)" class="form-control datepicker" id="toEdit" name="endDate"> 
                </div>
              </div>
            </div>
          </div>
          <div class="row">  
              <div class="col-sm-6">
                <video id="playerEdit"  width="100%" controls>
                <source id="sourceEdit" src="" type="video/mp4">Your browser does not support HTML5 video.</video>
              </div>  
              <div class="col-sm-6">
                <div class="col-sm-12">
                  <label>Location : 
                    <span id="locationEdit"></span>
                  </label>
                </div>
                <div class="col-sm-12">
                  <label>Total Duration Second : <span id="totalDurationEdit"></span></label>
                </div>
                <div class="col-sm-12">
                  <label>Remaining Duration : <span id="remainingDurationEdit"></span>
                  </label>
                </div>
                <div class="col-sm-12">
                  <label>Duration in Second-</label>
                  <label id="durationLabelEdit"></label>
                </div>
              </div>
          </div>
              
                <input type="hidden"  name="_token" id="csrf-token" value="{{ Session::token() }}" />
                <input type="hidden"  name="schedule_id" id="scheduleIdEdit"/>
                <input type="hidden"  name="advertise_id" id="advertiseIdEdit"/>
                <input type="hidden"  name="duration" id="durationEdit" value="" />
                <input type="hidden"  name="oldVideoUrl" id="oldVideoUrl" value="" />
                <div class="row">
                <div class="col-sm-6 form-group">
                  <label>Itration</label>
                  <input type="number" placeholder="Itration" name="iteration" rid="Edit" id="iterationEdit" class="form-control iteration" value="1" min="1">
                </div>
                  
                <div class="col-sm-6">
                    <label>At End</label>
                    <select class="form-control" name="at_end" id="at_endEdit">
                      <option value="1">Delete</option>
                      <option value="2">Remaning</option>
                    </select>
                </div>
                </div>
                  <input name="file" id="videoEdit" type="file" class="form-control" onchange="videoChange(this,'Edit')"><br/><div class="progress">
                    <div id="barEdit" class="bar"></div>
                    <div class="percent">0%</div ></div>
                    <div id="percentEdit">&nbsp;</div>
                    <div id="statusMessageEdit">&nbsp;</div>
                    <input  id="uploadEdit" type="submit"  value="Upload" class="btn btn-success" >
                  </div>
                
          </div>
          </form>
        </p>
      </div>
      <div class="modal-footer">
        {{-- <button type="button" disabled="" class="btn btn-default" data-dismiss="modal">Close</button> --}}
      </div>
    </div>

  </div>
</div>

<div id="viewModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="display: block;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">View</h4>
      </div>
      <div class="modal-body">

        <p id="modalContainer">
          <div class="col-md-12">
          <div class="row">  
              <div class="col-sm-12">
                <video id="playerView"  width="100%" controls>
                <source id="playerView" src="" type="video/mp4">Your browser does not support HTML5 video.</video>
              </div>  
             
          </div>
          </div>
                
          </div>
          </form>
        </p>
      </div>
      <div class="modal-footer">
        {{-- <button type="button" disabled="" class="btn btn-default" data-dismiss="modal">Close</button> --}}
      </div>
    </div>

  </div>
</div>


<!-- end container -->
@endsection
@section('extrajs')
<style type="text/css">
  .myUpload{
        padding: 10px;
    border-style: groove;
  }
</style>

 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

{{-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> --}}
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <style>
        .progress { position:relative; width:100%; border: 1px solid #7F98B2; padding: 1px; border-radius: 3px; }
        .bar { background-color: #B4F5B4; width:0%; height:25px; border-radius: 3px; }
        .percent { position:absolute; display:inline-block; top:3px; left:48%; color: #7F98B2;}
    </style>

    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script> --}}
 
<script type="text/javascript">

var _token = "{{ csrf_token() }}";

function dateChange(obj){
  var from = $('#fromEdit').val();
  var to = $('#toEdit').val();
  var id = $('#advertiseIdEdit').val();
  var fromDate = new Date(from);
  var toDate = new Date(to);
  console.log('fromDate',fromDate);
  console.log('toDate',toDate);
  var diffDays = toDate.getDate() - fromDate.getDate(); 
  var totalSecond = parseInt((parseInt(diffDays)+1)*{{ config('constants.TIME') }}*60*60);
  //alert(totalSecond);
  $('#totalDurationEdit').html(totalSecond);

  $.ajax({
        type: "POST",
        url: "{{ URL('admin/getRemainingTime') }}",
        data:{_token:_token,id:id,from:from,to:to},
        beforeSend(xhr){
            //alert('before');
        },
        success: function(result){
          console.log(result);
           var obj = JSON.parse(result);
          // console.log(obj.status);
          if(obj.status == "success"){
            var remaining = totalSecond-parseInt(obj.videoLenght);
            $('#remainingDurationEdit').html(remaining);
            if(totalSecond>parseInt(obj.videoLenght)){
              $('#uploadEdit').prop('disbled',false);
            }else{
              $('#uploadEdit').prop('disbled',true);  
            }
          }
          // if(obj.status == "failed"){
          //   alert(obj.message);
          // }
             //console.log(result);
        },error: function(data){
                //alert("error");
        },complete: function(){
                //alert('complete');
        } 
      }); 
}

function view(id){
  $('#modalContainer').html(id);
  $.ajax({
    type: "POST", 
    url: "{{ URL('/admin/getSchedule') }}", 
    data: {id:id,_token:_token }, 
    success: function(result){
      var upload = htm = "";
      var obj = JSON.parse(result);
      console.log(obj);
      var $source = $("#playerView");
      $source[0].src = "{{ URL('') }}/public/tmp/"+obj.advertises.videoUrl;
      $source.parent()[0].load();
      }
  }); // ajax closing tag
  $('#viewModal').modal('show');
}
function edit(id){
  $('#barEdit').removeAttr('style');
  $('#percentEdit').html('');
  $('#videoEdit').val('');
  $.ajax({
    type: "POST", 
    url: "{{ URL('/admin/getSchedule') }}", 
    data: {id:id,_token:_token }, 
    success: function(result){
      console.log('------------');
      

      //console.log(result.advertises);
      console.log('------------');
      //return false;
      var upload = htm = "";
      var obj = JSON.parse(result);
      console.log(obj.advertises.advertise.location.screen_name);
      //console.log(obj.videoLength);
      var fromDate = new Date(obj.advertises.fromDate);
      var toDate = new Date(obj.advertises.toDate);
      var diffDays = toDate.getDate() - fromDate.getDate(); 
      var totalSecond = ((parseInt(diffDays)+1)*{{config('constants.TIME')}}*60*60);
      var videoLength = obj.videoLength;
      $('#scheduleIdEdit').val(obj.advertises.id);
      $('#advertiseIdEdit').val(obj.advertises.advertise_id);
      $('#iterationEdit').val(obj.advertises.iteration);
      $('#durationEdit').val(obj.advertises.videoLength);
      $('#durationLabelEdit').html(obj.advertises.videoLength);
      $('#oldVideoUrl').val(obj.advertises.videoUrl);
      $('#at_endEdit').val(obj.advertises.at_end);
      $('#locationEdit').html(obj.advertises.advertise.location.location);
      $('#totalDurationEdit').html(totalSecond);
      var $source = $("#sourceEdit");
  $source[0].src = "{{ URL('') }}/public/tmp/"+obj.advertises.videoUrl;
  $source.parent()[0].load();
      //$('#sourceEdit').src = ;
      
      $('#remainingDurationEdit').html( parseInt(totalSecond)-parseInt(videoLength) );
          //  var obj1 = obj.advertises;
          //console.log(upload);
    $("#fromEdit").datepicker("setDate", fromDate); 
    $("#toEdit").datepicker("setDate", toDate); 
        //$('#modalContainer').html(upload);
      }
  }); // ajax closing tag
  $('#editModal').modal('show');
}
function deleteVideo(id){
    var _token = "{{ csrf_token() }}";
    if(id != ''){
      $.ajax({
        type: "POST",
        url: "{{ URL('admin/deleteVideo') }}",
        data:{_token:_token,id:id},
        beforeSend(xhr){
            //alert('before');
        },
        success: function(result){
          console.log(result);
          var obj = JSON.parse(result);
          if(obj.status == "success"){
            $('#example').DataTable().ajax.reload();
          }
          if(obj.status == "failed"){
            alert(obj.message);
          }
             //console.log(result);
        },error: function(data){
                //alert("error");
        },complete: function(){
                //alert('complete');
        } 
      }); 
  } 
}

function statusChange(status,id){
    if(status == '1'){
      //alert(status+' '+id);
    }


          // var sendingData={
          //       PIID:"PI-0001",
          //       videoId:"v3",
          //       videoname:"abc.mp4",
          //       videoFTPPath:"http://192.168.47.7/pathofvideo/abc.mp4",
          //       videoServerPath:"~/home/firstaddigital/public_html/public/tmp/1542868533.mp4",
          //       videoduration:"30000",
          //       videoItration:"2",
          //       startDate:"22/11/2018",
          //       EndDate:"23/11/2018",
          //       afterEnd:"1",
          //         from:"",
          //     }






    var _token = "{{ csrf_token() }}";
    if(true){
      $.ajax({
        type: "POST",
        url: "{{ URL('admin/changeStatus') }}",
        data:{_token:_token,status:status,id:id},
        beforeSend(xhr){
            //alert('before');
        },
        success: function(result){
          console.log(result);
          var obj = JSON.parse(result);
          if(obj.status == "success"){
console.log(obj.data);
console.log(obj.data[0].advertise.location.deviceId);

var sendingData={
      PIID:obj.data[0].advertise.location.deviceId,
      videoId:obj.data[0].id,
      videoname:obj.data[0].videoUrl,
      videoFTPPath:"http://192.168.47.7/pathofvideo/abc.mp4",
      videoServerPath:obj.data[0].videoUrl,
      videoduration:obj.data[0].videoLength,
      videoItration:obj.data[0].iteration,
      startDate:obj.data[0].fromDate,
      EndDate:obj.data[0].toDate,
      afterEnd:obj.data[0].at_end,
        from:"web",
}
    socket.emit('msg', sendingData);
console.log(sendingData);
            $('#example').DataTable().ajax.reload();
          }
          if(obj.status == "failed"){
            alert(obj.message);
          }
             //console.log(result);
        },error: function(data){
                //alert("error");
        },complete: function(){
                //alert('complete');
        } 
      }); 
  } 
}
  function reload(){
    $('#example').DataTable().ajax.reload();
  }
var table = '';
 var token = "{{ csrf_token() }}";
 $(document).ready(function() {
    var table=$('#example').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": {
          'url':"{{ URL('admin/getScheduleRecord') }}",
          "type": "POST",
          "data":{"_token":token}
        }, "columns": [
            { "data": "sno"},
            { "data": "client_name"},
            { "data": "location"},
            { "data": "screen"},
            { "data": "advertise"},
            { "data": "fromDate"},
            { "data": "toDate"},
            { "data": "videoLength" },
            { "data": "IsActive" },
            { "data": "action" },
        ]
    } );
} );
    // function validate(formData, jqForm, options) {
    //     var form = jqForm[0];
    //     if (!form.file.value) {
    //         alert('File not found');
    //         return false;
    //     }
    // }
 // function uploadFormSubmit(id){
 //   return false;
 // }
 // function uploadFormSubmit(id){
 //  alert(id);
 //  // $('#uploadForm'+id).submit(function(){
 //  //   return false;
 //  // });
 //  uploadForms(id);
 // }

 function editUpload(obj)
 {
     
    var id = $(obj).attr('fid');
    var duration = $('#duration'+id).val();
    var bar = $('#bar'+id);
    var percent = $('#percent'+id);
    var statusMessage =  $('#statusMessage'+id);
      //  return false;
    var formData = new FormData(obj);
    //formData.append('client_id', client_id);
    //formData.append('from', from);
    //formData.append('to', to);
    formData.append('duration', duration);
    formData.append('formType', 'edit');
    //alert();
    //alert(obj.files[0].size);
    //formData.append('client_id', client_id);
    if(true){
      $.ajax({
        type: "POST",
        url: "{{ route('fileUploadPost') }}",
        cache:false,
        contentType: false,
        processData: false,
         data:formData,
        beforeSend(xhr){
            //alert('before');
            bar.removeAttr('style');
            percent.html('');
            statusMessage.html('');
            // var percentVal = '0%';
            // var posterValue = $('input[name=file]').fieldValue();
            // bar.width(percentVal)
            // percent.html(percentVal);
               // $('#saveBtn').html('Loding.....');
               // $('#saveBtn').prop('disabled',true);
               // $('#saveLoader').show();
        },
        success: function(result){
          console.log(result);
           var obj = JSON.parse(result);
            if(obj.status == 'success'){
              //alert('success');
              $('#example').DataTable().ajax.reload();
              $('#editModal').modal('hide');
            }
          //   statusMessage.html('&nbsp;');
            // var duration = $("#duration"+id).val();
            // var iteration = $("#iteration"+id).val();
            // var remainingDuration = $('#remainingDuration'+id).html();
            // $('#remainingDuration'+id).html(parseInt(remainingDuration)-(parseInt(duration)*parseInt(iteration)) );
            // $('#example').DataTable().ajax.reload();
            // $('#remainingDuration'+id).html();
             //console.log(result);
        },error: function(data){
                //alert("error");
            // statusMessage.html('error');
            // bar.removeAttr('style');
            // percent.html('');
        },complete: function(){
                //alert('complete');
                //statusMessage.html("complete");
               // $('#saveBtn').html('Add Candidate');
               // $('#saveBtn').prop('disabled',false);
               // $('#saveLoader').hide();
        },
        xhr: function() {
          var xhr = new window.XMLHttpRequest();

          xhr.upload.addEventListener("progress", function(evt) {
          if (evt.lengthComputable) {
            var percentComplete = evt.loaded / evt.total;
            var remaining = "( "+evt.loaded+' of '+ evt.total+" )";
            percentComplete = parseInt(percentComplete * 100);
            console.log(evt.loaded +' , '+evt.total);
            bar.width(percentComplete+ '%');
            percent.html(percentComplete+ '% '+remaining);

            if (percentComplete === 100) {
              console.log('complete',percentComplete);
              bar.width(percentComplete+ '%');
              percent.html(percentComplete+ '%');
            }

          }
        }, false);
        return xhr;
        }  
    });  
    }else{
      alert('Please select file');
    }
    
   return false;

 }
 function testUpload(obj)
 {
     
    var client_id = $('#client_id').val();
    var from = $('#from').val();
    var to = $('#to').val();
    var id = $(obj).attr('fid');
    //alert('manish'+id);
    var duration = $('#duration'+id).val();
    var bar = $('#bar'+id);
    var percent = $('#percent'+id);
    var statusMessage =  $('#statusMessage'+id);
      //  return false;
    var formData = new FormData(obj);
    formData.append('client_id', client_id);
    formData.append('from', from);
    formData.append('to', to);
    formData.append('duration', duration);
    //alert();
    //alert(obj.files[0].size);
    //formData.append('client_id', client_id);
    if($('#video'+id).val() !=''){
      $.ajax({
        type: "POST",
        url: "{{ route('fileUploadPost') }}",
        cache:false,
        contentType: false,
        processData: false,
         data:formData,
        beforeSend(xhr){
            //alert('before');
            bar.removeAttr('style');
            percent.html('');
             statusMessage.html('');
            // var percentVal = '0%';
            // var posterValue = $('input[name=file]').fieldValue();
            // bar.width(percentVal)
            // percent.html(percentVal);
               // $('#saveBtn').html('Loding.....');
               // $('#saveBtn').prop('disabled',true);
               // $('#saveLoader').show();
        },
        success: function(result){
          console.log(result);
          var obj = JSON.parse(result);
            if(obj.status == 'success'){
              //alert('success');
            }
            statusMessage.html('&nbsp;');


            var duration = $("#duration"+id).val();
            var iteration = $("#iteration"+id).val();
            var remainingDuration = $('#remainingDuration'+id).html();
            $('#remainingDuration'+id).html(parseInt(remainingDuration)-(parseInt(duration)*parseInt(iteration)) );
            $('#example').DataTable().ajax.reload();
            // $('#remainingDuration'+id).html();
             //console.log(result);
        },error: function(data){
                //alert("error");
            statusMessage.html('error');
            bar.removeAttr('style');
            percent.html('');
        },complete: function(){
                //alert('complete');
                //statusMessage.html("complete");
               // $('#saveBtn').html('Add Candidate');
               // $('#saveBtn').prop('disabled',false);
               // $('#saveLoader').hide();
        },xhr: function() {
          var xhr = new window.XMLHttpRequest();

          xhr.upload.addEventListener("progress", function(evt) {
          if (evt.lengthComputable) {
            var percentComplete = evt.loaded / evt.total;
            var remaining = "( "+evt.loaded+' of '+ evt.total+" )";
            percentComplete = parseInt(percentComplete * 100);
            console.log(evt.loaded +' , '+evt.total);
            bar.width(percentComplete+ '%');
            percent.html(percentComplete+ '% '+remaining);

            if (percentComplete === 100) {
              console.log('complete',percentComplete);
              bar.width(percentComplete+ '%');
              percent.html(percentComplete+ '%');
            }

          }
        }, false);
        return xhr;
        }  
    });  
    }else{
      alert('Please select file');
    }
    
   return false;

 }
// function uploadForms(id){
//   //var id = $(e).attr('fid');
//   //console.log(e);
//   alert('new submit = '+id);
//   //return false;
//     var bar = $('#bar'+id);
//     var percent = $('#percent'+id);
//     var statusMessage =  $('#statusMessage'+id);
//     var video = $('#video'+id);
 
//     $('#uploadForm'+id).ajaxForm({
//         beforeSubmit: validate,
//         beforeSend: function() {
//             statusMessage.html('');
//             var percentVal = '0%';
//             var posterValue = $('input[name=file]').fieldValue();
//             bar.width(percentVal)
//             percent.html(percentVal);
//         },
//         uploadProgress: function(event, position, total, percentComplete) {
//           if(percentComplete < '100'){

//             var percentVal = percentComplete + '%';
//             bar.width(percentVal);
//             //$('#per').html(percentVal);
//             percent.html(percentVal);
//           }
//           //console.log(percentComplete);
//         },
//         success: function(res) {
//             var percentVal = 'Wait, Saving';
//             bar.width(percentVal)
//             percent.html(percentVal);
//             //status.html(percentVal);
//              //alert('success');
//         },
//         complete: function(xhr) {
//             //status.html(xhr.responseText);
//             percent.html('100%');
//             bar.width('100%');
//             //bar.removeAttr('style');
//             video.val('');
//             statusMessage.html('Uploaded Successfully');
//             alert('Uploaded Successfully');
//             //window.location.href = "/file-upload";
//         }
//     });
//      console.log('finish');
//    return false;
// }

 

</script>




<script type="text/javascript">
function checkSize(rowId){
  var id = rowId;
  var iteration = $('#iteration'+id).val();
  var duration = $("#duration"+id).val();
  var remainingDuration = $("#remainingDuration"+id).html();

  if( (parseInt(duration)*parseInt(iteration) ) <= parseInt(remainingDuration) ){
    return true;
  }else{
    return false;
  }
}
$(document).on('change','.iteration',function(event) {
  //alert();
  if(checkSize( $(this).attr('rid') )){
    //alert('upload');
  }else{
    //alert('not upload');
  }

  // var id = $(this).attr('rid');
  // var iteration = $(this).val();
  // var duration = $("#duration"+id).val();
  // var remainingDuration = $("#remainingDuration"+id).html();
});
function videoChange(obj,id){
console.log($(obj).val().split('.').pop().toLowerCase());
var ext = $(obj).val().split('.').pop().toLowerCase();
if($.inArray(ext, ['mp4']) == -1) {
    $(obj).val('');
    alert('invalid extension! please select only mp4 file');
    return false;
}

var remainingDuration = $("#remainingDuration"+id).html();
var iteration = $("#iteration"+id).val();
  var $source = $("#source"+id);
  $source[0].src = URL.createObjectURL(obj.files[0]);
  $source.parent()[0].load();
  var vid = document.getElementById("player"+id);  
  vid.onloadeddata = function() {
    $("#duration"+id).val(parseInt(vid.duration));
    $("#durationLabel"+id).html(parseInt(vid.duration));
       if(checkSize(id)){
        console.log('upload success');
        $('#upload'+id).attr("disabled", false);
       }else{
        alert("Remaining second: "+remainingDuration+", Your file too large");
        $(obj).val('');
        $('#upload'+id).attr("disabled", true);
       }
  };
  //$("#player"+id).html('<source src="test1.mp4" type="video/mp4"></source>' );
}  
  
$('#client_id').change(function(event) {
  //alert($(this).val());
  var from = $('#from').val();
  var to = $('#to').val();
  //alert(from +' '+ to); 
if(from !='' && to !=''){


var date1 = new Date(from);
var date2 = new Date(to);
var diffDays = date2.getDate() - date1.getDate(); 
var totalSecond = ((parseInt(diffDays)+1)*{{ config('constants.TIME') }}*60*60);

  var client_id = $(this).val();
 
  $.ajax({
    type: "POST", 
    url: "{{ URL('/admin/getAdds') }}", 
    data: {from:from,to:to,client_id:client_id,_token:_token }, 
    success: function(result){
      console.log('------------');
      console.log(result);
      //console.log(result.advertises);
      console.log('------------');
      //return false;
      var upload = htm = "";
      var obj = JSON.parse(result);
     // console.log(obj.advertises);
        if(obj.advertises.length>0){
          htm += "<option value='0' selected disabled>Select Advertisement</option>";

          for(var i=0;i<obj.advertises.length;i++){
            var obj1 = obj.advertises[i];
            var videoLength = obj.videoLength[i];
            upload += '<div class="col-md-4"><div>'+obj1.location.screen_name +'</div><video id="player'+i+'"  width="100%" controls><source id="source'+i+'" src="{{ URL("public/tmp/1541831639.mp4") }}" type="video/mp4">Your browser does not support HTML5 video.</video><div><label>Total Duration Second : '+totalSecond+'</label></div><div><label>Remaining Duration : <span id="remainingDuration'+i+'">'+(totalSecond-videoLength)+'</span></label></div><div><label>Duration in Second -</label><label id="durationLabel'+i+'"></label></div><form id="uploadForm'+i+'" fid="'+i+'" enctype="multipart/form-data" onsubmit="return testUpload(this)"><input type="hidden"  name="_token" id="csrf-token" value="{{ Session::token() }}" /><input type="hidden"  name="advertise_id" id="advertise_id" value="'+obj1.id+'" /><input type="hidden"  name="duration" id="duration'+i+'" value="" /><div class="form-group">Itration<input type="number" placeholder="Itration" name="iteration" rid="'+i+'" id="iteration'+i+'" class="form-control iteration" value="1" min="1">At End<select class="form-control" name="at_end"><option value="1">Delete</option><option value="2">Remaning</option></select><input name="file" id="video'+i+'" type="file" class="form-control" onchange="videoChange(this,'+i+')" required><br/><div class="progress"><div id="bar'+i+'" class="bar"></div ><div class="percent">0%</div ></div><div id="percent'+i+'">&nbsp;</div><div id="statusMessage'+i+'">&nbsp;</div><input  id="upload'+i+'" type="submit"  value="Upload" class="btn btn-success" ></div></form></div>';
            //console.log(obj1.city_id);
            htm += "<option value='"+obj1.id+"'>"+obj1.location.screen_name +"=>"+obj1.advertise_name+"</option>";
          }
        }else{
           htm += "<option value='0' selected disabled>No Advertisement</option>";
        }
        //uploadContainer
        console.log(upload);
        $("#uploadContainer").html(upload);
        $("#advertisement").html(htm);
        //$("#advertisement").select2({data:htm});
      
      }
  }); // ajax closing tag

  }else{
    alert('please select date!');
    $('#client_id').val(0);
  }
});


    $( function() {
      var dateFormat = "mm/dd/yy",

      from = $( "#from" )
        .datepicker({
          defaultDate: "+1w",
          minDate: new Date(),
          changeMonth: true,
          // numberOfMonths: 3
        }).on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#to" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        minDate: new Date(),
        // numberOfMonths: 3
      }).on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
      function getDate( element ) {
        var date;
        try {
          date = $.datepicker.parseDate( dateFormat, element.value );
        } catch( error ) {
          date = null;
        }
   
      return date;
      }
      fromEdit = $( "#fromEdit" )
        .datepicker({
          defaultDate: "+1w",
          minDate: new Date(),
          changeMonth: true,
         
          // numberOfMonths: 3
        }).on( "change", function() {
          toEdit.datepicker( "option", "minDate", getDateEdit( this ) );
        }),
      toEdit = $( "#toEdit" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        minDate: new Date(),
        // numberOfMonths: 3
      }).on( "change", function() {
        fromEdit.datepicker( "option", "maxDate", getDateEdit( this ) );
      });
 
      function getDateEdit( element ) {
        var date;
        try {
          date = $.datepicker.parseDate( dateFormat, element.value );
        } catch( error ) {
          date = null;
        }
        return date;
      }
   

  });
    

    $('.selectpicker').select2({
      width: '100%',
      // placeholder: "Select Transaction Type",
    });


</script>

@endsection