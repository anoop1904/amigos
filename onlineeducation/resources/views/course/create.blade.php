@extends('layouts.master')

@section('title', '| Student')

@section('content')
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
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
           {{ Form::model($course, array('route' => array('course.update', $course->id), 'method' => 'PUT',  'enctype'=>'multipart/form-data', 'id' => 'studentForm')) }} 
            
            <?php            
              $name               = $course->name;
              $image              = $course->image; 
              $category_id        = $course->category_id;           
              $sub_category_id    = $course->sub_category_id;                   
              $video_link           = $course->video_url;       
              $meta_data          = $course->meta_data;
              $meta_description   = $course->meta_description;
              $description        = $course->description;
              $short_description  = $course->short_description;      
              $price  = $course->price;      
              $discount  = $course->discount;      
              $discount_type  = $course->discount_type;      
              $plan_id  = $course->plan_id;      
              $videourl  = $course->videourl;      
            ?>
            {!! Form::hidden('id',$course->id) !!}
            
            @else
            {{ Form::open(array('url' => 'admin/course', 'enctype'=>'multipart/form-data', 'id' => 'studentForm')) }}
            {!! Form::hidden('CreatedBy',Auth::user()->id) !!}
            <?php 
              $name               = '';
              $sub_category_id    = '';                     
              $image              = '';  
              $category_id        = '';             
              $video_link           = '';
              $meta_data= '';
              $meta_description= '';
              $description= '';
              $short_description= '';           
              $price= '';           
              $discount= '';           
              $discount_type= '';           
              $plan_id= ''; 
              $videourl  =array();          
            ?>
            @endif
          

          
          <div class="row">
          
          </div>
            <div class="row"> 
              <!-- <div class="col-md-4">
                <div class="form-group">
                 {{ Form::label('Category', 'Category') }}
                 <span class="text text-danger">*</span>
                  <div>
                     
                 <select class="form-control category" name="category_id" id="category" target-data="sub_category">
                   <option value="" disabled="" selected="">Select Category</option>
                   @foreach($categories as $key=>$category)
                    <option value="{{$category->id}}" <?php if($category->id == $category_id){ echo "selected"; }  ?>>{{$category->name}}</option> 
                   @endforeach
                 </select>
                  </div>
                </div>
              </div>

              <div class="col-md-4" id="sub_category_section" style="">
                <div class="form-group">
                 {{ Form::label('Sub Category', 'Sub Category') }}
                 <span class="text text-danger">*</span>
                  <div>
                     
                 <select class="form-control sub_category category" name="sub_category" id="sub_category" target-data="sub_sub_category">
                   <option value="" selected="">Select Sub Category</option>
                   @foreach($sub_categories as $key=>$category)
                    <option value="{{$category->id}}" <?php if($category->id == $sub_category_id){ echo "selected"; }  ?>>{{$category->name}}</option> 
                   @endforeach
                 </select>
                  </div>
                </div>
              </div> -->
              <div class="col-md-4">
              <div class="form-group">
               {{ Form::label('Course name', 'Course Name') }}
               <span class="text text-danger">*</span>
                <div>
                   
               {{ Form::text('name', $name, array('class' => 'form-control','placeholder'=>'Name','id'=>'name')) }}
                </div>
              </div>
            </div>
        <!--    <div class="col-md-4">
              <div class="form-group">
                {{ Form::label('Video Link Url', 'Video Link Url') }}
                <span class="text text-danger">*</span><br>
                <span style="color:red;">Enter multiple video url separated by comma.</span>
                <div>
                  {{ Form::text('video_link', $video_link, array('class' => 'form-control',  'placeholder'=>'Video Link Url', 'id'=>'video_link')) }}
                </div>
              </div>
            </div> -->
            <div class="col-md-4">
              <div class="form-group">
                {{ Form::label('Price', 'Price') }}
                <span class="text text-danger">*</span>
                <div>
                  {{ Form::text('price', $price, array('class' => 'form-control',  'placeholder'=>'Price', 'id'=>'price')) }}
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                {{ Form::label('Discount', 'Discount') }}
                <span class="text text-danger">*</span>
                <div>
                  {{ Form::text('discount', $discount, array('class' => 'form-control',  'placeholder'=>'Discount', 'id'=>'discount')) }}
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                {{ Form::label('Discount Type', 'Discount Type') }}
                <span class="text text-danger">*</span>
                  <div>
                     
                 <select class="form-control" name="discount_type" id="discount_type" >
                    <option value="0" <?php if($discount_type == 0){ echo "selected"; }  ?>>No Discount</option> 
                    <option value="1" <?php if($discount_type == 1){ echo "selected"; }  ?>>%</option> 
                    <option value="2" <?php if($discount_type == 2){ echo "selected"; }  ?>>Flat</option> 
                   
                 </select>
                  </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                {{ Form::label('Meta Data', 'Meta Data') }}
                <span class="text text-danger">*</span>
                <div>
                  {{ Form::text('meta_data', $meta_data, array('class' => 'form-control',  'placeholder'=>'Meta Data', 'id'=>'meta_data')) }}
                </div>
              </div>
            </div>
              <div class="col-md-4">
              <div class="form-group">
                {{ Form::label('Razorpay Plan Id', 'Razorpay Plan Id') }}
                <span class="text text-danger">*</span>
                <div>
                  {{ Form::text('plan_id', $plan_id, array('class' => 'form-control',  'placeholder'=>'Razorpay Plan id', 'id'=>'plan_id','required'=>'required')) }}
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                {{ Form::label('Meta Description', 'Meta Description') }}
                <span class="text text-danger">*</span>
                <div>
                  {{ Form::text('meta_description', $meta_description, array('class' => 'form-control',  'placeholder'=>'Meta Description', 'id'=>'meta_description')) }}
                </div>
              </div>
            </div>
            </div>
            <div class="row input_fields_wrap">
              @if(empty($videourl))
              <div class="col-md-5"> 
                <div class="form-group">
                {{ Form::label('Video Link Url', 'Video Link Url') }}
                <span class="text text-danger">*</span>
                <div>
                  <input type="text" name="video_link[]" id="video_link" required="required" class="form-control">
                 
                </div>
              </div>
            </div>
              <div class="col-md-5">
                 <div class="form-group">
                {{ Form::label('Video Image', 'Video Image') }}
                <span class="text text-danger">*</span>
                <div>
                  <input type="file" name="videoimg[]" id="videoimg" required="required" class="form-control">
                 
                </div>
              </div>
              </div>
               <div class="col-md-2"><a style="cursor: pointer;" class="add_field_button">Add More Fields</a></div>
              @else
               @foreach($videourl as $key=> $video)
              <div class="row" style="width: 100%">
                <div class="col-md-5"> 
                <div class="form-group">
                {{ Form::label('Video Link Url', 'Video Link Url') }}
                <span class="text text-danger">*</span>
                <div>
                  <input type="text" name="video_link[]" id="video_link" required="required" class="form-control" value="{{$video->video_url}}">
                 
                   </div>
                  </div>
                </div>
              <div class="col-md-5">
                 <div class="form-group">
                {{ Form::label('Video Image', 'Video Image') }}
                <span class="text text-danger">*</span>
                <div>
                  <input type="file" name="videoimg[]" id="videoimg"  class="form-control">
                  <input type="hidden" name="oldimg[]" value="{{$video->image}}">
                 <?php
                        $url = 'assets/images/user.png';
                        if($video->image){
                        $url = 'public/assets/img/course/'.$video->image;
                        }
                      ?>
                      <img id="blah" src="{{asset($url)}}" style="height: 150px;width: 150px;">
                </div>
              </div>
              </div>
                @if($key=='0')
                  <div class="col-md-2"><a style="cursor: pointer;" class="add_field_button">Add More Fields</a></div>
                  @else
                  <div class="col-md-2">
                    <a href="#" class="remove_field">Remove</a>
                  </div>
                  @endif
                </div> 
               @endforeach
             
              @endif
            
            </div>
          <div class="col-md-12">
              <div class="form-group">
                {{ Form::label('Short Description', 'Short Description') }}
                <span class="text text-danger">*</span>
                <div>
                  {{ Form::textarea('short_description', $short_description, array('class' => 'form-control',  'placeholder'=>'Short Description', 'id'=>'short_description','rows'=>'5')) }}
                </div>
              </div>
            </div> 

            <div class="col-md-12">
              <div class="form-group">
                {{ Form::label('Description', 'Description') }}
                <span class="text text-danger">*</span>
                <div>
                  {{ Form::textarea('description', $description, array('class' => 'form-control textarea_editor',  'placeholder'=>'Description', 'id'=>'description','rows'=>'5')) }}
                </div>
                 <script>CKEDITOR.replace( 'description' );</script>
              </div>
            </div> 

            
         
            <div class="col-md-6">
                  <div class="form-group"> 
                    <label for="Language Code" id="code">Image</label>
                    <div> 
                      <?php
                        $url = 'assets/images/user.png';
                        if($image){
                        $url = 'public/assets/img/course/'.$image;
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
                <a href="{{ URL('admin/course') }}" type="reset" class="btn btn-secondary waves-effect m-l-5"> Cancel </a>
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

function reset(){
$('#sub_category,#sub_category_section').hide();
}

$(document).on('change','.category',function(){
    var cid = $(this).val();
    var attrId = $(this).attr('target-data');
    if(attrId == 'sub_category'){
      //reset();
    }
    console.log('attrId',attrId);
     $.ajax({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{URL('admin/getSubCategory')}}",
        type: 'POST',
        data: {cid:cid},
        success:function(response) { 
          var obj = JSON.parse(response);
          if(obj.status){
            $('#'+attrId).html(obj.result);
            $('#'+attrId).show();
            $('#'+attrId+'_section').show();
            // $('#sub_sub_category').html(obj.result);
          }else{
            $('#'+attrId).html(obj.result);
            $('#'+attrId+'_section').hide();
            $('#'+attrId).hide();
          }

        },
        error:function(){ alert('error');}
        }); 

  });
 
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
$(document).ready(function() {
  var max_fields      = 15; //maximum input boxes allowed
  var wrapper       = $(".input_fields_wrap"); //Fields wrapper
  var add_button      = $(".add_field_button"); //Add button ID
  
  var x = 1; //initlal text box count
  $(add_button).click(function(e){ //on add input button click
    e.preventDefault();
    if(x < max_fields){ //max input box allowed
      x++; //text box increment
      $(wrapper).append('<div class="row" style="width: 100%;"><div class="col-md-5"> <div class="form-group">{{ Form::label('Video Link Url', 'Video Link Url') }}<span class="text text-danger">*</span> <div> <input type="text" name="video_link[]" id="video_link" required="required" class="form-control"> </div></div> </div> <div class="col-md-5"> <div class="form-group">{{ Form::label('Video Image', 'Video Image') }}<span class="text text-danger">*</span> <div> <input type="file" name="videoimg[]" id="videoimg" required="required" class="form-control"></div></div></div><div class="col-md-2"><a href="#" class="remove_field">Remove</a></div></div>'); //add input box
    }
  });
  
  $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
    e.preventDefault(); $(this).parent('div').parent('div').remove(); x--;
  })
});
</script>

@endsection