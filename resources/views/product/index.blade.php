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
       <!-- BEGIN PAGE LEVEL PLUGINS -->
       <style type="text/css">
  .table td,.table th {
    border: 1px solid #EBEDF3 ! important;
  }
</style>
        <!-- END PAGE LEVEL PLUGINS -->
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
                 <a href="{!!URL('admin/product/create')!!}" class="btn btn-primary font-weight-bolder">
                    <span class="svg-icon svg-icon-md">
                       
                       <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                             <rect x="0" y="0" width="24" height="24"/>
                             <circle fill="#000000" cx="9" cy="15" r="6"/>
                             <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3"/>
                          </g>
                       </svg>
                      
                    </span>
                    New Record
                 </a>
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
                          <label>Category</label>
                          <select class="form-control category" name="category_id" id="category" target-data="sub_category">
                          <option value="all" selected="">All</option>
                          @foreach($categories as $key=>$category)
                          <option value="{{$category->id}}" <?php if(isset($_GET['category_id'])){ if($category->id == $_GET['category_id']){ echo "selected"; } } ?>>{{$category->name}}</option> 
                          @endforeach
                          </select>
                        </div>
                         
                         
                         <div class="col-lg-3 mb-lg-0 mb-6">
                          <label>Brand</label>
                          <select class="form-control category" name="brand_id" id="brand_id" target-data="brand_id">
                          <option value="all" selected="">All</option>
                          @foreach($brands as $key=>$brand)
                          <option value="{{$brand->id}}" <?php if(isset($_GET['brand_id'])){ if($brand->id == $_GET['brand_id']){ echo "selected"; } } ?>>{{$brand->name}}</option> 
                          @endforeach
                          </select>
                        </div>

                        <div class="col-lg-3 mb-lg-0 mb-6">
                          <label>Status</label>
                          <select class="form-control status" name="status" id="status" target-data="status">
                            <option value="all" selected="">All</option>
                            <option value="verify" <?php if(isset($_GET['status'])){ if('verify' == $_GET['status']){ echo "selected"; } } ?>>Verify</option>
                            <option value="unverify" <?php if(isset($_GET['status'])){ if('unverify' == $_GET['status']){ echo "selected"; } } ?>>Unverify</option>
                            <option value="active" <?php if(isset($_GET['status'])){ if('active' == $_GET['status']){ echo "selected"; } } ?>>Active</option>
                            <option value="deactive" <?php if(isset($_GET['status'])){ if('deactive' == $_GET['status']){ echo "selected"; } } ?>>Deactive</option>
                          </select>
                        </div>
                          
                       
                         <div class="col-lg-3 mb-lg-0 mb-6" style="margin-top: 25px;">
                          <button type="submit" class="btn btn-primary btn-primary--icon" id="kt_search">
                          <span>
                            <i class="la la-search"></i>
                            <span>Search</span>
                          </span>
                        </button>&nbsp;&nbsp;  <a class="btn btn-danger btn-secondary--icon" id="kt_reset" href="<?php echo URL('/') ?>/admin/product">
                          <span>
                            <i class="la la-close"></i>
                            <span>Reset</span>
                          </span>
                        </a>
                        </div>
                  </form>
            </div>
            <div style="width: 100%" id="message">
              
            </div>
        <table class="table" id="myTable" style="margin-top: 20px;">
             <thead>
              <tr>
                <th width="5%">Sr. No.</th>
                <th width="10%">Image</th>
                <th width="10%">Name</th>
                <th width="10%">Category</th>
                <th width="10%">Sub_Category</th>
                <th width="3%">Status</th>
                <th width="5%">Date</th>
                <th width="20%">Operations</th>
                </tr>
            </thead>
             <tbody>
           @php $count = 1; $link=''; @endphp
            
            @foreach ($customers as $key=> $user)
            <tr>
                    <td>{{$count}}</td>
                    <td>
                          <?php
                          $url = 'assets/images/user.png';
                          if($user->profile_pic){
                          $url = '/public/assets/img/product/'.$user->profile_pic;
                          }
                          ?>
                          <img src="{{asset($url)}}" style="height: 80px;width: 80px;">
                    </td>
                    <td>
                      {{ $user->name }}
                      @if(!$user->IsVerify)
                        <p class="text text-danger">Product Not Verify</p>
                      @endif
                      @if(!$user->category_id)
                        <p class="text text-danger">Categoty Not Added</p>
                      @endif
                      @if(!$user->brand_id)
                        <p class="text text-danger">Brand not added</p>
                      @endif
                      @if(!$user->sub_category_id)
                        <p class="text text-danger">Sub Category not added</p>
                      @endif
                    </td>
                    <td>{{ $user->category_list?$user->category_list->name:'NA' }}</td>
                    <td>{{ $user->sub_category_list?$user->sub_category_list->name:'NA' }}</td>
                   
                    <td >
                    @if($user->IsActive)
                          {{-- <i class="text text-success fa fa-check"></i> --}}
                          <div>
                            <input type="checkbox" class="switch myswitch" cstate="" id="myswitch{{$user->id}}" cid="{{$user->id}}"  data-backdrop="static" data-keyboard="false" checked />
                          </div>
                        @else
                          {{-- <i class="text text-danger fa fa-remove"></i> --}}
                          <div>
                            <input type="checkbox" class="switch myswitch" cstate="" id="myswitch{{$user->id}}" cid="{{$user->id}}"  data-backdrop="static" data-keyboard="false"/>
                          </div>
                        @endif
                    </td>
                    <td>{{  $user->created_at->format('F d, Y') }}</td>
                    <td>
                    {{-- @if(in_array("22", $modulePermission)) --}}
                    <a href="{{ route('product.edit', $user->id) }}" class="btn btn-info pull-left fa fa-pencil-square-o" style="margin-right: 3px;" title="Edit"></a>
                  
                   {{-- @endif --}}
                   {{-- @if(in_array("20", $modulePermission)) --}}
                   {{ Form::open(['method' => 'DELETE','style'=>'margin-right: 3px;float: left;', 'route' => ['product.destroy', $user->id] ]) }}
                    <button type="submit" class="btn btn-danger la la-trash" title="Delete" onclick="return confirm('Do You want to Delete?')"></button>
                    {{ Form::close() }}
                     {{-- @endif --}}
                   
                     @if(!$user->IsVerify)
                        <button type="button" onclick="openPopup('{{$user->id}}')" id="product_{{$user->id}}" class="btn btn-info pull-left" style="margin-right: 3px;" title="Edit">Verify</a>
                      @endif
                    </td>
            </tr>
              @php $count++; @endphp
              @endforeach
            </tbody>
            <tr>
              <td colspan="11">
                <?php 
             if(isset($_GET['name'])&& isset($_GET['category_id']) && isset($_GET['brand_id']) && isset($_GET['status']))
               {
               ?>
                 {{ $customers->appends(['name' => $_GET['name'],'category_id' => $_GET['category_id'],'brand_id' => $_GET['brand_id'],'status' => $_GET['status']])->links() }}
              <?php  }
             else
             {
              ?>
             {{ $customers->links() }}
            <?php } ?>
              </td>
            </tr>
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

function ambassador_status(userid,status)
{
  var msg='';
  var ambassadorstatus='';
  var alert='';
  var val='';
  var html='';
  if(status==0)
  {
    msg='Student successfully remove from ambassador list.';
    ambassadorstatus='<i class="text text-danger fa fa-remove"></i>';
    alert=' remove from ambassador list?';
    val=1;
    html='<i class="text fa fa-plus"></i>';
  }
  else
  {
    msg='Student successfully added in ambassador list.';
    ambassadorstatus='<i class="text text-success fa fa-check"></i>';
    alert=' added in ambassador list?';
    val=0;
    html='<i class="text fa fa-remove"></i>';
  }
  var r=confirm('Do you want'+alert);
  if(r)
  {
    $.ajax({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '<?php echo URL('/') ?>/admin/make_ambassador',
        type: 'POST',
        data: {userid:userid,status:status},
        success:function(response) { 
          $('#ambassadoratt'+userid).removeAttr('onclick');
          $('#ambassadoratt'+userid).attr('onclick', 'ambassador_status('+userid+','+val+')');
          $('#ambassadoratt'+userid).html(html);
         $('#message').html('<div class="alert alert-custom alert-success  mb-5" role="alert"> <div class="alert-icon">\
              <i class="flaticon-warning"></i>\
            </div>\
            <div class="alert-text">'+msg+'</div>\
            <div class="alert-close">\
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
                <span aria-hidden="true">\
                  <i class="ki ki-close"></i>\
                </span>\
              </button>\
            </div>\
          </div>') ;
         $('#ambassadorstatus'+userid).html(ambassadorstatus);
        },
        error:function(){ alert('error');}
        }); 
  }
  
    
    
}
    </script>
  <script>
        
        $(function() {
            $('.chk_boxes').click(function() {
                $('.checkbox').prop('checked', this.checked);
            });
        });
    </script>
  <script> 
    $( document ).ready(function() {
      $( ".table" ).wrap( "<div class='table_inner'></div>" );
    });
  </script>
@endsection