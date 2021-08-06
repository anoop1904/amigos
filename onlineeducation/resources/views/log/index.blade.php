@extends('layouts.master')

@section('title', '| Users')

@section('content')

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
                    Kitchen Food Item
                    <span class="d-block text-muted pt-2 font-size-sm">Kitchen Food Item made easy</span>
                 </h3>
              </div>
              <div class="card-toolbar">
                 <!--begin::Button-->
                  <a href="{!!URL('admin/kitchenfood/create')!!}" class="btn btn-primary font-weight-bolder">
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

            <form class="kt-form kt-form--fit mb-15" method="get">
                      @if(Session::has('message'))
                      <div class="alert alert-success login-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('message') !!} </div>
                      @endif
                      <div class="row">

                        <div class="col-lg-3 mb-lg-0 mb-6">
                            <label>Date Range</label>
                             <input type="text" autocomplete="off" class="form-control" name="date_filter" id="date_filter" value="<?php if(isset($_GET['date_filter'])){  echo $_GET['date_filter']; } ?>"/>
                         </div>

                          <div class="col-lg-3 mb-lg-0 mb-6">
                            <label>Date</label>
                              <input type="date" name="date" class="form-control" value="<?php if(isset($_GET['date'])){  echo $_GET['date']; } ?>" placeholder="Date" >
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
                              </button>&nbsp;&nbsp;  <a class="btn btn-danger btn-secondary--icon" id="kt_reset" href="<?php echo URL('/') ?>/admin/kitchenfood">
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
                <th width="10%">SNO</th>
                <th width="10%">Log Id</th>
                <th width="10%">Name</th>
                <th width="10%">ID</th>
                <th width="10%">Sattus</th>
                <th width="10%">Sub Status</th>
                {{-- <th width="10%">JSON</th> --}}
                <th width="10%">Date/Time Added</th>
                <th width="10%">Action</th>
                </tr>
            </thead>
            <tbody>

           @php $activeCount = 0;$statusCount=0; $count = 1;  @endphp
           
            @foreach ($logs as $value)
            <?php  $payload = json_decode($value->payload,true); ?>

            @if($payload['status'] == 'Canceled')
            <tr>
                <td>{{ $count }}</td>
                <td>{{ $value->id }}</td>
                <td>{{ $value->type }}</td>
                <td>{{$payload['id']}}</td>
                <td>{{$payload['status']}}
                  @if($payload['status'] == 'Executed')
                  {{':'.$payload['agreement_id']}}
                  @endif

                  @if($payload['status'] == 'Canceled')
                   @php $statusCount++; @endphp
                  @endif
                </td>
                <td>
                  @php
                    $subscription_existed=\App\Subscription::withTrashed()->where(['agreement_id'=>$payload['id']])->first();

                  @endphp

                  @if($subscription_existed)

                      @if($subscription_existed &&  date('Y-m-d', strtotime($subscription_existed['next_period_start'])) < date('Y-m-d', strtotime(now())) )
                      <span class="badge badge-danger">Plan Expired</span>
                      @else
                      @php $activeCount++ @endphp
                      <span class="badge badge-success">Plan Active</span>
                      @endif
                  @else
                    <span class="badge badge-warning">Plan Not Exist</span>
                  @endif

                </td>
                {{-- <td>{!! $value !!}</td> --}}
                <td>{{ $value->created_at->format('F d, Y') }}</td>
                <td><a href="{{URL('admin/cancelAgreementData').'/'.$payload['id']}}">Cancel</a></td>
            </tr>
            @endif
            @php $count++; @endphp
            @endforeach
            
            </tbody>
          </table>
         Cancel Count {{$activeCount .' ('.$statusCount.')'}} 
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