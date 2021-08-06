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
          
          
        {{ Form::open(array('url' => 'admin/update_password')) }}
        {!! Form::hidden('CreatedBy',Auth::user()->id) !!}
        {!! Form::hidden('userId',$user->id) !!}
<!--            <div class="row"> 
           <div class="col-md-6">
            <div class="form-group">
             {{ Form::label('old_password', 'Old Password') }}
             ( <span class="text text-danger">*</span> )
              <div>
                 
              {{ Form::password('old_password',array('class' => 'form-control','required'=>'required','placeholder'=>'Old Password')) }}
              </div>
            </div>
            </div>
           
            </div>-->
            
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
                <button type="reset" class="btn btn-secondary waves-effect m-l-5"> Cancel </button>
              </div>
            </div>
         {!! Form::close() !!}
        </div>
      </div>
    </div>
    <!-- end col -->
    <div class="col-lg-12">
      <div class="card m-b-30">
        <div class="card-body">
          <h4 class="mt-0 header-title">User List</h4>
          
          <table class="table table-dark">
            <thead>
              <tr>
                <th width="5%">#</th>
                <th width="15%">Name</th>
                <th width="20%">Email</th>
                <th width="20%">Date/Time Added</th>
                <th width="20%">User Roles</th>
                <th width="20%">Operations</th>
                </tr>
            </thead>
            <tbody>
           @php $count = 1; @endphp
            @foreach ($users as $user)
            <tr>
                <td>{{ $count }}</td>
               <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('F d, Y') }}</td>
                    <td>{{  $user->roles()->pluck('name')->implode(' ') }}</td>
                    <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id] ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                    </td>
            </tr>
            @php $count++; @endphp
            @endforeach
             
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- end col -->
  </div>
  <!-- end row -->
</div>
<!-- end container -->
@endsection