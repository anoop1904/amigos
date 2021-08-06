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
           {{ Form::model($plan, array('route' => array('plan.update', $plan->id), 'method' => 'PUT', 'id' => 'storeForm',  'enctype'=>'multipart/form-data')) }} 
            
            <?php  
                $name          = $plan->name;
                $price         = $plan->price;
                $ckeditor   = $plan->description;
                $plan_type     = $plan->plan_type;	
                $image         =$plan->image;				
            ?>
            {!! Form::hidden('id',$plan->id) !!}
            
            @else
            {{ Form::open(array('url' => 'admin/plan', 'enctype'=>'multipart/form-data','id' => 'userForm')) }}
            <?php 
			
                $name           = '';
                $price          = '';
                $ckeditor    = '';
                $plan_type      = '';	
                $image          = '';				
            ?>
           
             @endif
		 
		 
          <div class="row row1  @if ($errors->has('name')) has-error @endif">
           <div class="col-md-4">
              <div class="form-group">
               {{ Form::label('Plan', 'Plan') }}
               <span class="text text-danger">*</span>

                <div>
               {{ Form::text('name', $name, array('class' => 'form-control','placeholder'=>'Plan','id'=>$name)) }}
                </div>
          @if ($errors->has('name')) <p class="help-block text text-danger"  >{{ $errors->first('name') }}</p> @endif
               </div>
      </div>
	   
	  
	   <div class="col-md-4">
              <div class="form-group">
                 {{ Form::label('Plan Type', 'Plan Type') }}
               <span class="text text-danger">*</span>
                <div>
                   
                <select class="form-control select2 planType"  name="planType" required="">
                  <option selected="selected" value="" disabled="">Select Type</option>
                  
				  <option   value="1">Monthy</option>
				  <option   value="2">Yearly</option>
                   
                </select>

                </div>
              </div>
            </div>
			
	  
	    <div class="col-md-4">
              <div class="form-group">
               {{ Form::label('Price', 'Price') }}
               <span class="text text-danger">*</span>

                <div>
               {{ Form::text('price', $price, array('class' => 'form-control','placeholder'=>'Price','id'=>$price)) }}
                </div>
          @if ($errors->has('title')) <p class="help-block text text-danger"  >{{ $errors->first('title') }}</p> @endif
               </div>
      </div>
          </div>
              <div class="row row1" @if ($errors->has('body')) has-error @endif >
             <div class="col-md-12">
         <textarea name="editor1" class="textarea_editor" id="textarea_editor" rows="6", cols="100" >{{$ckeditor}}</textarea>
      @if ($errors->has('body')) <p class="help-block text text-danger"  >{{ $errors->first('body') }}</p> @endif
        <script>
            CKEDITOR.replace( 'editor1' );
        </script>
     </div>       
        </div>
           <div class="row">
            <div class="col-md-6">
                  <div class="form-group"> 
           {{ Form::label('Image', 'Image(optional)') }}
              <span class="text text-danger">*</span>
                    <div> 
                      <?php
                        $url = 'assets/images/user.png';
                        if($image){
                        $url = 'public/assets/img/plan/'.$image;
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
                <a href="{{ URL('admin/plan') }}" type="reset" class="btn btn-secondary waves-effect m-l-5"> Cancel </a>
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
            </div>

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


 
</script>

@endsection