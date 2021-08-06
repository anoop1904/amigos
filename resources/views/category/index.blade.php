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
                 
                 <!--end::Dropdown-->
                 <!--begin::Button-->
                 <a href="{!!URL('admin/category/create')!!}" class="btn btn-primary font-weight-bolder">
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
                 <a href="{{URL('/admin/changeorder')}}" style="margin-left: 10px;" class="btn btn-primary font-weight-bolder">Change Category Order</a>
                 <!--end::Button-->
              </div>
           </div>
           <!--end::Header-->
           <!--begin::Body-->
                <div class="card-body">
         
          {{-- @if(in_array("19", $modulePermission)) --}}
           <form class="kt-form kt-form--fit mb-15" method="get">
                      <div class="row">
                       
                        <div class="col-lg-3 mb-lg-0 mb-6">
                          <label>Name</label>
                           <input type="text" name="name" class="form-control" value="<?php if(isset($_GET['name'])){  echo $_GET['name']; } ?>" placeholder="Name" >
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
                        </button>&nbsp;&nbsp;  <a class="btn btn-danger btn-secondary--icon" id="kt_reset" href="<?php echo URL('/') ?>/admin/category">
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
                <th width="5%">Sr. No.</th>
                <th width="10%">Image</th>
                <th width="30%">Name</th>
                <th width="10%">Parent</th>
                <th width="10%">Date/Time Added</th>
                <th width="3%">Status</th>
                <th width="3%">Home Page</th>
                <th width="10%">Operations</th>
                </tr>
            </thead>
            <tbody>
            @php $count = 1; @endphp
              @foreach ($categories as $key=> $value)
                <tr>
                        <td>{{$key+1}}</td>
                        <td>
                          <?php
                          $url = 'assets/images/user.png';
                          if($value->image){
                          $url = '/public/assets/img/category/'.$value->image;
                          }
                          ?>
                          <img src="{{asset($url)}}" style="height: 80px;width: 80px;">
                        </td>
                        <td>{{ $value->name }}</td>
                        <td>
                          @if($value->category_name)
                            <span>{{$value->category_name->name}}</span>
                          @else
                            <span>Parent</span>
                          @endif
                        </td>
                        
                        <td>{{ $value->created_at->format('F d, Y') }}</td>
                       
                      
                        <td>
                        {{-- <span class="switch switch-sm">
                          <label>
                            <input type="checkbox" checked="checked" class="switch_btn" name="select"/>
                            <span></span>
                          </label>
                        </span> --}}


                        


                        @if($value->IsActive)
                        {{-- <i class="text text-success fa fa-check"></i> --}}
                        <div>
                        <input type="checkbox" class="switch myswitch" cstate="" id="myswitch{{$value->id}}" cid="{{$value->id}}"  data-backdrop="static" data-keyboard="false" 
                        checked />
                        </div>
                        @else
                        {{-- <i class="text text-danger fa fa-remove"></i> --}}
                        <div>
                        <input type="checkbox" class="switch myswitch" cstate="" id="myswitch{{$value->id}}" cid="{{$value->id}}"  data-backdrop="static" data-keyboard="false"/>
                        </div>
                        @endif
                        </td>
                        <td>
                        {{-- <span class="switch switch-sm">
                          <label>
                            <input type="checkbox" checked="checked" class="switch_btn" name="select"/>
                            <span></span>
                          </label>
                        </span> --}}

                        @if($value->IsHomePage)
                        {{-- <i class="text text-success fa fa-check"></i> --}}
                        <div>
                        <input type="checkbox" class="switch myswitch" cstate="" id="homemyswitch{{$value->id}}" cid="{{$value->id}}"  data-backdrop="static" status="homepage" data-keyboard="false" 
                        checked />
                        </div>
                        @else
                        {{-- <i class="text text-danger fa fa-remove"></i> --}}
                        <div>
                        <input type="checkbox" class="switch myswitch" cstate="" id="homemyswitch{{$value->id}}" cid="{{$value->id}}"  data-backdrop="static" status="homepage" data-keyboard="false"/>
                        </div>
                        @endif
                        </td>
                        <td>
                        {{-- @if(in_array("22", $modulePermission)) --}}
                        <a href="{{ route('category.edit', $value->id) }}" class="btn btn-info pull-left fa fa-pencil-square-o" style="margin-right: 3px;" title="Edit"></a>
                       {{-- @endif --}}
                       {{-- @if(in_array("20", $modulePermission)) --}}
                       {{ Form::open(['method' => 'DELETE', 'route' => ['category.destroy', $value->id] ]) }}
                        <button type="submit" class="btn btn-danger la la-trash" title="Delete" onclick="return confirm('Do You want to Delete?')"></button>
                        {{ Form::close() }}
                         {{-- @endif --}}

                        </td>
                </tr>
              @php $count++; @endphp
              @endforeach
             <tr>
              <td colspan="7">
                @if(isset($_GET['name']) &&  isset($_GET['status']))
                  {{ $categories->appends(['name' => $_GET['name'],'status' => $_GET['status']])->links() }}
                @else
                  {{ $categories->links() }}
                @endif
              </td>
            </tr>
            </tbody>
          </table>
          {{-- @endif --}}
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
<style type="text/css">
  .modal-backdrop {
    background: transparent;
  }
</style>
<script src="{{ asset('assets/backend') }}/js/pages/custom/user/list-datatable.js?v=7.0.6"></script>
</script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"/>
 <!-- BEGIN PAGE LEVEL PLUGINS -->
       
        <!-- END PAGE LEVEL PLUGINS -->
<script type="text/javascript">



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
@endsection