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
                    School Not Map
                   
                 </h3>
              </div>
              <div class="card-toolbar">
               </div>
           </div>
           <!--end::Header-->
           <!--begin::Body-->
                <div class="card-body">
         
          {{-- @if(in_array("19", $modulePermission)) --}}
          @if(Session::has('message'))
              <div class="alert alert-success login-success"> 
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('message') !!} 
              </div>
          @endif
          
          <table class="table" id="myTable" style="margin-top: 20px;">
            <thead>
              <tr>
                <th width="5%">Sr. No.</th>
                <th width="10%">Name</th>
                <th width="20%">Operations</th>
                </tr>
            </thead>
            <tbody>
           @php $count = 1; @endphp
            @foreach ($school as $key=> $user)
            <tr>
                    <td>{{$key+1}}</td>
                    <td>{{ $user->name }}</td>
                    <td>
                   <a onclick="get_mapschool({{ $user->id }})" class="btn btn-info pull-left " style="margin-right: 3px; cursor: pointer;color:#fff" title="Map School">Map School</a>
                   </td>
            </tr>
            @php $count++; @endphp
            @endforeach
             <tr>
              <td colspan="7">
               {{ $school->links() }}
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
<!-- Popup modal for view order details -->
<div class="modal fade" id="orderDetail" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Map School</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body" style="height: 300px;">
              {{ Form::open(array('url' => 'admin/mapschool', 'enctype'=>'multipart/form-data', 'id' => 'schoolForm')) }}
                <select name="vendor" id="vendor" required="required" class="form-control">
                 <option value="">Select Vendor</option>
                   @if(!empty($vendorList))
                        @foreach($vendorList as $vendor)
                          <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                        @endforeach

                   @endif
                </select> 
            <div class="form-group m-b-0" style="margin-top: 20px;">
              <input type="hidden" name="school_id" id="school_id" value="">
              <div>
                <button type="submit" class="btn btn-primary waves-effect waves-light"> Submit </button>
               </div>
            </div>
         {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
               
            </div>
        </div>
    </div>
</div>

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
 function get_mapschool(id)
  {
    $('#school_id').val(id);
    $('#orderDetail').modal('show');
  }
</script>
@endsection