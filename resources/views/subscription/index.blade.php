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

                
                <div class="col-lg-3 mb-lg-0 mb-4">
                            <label>Date Range</label>
                             <input type="text" autocomplete="off" class="form-control" name="date_filter" id="date_filter" value="<?php if(isset($_GET['date_filter'])){  echo $_GET['date_filter']; } ?>"/>
                         </div>
                         <div class="col-lg-3 mb-lg-0 mb-6">
                            <label>Date</label>
                              <input type="date" name="date" class="form-control" value="<?php if(isset($_GET['date'])){  echo $_GET['date']; } ?>" placeholder="Date" >
                          </div> 

                     <div class="col-lg-3 mb-lg-0 mb-4">
                        <div class="form-group">
                                  {{ Form::label('Store', 'Store') }}
                                  <span class="text text-danger">*</span>
                                <div>       
                                  <select class="form-control select2" name="store" required="">
                                  <option value="all" >All</option>
                                    @foreach($stores as $key => $store)
                                  <option <?php if(isset($_GET['store'])){ if($_GET['store']==$store->id){ echo "selected";}} ?> value="{{$store->id}}">{{$store->name}}</option>
                                  @endforeach
                                  </select>
                             </div>
                        </div> 
                     </div>
               
             

                     

            <div class="col-lg-3 mb-lg-0 mb-4">
             <div class="form-group">
             {{ Form::label('Plan', 'Plan') }}
             <span class="text text-danger">*</span>
             <div>
                <select class="form-control select2" name="plan" required="">
                <option value="all" >All</option>
                @foreach($temdata as $key => $plan)
                <option <?php if(isset($_GET['plan'])){ if($_GET['plan']==$plan['id']){ echo "selected";}} ?> value="{{$plan['id']}}">{{$plan['name']}}</option>
                @endforeach
                </select>
              </div>
              </div>
              </div>

                      

                          

                      
                      
                         <div class="col-lg-3 mb-lg-0 mb-4" style="margin-top: 25px;">
                          <button type="submit" class="btn btn-primary btn-primary--icon" id="kt_search">
                          <span>
                            <i class="la la-search"></i>
                            <span>Search</span>
                          </span>
                        </button>&nbsp;&nbsp;  <a class="btn btn-danger btn-secondary--icon" id="kt_reset" href="<?php echo URL('/') ?>/getPaymentDetails">
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
                <!--  <th width="10%">Plan</th> -->
                <th width="10%">Subscription Id</th>
                <th width="10%">Plan</th>
                <th width="10%">Store</th>
                <th width="10%">Expiry Date</th>
                <th width="10%">price</th>
                <th width="10%">Payment Date</th>
                <th width="10%">Next Billing Date</th>
                <th width="10%">Status</th>
                <th width="10%">Action</th>
              </tr>
            </thead>
            <tbody>
           @php $count = 1; @endphp
            @foreach ($paymentDetails as $value)
            @php  $plandetail=json_decode(getPlanDetail($value->plan_id));@endphp
            <tr>
            <td>{{ $value->subscription_id }}</td>
            <td>{{ $plandetail->item->name}}</td>
                    <td>
                       @if(!empty($value->getStore->name))
                         <span>{{$value->getStore->name}}</span>
                       @endif
                    </td>
                    <td>{{ $value->expiry_date }}</td>
                    <td>{{ $value->price }}</td>
                    <td>{{ $value->payment_date }}</td>
                    <td>{{ $value->payment_date }}</td>
                     <td>
                         @if( $value->status == 1) 
                           <span style="font-size:16px" class="text-success">Active</span> 
                           @else 
                           <span style="font-size:16px" class=" text-danger" >Cancelled </span> 
                         @endif 
                     </td>
                   
                     <td>
                        @if( $value->status == 1)
                          <a class="btn btn-primary btn-primary--icon" style="color:#ffffff" @if(!empty($value->getStore->name)) onclick="cancel_subscription({{$value->getStore->id}})"    style="cursor: pointer;" @endif >
                            Cancel
                          </a>
                        @endif
                     </td>
                  
            </tr>
            @php $count++; @endphp
            @endforeach

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
  function cancel_subscription(userid)
  {
    if(confirm("Do you really want to cancel this subscription?"))
    {
      $.ajax({
      type:'get',
      url:"<?php echo URL('/cancelSubscription'); ?>",
      data:{id:userid},
      success:function(data)
      {
       window.location.reload(true); 
      }
      }); 
    }
   
  
  }
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
<script>
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
@endsection