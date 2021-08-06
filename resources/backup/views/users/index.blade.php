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
        <a href="{!!URL('admin/users/create')!!}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> New User</a>
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
  
  
    <!-- end col -->
    <div class="col-lg-12">
      <div class="card m-b-30">
        <div class="card-body">
          <h4 class="mt-0 header-title">User List</h4>
          
          <table class="table">
            <thead>
              <tr>
                <th width="2%">#</th>
                <th width="10%">Name</th>
                <th width="10%">Email</th>
                <th width="10%">Date/Time Added</th>
                <th width="10%">User Roles</th>
                <th width="3%">Status</th>
                <th width="25%">Operations</th>
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
                   <?php
                   if($user->IsActive){ ?>
                       <span class="badge badge-success">Active</span>
                   <?php }else{ ?>
                    <span class="badge badge-danger">Deactive</span>
                   <?php } ?>
                  </td>

                    <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                    <a href="{{ URL("admin/change_password/$user->id") }}" class="btn btn-info pull-left" style="margin-right: 3px;">Change Password</a>

                   <?php
                   if($user->IsActive){ ?>
                <a href="{{ URL::to('admin/deActiveUser/'.$user->id) }}" class="btn btn-danger pull-left" style="margin-right: 3px;" onclick="return confirm('Are You Sure To Dctivated?')" title="Click to Deactive">Deactive</a>
                   <?php }else{ ?>
                       <a href="{{ URL::to('admin/activeUser/'.$user->id) }}" class="btn btn-success pull-left" style="margin-right: 3px;" onclick="return confirm('Are You Sure To Activated?')" title="Click to Active">Active</a>
                   <?php } ?>

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