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

        <div class="card-body">
        @if(Session::has('message'))
            <div class="alert alert-success login-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('message') !!} 
            </div>
            @endif
            <div class="row"  >
          <table class="table" id="myTable" style="margin-top: 20px;">
              <thead>
              <tr>
              <th width="10%">Plan Id</th>
              <th width="10%">Plan Name</th>
              <th width="10%">Amount</th>
              <th width="10%">Billing Cycle</th>
              </tr>
              </thead>
          <tbody>

           @php $count = 1; $link=''; $plans_data = json_decode($plans); @endphp

            @foreach ($plans_data->items as  $plan_val)
  
            <tr>
                    <td>{{$plan_val->id}}</td>
                    <td>{{$plan_val->item->name}}</td>
                    <td><i class="fas fa-rupee-sign"></i>&nbsp;{{ number_format($plan_val->item->amount/100, 2)}}</td>
                    <td>Every {{ucfirst($plan_val->period)}}</td>
            </tr>          
              @endforeach
            </tbody>
            <tr>
              <td colspan="11">
                <?php 
             if(isset($_GET['name']))
               {
               ?>
                 {{ $plans->appends(['name' => $_GET['name']])->links() }}
              <?php  }
             else
             {
              ?>
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
<script src="{{ asset('assets/backend') }}/js/pages/custom/user/list-datatable.js?v=7.0.6"></script>
</script>

<script>
function template_preview(temp_id)
{
	console.log(temp_id);
	 $.ajax({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '<?php echo URL('/') ?>/admin/emailtemplate/tempprview',
        type: 'POST',
        data: {temp_id:temp_id},
        success:function(response) {
			console.log(response,'responce');
        /*			
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
		 */
        },
        error:function(){ alert('error');}
        }); 
}
</script>

@endsection