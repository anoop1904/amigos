@extends('layouts.master')

@section('title', '| Users')

@section('content')


<!--begin::Main-->
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

<style>
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
        <div class="card-body">
          
           @if(Request::segment(4)==='edit')
           {{ Form::model($offer, array('route' => array('emailtemplate.update', $offer->id), 'method' => 'PUT', 'id' => 'storeForm',  'enctype'=>'multipart/form-data')) }} 
            
            <?php  
                $template_title             = $offer->template_title;
                $ckeditor           = $offer->ckeditor; 
                $image             = "";				
            ?>
            {!! Form::hidden('id',$offer->id) !!}
            
            @else
            {{ Form::open(array('url' => 'admin/emailtemplate', 'enctype'=>'multipart/form-data','id' => 'userForm')) }}
            <?php 
               
                $template_title             = '';
                $ckeditor           = '';
                $image = '';				
            ?>
            @endif

          
          <div class="row row1  @if ($errors->has('title')) has-error @endif">
           <div class="col-md-4">
              <div class="form-group">
               {{ Form::label('Template Title', 'Template Title') }}
               <span class="text text-danger">*</span>

                <div>
               {{ Form::text('template_title', $template_title, array('class' => 'form-control','placeholder'=>'Template Title','id'=>'to_date')) }}
                </div>
			    @if ($errors->has('title')) <p class="help-block text text-danger"  >{{ $errors->first('title') }}</p> @endif
               </div>
			</div>
          </div>
		  <div class="row row1">

		    
	
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
              <div class="row row1" @if ($errors->has('body')) has-error @endif >
             <div class="col-md-12">
         <textarea name="editor1" class="textarea_editor" id="textarea_editor" rows="6", cols="100" ></textarea>
		  @if ($errors->has('body')) <p class="help-block text text-danger"  >{{ $errors->first('body') }}</p> @endif
        <script>
            CKEDITOR.replace( 'editor1' );
        </script>
		 </div>			  
			  </div>
           <div class="row">
		        <div class="col-md-6">
                  <div class="form-group"> 
					 {{ Form::label('Background Image', 'Background Image(optional)') }}
					    <span class="text text-danger">*</span>
                    <div> 
                      <?php
                        $url = 'assets/images/user.png';
                        if($image){
                        $url = 'public/assets/img/banner/'.$image;
                        }
                      ?>
                      <img id="blah" src="{{asset($url)}}" style="height: 150px;width: 150px;">
                      <input id="imgInp" type="file" name="file">
                    </div>
                  </div>
            </div>  
		   </div>
            <div class="form-group m-b-0">
              <div>
                <button type="submit" class="btn btn-primary waves-effect waves-light"> Submit </button>
                <a href="{{ URL('admin/offer') }}" type="reset" class="btn btn-secondary waves-effect m-l-5"> Cancel </a>
              </div>
            </div>
         {!! Form::close() !!}
        </div>
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

@endsection