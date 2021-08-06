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
           {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT', 'id' => 'userForm')) }} 
            
            <?php  
                $roleid             = $user->user_type;
                $name               = $user->name;
                $email              = $user->email;
                $Phone              = $user->Phone;
                $Designation        = $user->Designation;
                $Language           = $user->language_known;
                $readonly           = 'readonly';
                $zipcode            = $user->zipcode;
                $latitude           = $user->latitude;
                $longitude          = $user->longitude;
                $address            = $user->address;
                
            ?>
            {!! Form::hidden('id',$user->id) !!}
            
            @else
            {{ Form::open(array('url' => 'admin/users', 'id' => 'userForm')) }}
            {!! Form::hidden('CreatedBy',Auth::user()->id) !!}
            <?php 
               
                //$roleid           = '';
                if(old('roles')){
                  $roleid  = old('roles');
                }else{
                  $roleid  = '';
                }
                
                $name             = '';
                $email            = '';
                $Phone            = '';
                $Designation      = '';
                $zipcode = '';
                $latitude = '';
                $longitude = '';
                $address = '';
                $readonly = '';
               
                             
            ?>
            @endif

          
          <div class="row">
          
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
                 
              {{ Form::number('Phone', $Phone, array('class' => 'form-control only-numeric','placeholder'=>'Contact Number','maxlength' => 10)) }}
              </div>
              </div>
            </div>
            
            <div class='col-md-4 form-group'>
                {{ Form::label('Role', 'Role') }}
                <span class="text text-danger">*</span>
                <select class="form-control" name="roles" id="roles">
                <!--  <option value="0" selected="" disabled="">Select Role</option>  -->
                 {{-- <option value="20" selected="selected" @if($roleid==20) selected @endif>Store Manager</option>  --}}

                  @foreach ($roles as $role)
                   <option value="{{$role->id}}" @if($roleid==$role->id) selected @endif>{{$role->name}}</option> 
                   {{-- <input type="radio" name="roles" value="{{$role->id}}" @if($roleid==$role->id) checked @endif> --}}
                    {{-- {{ Form::label($role->name, ucfirst($role->name)) }}<br> --}}
                  @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                @if(Request::segment(4) ==='edit')
                {{ Form::label('password', 'Change Password') }}
                <div>
                {{ Form::password('password',array('class' => 'form-control','placeholder'=>'Password')) }}
                           
                @else
                {{ Form::label('password', 'Password') }}
                 <span class="text text-danger">*</span> 
                <div>
                {{ Form::password('password',array('class' => 'form-control','required'=>'required','placeholder'=>'Password')) }}
                @endif

                
                </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                {{ Form::label('password_confirmation', 'Confirm Password') }}
                @if(Request::segment(4) ==='edit')
                <div>
                {{ Form::password('password_confirmation', array('class' => 'form-control','placeholder'=>'Confirm password')) }}
               
                @else
                <span class="text text-danger">*</span> 
                <div>
                {{ Form::password('password_confirmation', array('class' => 'form-control','required'=>'required','placeholder'=>'Confirm password')) }}
               
                @endif
                
                
                </div>
                </div>
            </div>
            
            <div class='col-md-12 form-group'>
                {{ Form::label('Address', 'Address') }}
                <span class="text text-danger">*</span>
                <div>

                {{ Form::textarea('address', $address, array('class' => 'form-control','rows' => '3','placeholder'=>'Address')) }}
                </div>
            </div>

            
            
            <div class="col-md-4">
              <div class="form-group">
              {{ Form::label('Zip Code', 'Zip Code') }}
              <div>

              {{ Form::number('zipcode', $zipcode, array('class' => 'form-control','placeholder'=>'zip code')) }}
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
@endsection