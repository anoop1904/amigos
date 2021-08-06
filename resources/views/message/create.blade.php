@extends('layouts.master')

@section('title', '| Users')

@section('content')


<!--begin::Main-->
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

<style>
.wrapper { width:100%; margin:50px auto; }
.char-textarea { width:100%; height:100px; resize:none; }
.char-count { font-weight:bold; }
h4 { font-weight:normal; }
.row1{
	margin-bottom:12px;
}
</style>      
          <!--begin::Entry-->
            <div class="d-flex flex-column-fluid">
               <!--begin::Container-->
               <div class="container ">
                  <!--begin::Dashboard-->
                  <div class="container-fluid">
  <!-- Page-Title -->
  <div class="row">
    <div class="col-sm-12">
      <div class="page-title-box">
        
        {{-- <h4 class="page-title"><i class="fa fa-key"></i>Users Administration</h4> --}}
      </div>
    </div> 
  </div>
    
  
  @if(Session::has('message'))
    <div class="alert alert-success login-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('message') !!} </div>
  @endif
  <!-- end page title end breadcrumb -->
  
  <div class="row">
    <div class="col-lg-12">
      <div class="card m-b-30">
	 
          @if(Request::segment(4)==='edit')
           {{ Form::model($message_temp, array('route' => array('messages.update', $message_temp->id), 'method' => 'PUT', 'id' => 'storeForm',  'enctype'=>'multipart/form-data')) }}
            <?php   
                $title             = $message_temp->title;
                $message           = $message_temp->body;
              ?>
                 
		
            {!! Form::hidden('id',$message_temp->id) !!}
            
            @else
            {{ Form::open(array('url' => 'admin/messages', 'enctype'=>'multipart/form-data','id' => 'userForm')) }}
            <?php 
               
                $title             = '';
                $message           = '';
                		
            ?>
            @endif
      <div class="card-body" >
          
          <div class="row row1  @if ($errors->has('title')) has-error @endif">
           <div class="col-md-4">
              <div class="form-group">
               {{ Form::label('Template Title', 'Template Title') }}
               <span class="text text-danger">*</span>

                <div>
               {{ Form::text('template_title', $title, array('class' => 'form-control','placeholder'=>'Template Title')) }}
                </div>
          @if ($errors->has('title')) <p class="help-block text text-danger"  >{{ $errors->first('title') }}</p> @endif
               </div>
      </div>
          </div>
     
          <div class="row row1"  >
       <div class="col-md-12 row1">
      <span class="text text-danger">Use This Variaval for Dynamic*</span>
      </div>
      <div class ="col-lg-12">
      <span class="text text-danger" >{first_name} , {last_name} , {email} , {mobile}</span>
      </div>
      </div>
       <div class="row row1" style="display:none;"  >
             <div class="col-md-2">
        <input type="checkbox" value="1"  id="emaildetail" name="emaildetail" data-value="{first_name}" > First_Name
       </div>
        <div class="col-md-2">
        <input type="checkbox" value="1"  id="emaildetail" name="emaildetail" data-value="{last_name}" > Last_Name
       </div>
        <div class="col-md-2">
        <input type="checkbox" value="1"  id="emaildetail" name="emaildetail" data-value="{email}" > Email
       </div>
        <div class="col-md-2">
        <input type="checkbox" value="1"  id="emaildetail" name="emaildetail" data-value="{mobile}" > Mobile
       </div>
      </div>
              <div class="row row1" @if ($errors->has('message')) has-error @endif >
               
      <div class="col-md-8">
    <textarea name="editor1"  data-length=250 rows="6", cols="50" class="char-textarea textarea_editor" placeholder="Type Message">{{$message}}</textarea>
  <h4><span class="char-count text-danger">250</span> chars remaining</h4>
    @if ($errors->has('message')) <p class="help-block text text-danger"  >{{ $errors->first('message') }}</p> @endif
        
</div>     
        </div>
        
            <div class="form-group m-b-0">
              <div>
                <button type="submit" class="btn btn-primary waves-effect waves-light"> Submit </button>
                <a href="{{ URL('admin/messages') }}" type="reset" class="btn btn-secondary waves-effect m-l-5"> Cancel </a>
              </div>
            </div>
       
        </div>
		  {!! Form::close() !!}
		  
		  
		
      </div>
    </div>
    <!-- end col -->
   
    <!-- end col -->
  </div>
  <!-- end row -->
</div>
<!-- end container -->
               </div>
               <!--end::Container-->
            </div>
          <!--end::Entry-->
         
<!--end::Main-->

@endsection

@section('extrajs')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.datetimepicker.css') }}">
<script src="{{ asset('assets/js/jquery.datetimepicker.js') }}"></script>
<script src="{{ asset('assets/js/jquery.datetimepicker.full.min.js') }}"></script>

<style type="text/css">
   .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 12px !important;
}
 </style> 
<script type="text/javascript">
  $( function() {
    $('.select2').select2({ width: '100%' });  
  });

$('#from_date').datetimepicker();
$('#to_date').datetimepicker();

jQuery(function(){
 jQuery('#from_date').datetimepicker({
  format:'Y/m/d',
  onShow:function( ct ){
   this.setOptions({
    maxDate:jQuery('#to_date').val()?jQuery('#to_date').val():false
   })
  },
  timepicker:false
 });
 jQuery('#to_date').datetimepicker({
  format:'Y/m/d',
  onShow:function( ct ){
   this.setOptions({
    minDate:jQuery('#from_date').val()?jQuery('#from_date').val():false
   })
  },
  timepicker:false
 });
});


	$('#emaildetail[type="checkbox"]').on('click',function(){
			var value = $(this).attr('data-value');
    
	//$(".cke_wysiwyg_frame").contents().find(".cke_editable").html($(".cke_wysiwyg_frame").contents().find(".cke_editable").html());

			if (this.checked) {
				if(typeof value !== 'undefined') {            				
	$(".cke_wysiwyg_frame").contents().find(".cke_editable").html($(".cke_wysiwyg_frame").contents().find(".cke_editable").html()+value);

				} 
			} else {
				
				if(typeof value !== 'undefined') {            
					var t = $(".cke_wysiwyg_frame").contents().find(".cke_editable").html();
					console.log(value,'value');
                    console.log(t);                    
					t = t.replace(value, '');                    
					$(".cke_wysiwyg_frame").contents().find(".cke_editable").html(t)
				} 
			}            
			$('.cke_editable p').focus();
		});
 
</script>
<script>
$(".char-textarea").on("keyup",function(event){
  checkTextAreaMaxLength(this,event);
});

function checkTextAreaMaxLength(textBox, e) { 
    
    var maxLength = parseInt($(textBox).data("length"));
    
  
    if (!checkSpecialKeys(e)) { 
        if (textBox.value.length > maxLength - 1) textBox.value = textBox.value.substring(0, maxLength); 
   } 
  $(".char-count").html(maxLength - textBox.value.length);
    
    return true; 
} 

function checkSpecialKeys(e) { 
    if (e.keyCode != 8 && e.keyCode != 46 && e.keyCode != 37 && e.keyCode != 38 && e.keyCode != 39 && e.keyCode != 40) 
        return false; 
    else 
        return true; 
}

</script>

@endsection