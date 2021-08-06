@extends('layouts.master')

@section('title', '| School')

@section('content')

<script src="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
<link href="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>


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
           {{ Form::model($category, array('route' => array('category.update', $category->id), 'method' => 'PUT',  'enctype'=>'multipart/form-data', 'id' => 'schoolForm')) }} 
              <?php  
                  $name     = $category->name;
                  $image    = $category->image;    
                  $banner    = $category->banner_image;    
                  $category_id    = $category->parent_id;    
              ?>
              {!! Form::hidden('id',$category->id) !!}
            @else
            {{ Form::open(array('url' => 'admin/category', 'enctype'=>'multipart/form-data', 'id' => 'schoolForm')) }}
              {!! Form::hidden('CreatedBy',Auth::user()->id) !!}
              <?php 
                  $name             = '';
                  $image            = '';                
                  $category_id      = '';
                  $banner    ='';                
              ?>
            @endif
          
            <div class="row"> 
            
             <div class="col-md-6">
              <div class="form-group">
               {{ Form::label('Category', 'Category') }}
               <span class="text text-danger">*</span>
                <div>
                   
               <select class="form-control" name="category_id" required="">
                 <option value="0" selected="">Root</option>
                 @foreach($categories_array as $key=>$category)
                  <option value="{{$category['id']}}" <?php if($category['id'] == $category_id){ echo "selected"; }  ?>>{{implode('/', array_reverse($category['data'])) }}</option> 
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

            
       

             <div class="col-md-6">
                  <div class="form-group"> 
                    <label for="Language Code" id="code">Image</label>
                    <div> 
                      <?php
                        $url = 'assets/images/user.png';
                        if($image){
                        $url = 'public/assets/img/category/'.$image;
                        }
                      ?>
                      <img id="blah" src="{{asset($url)}}" style="height: 150px;width: 150px;">
					@if(Request::segment(4)==='edit')
					  <input id="imgInp" type="file" name="file" >
				    @else
                      <input id="imgInp" type="file" name="file"  required="" >
                    @endif				
					</div>
                  </div>
            </div>

            <div class="col-md-6" > 
                  <div class="form-group"> 
                    <label for="Language Code" id="code1">Banner Image</label>
                    <div> 
                      <?php
                        $url = 'assets/images/user.png';
                        if($banner){
                        $url = 'public/assets/img/category/'.$banner;
                        }
                      ?>
                      <img id="blah1" src="{{asset($url)}}" style="height: 150px;width: 150px;">
					@if(Request::segment(4)==='edit')
                      <input id="imgInp1" type="file" name="bannerimage"  >
				    @else
					  <input id="imgInp1" type="file" name="bannerimage" required="" >
					@endif	
		            </div>
                  </div>
            </div>

        
             
            </div>
            
           
            <div class="form-group m-b-0">
              <div>
                <button type="submit" class="btn btn-primary waves-effect waves-light"> Submit </button>
                <a href="{{ URL('admin/category') }}" type="reset" class="btn btn-secondary waves-effect m-l-5"> Cancel </a>
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

 
  var timepicker = new TimePicker('time', {
  lang: 'en',
  theme: 'dark'
});
timepicker.on('change', function(evt) {
  
  var value = (evt.hour || '00') + ':' + (evt.minute || '00');
  evt.element.value = value;

});

</script>
@endsection