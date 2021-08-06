@extends('layouts.master')


@section('content')
<div class="container-fluid">
  <!-- Page-Title -->
  <div class="row">
    <div class="col-sm-12">
      <div class="page-title-box">
        
        <h4 class="page-title"><i class="fa fa-key"></i>Available Organization
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
           {{ Form::model($organization, array('route' => array('organization.update', $organization->id), 'method' => 'PUT','enctype'=>'multipart/form-data')) }} 
            
            <?php 
                $OrgName           = $organization->OrgName;
                $Address1          = $organization->Address1;
                $Address2          = $organization->Address2;
                $City              = $organization->City;
                $State             = $organization->State;
                $AdminEmailID      = $organization->AdminEmailID;
                $image             = $organization->image;
            ?>
            {{ Form::hidden('oldimage',$image) }}
           @else
            {{ Form::open(array('url' => 'admin/organization','enctype'=>'multipart/form-data')) }}
           <?php 
                $OrgName           = '';
                $Address1          = '';
                $Address2          = '';
                $City              = '';
                $State             = '';
                $AdminEmailID      = '';
                $image             = '';
            ?>
            @endif



            
           
            
             
            <div class="form-group">
             {{ Form::label('OrgName', 'Organization Name') }}
              <div>
                 
             {{ Form::text('OrgName', $OrgName, array('class' => 'form-control','required'=>'required')) }}
              </div>
            </div>
            <div class="form-group">
             {{ Form::label('image', 'Image') }}
              <div>
                
             {{ Form::file('image', array('class' => 'form-control')) }}

              </div>
            </div>

            <div class="form-group">
             
              <div>
                @if(!empty($image))  
             <img src="{{URL('/')}}/assets/images/organization/{{$image}}" style="width:100px; height="100px;">
             @endif
              </div>
            </div>

            <div class="form-group">
             {{ Form::label('Address1', 'Address1') }}
              <div>
                 
              {{ Form::text('Address1', $Address1, array('class' => 'form-control','required'=>'required')) }}
              </div>
            </div>

            
            <div class="form-group">
             {{ Form::label('Address2', 'Address2') }}
              <div>
                 
              {{ Form::text('Address2', $Address2,array('class' => 'form-control','required'=>'required')) }}
              </div>
            </div>

            <div class="form-group">
                {{ Form::label('City', 'City') }}
                <div>
                {{ Form::text('City',$City, array('class' => 'form-control','required'=>'required')) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('State', 'State') }}
                <div>
                {{ Form::text('State',$State, array('class' => 'form-control','required'=>'required')) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('AdminEmailID', 'AdminEmailID') }}
                <div>
                {{ Form::text('AdminEmailID',$AdminEmailID, array('class' => 'form-control','required'=>'required')) }}
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