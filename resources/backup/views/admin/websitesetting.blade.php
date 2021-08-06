@extends('layouts.master')

@section('title', '| Permissions')

@section('content')
<div class="container-fluid">
  <!-- Page-Title -->
  <div class="row">
    <div class="col-sm-12">
      <div class="page-title-box">
        
        <h4 class="page-title"><i class="fa fa-key"></i>Available Permissions</h4>
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
          
           
            {!! Form::open(array('url' => 'admin/websettingupd')) !!}
            {{ Form::hidden('id',$webseting->id) }}
            
            
            <div class="form-group">
              {{ Form::label('website_name', 'Website Name') }}
              <div>
                {{ Form::text('website_name',$webseting->website_name , array('class' => 'form-control','required'=>'required')) }}
                
              </div>
            </div>

            <div class="form-group">
              {{ Form::label('locktimeout', 'Lock Time') }}
              <div>
                {{ Form::text('locktimeout',$webseting->locktimeout , array('class' => 'form-control','required'=>'required')) }}
                
              </div>
            </div>

            <div class="form-group">
              {{ Form::label('email', 'Email') }}
              <div>
                {{ Form::email('email',$webseting->email , array('class' => 'form-control','required'=>'required')) }}
                
              </div>
            </div>

            <div class="form-group">
              {{ Form::label('address', 'Address') }}
              <div>
                {{ Form::text('address',$webseting->address , array('class' => 'form-control','required'=>'required')) }}
                
              </div>
            </div>

            <div class="form-group">
              {{ Form::label('mobile', 'Mobile') }}
              <div>
                {{ Form::number('mobile',$webseting->mobile , array('class' => 'form-control','required'=>'required')) }}
                
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