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
                <a href="{{URL('/admin/category')}}" style="margin-left: 10px;" class="btn btn-primary font-weight-bolder">Category List</a>
                 <!--end::Button-->
              </div>
           </div>
           <!--end::Header-->
           <!--begin::Body-->
                <div class="card-body">
         
          {{-- @if(in_array("19", $modulePermission)) --}}
         
          <table class="table" id="myTable" style="margin-top: 20px;">
            <thead>
              <tr>
                 <th width="30%">Sr.No.</th>
                 <th width="30%">Name</th>
              </tr>
            </thead>
            <tbody class="row_position">
            @php $count = 1; @endphp
              @foreach ($categories as $key=> $value)
                <tr id="<?php echo $value->id; ?>" style="cursor: all-scroll;" >
                  <td>{{$count}}</td>
                  <td>{{ $value->name }}</td>
                       
                </tr>
              @php $count++; @endphp
              @endforeach
           
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
<script src="{{ asset('assets/backend') }}/js/jquery-ui.min_1.js"></script>
<script type="text/javascript">
  var $sortable = $( "#myTable > tbody" );
  $sortable.sortable({
      stop: function ( event, ui ) {
          var parameters = $sortable.sortable( "toArray" );
             $.ajax({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '<?php echo URL('/') ?>/admin/chnageCategoryOrder',
        type: 'POST',
        data: {value:parameters},
        success:function(response) { 
         location.reload();
        },
        error:function(){ alert('error');}
        }); 

         
      }
  });
</script>
@endsection