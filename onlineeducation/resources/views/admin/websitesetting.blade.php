@extends('layouts.master')

@section('title', '| Permissions')

@section('content')
<div class="container-fluid">
  <!-- Page-Title -->
  <div class="row">
    <div class="col-sm-12">
      <div class="page-title-box">
        
       <!--  <h4 class="page-title">Available Permissions</h4> -->
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
          <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                  aria-selected="true">General Setting</a>
              </li>
             <!--  <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                  aria-selected="false">App Setting</a>
              </li> -->
 
          </ul>

           
            {!! Form::open(array('url' => 'admin/websettingupd')) !!}
            {{ Form::hidden('id',$webseting->id) }}
<div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        
            <div class="form-group" style="margin-top: 20px;">
              {{ Form::label('website_name', 'Website Name') }}
              <div>
                {{ Form::text('website_name',$webseting->website_name , array('class' => 'form-control','required'=>'required')) }}
                
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
      </div>
      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="form-group" style="margin-top: 20px;">
              {{ Form::label('Near By Distance In KM', 'Near By Distance In KM') }}
              <div>
                {{ Form::text('near_by_distance',$webseting->near_by_distance , array('class' => 'form-control','required'=>'required')) }}
                
              </div>
            </div>

           
      
      <div class="form-group">
              {{ Form::label('Whatapp No', 'Whatapp No') }}
              <div>
                {{ Form::number('whatapps_no',$webseting->whatapps_no , array('class' => 'form-control','required'=>'required')) }}
                
              </div>
            </div>
      
      <div class="form-group">
              {{ Form::label('Support No', 'Support No') }}
              <div>
                {{ Form::number('sapport_no',$webseting->sapport_no , array('class' => 'form-control','required'=>'required')) }}
                
              </div>
            </div>

            <div class="form-group">
              {{ Form::label('Shipping Charge', 'Shipping Charge') }}
              <div>
                {{ Form::number('shpping_charge',$webseting->shpping_charge , array('class' => 'form-control')) }}
                
              </div>
            </div>
        
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