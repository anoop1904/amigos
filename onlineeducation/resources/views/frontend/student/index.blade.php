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
                 <h3 class="card-label">
                    Student Management
                    <span class="d-block text-muted pt-2 font-size-sm">Student management made easy</span>
                 </h3>
              </div>
              <div class="card-toolbar">
               
                 <div class="dropdown dropdown-inline mr-2">
                  <!--   <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <span class="svg-icon svg-icon-md">
                         
                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                             <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3"/>
                                <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000"/>
                             </g>
                          </svg>
                       
                       </span>
                       Export
                    </button> -->
                   
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                       <!--begin::Navigation-->
                      <!--  <ul class="navi flex-column navi-hover py-2">
                          <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">
                             Choose an option:
                          </li>
                          <li class="navi-item">
                             <a href="#" class="navi-link">
                             <span class="navi-icon"><i class="la la-print"></i></span>
                             <span class="navi-text">Print</span>
                             </a>
                          </li>
                          <li class="navi-item">
                             <a href="#" class="navi-link">
                             <span class="navi-icon"><i class="la la-copy"></i></span>
                             <span class="navi-text">Copy</span>
                             </a>
                          </li>
                          <li class="navi-item">
                             <a href="#" class="navi-link">
                             <span class="navi-icon"><i class="la la-file-excel-o"></i></span>
                             <span class="navi-text">Excel</span>
                             </a>
                          </li>
                          <li class="navi-item">
                             <a href="#" class="navi-link">
                             <span class="navi-icon"><i class="la la-file-text-o"></i></span>
                             <span class="navi-text">CSV</span>
                             </a>
                          </li>
                          <li class="navi-item">
                             <a href="#" class="navi-link">
                             <span class="navi-icon"><i class="la la-file-pdf-o"></i></span>
                             <span class="navi-text">PDF</span>
                             </a>
                          </li>
                       </ul> -->
                       <!--end::Navigation-->
                    </div>
                    <!--end::Dropdown Menu-->
                 </div>
                 <!--end::Dropdown-->
                 <!--begin::Button-->
                 <a href="{!!URL('admin/student/create')!!}" class="btn btn-primary font-weight-bolder">
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
                          <label>Email</label>
                        <input type="text" name="email" class="form-control" value="<?php if(isset($_GET['email'])){  echo $_GET['email']; } ?>" placeholder="Email" >
                        </div>
                         <div class="col-lg-3 mb-lg-0 mb-6">
                          <label>Mobile</label>
                        <input type="text" name="mobile" class="form-control" value="<?php if(isset($_GET['mobile'])){  echo $_GET['mobile']; } ?>" placeholder="Mobile" >
                        </div>
                       
                        <div class="col-lg-3 mb-lg-0 mb-6">
                          <label>School</label>
                          <select class="selectpicker form-control form-control-lg"  data-live-search="true" name="school">
                            <option value="all">All</option>
                            @foreach ($schoolList as $school)
                              <option <?php if(isset($_GET['school'])){ if($_GET['school']==$school->id){ echo 'selected';} } ?> value="{{ $school->id }}">{{ $school->name }}</option>
                            @endforeach

                         </select>
                        </div>
                       
                        <!-- 
                        <div class="col-lg-3 mb-lg-0 mb-6">
                            <label>Date Range</label>
                             <input type="text" autocomplete="off" class="form-control" name="date_filter" id="date_filter" value="<?php if(isset($_GET['date_filter'])){  echo $_GET['date_filter']; } ?>"/>
                         </div>

                          <div class="col-lg-3 mb-lg-0 mb-6">
                            <label>Date</label>
                              <input type="date" name="date" class="form-control" value="<?php if(isset($_GET['date'])){  echo $_GET['date']; } ?>" placeholder="Date" >
                          </div> -->
                          <div class="col-lg-3 mb-lg-0 mb-6">
                          <label>Ambassador</label>
                          <select class="form-control" name="ambassador">
                            <option value="all">All</option>
                            <option <?php if(isset($_GET['ambassador'])){ if($_GET['ambassador']=='1'){ echo 'selected';} } ?> value="1">Yes</option>
                            <option <?php if(isset($_GET['ambassador'])){ if($_GET['ambassador']=='0'){ echo 'selected';} } ?> value="0">No</option>
                          </select>
                        </div>
                        <!-- <div class="col-lg-3 mb-lg-0 mb-6">
                          <label>Status</label>
                          <select class="form-control" name="status">
                            <option value="all">All</option>
                            <option <?php if(isset($_GET['status'])){ if($_GET['status']=='1'){ echo 'selected';} } ?> value="1">Approve</option>
                            <option <?php if(isset($_GET['status'])){ if($_GET['status']=='0'){ echo 'selected';} } ?> value="0">Unapprove</option>
                          </select>
                        </div> -->
                         <div class="col-lg-3 mb-lg-0 mb-6" style="margin-top: 25px;">
                          <button type="submit" class="btn btn-primary btn-primary--icon" id="kt_search">
                          <span>
                            <i class="la la-search"></i>
                            <span>Search</span>
                          </span>
                        </button>&nbsp;&nbsp;  <a class="btn btn-danger btn-secondary--icon" id="kt_reset" href="<?php echo URL('/') ?>/admin/student">
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
                <th width="10%">School</th>
                <th width="10%">Name</th>
                <th width="10%">Email</th>
                <th width="5%">Mobile</th>
                <th width="2%">Is Ambassador</th>
                <th width="3%">Status</th>
                <th width="5%">Total Earned</th>
                <th width="5%">Subcription</th>
                <th width="5%">Date</th>
                <th width="20%">Operations</th>
                </tr>
            </thead>
             <tbody>
           @php $count = 1; $link=''; @endphp
            
            @foreach ($student as $key=> $user)
            <?php 
            $schoolname=singledata('school_info','id',$user->school_id);
            $totalearn=getTotalErning($user->id);
            if($totalearn!='0'){$link=URL('/admin/referrallist/'.$user->id);}else{$link='#';}
            
            ?>
            <tr>
                    <td> <!-- <input type="checkbox" class="checkbox" name="checkbox[]" value="{{$user->id}}"/> -->{{$count}}</td>
                    <td>{{ !empty($schoolname->name) ? $schoolname->name:''  }} </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->mobile_number }}</td>
                    
                      <td id='ambassadorstatus{{ $user->id }}'>
                    @if($user->ambassador =='1')
                    <i class="text text-success fa fa-check"></i>
                    @else
                    <i class="text text-danger fa fa-remove"></i>
                    @endif
                    </td>
                  
                    <td >
                    @if($user->status =='1')
                    <i class="text text-success fa fa-check"></i>
                    @else
                    <i class="text text-danger fa fa-remove"></i>
                    @endif
                    </td>
                    <td><a href="{{$link}}">{{$totalearn}}</a></td>
                    <td>
                        @if($user->subscription )
                          @if(date('Y-m-d', strtotime($user->subscription->next_period_start)) >= date('Y-m-d', strtotime(now())) )
                            <span>Plan Expire :<br/>{{date('F d, Y', strtotime($user->subscription->next_period_start))}}</span>
                          @else
                            <span>Plan Expired :<br/><span class="text text-danger">{{date('F d, Y', strtotime($user->subscription->next_period_start))}}</span></span>
                          @endif
                        @else
                          <span>NA</span>
                        @endif
                    </td>
                    <td>{{  $user->created_at->format('F d, Y') }}</td>
                    <td>
                    {{-- @if(in_array("22", $modulePermission)) --}}
                    <a href="{{ route('student.edit', $user->id) }}" class="btn btn-info pull-left fa fa-pencil-square-o" style="margin-right: 3px;" title="Edit"></a>
                  
                   {{-- @endif --}}
                   {{-- @if(in_array("20", $modulePermission)) --}}
                   {{ Form::open(['method' => 'DELETE','style'=>'width: 23%;
    float: left;', 'route' => ['student.destroy', $user->id] ]) }}
                    <button type="submit" class="btn btn-danger la la-trash" title="Delete" onclick="return confirm('Do You want to Delete?')"></button>
                    {{ Form::close() }}
                     {{-- @endif --}}
                   @if($user->ambassador =='1')
                    <a id='ambassadoratt{{ $user->id }}' onclick="ambassador_status({{$user->id}},0)" class="btn btn-success pull-left " style="margin-right: 3px; cursor: pointer;" title="Remove Ambassador"><i class="text fa fa-remove"></i></a>
                    @else
                    <a id='ambassadoratt{{ $user->id }}' onclick="ambassador_status({{$user->id}},1)"  class="btn btn-success pull-left " style="margin-right: 3px; cursor: pointer;" title="Add Ambassador"><i class="text fa fa-plus"></i></a>
                    @endif
                    
                    </td>
            </tr>
              @php $count++; @endphp
              @endforeach
            </tbody>
            <tr>
              <td colspan="9">
                <?php 
             if(isset($_GET['name'])&& isset($_GET['email']) && isset($_GET['mobile'])&& isset($_GET['school'])&& isset($_GET['ambassador']))
               {
               ?>
                 {{ $student->appends(['name' => $_GET['name'],'email' => $_GET['email'],'mobile' => $_GET['mobile'],'school' => $_GET['school'],'ambassador' => $_GET['ambassador']])->links() }}
              <?php  }
             else
             {
              ?>
             {{ $student->links() }}
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