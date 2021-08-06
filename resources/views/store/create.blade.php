@extends('layouts.master')

@section('title', '| Users')

@section('content')

<style>
.document_verification{
  margin-right: 10px;
}
</style>
<!--begin::Main-->

      
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
           {{ Form::model($store, array('route' => array('store.update', $store->id), 'method' => 'PUT', 'id' => 'storeForm',  'enctype'=>'multipart/form-data')) }} 
            
            <?php 
                $roleid             = $store->user_type;
                $name               = $store->name;
                $email              = $store->email;
                $Phone              = $store->Phone;
                $readonly           = 'readonly';
                $zipcode            = $store->zipcode;
                $latitude           = $store->latitude;
                $longitude          = $store->longitude;
                $address            = $store->address;
                $image              = $store->image;
			        	$store_logo         = $store->storelogo;
                $city               = $store->city;
                $ratting            = $store->ratting;
                $pan_card           = $store->pan_card;
                $store_registration = $store->store_registration;
                $aadhar_front       = $store->aadhar_front;
                $aadhar_back        = $store->aadhar_back;
                $pan_number         = $store->pan_number;
                $registration_number= $store->registration_number; 
                $aadhar_number      = $store->aadhar_number;
               
            ?>
            {!! Form::hidden('id',$store->id) !!}
            
            @else
            {{ Form::open(array('url' => 'admin/store', 'enctype'=>'multipart/form-data','id' => 'userForm')) }}
            <?php 
               
                $name                 = '';
                $email                = '';
                $Phone                = '';
                $zipcode              = '';
                $latitude             = '';
                $longitude            = '';
                $address              = '';
                $readonly             = '';
                $image                = '';
                $city                 = '';
                $ratting              = '';
                $store_logo           = '';
                $pan_card             = '';
                $store_registration   = '';
                $aadhar_front         = '';
                $aadhar_back          = '';
                $pan_number           = '';
                $registration_number  = '';
                $aadhar_number        = '';
               
                             
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
                   
               <select class="form-control select2" name="category[]" multiple="" required="">
                    <option value="all" >Select Category</option>
                    @foreach($categoryList as $key => $category)
				     <option  value="{{$category->id}}" @if(in_array($category->id,$category_ids)) selected @endif>{{$category->name}}</option>
				    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
               {{ Form::label('Store Name', 'Store Name') }}
               <span class="text text-danger">*</span>
                <div>
                   
               {{ Form::text('name', $name, array('class' => 'form-control','placeholder'=>'Name','id'=>'name')) }}
                </div>
              </div>
            </div>

            
            <div class="col-md-4">
              <div class="form-group">
                {{ Form::label('email', 'Email') }}
                <span class="text text-danger">*</span>
                <div>
                  {{ Form::email('email', $email, array('class' => 'form-control','placeholder'=>'Email','id'=>'email',$readonly)) }}
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
              {{ Form::label('Contact Number', 'Contact Number') }}
              <span class="text text-danger">*</span>
              <div>
                 
              {{ Form::number('mobile_number', $Phone, array('class' => 'form-control only-numeric','placeholder'=>'Contact Number')) }}
              </div>
              </div>
            </div>

            <div class='col-md-4 form-group'>
                {{ Form::label('Address', 'Address') }}
                <span class="text text-danger">*</span>
                <div>
                  {{ Form::text('address', $address, array('class' => 'form-control','placeholder'=>'Address','id'=>'autocomplete')) }}
                </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
              {{ Form::label('City', 'City') }}
              <div>

              {{ Form::text('city', $city, array('class' => 'form-control','placeholder'=>'City','id'=>'city','readonly'=>'readonly')) }}
              </div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
              {{ Form::label('Latitude', 'Latitude') }}
              <div>

              {{ Form::text('latitude', $latitude, array('class' => 'form-control','placeholder'=>'Latitude','id'=>'latitude','readonly'=>'readonly')) }}
              </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
              {{ Form::label('Longitude', 'Longitude') }}
              <div>

              {{ Form::text('longitude', $longitude, array('class' => 'form-control','placeholder'=>'Longitude','id'=>'longitude','readonly'=>'readonly')) }}
              </div>
              </div>
            </div>
           <div class="col-md-4">
              <div class="form-group">
              {{ Form::label('Zipcode', 'Zipcode') }}
              <div>

              {{ Form::text('zipcode', $zipcode, array('class' => 'form-control','placeholder'=>'Zipcode')) }}
              </div>
              </div>
            </div>
              <div class="col-md-4">
              <div class="form-group">
              {{ Form::label('Ratting', 'Ratting') }}
              <div>

              {{ Form::number('ratting', $ratting, array('class' => 'form-control','placeholder'=>'Ratting','max'=>'5')) }}
              </div>
              </div>
            </div>

            
              <div class="col-md-4">
              <div class="form-group">
              {{ Form::label('Password', 'Password') }}
              <div>
                <input  type="password" autocomplete="off" class="form-control form-control" name="password" @if(Request::segment(4)!='edit') required @endif placeholder="Password">
           
              </div>
              </div>
            </div>
            </div>
            <div class="row"> 

            <div class="col-md-2 document_verification">
                  <div class="form-group"> 
                    <label for="Language Code" id="code">Store Registration 
                      <br> 
                      <?php if($registration_number!=''){ echo '('.$registration_number.')';} ?>
                    
                  </label>
                    <div> 
                      <?php
                        $url = 'assets/images/user.png';
                        if($store_registration){
                        $url = 'public/assets/img/store/'.$store_registration;
                        }
                      ?>
                      <img id="blah2" src="{{asset($url)}}" style="height: 150px;width: 150px;">
                      <input id="store_registration" type="file" name="file" style="margin-top: 10px;">
                    </div>
                  </div>
            </div>

            <div class="col-md-2 document_verification">
                  <div class="form-group"> 
                    <label for="Language Code" id="code">Pan Card <br> <?php if($pan_number!=''){ echo '('.$pan_number.')';} ?></label>
                    <div> 
                      <?php
                        $url = 'assets/images/user.png';
                        if($pan_card){
                        $url = 'public/assets/img/store/'.$pan_card;
                        }
                      ?>
                      <img id="blah" src="{{asset($url)}}" style="height: 150px;width: 150px;">
                      <input id="imgInp" type="file" name="pan_card" style="margin-top: 10px;">
                    </div>
                  </div>
            </div>

            <div class="col-md-2 document_verification">
                  <div class="form-group"> 
                    <label for="Language Code" id="code">Aadhar Card Front <br> <?php if($aadhar_number!=''){ echo '('.$aadhar_number.')';} ?></label>
                    <div> 
                      <?php
                        $url = 'assets/images/user.png';
                        if($aadhar_front){
                        $url = 'public/assets/img/store/'.$aadhar_front;
                        }
                      ?>
                      <img id="blah3" src="{{asset($url)}}" style="height: 150px;width: 150px;">
                      <input id="aadhar_front" type="file" name="aadhar_card_front" style="margin-top: 10px;">
                    </div>
                  </div>
            </div>

            <div class="col-md-2 document_verification">
                  <div class="form-group"> 
                    <label for="Language Code" id="code">Aadhar Card Back</label>
                    <div> 
                      <?php
                        $url = 'assets/images/user.png';
                        if($aadhar_back){
                        $url = 'public/assets/img/store/'.$aadhar_back;
                        }
                      ?>
                      <img id="blah4" src="{{asset($url)}}" style="height: 150px;width: 150px;">
                      <input id="aadhar_back" type="file" name="aadhar_card_back" style="margin-top: 10px;">
                    </div>
                  </div>
            </div>


               <div class="col-md-2 document_verification">
                  <div class="form-group"> 
                    <label for="Language Code" id="code">Store Logo</label>
                    <div> 
                      <?php
                        $url1 = 'assets/images/user.png';
                        if($store_logo){
                        $url1 = 'public/assets/img/store/'.$store_logo;
                        }
                      ?>
                      <img id="blah1" src="{{asset($url1)}}" style="height: 150px;width: 150px;">
                      <input id="storeLogo" type="file" name="storelogo" style="margin-top: 10px;">
                    </div>
                  </div>
            </div>  	 		
            

             
            </div>
            
           
            <div class="form-group m-b-0">
              <div>
                <button type="submit" class="btn btn-primary waves-effect waves-light"> Submit </button>
                <a href="{{ URL('admin/store') }}" type="reset" class="btn btn-secondary waves-effect m-l-5"> Cancel </a>
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<link rel="stylesheet" type="text/css" href="{{ asset('public/css/jquery.datetimepicker.css') }}">
<script src="{{ asset('public/js/jquery.datetimepicker.js') }}"></script>
<script src="{{ asset('public/js/jquery.datetimepicker.full.min.js') }}"></script>

{{-- javascript code --}}
   <script src="https://maps.google.com/maps/api/js?key=AIzaSyAgAlL4lJvPU9v3nOa_GnUmfsPSkX11Yrg&libraries=places&callback=initAutocomplete" type="text/javascript"></script>

   <script>
    $( function() {
    $('.select2').select2({ width: '100%' });  
  });
      $('#autocomplete').on('keypress', function(e) {
        return e.which !== 13;
      });
       $(document).ready(function() {
            $("#lat_area").addClass("d-none");
            $("#long_area").addClass("d-none");
       });
   </script>


   <script>
       google.maps.event.addDomListener(window, 'load', initialize);

       function initialize() {
            var options = {
             componentRestrictions: {country: "IN"}
           };
           var input = document.getElementById('autocomplete');
           var autocomplete = new google.maps.places.Autocomplete(input,options);
           autocomplete.addListener('place_changed', function() {
               var place = autocomplete.getPlace();
               console.log('place',place);
               console.log('place',);
               $('#city').val(place.vicinity);
               $('#latitude').val(place.geometry['location'].lat());
               $('#longitude').val(place.geometry['location'].lng());

            // --------- show lat and long ---------------
               $("#lat_area").removeClass("d-none");
               $("#long_area").removeClass("d-none");
           });
       }
    </script>

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



function readURL1(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#blah1').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#storeLogo").change(function() {
  readURL1(this);
});


function readURL2(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#blah2').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#store_registration").change(function() {
  readURL2(this);
});


function readURL3(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#blah3').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#aadhar_front").change(function() {
  readURL3(this);
});


function readURL4(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#blah4').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#aadhar_back").change(function() {
  readURL4(this);
});




</script>
@endsection