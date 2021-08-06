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
                    School Subscriptions List
                 </h3>
              </div>
              <div class="card-toolbar">
                
              </div>
           </div>
           <!--end::Header-->
           <!--begin::Body-->
                <div class="card-body">
         
          {{-- @if(in_array("19", $modulePermission)) --}}
           <form class="kt-form kt-form--fit mb-15" method="get">
                      <div class="row">
                        <div class="col-lg-3 mb-lg-0 mb-6">
                          <label>School</label>
                          <select class="selectpicker form-control form-control-lg"  data-live-search="true" name="school">
                            <option value="all">All</option>
                            @foreach ($schools as $school)
                              <option <?php if(isset($_GET['school'])){ if($_GET['school']==$school->id){ echo 'selected';} } ?> value="{{ $school->id }}">{{ $school->name }}</option>
                            @endforeach

                         </select>
                        </div>
                      <div class="col-lg-3 mb-lg-0 mb-6" style="margin-top: 25px;">
                          <button type="submit" class="btn btn-primary btn-primary--icon" id="kt_search">
                          <span>
                            <i class="la la-search"></i>
                            <span>Search</span>
                          </span>
                        </button>&nbsp;&nbsp;  <a class="btn btn-danger btn-secondary--icon" id="kt_reset" href="<?php echo URL('/') ?>/admin/subscriptions">
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
                <th width="10%">School</th>
                <th width="10%">Total Active Subscribers</th>
                
                </tr>
            </thead>
            <tbody>
             @php $total=0;$count=1;   @endphp
             @foreach ($schoolList as $school)
               @php  
                    $totalcount=getSubscribers($school->id); 
                    
                    $url='#';
                    if($totalcount>0)
                    {
                      $url=URL('/admin/subscriptiondetail/'.$school->id.'/active');
                    }
               @endphp
            <tr>
                    <td>{{$count}}</td>
                    <td>{{$school->name}}</td>
                    <td><a href="{{$url}}">{{$totalcount}}</a></td>
            </tr>
            @php $count++; @endphp
            @endforeach
              
             <tr>
              <td colspan="3">
                <?php 
             if(isset($_GET['school']))
               {
               ?>
                 {{ $schoolList->appends(['school' => $_GET['school']])->links() }}
              <?php  }
             else
             {
              ?>
             {{ $schoolList->links() }}
            <?php } ?>
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