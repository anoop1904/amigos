@extends('layouts.master')

@section('title', '| Users')

@section('content')


<!--begin::Main-->
 @php  
    $role_name = Auth::user()->roles()->pluck('name')->implode(' ');
    $role_id = Auth::user()->roles()->pluck('id')->implode(' ');
    $modulePermission = Illuminate\Support\Facades\DB::table('role_has_permissions')->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')->where('permissions.parent_id','1')->where('role_id',$role_id)->select('permissions.id')->get()->pluck('id')->toArray();
    
    //print_r($myData);
  @endphp
<style type="text/css">
  .table td,.table th {
    border: 1px solid #EBEDF3 ! important;
  }
</style>    
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
   <!--begin::Container-->
     <div class=" container ">
        <!--begin::Card-->
        <div class="card card-custom">
           <!--begin::Header-->
           <div class="card-header flex-wrap border-0 pt-6 pb-0">
              <div class="card-title">
              </div>
              <div class="card-toolbar">
            
                 <!--begin::Button-->
                 <a href="{{ URL('admin/users/create') }}" class="btn btn-primary font-weight-bolder">
                    <span class="svg-icon svg-icon-md">
                       <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                       <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                             <rect x="0" y="0" width="24" height="24"/>
                             <circle fill="#000000" cx="9" cy="15" r="6"/>
                             <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3"/>
                          </g>
                       </svg>
                       <!--end::Svg Icon-->
                    </span>
                    New Record
                 </a>
                 <!--end::Button-->
              </div>
           </div>
           <!--end::Header-->
           <!--begin::Body-->
           <div class="card-body">
              @if(Session::has('message'))
                <div class="alert alert-success login-success">
                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('message') !!} 
                </div>
              @endif
              <form class="kt-form kt-form--fit mb-15" method="get">
                      <div class="row">
                       
                        <div class="col-lg-3 mb-lg-0 mb-6">
                          <label>Name</label>
                           <input type="text" name="name" class="form-control" value="<?php if(isset($_GET['name'])){  echo $_GET['name']; } ?>" placeholder="Name" >
                        </div>
                        <div class="col-lg-3 mb-lg-0 mb-6">
                          <label>Email</label>
                        <input type="text" name="email" class="form-control" value="<?php if(isset($_GET['email'])){  echo $_GET['email']; } ?>" placeholder="Email" >
                        </div>

                        <div class="col-lg-3 mb-lg-0 mb-6">
                          <label>Status</label>
                          <select class="form-control" name="status">
                            <option value="all">All</option>
                            <option <?php if(isset($_GET['status'])){ if($_GET['status']=='1'){ echo 'selected';} } ?> value="1">Active</option>
                            <option <?php if(isset($_GET['status'])){ if($_GET['status']=='0'){ echo 'selected';} } ?> value="0">Deactive</option>
                          </select>
                        </div>
                         <div class="col-lg-3 mb-lg-0 mb-6" style="margin-top: 25px;">
                          <button type="submit" class="btn btn-primary btn-primary--icon" id="kt_search">
                          <span>
                            <i class="la la-search"></i>
                            <span>Search</span>
                          </span>
                        </button>&nbsp;&nbsp;  <a class="btn btn-danger btn-secondary--icon" id="kt_reset" href="<?php echo URL('/') ?>/admin/users">
                          <span>
                            <i class="la la-close"></i>
                            <span>Reset</span>
                          </span>
                        </a>
                        </div>
                  </form>
          <table class="table" id="myTable" style="margin-top: 20px;">
            <thead>
              <tr>
                <th width="5%">User Id</th>
                <th width="5%">Name</th>
                <th width="8%">Email</th>
                <th width="5%">Contact Number</th>
                <th width="5%">User Type</th>
                <th width="3%">Status</th>
                <th width="15%">Operations</th>
                </tr>
            </thead>
            <tbody>
           @php $count = 1; @endphp
            @foreach ($users as $user)
            <tr>
              <?php
               $rolename = singledata('roles','id',$user->user_type);
            
                ?>
                    <td>{{ ucfirst($user->user_code) }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->Phone }}</td>
                    <td>{{ $rolename->name }}</td>
                    <td>
                        @if($user->IsActive)
                            <i class="text text-success fa fa-check"></i>
                            @else
                            <i class="text text-danger fa fa-remove"></i>
                        @endif
                    </td>

                    <td>
                       @if( $rolename->name == "Staff")
                       <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info pull-left fa fa-pencil-square-o" style="margin-right: 3px;" title="Edit"></a>
                    @else
                        <a href="#" class="btn btn-secondary pull-left fa fa-pencil-square-o" style="margin-right: 3px;" title="Edit"></a>
                    @endif

                   <?php
                   if($user->IsActive){ ?>
                      <a href="{{ URL::to('admin/deActiveUser/'.$user->id) }}" class="btn btn-danger pull-left" style="margin-right: 3px;" onclick="return confirm('Are You Sure To Deactivate?')" title="Click to Deactive">
                        <i class="ki ki-close" style="font-size: 12px;" ></i>
                      </a>
                   <?php }else{ ?>
                       <a href="{{ URL::to('admin/activeUser/'.$user->id) }}" class="btn btn-success pull-left" style="margin-right: 3px;" onclick="return confirm('Are You Sure To Activated?')" title="Click to Active">
                        <i class="ki ki-close " style="font-size: 12px;" ></i>
                       </a>
                   <?php } ?>
                   {{ Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id] ]) }}
                    <button type="submit" title="Delete" class="btn btn-danger la la-trash" onclick="return confirm('Do You want to Delete?')">
                    </button>
                    
                    {{ Form::close() }}
              
                    </td>
            </tr>
            @php $count++; @endphp
            @endforeach
             <tr>
              <td colspan="7">
                <?php 
             if(isset($_GET['name'])&& isset($_GET['email']) && isset($_GET['status']))
               {
               ?>
                 {{ $users->appends(['name' => $_GET['name'],'email' => $_GET['email'],'status' => $_GET['status']])->links() }}
              <?php  }
             else
             {
              ?>
             {{ $users->links() }}
            <?php } ?>
              </td>
            </tr>
            </tbody>
          </table>
          </div>
           <!--end::Body-->
        </div>
        <!--end::Card-->
     </div>
   <!--end::Container-->
</div>
<!--end::Entry-->
         
<!--end::Main-->


@endsection


@section('extrajs')
<script src="{{ asset('assets/backend') }}/js/pages/custom/user/list-datatable.js?v=7.0.6"></script>
</script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"/>
 <!-- BEGIN PAGE LEVEL PLUGINS -->
       
        <!-- END PAGE LEVEL PLUGINS -->
<script type="text/javascript">


$( function() {
    $('.select2').select2({ width: '100%' });  
  });


$(function() {

  $('input[name="date_filter"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
  });

  $('input[name="date_filter"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
  });

  $('input[name="date_filter"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });

});

</script>
<script src="{{ asset('assets/backend') }}/js/pages/custom/user/list-datatable.js?v=7.0.6"></script>
</script>

@endsection