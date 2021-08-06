@extends('layouts.master')

@section('title', '| Roles')

@section('content')
<div class="container-fluid">
  <!-- Page-Title -->
  <div class="row">
    <div class="col-sm-12">
      <div class="page-title-box">
        
        <h4 class="page-title"><i class="fa fa-key"></i>Available Roles</h4>
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
    <div class="col-lg-4">
      <div class="card m-b-30">
        <div class="card-body">
          
           @if(Request::segment(4)==='edit')
            {{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT')) }}
            
            <?php 
                
                $name             = $role->name;
                $permission_id    = $role->permissions
                
            ?>
            
            @else
            {!! Form::open(array('url' => 'admin/roles')) !!}
            
            <?php 
                $permission_id      = '';
                $name               = '';
                
            ?>
            @endif

           

            <div class="form-group">
              {{ Form::label('name', 'Role Name') }}
              <div>
                {{ Form::text('name', null, array('class' => 'form-control','placeholder'=>'Name','required'=>'required')) }}
                
              </div>
            </div>
             <div class="form-group">
              <div>
                <input type="checkbox" name="selectAll" id="selectAll">
                {{ Form::label('name', 'Select All') }}
              </div>
            </div>
            <div class='form-group'>

            @foreach ($result as $key=>$permission)

            {{Form::checkbox('permissions[]',  $permission["parent"]["id"], $permission_id, array('class' => 'module parentModule','id'=>$key) ) }}
            {{Form::label($permission["parent"]["name"], ucfirst($permission["parent"]["name"]) ) }}<br>
              @if(count($permission["child"])>0) 
                <div class='form-group'>
                @foreach ($permission["child"] as $child)
                {{Form::checkbox('permissions[]',  $child["id"], $permission_id, array('class' => 'module childModule_'.$key) ) }}
                {{Form::label($child["name"], ucfirst($child["name"])) }}&nbsp;
                @endforeach
                </div>
              @endif
            
            @endforeach
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
    <div class="col-lg-8">
      <div class="card m-b-30">
        <div class="card-body">
          <h4 class="mt-0 header-title">Role List</h4>
         
          <table class="table table-dark">
            <thead>
              <tr>
                <th width="5%">#</th>
                <th width="10%">Role</th>
                <th width="60%">Permissions</th>
                <th width="25%">Operation</th>
              </tr>
            </thead>
            <tbody>
           @php $count = 1; @endphp
           @foreach ($roles as $key=>$role)
           
            <tr>
                <td>{{ $count }}</td>
                <td>{{ $role->name }}</td>
{{--
      $parentModules = DB::table('role_has_permissions')->select('role_has_permissions.permission_id','permissions.*')
                ->join('permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                ->where('permissions.parent_id','0')
                ->where('role_has_permissions.role_id','20')->get();
                $permissions = array();
        foreach ($parentModules as $key => $parentModule) {
             $permissions[$key]['parent']=$parentModule;
            $childModules = DB::table('role_has_permissions')->select('role_has_permissions.permission_id','permissions.*')
                ->join('permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                ->where('permissions.parent_id',$parentModule->id)
                ->where('role_has_permissions.role_id','20')->get();
              $permissions[$key]['child']=$childModules;
        }
dd($permissions);
--}}



                    <td>{{  $role->permissions()->pluck('name')->implode(',') }}</td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                    <td>
                    <a href="{{ URL::to('admin/roles/'.$role->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]) !!}
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


@section('extrajs')
<script type="text/javascript">
  //alert();
  $('.parentModule').change(function(event) {
    var id = $(this).attr('id');
    $('.childModule_'+id).prop('checked', this.checked);

    childModule_1
  });
  $('#selectAll').change(function(event) {
    $('input:checkbox').not(this).prop('checked', this.checked);
  //   if ($(this).is('checked')) {
  //     $('.module').attr('checked','checked');
  // } else {
  //     $('.module').removeAttr('checked');
  // }   
  });


</script>

@endsection

