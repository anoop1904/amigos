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
           {{ Form::model($product, array('route' => array('product.update', $product->id), 'method' => 'PUT',  'enctype'=>'multipart/form-data', 'id' => 'studentForm')) }} 
            
            <?php            
              $name               = $product->name;
              $image              = $product->profile_pic; 
              $category_id        = $product->category_id;           
              $sub_category_id    = $product->sub_category_id;           
              $sub_sub_category_id= $product->sub_sub_category_id;           
              $brand_id           = $product->brand_id;           
              $unit_id            = $product->unit_id;      
              $brand_id           = $product->brand_id;
              $price              = $product->price;
              $internal_price     = $product->internal_price;
              $meta_data          = $product->meta_data;
              $meta_description   = $product->meta_description;
              $product_tags       = $product->product_tags;
              $discount           = $product->discount;
              $discount_type      = $product->discount_type;
              $description        = $product->description;
              $short_description  = $product->short_description;      
            ?>
            {!! Form::hidden('id',$product->id) !!}
            
            @else
            {{ Form::open(array('url' => 'admin/product', 'enctype'=>'multipart/form-data', 'id' => 'studentForm')) }}
            {!! Form::hidden('CreatedBy',Auth::user()->id) !!}
            <?php 
              $name               = '';
              $sub_category_id    = '';           
              $sub_sub_category_id= '';           
              $brand_id           = ''; 
              $image              = '';  
              $category_id        = '';           
              $unit_id            = '';           
              $brand_id           = '';
              $price ='';
            $internal_price= '';
            $meta_data= '';
            $meta_description= '';
            $product_tags= '';
            $discount= '';
            $discount_type= '';
            $description= '';
            $short_description= '';           
            ?>
            @endif
          

          
          <div class="row">
          
          </div>
            <div class="row"> 
              <div class="col-md-4">
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

              <div class="col-md-4" id="sub_category_section" style="<?php if(!count($sub_categories)){ echo "display:none"; } ?>">
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
              </div>
              <div class="col-md-4" id="sub_sub_category_section" style="<?php if(!count($sub_sub_categories)){ echo "display:none"; } ?>">
                <div class="form-group">
                 {{ Form::label('Category Level 2', 'Category Level 2') }}
                 <span class="text text-danger">*</span>
                  <div>
                     
                 <select class="form-control" name="sub_sub_category" id="sub_sub_category">
                   <option value="" selected="">Category Level 2</option>
                   @foreach($sub_sub_categories as $key=>$category)
                    <option value="{{$category->id}}" <?php if($category->id == $category_id){ echo "selected"; }  ?>>{{$category->name}}</option> 
                   @endforeach
                 </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row"> 
              <div class="col-md-4">
                <div class="form-group">
                 {{ Form::label('Unit', 'Unit') }}
                 <span class="text text-danger">*</span>
                  <div>  
                 <select class="form-control" name="unit_id">
                   <option value="" disabled="" selected="">Select Unit</option>
                   @foreach($units as $key=>$unit)
                    <option value="{{$unit->id}}" <?php if($unit->id == $unit_id){ echo "selected"; }  ?>>{{$unit->name}}</option> 
                   @endforeach
                 </select>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                 {{ Form::label('Brand', 'Brand') }}
                 <span class="text text-danger">*</span>
                  <div>  
                 <select class="form-control" name="brand_id">
                   <option value="" disabled="" selected="">Select Brand</option>
                   @foreach($brands as $key=>$brand)
                    <option value="{{$brand->id}}" <?php if($brand->id == $brand_id){ echo "selected"; }  ?>>{{$brand->name}}</option> 
                   @endforeach
                 </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">

            <div class="col-md-4">
              <div class="form-group">
               {{ Form::label('name', 'Name') }}
               <span class="text text-danger">*</span>
                <div>
                   
               {{ Form::text('name', $name, array('class' => 'form-control','placeholder'=>'Name','id'=>'name')) }}
                </div>
              </div>
            </div>



             <div class="col-md-4">
              <div class="form-group">
              {{ Form::label('Price', 'Price') }}
              <div>

              {{ Form::text('price', $price, array('class' => 'form-control','placeholder'=>'Price','required'=>'required')) }}
              </div>
              </div>
            </div>
            
            <div class="col-md-4">
              <div class="form-group">
                {{ Form::label('Internal Price', 'Internal Price') }}
                <span class="text text-danger">*</span>
                <div>
                  {{ Form::text('internal_price', $internal_price, array('class' => 'form-control',  'placeholder'=>'Internaml Price', 'id'=>'internal_price')) }}
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
                {{ Form::label('Meta Description', 'Meta Description') }}
                <span class="text text-danger">*</span>
                <div>
                  {{ Form::text('meta_description', $meta_description, array('class' => 'form-control',  'placeholder'=>'Meta Description', 'id'=>'meta_description')) }}
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                {{ Form::label('Product Tags', 'Product Tags') }}
                <span class="text text-danger">*</span>
                <div>
                  {{ Form::text('product_tags', $product_tags, array('class' => 'form-control',  'placeholder'=>'Product Tags', 'id'=>'product_tags')) }}
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                {{ Form::label('Discount Type', 'Discount Type') }}
                <span class="text text-danger">*</span>
                <div>
                  <select class="form-control" name="discount_type" id="discount_type">
                    <option value="1">Flat</option>
                    <option value="2">Percentage</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                {{ Form::label('Discount', 'Discount') }}
                <span class="text text-danger">*</span>
                <div>
                  {{ Form::number('discount', $discount, array('class' => 'form-control',  'placeholder'=>'Discount', 'id'=>'discount')) }}
                </div>
              </div>
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
                  {{ Form::textarea('description', $description, array('class' => 'form-control',  'placeholder'=>'Description', 'id'=>'description','rows'=>'5')) }}
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
                        $url = 'public/assets/img/product/'.$image;
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
                <a href="{{ URL('admin/customer') }}" type="reset" class="btn btn-secondary waves-effect m-l-5"> Cancel </a>
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
  $('#sub_sub_category,#sub_sub_category_section').hide();
  $('#sub_category,#sub_category_section').hide();
}
// $('#sub_sub_category,#sub_sub_category_section').hide();
// $('#sub_category,#sub_category_section').hide();
$(document).on('change','.category',function(){
    var cid = $(this).val();
    var attrId = $(this).attr('target-data');
    if(attrId == 'sub_category'){
      reset();
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