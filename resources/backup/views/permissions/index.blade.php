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
            {{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT')) }}
            
            <?php 
                
                $name          = $permission->name;
                
            ?>
            {!! Form::hidden('id',$permission->id) !!}
            
            @else
            {!! Form::open(array('url' => 'admin/permissions')) !!}
            
            <?php 
                $id              = '';
                $name            = '';
                
            ?>
            @endif
            
            <div class="form-group">
              {{ Form::label('name', 'Permission Name') }}
              <div>
                {{ Form::text('name', $name, array('class' => 'form-control','required'=>'required')) }}
                
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
          <h4 class="mt-0 header-title">Permission List</h4>
          
          <table class="table table-dark">
            <thead>
              <tr>
                <th>#</th>
                <th>Permissions</th>
               <!-- <th>Operation</th>-->
              </tr>
            </thead>
            <tbody>
           @php $count = 1; @endphp
           @foreach ($permissions as $permission)
           @if($permission->parent_id == '0')
            <tr>
                <td>{{ $count }}</td>
                <td>{{ $permission->name }}</td> 
               <!-- <td>
                <a href="{{ URL::to('admin/permissions/'.$permission->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id] ]) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}

                </td>-->
            </tr>
            @endif
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