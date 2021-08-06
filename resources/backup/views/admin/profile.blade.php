@extends('layouts.master')

@section('title', '| Permissions')

@section('content')
<div class="container-fluid">
  <!-- Page-Title -->
  <div class="row">
    <div class="col-sm-12">
      <div class="page-title-box">
        <div class="btn-group pull-right">
          <ol class="breadcrumb hide-phone p-0 m-0">
            
          <li class="breadcrumb-item">
            <a href="">Dashboard</a>
          </li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
       
        <h4 class="page-title"><i class="fa fa-key"></i>User Profile</h4>
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
          
           
            {!! Form::open(array('url' => 'admin/profileupdate')) !!}
            {{ Form::hidden('id',$userdata->id) }}
            
            
            <div class="form-group">
              {{ Form::label('email', 'Email') }}
              <div>
                {{ Form::text('email',$userdata->email , array('class' => 'form-control','required'=>'required','readonly')) }}
                
              </div>
            </div>

            <div class="form-group">
              {{ Form::label('password', 'Old Password') }}
              <div>
                {{ Form::password('oldpassword', array('class' => 'form-control','required'=>'required','placeholder'=>'Old password')) }}
                
              </div>
            </div>

             <div class="form-group">
              {{ Form::label('password', 'New Password') }}
              <div>
                {{ Form::password('password', array('class' => 'form-control','required'=>'required','placeholder'=>'New password')) }}
                
              </div>
            </div>

             <div class="form-group">
              {{ Form::label('password', 'Confirm Password') }}
              <div>
                {{ Form::password('password_confirmation', array('class' => 'form-control','required'=>'required','placeholder'=>'Confirm password')) }}
                
              </div>
            </div>
           
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