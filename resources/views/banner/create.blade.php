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
           {{ Form::model($banner, array('route' => array('banner.update', $banner->id), 'method' => 'PUT', 'id' => 'storeForm',  'enctype'=>'multipart/form-data')) }} 
            
            <?php  
                $title             = $banner->title;
                $caption           = $banner->caption;
                $secondCaption     = $banner->secondCaption;
                $thirdCaption      = $banner->thirdCaption;
                $image             = $banner->image;
            ?>
            {!! Form::hidden('id',$banner->id) !!}
            
            @else
            {{ Form::open(array('url' => 'admin/banner', 'enctype'=>'multipart/form-data','id' => 'userForm')) }}
            <?php 
               
                $title             = '';
                $caption           = '';
                $secondCaption     = '';
                $thirdCaption      = '';
                $image             = '';              
            ?>
            @endif

          
          <div class="row">
          
          </div>
            <div class="row"> 
            
            <div class="col-md-4">
              <div class="form-group">
               {{ Form::label('Title', 'Title') }}
               <span class="text text-danger">*</span>
                <div>
                   
               {{ Form::text('title', $title, array('class' => 'form-control','placeholder'=>'Title','id'=>'name')) }}
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
               {{ Form::label('Caption', 'Caption') }}
               <span class="text text-danger">*</span>
                <div>
                   
               {{ Form::text('caption', $caption, array('class' => 'form-control','placeholder'=>'Caption','id'=>'name')) }}
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
               {{ Form::label('Second Caption', 'Second Caption') }}
               <span class="text text-danger">*</span>
                <div>
                   
               {{ Form::text('secondCaption', $secondCaption, array('class' => 'form-control','placeholder'=>'Second Caption','id'=>'name')) }}
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
               {{ Form::label('Third Caption', 'Third Caption') }}
               <span class="text text-danger">*</span>
                <div>
                   
               {{ Form::text('thirdCaption', $thirdCaption, array('class' => 'form-control','placeholder'=>'Third Caption','id'=>'name')) }}
                </div>
              </div>
            </div>

            
            <div class="col-md-6">
                  <div class="form-group"> 
                    <label for="Language Code" id="code">Banner Image</label>
                    <div> 
                      <?php
                        $url = 'assets/images/user.png';
                        if($image){
                        $url = 'public/assets/img/banner/'.$image;
                        }
                      ?>
                      <img id="blah" src="{{asset($url)}}" style="height: 150px;width: 150px;">
                      <input id="imgInp" type="file" name="file">
                    </div>
                  </div>
            </div>  
            
             
            </div>
            
           
            <div class="form-group m-b-0">
              <div>
                <button type="submit" class="btn btn-primary waves-effect waves-light"> Submit </button>
                <a href="{{ URL('admin/banner') }}" type="reset" class="btn btn-secondary waves-effect m-l-5"> Cancel </a>
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