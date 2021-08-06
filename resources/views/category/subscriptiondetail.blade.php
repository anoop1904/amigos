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
                 <h3 class="card-label">
                    Subscriptions list of ({{$schoolname->name}})
                   
                 </h3>
              </div>
             <div class="card-toolbar">
              @if($status=='active')
              <a class="btn btn-success" href="<?php echo URL('/') ?>/admin/subscriptions"><i class="icon-2x text-dark-50 flaticon-reply"></i> Go To Back</a>
              @else
              <a class="btn btn-success" href="<?php echo URL('/') ?>/admin/subscriptionlist"><i class="icon-2x text-dark-50 flaticon-reply"></i> Go To Back</a>
              @endif
             </div>
           </div>
           <!--end::Header-->
           <!--begin::Body-->
                <div class="card-body">
         
          {{-- @if(in_array("19", $modulePermission)) --}}
         
          
          <table class="table" id="myTable" style="margin-top: 20px;">
            <thead>
              <tr>
                <th width="5%">Sr. No.</th>
                <th width="10%">Name</th>
                <th width="10%">Email</th>
                <th width="10%">Mobile</th>
                <!-- <th width="10%">Is Ambassador</th> -->
                <th width="10%">Plan</th>
                <th width="10%">Subcription</th>
                
                </tr>
            </thead>
            <tbody>
             @php $total=0;$count=1;   @endphp
             @foreach ($list as $student)
            <tr>
                    <td>{{$count}}</td>
                    <td>{{$student->name}}</td>
                    <td>{{$student->email}}</td>
                    <td>{{$student->mobile_number}}</td>
                    <!-- <td>
                      @if($student->ambassador =='1')
                        <i class="text text-success fa fa-check"></i>
                        @else
                        <i class="text text-danger fa fa-remove"></i>
                      @endif
                  </td> -->
                  <td>{{$student->plan_name->name}}</td>
                    <td> 
                      @if($student->subscription && $student->subscription->next_period_start!='' )
                          @if(date('Y-m-d', strtotime($student->subscription->next_period_start)) >= date('Y-m-d', strtotime(now())) )
                            <span>Plan Expire :<br/>{{date('F d, Y', strtotime($student->subscription->next_period_start))}}</span>
                          @else
                            <span>Plan Expired :<br/><span class="text text-danger">{{date('F d, Y', strtotime($student->subscription->next_period_start))}}</span></span>
                          @endif
                        @else
                          <span>NA</span>
                        @endif
                     </td>
                    
            </tr>
            @php $count++; @endphp
            @endforeach
               
             <tr>
              <td colspan="7">
               {{ $list->links() }}
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