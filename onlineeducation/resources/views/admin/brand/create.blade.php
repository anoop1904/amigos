@extends('layouts.master')

@section('title', '| Student')

@section('content')
<div class="container-fluid">
  <!-- Page-Title -->
  <div class="row">
    <div class="col-sm-12">
      <div class="page-title-box">
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
        <div class="card-body">
         
          
           @if(Request::segment(4)==='edit')
           {{ Form::model($brand, array('route' => array('brand.update', $brand->id), 'method' => 'PUT',  'enctype'=>'multipart/form-data', 'id' => 'studentForm')) }} 
            
            <?php            
              $name               = $brand->name;
              $category_id = $brand->category_id;           
            ?>
            {!! Form::hidden('id',$brand->id) !!}
            
            @else
            {{ Form::open(array('url' => 'admin/brand', 'enctype'=>'multipart/form-data', 'id' => 'studentForm')) }}
            {!! Form::hidden('CreatedBy',Auth::user()->id) !!}
            <?php 
              $name             = '';
              $category_id = '';           
            ?>
            @endif
          

          
          <div class="row">
          
          </div>
            <div class="row"> 
            

            <div class="col-md-6">
              <div class="form-group">
               {{ Form::label('Category', 'Category') }}
               <span class="text text-danger">*</span>
                <div>
                   
               <select class="form-control" name="category_id">
                 <option value="" disabled="" selected="">Select Category</option>
                 @foreach($categories as $key=>$category)
                  <option value="{{$category->id}}" <?php if($category->id == $category_id){ echo "selected"; }  ?>>{{$category->name}}</option> 
                 @endforeach
               </select>
                </div>
              </div>
            </div>

           
            <div class="col-md-6">
              <div class="form-group">
               {{ Form::label('name', 'Name') }}
               <span class="text text-danger">*</span>
                <div>
                   
               {{ Form::text('name', $name, array('class' => 'form-control','placeholder'=>'Name','id'=>'name')) }}
                </div>
              </div>
            </div>   
             
            </div>
            
           
            <div class="form-group m-b-0">
              <div>
                <button type="submit" class="btn btn-primary waves-effect waves-light"> Submit </button>
                <a href="{{ URL('admin/brand') }}" type="reset" class="btn btn-secondary waves-effect m-l-5"> Cancel </a>
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
@endsection

@section('extrajs')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<link rel="stylesheet" type="text/css" href="{{ asset('public/css/jquery.datetimepicker.css') }}">
<script src="{{ asset('public/js/jquery.datetimepicker.js') }}"></script>
<script src="{{ asset('public/js/jquery.datetimepicker.full.min.js') }}"></script>

<script type="text/javascript">
  $( function() {
    $('.select').select2({
      width: '100%',
      placeholder: 'Select Language',
    });  
  });

 
</script>
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