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
                          {{ Form::open(array('url' => 'admin/update_password')) }}
                          {!! Form::hidden('CreatedBy',Auth::user()->id) !!}
                          {!! Form::hidden('userId',$user->id) !!}

                          <div class="row"> 

                            <div class="col-md-12 card-body">
                            <div class="col-md-12">
                            <label class="col-md-2">User Name</label>
                            <label>{{ $user->name }}</lable>
                            </div>

                            <div class="col-md-12">
                            <label class="col-md-2">Email</label>
                            <label>{{ $user->email }}</lable>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                            {{ Form::label('password', 'Password') }}
                            ( <span class="text text-danger">*</span> )
                            <div>

                            {{ Form::password('password',array('class' => 'form-control','required'=>'required','placeholder'=>'Password')) }}
                            </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                            {{ Form::label('password', 'Confirm Password') }}
                            ( <span class="text text-danger">*</span> )
                            <div>
                            {{ Form::password('password_confirmation', array('class' => 'form-control','required'=>'required','placeholder'=>'Confirm password')) }}
                            </div>
                            </div>
                          </div>
                        </div>

                        <div class="form-group m-b-0">
                          <div>
                          <button type="submit" class="btn btn-primary waves-effect waves-light"> Submit </button>
                          <a href="{{ URL('admin/Users')}}" class="btn btn-secondary waves-effect m-l-5"> Cancel </a>
                          </div>
                        </div>
                        {!! Form::close() !!}
                      </div>
                    </div>
                  </div>
                  <!-- end col -->
                </div>
                  <!-- end row -->

               </div>
               <!--end::Container-->
            </div>
          <!--end::Entry-->
         
<!--end::Main-->

  @endsection