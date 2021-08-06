@extends('layouts.master')

@section('title', '| Roles')

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
    <div class="col-lg-4">
      
      <div class="card m-b-30 ">
        
        <div class="card-body " >
          <div class="col-md-12">
           @if(Request::segment(4)!=='edit')
            <a class="addnew btn btn-info" style="color: #ffffff; margin-bottom: 10px;">Add Role</a>
          @endif
          </div>
          
           @if(Request::segment(4)==='edit')
           <div class="addnewrole">
            {{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT')) }}
            
            <?php 
                
                $name             = $role->name;
                $permission_id    = $role->permissions
                
            ?>
            
            @else
            <div class="addnewrole"  style="display: none;">
            {!! Form::open(array('url' => 'admin/roles')) !!}
            
            <?php 
                $permission_id      = '';
                $name               = '';
                
            ?>
            @endif

           

            <div class="form-group">
              {{ Form::label('name', 'Add Role') }}
              <div>
                {{ Form::text('name', null, array('class' => 'form-control','placeholder'=>'Name','required'=>'required')) }}
                
              </div>
            </div>
             <div class="form-group">
              <div>
                <input type="checkbox" id="selectAll">
                {{ Form::label('name', 'Select All') }}
              </div>
            </div>
            <div class='form-group'>

            @foreach ($result as $key=>$permission)

            {{Form::checkbox('permissions[]',  $permission["parent"]["id"], $permission_id, array('class' => 'module parentModule parentModule_'.$key,'id'=>$key) ) }}
            {{Form::label($permission["parent"]["name"], ucfirst($permission["parent"]["name"]) ) }}<br>
              @if(count($permission["child"])>0) 
                <div class='form-group' style="padding-left: 15px;">
                @foreach ($permission["child"] as $child)
                {{Form::checkbox('permissions[]',  $child["id"], $permission_id, array('class' => 'module childModule childModule_'.$key,'id'=>$key) ) }}
                {{Form::label($child["name"], ucfirst($child["name"])) }}&nbsp;
                @endforeach
                </div>
              @endif
            
            @endforeach
            </div>
            
            <div class="form-group m-b-0">
              <div>
                <button type="submit" class="btn btn-primary waves-effect waves-light"> Submit </button>
                <a href="{{URL('admin/roles')}}" class="btn btn-secondary waves-effect m-l-5"> Cancel </a>
              </div>
            </div>
          {!! Form::close() !!}
        </div>
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

<td>{{--  $role->permissions()->pluck('name')->implode(',') --}}
@php
      $parentModules = DB::table('role_has_permissions')->select('role_has_permissions.permission_id','permissions.*')
                ->join('permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                ->where('permissions.parent_id','0')
                ->where('role_has_permissions.role_id',$role->id)->get();
                $permissions = array();
        foreach ($parentModules as $key => $parentModule) {
             $permissions[$key]['parent']=$parentModule;
            $childModules = DB::table('role_has_permissions')->select('role_has_permissions.permission_id','permissions.*')
                ->join('permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                ->where('permissions.parent_id',$parentModule->id)
                ->where('role_has_permissions.role_id',$role->id)->get();
              $permissions[$key]['child']=$childModules;
        }
//dd($permissions)
@endphp  
@foreach ($permissions as $key => $permission)
  <ul>
    <li>
      {{ $permission['parent']->name }}
      @if(!empty($permission['child']))
      &nbsp;(&nbsp;
      @foreach ($permission['child'] as $key => $child)
        {{ $child->name }}
      @endforeach
      &nbsp;)&nbsp;
      @endif
    </li>
  </ul>
@endforeach

                    </td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                    <td>
                    <a href="{{ URL::to('admin/roles/'.$role->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;" title="Edit Role">Edit</a>

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
  $(document).ready(function(){
    $(".addnew").click(function(){
     $( ".addnewrole" ).toggle();
   });
  });
  $('.module').change(function(event) {
    var flag = true;
    $('.module').each(function(){
      if(!$(this).is(":checked")){
        flag =false;
      }
    });
    $('#selectAll').prop('checked',flag);
  });

  $('.childModule').change(function(event) {
    var id = $(this).attr('id');
    var flag = false;
    $('.childModule_'+id).each(function(){
      if($(this).is(":checked")){
        flag =true;
      }
    });
    $('.parentModule_'+id).prop('checked',flag);
  });

  $('.parentModule').change(function(event) {
    var id = $(this).attr('id');
    $('.childModule_'+id).prop('checked', this.checked);

    //childModule_1
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

