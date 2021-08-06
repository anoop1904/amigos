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
            
                 <!--begin::Button-->
                 <a href="{{ URL('admin/messages/create') }}" class="btn btn-primary font-weight-bolder">
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
              @if(Session::has('message'))
                <div class="alert alert-success login-success">
                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('message') !!} 
                </div>
              @endif
              <form class="kt-form kt-form--fit mb-15" method="get">
                      <div class="row">
                       
                        <div class="col-lg-3 mb-lg-0 mb-6">
                          <label>Template Title</label>
                           <input type="text" name="title" class="form-control" value="<?php if(isset($_GET['title'])){  echo $_GET['title']; } ?>" placeholder="Title" >
                        </div>
                    
                      
                        <div class="col-lg-3 mb-lg-0 mb-6">
                          <label>Status</label>
                          <select class="form-control" name="IsActive">
                            <option value="all">All</option>
                            <option <?php if(isset($_GET['IsActive'])){ if($_GET['IsActive']=='1'){ echo 'selected';} } ?> value="1">Active</option>
                            <option <?php if(isset($_GET['IsActive'])){ if($_GET['IsActive']=='0'){ echo 'selected';} } ?> value="0">Deactive</option>
                          </select>
                        </div>
                         <div class="col-lg-3 mb-lg-0 mb-6" style="margin-top: 25px;">
                          <button type="submit" class="btn btn-primary btn-primary--icon" id="kt_search">
                          <span>
                            <i class="la la-search"></i>
                            <span>Search</span>
                          </span>
                        </button>&nbsp;&nbsp;  <a class="btn btn-danger btn-secondary--icon" id="kt_reset" href="<?php echo URL('/') ?>/admin/messages">
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
               
                <th width="10%">Template Title</th>
                
                <th width="3%">Status</th>
                <th width="5%">Date</th>
                <th width="20%">Operations</th>
                </tr>
            </thead>
             <tbody>
           @php $count = 1; $link=''; @endphp
            
            @foreach ($messages as $key=> $messages_val)
            <tr>
                    <td>{{$count}}</td>
                
                    <td id="msgtitle{{$messages_val->id}}">
                      {{ $messages_val->title }}
                      <div id="msgdes{{$messages_val->id}}" style="display: none;">{{ $messages_val->body}}</div>
                    </td>
                    
                    <td >
                    @if($messages_val->IsActive)
                          {{-- <i class="text text-success fa fa-check"></i> --}}
                          <div>
                            <input type="checkbox" class="switch myswitch" cstate="" id="myswitch{{$messages_val->id}}" cid="{{$messages_val->id}}"  data-backdrop="static" data-keyboard="false" checked />
                          </div>
                        @else
                          {{-- <i class="text text-danger fa fa-remove"></i> --}}
                          <div>
                            <input type="checkbox" class="switch myswitch" cstate="" id="myswitch{{$messages_val->id}}" cid="{{$messages_val->id}}"  data-backdrop="static" data-keyboard="false"/>
                          </div>
                        @endif
                    </td>
                    <td>{{  $messages_val->created_at->format('F d, Y') }}</td>
                     <td>
                    {{-- @if(in_array("22", $modulePermission)) --}}
              <a onclick="show_detail({{$messages_val->id}})" class="btn btn-info pull-left fa fa-eye" style="margin-right: 3px;color:#fff" title="View"></a>
               <a href="{{ route('messages.edit', $messages_val->id) }}" class="btn btn-info pull-left fa fa-pencil-square-o" style="margin-right: 3px;" title="Edit"></a>
  
                   {{-- @if(in_array("20", $modulePermission)) --}}
                   {{ Form::open(['method' => 'DELETE','style'=>'width: 12%;float: left;', 'route' => ['messages.destroy', $messages_val->id] ]) }}
                    <button type="submit" class="btn btn-danger la la-trash" title="Delete" onclick="return confirm('Do You want to Delete?')"></button>
                    {{ Form::close() }}
                     {{-- @endif --}}
                   
                    
                    </td>
                   
            </tr>
              @php $count++; @endphp
              @endforeach
            </tbody>
            <tr>
              <td colspan="11">
                <?php 
             if(isset($_GET['title']))
               {
               ?>
                 {{ $messages->appends(['title' => $_GET['title']])->links() }}
              <?php  }
             else
             {
              ?>
             {{ $messages->links() }}
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 800px;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Message Template</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"  >
         <div class="col-md-12">
              <div class="form-group">
                <b>Template Title</b>
              
                <div id="msg_title">
               
                </div>
         
               </div>
          </div>
         
          <div class="col-md-12">
              <div class="form-group">
               <b> Description</b>
              

                <div id="msg_des">
               
                </div>
         
               </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('assets/backend') }}/js/pages/custom/user/list-datatable.js?v=7.0.6"></script>
</script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"/>
 <!-- BEGIN PAGE LEVEL PLUGINS -->
       
        <!-- END PAGE LEVEL PLUGINS -->
<script type="text/javascript">
function show_detail(id)
{
  $('#msg_title').html($('#msgtitle'+id).html());
  $('#msg_des').html($('#msgdes'+id).html());
  $('#exampleModal').modal('show');
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
function template_preview(temp_id)
{
	console.log(temp_id);
	 $.ajax({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '<?php echo URL('/') ?>/admin/messages/tempprview',
        type: 'GET',
        data: {temp_id:temp_id},
        success:function(response) {
			console.log(response,'responce');
       
        },
        error:function(){ alert('error');}
        }); 
}
</script>

@endsection