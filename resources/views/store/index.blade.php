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
                 <a href="{{ URL('admin/store/create') }}" class="btn btn-primary font-weight-bolder">
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
                          <label>Name</label>
                           <input type="text" name="name" class="form-control" value="<?php if(isset($_GET['name'])){  echo $_GET['name']; } ?>" placeholder="Name" >
                        </div>
                        <div class="col-lg-3 mb-lg-0 mb-6">
                          <label>Email</label>
                        <input type="text" name="email" class="form-control" value="<?php if(isset($_GET['email'])){  echo $_GET['email']; } ?>" placeholder="Email" >
                        </div>
                       <!--  <div class="col-lg-3 mb-lg-0 mb-6">
                            <label>Date Range</label>
                             <input type="text" autocomplete="off" class="form-control" name="date_filter" id="date_filter" value="<?php if(isset($_GET['date_filter'])){  echo $_GET['date_filter']; } ?>"/>
                         </div>

                          <div class="col-lg-3 mb-lg-0 mb-6">
                            <label>Date</label>
                              <input type="date" name="date" class="form-control" value="<?php if(isset($_GET['date'])){  echo $_GET['date']; } ?>" placeholder="Date" >
                          </div> -->
                      
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
                        </button>&nbsp;&nbsp;  <a class="btn btn-danger btn-secondary--icon" id="kt_reset" href="<?php echo URL('/') ?>/admin/store">
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
				<th width="5%">Store Logo</th>
                <th width="5%">Store Name</th>
                <th width="5%">Category</th>
                <th width="5%">Email</th>
                <th width="5%">Contact Number</th>
				<th width="5%">Payment Status</th>
				<th width="5%">Document Status</th>				
                <th width="5%">Status</th>
                <th width="5%">Operations</th>
                </tr>
            </thead>
            <tbody>
           @php $count = 1; @endphp
            @foreach ($stores as $user)
            @php   $category=getCategoryName($user['checkcategory']);@endphp
            <tr>
               
					
					 <td> 
                          <?php
                          $url1 = 'assets/images/user.png';
                          if($user->storelogo){
                          $url1 = '/public/assets/img/store/'.$user->storelogo;
                          }
                          ?>
                          <img src="{{asset($url1)}}" style="height: 80px;width: 80px;">
                    </td>
					
                    <td>{{ $user->name }}</td>
                    <td>{{implode(',',$category)}}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->mobile_number }}</td>
					
					<td>
                        @if($user->payment_status)
                          <div>
                          <span class="text text-success " data_val="<?= $user->id ?>" >Done</span>
						  </div>
                        @else
                          <div>
                          <span class="text text-danger " data_val="<?= $user->id ?>" >Pending</span>
						  </div>
                        @endif
                    </td>
					
					<td>
                        @if(!empty($user->isDocumentApprove))
                          <div>
                          <span class="text text-success " data_val="<?= $user->id ?>" >Verified</span>
						  </div>
                        @else
                          <div>
                          <span class="text text-danger " data_val="<?= $user->id ?>" >Not Verified</span>
						  </div>
                        @endif
                    </td>
					
                    <td>
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

                    <td> 
        <a href="{{ route('store.edit', $user->id) }}" class=" fa fa-pencil-square-o" style="color: black;font-size: 16px;margin-top: 2px;"  title="Edit"></a>
        @if(!$user->payment_status)
		<span class=" fa fa-eye payment_details" style="cursor: pointer;font-size: 20px;" data_val="<?= $user->id ?>,<?= $user->pan_card ?>,<?= $user->aadhar_front ?>,<?= $user->aadhar_back ?>,<?= $user->image ?>,<?= $user->isDocumentApprove ?>"   title="view Document"  ></span>        	
		@endif	 
		 
		{{ Form::open(['method' => 'DELETE', 'route' => ['store.destroy', $user->id],'style'=>'float: left;' ]) }}
        <button type="submit" title="Delete" class=" la la-trash" style="float:left;border: none;font-size: 20px;background: #fff;" onclick="return confirm('Do You want to Delete?')">
        </button> 
     
        
		   {{ Form::close() }}
                    </td>
            </tr>
            @php $count++; @endphp
            @endforeach
             <tr>
              <td colspan="9">
                <?php 
             if(isset($_GET['name'])&& isset($_GET['email']) && isset($_GET['status']))
               {
               ?>
                 {{ $stores->appends(['name' => $_GET['name'],'email' => $_GET['email'],'status' => $_GET['status']])->links() }}
              <?php  }
             else
             {
              ?>
             {{ $stores->links() }}
            <?php } ?>
              </td>
            </tr>
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
<!-- Payment Link modal start -->
<div class="modal fade" style="width:100% !important;" id="payment_link_status" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width:800px !important;" role="document">
    <div class="modal-content">
	  {{ Form::open(array('url' => 'admin/paymentLink', 'enctype'=>'multipart/form-data','id' => 'userForm')) }}
      <div class="modal-header">
        <h5 class="modal-title" id="payment_link_status"><u>Payment Link</u></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  
            <?php 
                $payment_link       = '';	
            ?> 
            <div class="row">
			 <div class="col-md-12 payment_status" id="payment_status"  >
              <div class="form-group">
               {{ Form::label('Payment Type', 'Payment Type') }}
                <select class="form-control select2 payment_method" name="payment_method" >
                  <option selected="selected" value="" disabled="">Payment Type</option>
                  
				  <option   value="0">Phone Pey</option>
				  <option   value="1">Google Pay</option>
				  <option   value="2">UPI</option>
				  <option   value="3">PayTM</option>
                   
                </select>
              </div>
            </div>
			
             <div class="col-md-12">
			 <input type="hidden" name="storeid" id="storeid" />
              <div class="form-group">
               {{ Form::label('Payment Link', 'Payment Link') }}
                <div>
               {{ Form::text('payment_link', $payment_link, array('class' => 'form-control','placeholder'=>'Payment Link','id'=>'payment_link')) }}
                </div>
              </div>
            </div>
			
		
			</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Submit</button>
      </div>
	  {!! Form::close() !!}
    </div>
  </div>
</div>
<!-- Payment Link status modal end -->


<!-- Payment Details modal start -->
<div class="modal fade" style="width:100% !important;" id="payment_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width:800px !important;" role="document">
    <div class="modal-content">
	  {{ Form::open(array('url' => 'admin/docVerified', 'enctype'=>'multipart/form-data','id' => 'userForm')) }}
      <div class="modal-header">
        <h5 class="modal-title" id="payment_details"><u>View Document</u></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="hidden" id="store_id" name="store_id" >
      <div style="width: 40%;float:right">
      <label style="float:right;font-weight: 800;" >Pan Card</label>
       			<img src="" id="store_regi" style="width: 100%;height: 170px;">
      </div>
      <div style="width: 40%;margin-bottom:20px;">
      <label style="font-weight: 800;" >Aadhar Card Front</label>
       			<img src="" id="pan_card" style="width: 100%;height: 170px;">
      </div>
      <div style="width: 40%;float:right">
      <label style="float:right;font-weight: 800;" >Aadhar Card Back</label>
       			<img src="" id="aadhar_front" style="width: 100%;height: 170px;">
      </div>
      <div style="width: 40%">
      <label style="font-weight: 800;">Store Registration</label>
       			<img src="" id="aadhar_back" style="width: 100%;height: 170px;">
      </div>
          
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" onclick="return confirm('Are you sure you want to Verified?');" class="btn btn-primary isVerified" >isVerified</button>
      
      </div>
	  {!! Form::close() !!}
    </div>
  </div>
</div>
<!-- Payment Details modal end -->

@endsection


@section('extrajs')
<script src="{{ asset('assets/backend') }}/js/pages/custom/user/list-datatable.js?v=7.0.6"></script>
</script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"/>
 <!-- BEGIN PAGE LEVEL PLUGINS -->
       
        <!-- END PAGE LEVEL PLUGINS -->
<script type="text/javascript">

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
<script src="{{ asset('assets/backend') }}/js/pages/custom/user/list-datatable.js?v=7.0.6"></script>
</script>
<script>
$(".payment_link_status").on('click', function(event){
var cid = $(this).attr('data_val');
console.log(cid);
$("#storeid").val(cid);
$('#exampleModal').modal('hide');	
$('#payment_link_status').modal('show');
});

$(".payment_details").on('click', function(event){
var doc_Arr=[];
var viewdocument = $(this).attr('data_val');
doc_Arr = viewdocument.split(',');

var doc_img = '<?php echo URL("/") ?>/assets/images/user.png';
var store_regi = '<?php echo URL("/") ?>/public/assets/img/store/'+doc_Arr[1];
var pan_card = '<?php echo URL("/") ?>/public/assets/img/store/'+doc_Arr[2];
var aadhar_front = '<?php echo URL("/") ?>/public/assets/img/store/'+doc_Arr[3];
var aadhar_back = '<?php echo URL("/") ?>/public/assets/img/store/'+doc_Arr[4];

if(doc_Arr[1]==''){ store_regi = doc_img; }  
if(doc_Arr[2]==''){ pan_card =  doc_img;  }
if(doc_Arr[3]==''){ aadhar_front = doc_img; }
if(doc_Arr[4]==''){ aadhar_back = doc_img; }
 
var isVerified = doc_Arr[5];
$(".isVerified").show();
if(isVerified==1){
$(".isVerified").hide();
}

$('#store_regi').attr('src', store_regi);
$('#pan_card').attr('src', pan_card);
$('#aadhar_front').attr('src', aadhar_front);
$('#aadhar_back').attr('src', aadhar_back);
$('#store_id').val(doc_Arr[0]);
$("#Paymetn_storeid").val(viewdocument);

$('#exampleModal').modal('hide');	
$('#payment_details').modal('show');
});
 
</script>


<script>

$(document).on('click','.modal_value',function(){
    var rid = $(this).attr('rid');
	var cid = $(this).attr('data_val');
    console.log("cid = "+cid+" rid = "+rid);
     $.ajax({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{URL('admin/getOrderDetails')}}",
        type: 'POST',
        data: {cid:cid},
        success:function(response) { 
          var obj = JSON.parse(response);
		  console.log(obj);
          if(obj.status){
		   var total=0;
		   var htm ='';
		   $.each(obj.result,function(index,val){
			var waight_unit=val.waight+' '+val.unit.name;
			htm+="<tr><th scope='row'>"+(index+1)+"</th><td>"+val.product.name+"</td><td>"+val.amount+"</td><td>"+waight_unit+"</td><td>"+val.qty+"</td><td>"+(parseFloat(val.qty) * parseFloat(val.amount))+"</td></tr>"
		   total = total + (parseFloat(val.qty) * parseFloat(val.amount));
		   });
		   htm+="<tr><th scope='row' colspan='5' >Total</th><th >"+total+"</th><tr>";
		   console.log(total);
		   $('.tabledata').html(htm);
		   
       $('#exampleModal').modal('show');
          } 

        },
        error:function(){ alert('error');}
        }); 

  });
  
</script>
@endsection