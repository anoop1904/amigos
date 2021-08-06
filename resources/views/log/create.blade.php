@extends('layouts.master')

@section('title', '| Users')

@section('content')


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
           {{ Form::model($kitchen, array('route' => array('kitchenfood.update', $kitchen->id), 'method' => 'PUT', 'id' => 'userForm','enctype'=>'multipart/form-data')) }} 
            
            <?php  
                $userId             = $kitchen->vendorId;
                $name               = $kitchen->name;
                $price              = $kitchen->price;
                $internal_price     = $kitchen->internal_price;
   
                $image              = $kitchen->image;
                $description = $kitchen->description;
                
            ?>
            {!! Form::hidden('id',$kitchen->id) !!}
            
            @else
            {{ Form::open(array('url' => 'admin/kitchenfood', 'id' => 'KitchenForm','enctype'=>'multipart/form-data')) }}
            <?php 
               
                if(old('roles')){
                  $userId  = old('roles');
                }else{
                  $userId  = '';
                }
                
                $name             = '';
                $price            = '';
                $internal_price   = '';
                $stock            = '';
                $Designation      = '';
                $Language      = '';
                $readonly = '';
                $image ='';
                $description = '';

          
                               
                             
            ?>
            @endif

          
          <div class="row">
          
          </div>
            <div class="row"> 
            
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
                {{ Form::label('price', 'Price') }}
                <span class="text text-danger">*</span>
                <div>
                  {{ Form::number('price', $price, array('class' => 'form-control','placeholder'=>'price','id'=>'price')) }}
                </div>
              </div>
            </div>
   
            <div class="col-md-6">
              <div class="form-group">
                {{ Form::label('internal_price', 'Internal  Price') }}
               
                <span class="text text-danger">*</span>
                <div>
                  @php
                   if(Auth::user()->user_type == 1)
                   {@endphp
                     {{ Form::number('internal_price', $internal_price, array('class' => 'form-control','placeholder'=>'Internal  Price','id'=>'internal_price')) }}
                   @php }
                  
                  else if($name=='')
                  { @endphp

                   {{ Form::number('internal_price', $internal_price, array('class' => 'form-control','placeholder'=>'Internal  Price','id'=>'internal_price')) }}
                  @php }
                 else
                 { @endphp
                   {{ Form::number('internal_price', $internal_price, array('class' => 'form-control','placeholder'=>'Internal  Price','id'=>'internal_price','readonly'=>'readonly')) }}
                @php } @endphp
                  
                </div>
              </div>
            </div>
        
             <div class='col-md-6 form-group'>
                {{ Form::label('Vendor', 'Vendor') }}
                <span class="text text-danger">*</span>
                <select class="form-control form-control-lg" name="vendorUserId" id="vendorUserId">
                 <option value="0" selected="" disabled="">Select Vendor</option> 
                 @if($is_vendor == 1)
                 <option value="{{Auth::user()->id}}"  selected>{{Auth::user()->name}}</option> 
                 @else
                 @foreach ($users as $user)
                   <option value="{{$user->id}}" @if($userId==$user->id) selected @endif>{{$user->name}}</option> 
                 
                    {{-- {{ Form::label($role->name, ucfirst($role->name)) }}<br> --}}
                  @endforeach
                 @endif
                 
                </select>
            </div>

                   <div class="col-md-6">
                  <div class="form-group"> 
                    <label for="Language Code" id="code">Image</label>
                    <div> 
                      <?php
                        $url = 'assets/images/user.png';
                        if($image){
                        $url = 'public/kitchenfood/'.$image;
                        }
                      ?>
                      <img id="blah" src="{{asset($url)}}" style="height: 150px;width: 150px;">
                      <input id="imgInp" type="file" name="file">
                    </div>
                  </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                {{ Form::label('Description', 'Description') }}
                <span class="text text-danger">*</span>
                <div>
                  {{ Form::textarea('description', $description, array('class' => 'form-control','placeholder'=>'Description','id'=>'price','rows'=>5)) }}
                </div>
              </div>
            </div>
            </div>
            
           
            <div class="form-group m-b-0">
              <div>
                <button type="submit" class="btn btn-primary waves-effect waves-light"> Submit </button>
                <a href="{{ URL('admin/users') }}" type="reset" class="btn btn-secondary waves-effect m-l-5"> Cancel </a>
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
<script type="text/javascript" src="{{asset('assets/backend/js/jquery.min.js')}}"></script>

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