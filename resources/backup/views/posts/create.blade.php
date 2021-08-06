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
          
           @if(Request::segment(4)==='edit')
            {{ Form::model($post, array('route' => array('posts.update', $post->id), 'method' => 'PUT')) }}
            
            <?php 
                
                $title          = $post->title;
                $body           = $post->body;
                
            ?>
            {!! Form::hidden('id',$post->id) !!}
            
            @else
            {{ Form::open(array('route' => 'posts.store')) }} 
            
            <?php 
                $body              = '';
                $title            = '';
                
            ?>
            @endif
            
            <div class="form-group">
              {{ Form::label('title', 'Title') }}
              <div>
                {{ Form::text('title', $title, array('class' => 'form-control')) }}
                
              </div>
            </div>

            <div class="form-group">
             {{ Form::label('body', 'Post Body') }}
              <div>
               {{ Form::textarea('body', $body, array('class' => 'form-control')) }}
                
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