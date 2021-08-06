@extends('layouts.master')


@section('content')
<div class="container-fluid">
  <!-- Page-Title -->
  <div class="row">
    <div class="col-sm-12">
      <div class="page-title-box">
        <h4 class="page-title"> </h4>
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
        <div class="card-body"> @if(Request::segment(4)==='edit')
          {{ Form::model($sizes, array('route' => array('size.update', $sizes->id), 'method' => 'PUT')) }}
          <?php  
               $size = $sizes->size;
               
            ?>
          @else
          {{ Form::open(array('url' => 'admin/size')) }}
          
          <?php 
               $size = '';
               
            ?>
          @endif

         
          <div class="row">
            
            <div class="col-md-12">
             <div class="row">
              <div class="col-md-12">
                <div class="form-group"> 
                   {{ Form::label('Screen Size', 'Screen Size') }}
                  <div> {{ Form::number('size', $size, array('class' => 'form-control','placeholder'=>'Screen Size','required'=>'required')) }} </div>
                </div>
              </div>
             <div class="col-md-4">
                <div class="form-group"> <button type="submit" class="btn btn-primary waves-effect waves-light"> Submit </button>
              <button type="reset" class="btn btn-secondary waves-effect m-l-5"> Cancel </button>   </div>
                </div>
              </div>

              </div>
              

             

              
             

             

              
            </div>

          </div>
          
          </div>
          {!! Form::close() !!} </div>
      </div>
    </div>
    <!-- end col -->
   
  </div>
  <!-- end row -->
</div>
<!-- end container -->
@endsection
@section('extrajs')

@endsection