@extends('layouts.master')

@section('title', '| Permissions')

@section('content')
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
           

            <div class="form-group row">
                <div class="col-sm-4">
                  {{ Form::label('name', 'Parent Module') }}
                  <div>
                   <select id="parent_id" name="parent_id" class="form-control">
                     <option>No Parent Module</option>
                     @if(!empty($parentpermissions))
                      @foreach ($parentpermissions as $permission)
                      <option value="{{$permission->id}}">{{$permission->name}}</option>
                      @endforeach

                     @endif
                   </select>
                  </div>  
                </div>
                <div class="col-sm-4">
                  {{ Form::label('name', 'Module Name') }}
                  <div>
                    {{ Form::text('name', $name, array('class' => 'form-control','required'=>'required')) }}
                    
                  </div>  
                </div>
                <div class="col-sm-4">
                  {{ Form::label('Url', 'Url') }}
                  <div>
                    {{ Form::text('url', '', array('class' => 'form-control','required'=>'required')) }}
                    
                  </div>  
                </div>
                <div class="col-sm-6">
                  {{ Form::label('Operation', 'Operation') }}
                  <div class="row">
                    <div class="col-sm-2">
                      <input type="checkbox" name="operation[]" value="add">
                      <label>Add</label>
                    </div>

                    <div class="col-sm-2">
                      <input type="checkbox" name="operation[]" value="edit">
                      <label>Edit</label>
                    </div>

                    <div class="col-sm-2">
                      <input type="checkbox" name="operation[]" value="delete">
                      <label>Delete</label>
                    </div>

                    <div class="col-sm-2">
                      <input type="checkbox" name="operation[]" value="view">
                      <label>View</label>
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