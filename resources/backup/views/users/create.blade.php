@extends('layouts.master')

@section('title', '| Users')

@section('content')
<div class="container-fluid">
  <!-- Page-Title -->
  <div class="row">
    <div class="col-sm-12">
      <div class="page-title-box">
        
        <h4 class="page-title"><i class="fa fa-key"></i>Users Administration
        </h4>
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
           {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }} 
            
            <?php  
                $roleid             = $user->roles()->pluck('id')->implode(' ');
                $name               = $user->name;
                $email              = $user->email;
                $Phone              = $user->Phone;
                $Designation        = $user->Designation;
                $readonly = 'readonly';
                
            ?>
            {!! Form::hidden('id',$user->id) !!}
            
            @else
            {{ Form::open(array('url' => 'admin/users')) }}
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
                $readonly = '';
               
                             
            ?>
            @endif

          
           <div class="row"> 
           <div class="col-md-6">
            <div class="form-group">
             {{ Form::label('name', 'Name') }}
              <div>
                 
             {{ Form::text('name', $name, array('class' => 'form-control','placeholder'=>'Name','required'=>'required')) }}
              </div>
            </div>
            </div>
               <div class="col-md-6">
            <div class="form-group">
             {{ Form::label('email', 'Email') }}
              <div>
              {{ Form::email('email', $email, array('class' => 'form-control','placeholder'=>'Email','required'=>'required',$readonly)) }}
              </div>
            </div>
            </div>
            </div>
            <div class="row">
             <div class="col-md-6">
            <div class="form-group">
             {{ Form::label('Phone', 'Phone') }}
              <div>
                 
             {{ Form::number('Phone', $Phone, array('class' => 'form-control','placeholder'=>'Phone Number','required'=>'required')) }}
              </div>
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
             {{ Form::label('Designation', 'Designation') }}
              <div>
                 
             {{ Form::text('Designation', $Designation, array('class' => 'form-control','required'=>'required','placeholder'=>'Designation')) }}
              </div>
            </div>
            </div>
            </div>

            

            <div class="row">
            <div class='col-md-6 form-group'>
            
                 <select class="form-control" name="roles">
                   
                 <option value="0" selected="" disabled="">Select Role</option> 
                @foreach ($roles as $role)
                   <option value="{{$role->id}}" @if($roleid==$role->id) selected @endif>{{$role->name}}</option> 
                   {{-- <input type="radio" name="roles" value="{{$role->id}}" @if($roleid==$role->id) checked @endif> --}}
                    {{-- {{ Form::label($role->name, ucfirst($role->name)) }}<br> --}}
                 
                @endforeach
                </select>
            </div>
            </div>
            
             @if(Request::segment(4)!='edit')
            <div class="row"> 
           <div class="col-md-6">
            <div class="form-group">
             {{ Form::label('password', 'Password') }}
              <div>
                 
              {{ Form::password('password',array('class' => 'form-control','required'=>'required','placeholder'=>'Password')) }}
              </div>
            </div>
            </div>
           <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('password', 'Confirm Password') }}
                <div>
                {{ Form::password('password_confirmation', array('class' => 'form-control','required'=>'required','placeholder'=>'Confirm password')) }}
                </div>
            </div>
            </div>
            </div>
        @endif
           
            <div class="form-group m-b-0">
              <div>
                <button type="submit" class="btn btn-primary waves-effect waves-light"> Submit </button>
                <button type="reset" class="btn btn-secondary waves-effect m-l-5"> Cancel </button>
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