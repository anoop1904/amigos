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
          {{ Form::model($jobmaster, array('route' => array('jobmaster.update', $jobmaster->id), 'method' => 'PUT')) }}
          <?php  
                $HiringManagerID                = $jobmaster->HiringManagerID;
                $JobTitle                       = $jobmaster->JobTitle;
                $Description                    = $jobmaster->Description;
                $Department                     = $jobmaster->Department;
                $SalaryFrom                     = $jobmaster->SalaryFrom;
                $SalaryTo                       = $jobmaster->SalaryTo;
                $Positions                      = $jobmaster->Positions;
                $ExpectedJoiningDate            = $jobmaster->ExpectedJoiningDate;
                $Tags                           = $jobmaster->Tags;
                $Skills                         = $jobmaster->Skills;
                $Location                       = $jobmaster->Location;
                $Keywords                       = $jobmaster->Keywords;
               
            ?>
          @else
          {{ Form::open(array('url' => 'admin/jobmaster','id'=>'jobForm')) }}
          <?php 
                
                $HiringManagerID            = '';
                $JobTitle                   = '';
                $Description                = '';
                $Department                 = '';
                $SalaryFrom                 = '';
                $SalaryTo                   = '';
                $Positions                  = '';
                $ExpectedJoiningDate        = '';
                $Tags                       = '';
                $Skills                     = '';
                $Location                   = '';
                $Keywords                   = '';
                
                             
            ?>
          @endif
    
            <div class="row">
            
            <div class="col-md-12">
             
                <div class="form-group"> {{ Form::label('OrgID', 'Hiring Deliver Manager') }}
                  <div> <select name="HiringManagerID" id="HiringManagerID" class="form-control" style="height: 37px;">
              @if(Request::segment(4)==='edit')
              @else
                <option value="" selected disabled>Select Hiring Deliver Manager</option>
              @endif
                @foreach($hiring as $hiringrow)
                <option value="{{$hiringrow->id}}" @if($hiringrow->id==$HiringManagerID) selected @endif>{{$hiringrow->name}}</option>
                @endforeach
              </select> </div>
                
              
              </div>
              </div>
              </div>
         
          <div class="row">
            
            <div class="col-md-12">
             <div class="row">
              <div class="col-md-4">
                <div class="form-group"> {{ Form::label('JobTitle', 'Job Title') }}
                  <span id="jobTitleError"></span>
                  <div> {{ Form::text('JobTitle', $JobTitle, array('class' => 'form-control','placeholder'=>'Job Title','required'=>'required','id'=>'jobTitle')) }} </div>
                </div>
              </div>
             <div class="col-md-4">
              <div class="form-group"> {{ Form::label('SalaryTo', 'Salary To') }}
                <div> {{ Form::number('SalaryTo', $SalaryTo, array('step'=>'0.01', 'class' => 'form-control','placeholder'=>'Salary To','required'=>'required')) }} </div>
              </div>
              </div>
              <div class="col-md-4">
              <div class="form-group"> {{ Form::label('SalaryFrom', 'Salary From') }}
                <div> {{ Form::number('SalaryFrom', $SalaryFrom, array('step'=>'0.01','class' => 'form-control','placeholder'=>'Salary From','required'=>'required')) }} </div>
              </div>
              </div>
              </div>
              <div class="row">
              <div class="col-md-4">
              <div class="form-group"> {{ Form::label('ExpectedJoiningDate', 'Expected Joining Date') }}
                <div> {{ Form::text('ExpectedJoiningDate', $ExpectedJoiningDate, array('class' => 'form-control datepicker','placeholder'=>'Expected Joining Date','required'=>'required')) }} </div>
              </div>
              </div>
              <div class="col-md-4">
               <div class="form-group"> {{ Form::label('Positions', 'Positions') }}
                <div> {{ Form::number('Positions', $Positions, array('class' => 'form-control','placeholder'=>'Positions','required'=>'required')) }} </div>
              </div>
              </div>
              <div class="col-md-4">

              <div class="form-group"> {{ Form::label('Location', 'Location') }}
                <div> {{ Form::text('Location', $Location, array('class' => 'form-control','placeholder'=>'Location','required'=>'required')) }} </div>
              </div>
              </div>
              </div>

              <div class="row">
              <div class="col-md-6">
              <div class="form-group"> {{ Form::label('Keywords', 'Keywords') }}
                <div> 
                
                <select name="Keywords[]"  class="form-control selectpicker" id="Keywords" data-live-search="true" multiple="">
              @if(Request::segment(4)==='edit')
             
              @else
              <option value="0"  disabled="">Select Keywords</option>
              @endif
                @foreach($keywordall as $keywordalls)
                <option value="{{$keywordalls->id}}" @if( in_array($keywordalls->id, explode(',',$Keywords) ) ) selected @endif>{{$keywordalls->name}}</option>
                @endforeach
              </select></div>
              </div>
              </div>
              
              <div class="col-md-6">

              <div class="form-group"> {{ Form::label('Department', 'Department') }}
                <div> {{ Form::text('Department', $Department, array('class' => 'form-control','placeholder'=>'Department','required'=>'required')) }} </div>
              </div>
              </div>
              </div>

               <div class="row">
              <div class="col-md-6">
              <div class="form-group"> {{ Form::label('Tags', 'Tags') }}
                <div>
                  <select class="form-control myForm selectpicker" multiple="" id="Tags" name="Tags[]" required="">
                    <option value="0"  disabled="">Select Tag</option>
                      @foreach($tagall as $tagalls)
                      <option value="{{ $tagalls->id }}" 
 @if( in_array($tagalls->id, explode(',',$Tags) ) ) selected @endif
                        >{{ $tagalls->name }}
                    </option>
                    @endforeach
                  </select>
                </div>
              </div>
              </div>
              
              <div class="col-md-6">

              <div class="form-group"> {{ Form::label('Skills', 'Skills') }}
                <div> 
                <select name="Skills[]"  class="form-control selectpicker" id="select-country" data-live-search="true" multiple>
              @if(Request::segment(4)==='edit')
              @else
                <option value="" selected disabled>Select Keywords</option>
              @endif
                @foreach($skillall as $skillalls)
                <option value="{{$skillalls->id}}" @if( in_array($skillalls->id, explode(',',$Skills))) selected @endif>{{$skillalls->name}}</option>
                @endforeach
              </select> </div>
              </div>
              </div>
              </div>
            
              
               <div class="form-group"> {{ Form::label('Description', 'Job Description') }}
                <div> {{ Form::textarea('Description', $Description, array('class' => 'form-control ckeditor','rows'=>'3','placeholder'=>'Description','required'=>'required')) }} </div>
              </div>

            </div>

          </div>
          <div class="form-group m-b-0">
            <div>
              <button type="submit" class="btn btn-primary waves-effect waves-light"> Submit </button>
              <a href="{{ url('admin/job') }}" class="btn btn-secondary waves-effect m-l-5"> Cancel </a>
            </div>
          </div>
          {!! Form::close() !!} </div>
      </div>
    </div>
    <!-- end col -->
   
  </div>
  <!-- end row -->
</div>
<!-- end container -->
@endsection
@section('extrajs')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>


<script type="text/javascript">
var base_url = "{{ URL('') }}";
$(document).ready(function(){

  $('#jobTitle').change(function(){
    if($('#HiringManagerID').val() == null || $('#HiringManagerID').val() == ''){
      alert();
      $('#HiringManagerID').css('border','1px solid red');
      $('#jobTitle').val('');
    }else{
      orgId = $('#HiringManagerID').val();
      title = $('#jobTitle').val();
      //alert('call validation');
       $.ajax({
        type: "GET",
        url: base_url+"/admin/checkJobTitle/"+orgId+'/'+title,
        beforeSend(xhr){
           //alert('before');
           // $('#show').hide();
           // $('#hide').hide();
                $('#jobTitleError').html('search.....');
               // $('#saveBtn').prop('disabled',true);
               // $('#saveLoader').show();
        },
        success: function(result){
            //alert(result);
             //console.log(result);
            var obj = JSON.parse(result);
           
             if(obj['result'] == 'success'){
                $('#jobTitleError').html('');
             }
            if(obj['result'] == 'failed'){
               $('#jobTitleError').html('<span class="text text-danger">'+obj['message']+'</span>');
               $('#jobTitle').val('');
             }
        },error: function(data){
                alert("error");
                //console.log(data);
        },complete: function(){
                //alert('complete');
                //$('#jobTitleError').html('Loding.....');
               // $('#saveBtn').html('Add Candidate');
               // $('#saveBtn').prop('disabled',false);
               // $('#saveLoader').hide();
        }  
    });

    }

  });
});


  $(function() {
  //$('.selectpicker').selectpicker();
  $('.selectpicker').select2({
      width: '100%',
     // placeholder: "Select Transaction Type",
  });
});
</script>

 <script>
  $( function() {
    $( ".datepicker" ).datepicker({
  changeYear: true,changeMonth: true
});
  } );
  </script>
  
  
  
  
  <script src="{{ asset('assets/plugins/editor/ckeditor.js') }}"></script>
  <!--<link rel="stylesheet" href="{{ asset('assets/plugins/editor/samples/sample.css') }}">-->
	<script>

		var editor, html = '';

		function createEditor() {
			if ( editor )
				return;

			// Create a new editor inside the <div id="editor">, setting its value to html
			var config = {};
			editor = CKEDITOR.appendTo( 'editor', config, html );
		}

		function removeEditor() {
			if ( !editor )
				return;

			// Retrieve the editor contents. In an Ajax application, this data would be
			// sent to the server or used in any other way.
			document.getElementById( 'editorcontents' ).innerHTML = html = editor.getData();
			document.getElementById( 'contents' ).style.display = '';

			// Destroy the editor.
			editor.destroy();
			editor = null;
		}

	</script>

@endsection