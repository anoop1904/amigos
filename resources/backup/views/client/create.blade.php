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
          {{ Form::model($client, array('route' => array('client.update', $client->id), 'method' => 'PUT','enctype'=>'multipart/form-data')) }}
          <?php  
               $fname = $client->fname;
               $lname = $client->fname;
               $mobile = $client->mobile;
               $email = $client->email;
               $address = $client->address;
               $logo = $client->logo;
               $company = $client->company_name;
               
            ?>
          @else
          {{ Form::open(array('url' => 'admin/client','enctype'=>'multipart/form-data')) }}
          
          <?php 
               $fname = '';
               $lname = '';
               $mobile = '';
               $email = '';
               $address = '';
               $logo = '';
               $company = '';
               
            ?>
          @endif
          <div class="row">
            
            <div class="col-md-12">
             <div class="row">
              <div class="col-md-6">
                <div class="form-group"> 
                   {{ Form::label('First Name', 'First Name') }}
                  <div> {{ Form::text('fname', $fname, array('class' => 'form-control','placeholder'=>'First Name','required'=>'required')) }} </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group"> 
                   {{ Form::label('Last Name', 'Last Name') }}
                  <div> {{ Form::text('lname', $lname, array('class' => 'form-control','placeholder'=>'Last Name','required'=>'required')) }} </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group"> 
                  {{ Form::label('Email', 'Email') }}
                  <div> {{ Form::text('email', $email, array('class' => 'form-control','placeholder'=>'Email','required'=>'required')) }} </div>

                </div>
              </div>

             
               <div class="col-md-6">
                <div class="form-group"> 
                  {{ Form::label('Mobile', 'Mobile') }}
                  <div> {{ Form::text('mobile', $mobile, array('class' => 'form-control','placeholder'=>'Enter Mobile','required'=>'required')) }} </div>

                </div>
              </div>

               <div class="col-md-6">
                <div class="form-group"> 
                  {{ Form::label('Company Name', 'Company Name') }}
                  <div> {{ Form::text('company', $company, array('class' => 'form-control','placeholder'=>'Enter Company name','required'=>'required')) }} </div>

                </div>
              </div>

               <div class="col-md-6">
                <div class="form-group"> 
                  {{ Form::label('Logo', 'Logo') }}
                  <div class="col-md-4"> 
                      <img style="height: 40px;width: 100px;"  src="{{ URL('/assets/client').'/'.$logo }}" >
                    <input type="hidden" name="oldLogoUrl" value="{{ $logo }}" > 
                  </div>
                  <div class="col-md-8"> {{ Form::file('file') }} </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group"> 
                  {{ Form::label('Address', 'Address') }}
                  <div> {{ Form::textarea('address', $address, array('class' => 'form-control','placeholder'=>'Address','required'=>'required')) }} </div>

                </div>
              </div>
              
              {{--<div class="col-md-6">
                <div class="form-group"> 
                  {{ Form::label('Address1', 'Address1') }}
                  <div> {{ Form::text('name', $fname, array('class' => 'form-control','placeholder'=>'Keyword Name','required'=>'required')) }} </div>

                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group"> 
                  {{ Form::label('Address1', 'Address1') }}
                  <div> {{ Form::text('name', $fname, array('class' => 'form-control','placeholder'=>'Keyword Name','required'=>'required')) }} </div>

                </div>
              </div>
 --}}

          
             <div class="col-md-4">
                <div class="form-group"> <button type="submit" class="btn btn-primary waves-effect waves-light"> Submit </button>
              <button type="reset" class="btn btn-secondary waves-effect m-l-5"> Cancel </button>   </div>
                </div>
              </div>

              </div>
              

             

              
             

             

              
            </div>
          </div>
          </div>
          </form>
          </div>
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