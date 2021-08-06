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
                       
                       <div class="col-md-3">
                  <div class="form-group">
                   {{ Form::label('Customers', 'Customers') }}
                   <span class="text text-danger">*</span>
                    <div>
                       
                 <select class="form-control select2" name="customers" required="">
                    <option value="all" >All</option>
                    @foreach($customer as $key => $customers)
                    <option <?php if(isset($_GET['customers'])){ if($_GET['customers']==$customers->id){ echo "selected";}} ?> value="{{$customers->id}}">{{$customers->name}}</option>
                    @endforeach
                  </select>
                    </div>
                  </div>
                </div>
                           
                     <div class="col-md-3">
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


                           <div class="col-lg-3 mb-lg-0 mb-6">
                            <label>Date Range</label>
                             <input type="text" autocomplete="off" class="form-control" name="date_filter" id="date_filter" value="<?php if(isset($_GET['date_filter'])){  echo $_GET['date_filter']; } ?>"/>
                         </div>
						  
                          <div class="col-lg-3 mb-lg-0 mb-6">
                            <label>Date</label>
                              <input type="date" name="date" class="form-control" value="<?php if(isset($_GET['date'])){  echo $_GET['date']; } ?>" placeholder="Date" >
                          </div>
             
                <div class="col-md-3">
                  <div class="form-group">
                   {{ Form::label('Delivery Boy', 'Delivery Boy') }}
                   <span class="text text-danger">*</span>
                    <div>      
                 <select class="form-control select2" name="delivery_boy" required="">
                    <option value="all" >All</option>
                    @foreach($delevery_boy as $key => $values)
                    <option <?php if(isset($_GET['delivery_boy'])){ if($_GET['delivery_boy']==$values->id){ echo "selected";}} ?> value="{{$values->id}}">{{$values->name}}</option>
                    @endforeach
                  </select>
                    </div>
                  </div>
                </div>

                      
                        <div class="col-lg-3 mb-lg-0 mb-6">
                          <label>Status</label>
                          <select class="form-control" name="status">
						  
                            <option value="all">All</option>
                            <option <?php if(isset($_GET['status'])){ if($_GET['status']=='1'){ echo 'selected';} } ?> value="1" >Pending</option>
                            <option <?php if(isset($_GET['status'])){ if($_GET['status']=='2'){ echo 'selected';} } ?> value="2" >Accept</option>
							<option <?php if(isset($_GET['status'])){ if($_GET['status']=='3'){ echo 'selected';} } ?> value="3" >Placed</option>
                            <option <?php if(isset($_GET['status'])){ if($_GET['status']=='4'){ echo 'selected';} } ?> value="4" >Discard</option>
							<option <?php if(isset($_GET['status'])){ if($_GET['status']=='5'){ echo 'selected';} } ?> value="5" >Delivered</option>
							
                          </select>
                        </div>
                         <div class="col-lg-6 mb-lg-0 mb-6" style="margin-top: 25px;">
                          <button type="submit" class="btn btn-primary btn-primary--icon" id="kt_search">
                          <span>
                            <i class="la la-search"></i>
                            <span>Search</span>
                          </span>
                          </button>&nbsp;&nbsp;  

                        <a class="btn btn-danger btn-secondary--icon" id="kt_reset" href="<?php echo URL('/') ?>/admin/order">
                          <span>
                            <i class="la la-close"></i>
                            <span>Reset</span>
                          </span> 
                        </a>

                          &nbsp;&nbsp;
                          <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-info btn-primary--icon getcheckbox" id="assignorder"> <i class="las la-user-tie"></i>
                            <span>Assign</span>
                          </span></button>
                         

                        </div>
                  </form>




 

          <table class="table" id="myTable" style="margin-top: 20px;">
            <thead>
              <tr>
                <th width="5%">SNO</th>
                <th width="10%">User</th>
                <th width="10%">Store</th>
				<th width="5%">Amount</th>
				<!-- <th width="10%">Order</th> -->
				<th width="5%">Order Date</th>
				<th width="5%">Status</th>
				<th width="10%">Current Assignee</th>
		
               
                </tr>
            </thead>
            <tbody>
         


        <?php $rid = 1; ?>
           @php $count = 1; @endphp
            @foreach ($order as $key=>$value)
            <tr>
                 <td>
                      {{($key+1)}} &nbsp; <input type="checkbox" name="delivery_checkbox[]" id="delivery_checkbox" class="delivery_checkbox" value="{{$value->id}}" > 

                    </td>
					
					@if($value->order_Count()!=0)
					<td value="<?= $value->id ?>" data_val="<?= $value->id ?>" class="modal_value" id="modal_value<?= $rid; ?>"  rid="<?= $rid; ?>" style="color:blue;cursor: pointer;" >{{$value->user_detail() }}</td>
					@else
				    <td>{{$value->user_detail() }}</td>
				  @endif
					
                    
					<td>{{$value->store()}}</td>
					<td>{{$value->offer_amount}}</td>
					<!-- @if($value->order_Count()!=0)
					<td value="<?= $value->id ?>" data_val="<?= $value->id ?>" class="modal_value" id="modal_value<?= $rid; ?>"  rid="<?= $rid; ?>" style="color:blue;cursor: pointer;" >{{$value->order_Count()}}</td>
					@else
					<td>{{$value->order_Count()}}</td>  
				    @endif	  --> 
					<td>{{$value->created_at}}</td>
                      
					<td  >
					@if( $value->status == 1)
                          <div>
                          <span class="text text-info " data_val="<?= $value->id ?>" >Pending</span>
						  </div>
                    @elseif($value->status == 2)
                          <div>
                          <span class="text text-primary " data_val="<?= $value->id ?>" >Accept</span>
						  </div>
					@elseif($value->status == 3)
                          <div>
                          <span class="text text-success " data_val="<?= $value->id ?>" >Placed</span>
						  </div>
				    @elseif($value->status == 4)
					      <div>
                          <span class="text text-danger " data_val="<?= $value->id ?>" >Discard</span>
						  </div>
				    @elseif($value->status == 5)
					      <div>
                          <span style="color:green;" data_val="<?= $value->id ?>" >Delivered</span>
						  </div>
                    @endif
					</td>
					
					
					<td>
				    {{ $value->delivery_boy() }}
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
<div class="modal fade" style="width:100% !important;" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width:800px !important;left:10%" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><u>ORDER DETAILS</u></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Product Name</th>
	  <th scope="col">Price</th>
	  <th scope="col">Weight</th>
      <th scope="col">Quantity</th>
      <th scope="col">Amount</th>
    </tr>
  </thead>
  <tbody class="tabledata" >
 
  </tbody>
  </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>
    </div>
  </div>
</div>


<!-- order status modal start -->
<div class="modal fade" style="width:100% !important;" id="Order_Status_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width:800px !important;" role="document">
    <div class="modal-content">
	  {{ Form::open(array('url' => 'admin/orderStatus', 'enctype'=>'multipart/form-data','id' => 'userForm')) }}
      <div class="modal-header">
        <h5 class="modal-title" id="Order_Status_Modal"><u>ORDER STATUS</u></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  
            <?php 
                $status       = '';
                $description  = '';				
            ?> 
            <div class="row">
             <div class="col-md-12">
              <div class="form-group">
               {{ Form::label('Delivery Status', 'Delivery Status') }}
               <span class="text text-danger">*</span>
                <select class="form-control select2 delivery_status" name="delivery_status" id="delivery_status" required="">
                  <option selected="selected" value="" disabled="">Select Type</option>
				  <option   value="1">Pending</option>
				  <option   value="2">accept</option>
				  <option   value="3">placed</option>
				  <option   value="4">discard</option>
				  <option   value="5">Delivered</option>
                </select>
              </div>
            </div>
			
			 <div class="col-md-12 payment_status" id="payment_status" style="display:none;"  >
              <div class="form-group">
               {{ Form::label('Payment Status', 'Payment Status') }}
                <select class="form-control select2 payment_status" name="payment_status" >
                  <option selected="selected" value="" disabled="">Select Type</option>
                  
				  <option   value="0">Pending</option>
				  <option   value="1">Done</option>
                   
                </select>
              </div>
            </div>
			
			
			 <div class="col-md-12">
			 <input type="hidden" name="orderid" id="orderid" />
              <div class="form-group">
               {{ Form::label('Description', 'Description') }}
                <div>
               {{ Form::textarea('description', $description, array('class' => 'form-control','placeholder'=>'Discription','id'=>'description','row'=>'3')) }}
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
<!-- order status modal end -->


 
 {{ Form::open(array('url' => 'admin/orderAssign', 'enctype'=>'multipart/form-data')) }}
        

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delivery Boy</h4>
      </div>
      <div class="modal-body">
            <input type="hidden" name="orderids" id="orderids" value="" />
                <div class="col-md-12">
                  <div class="form-group">
                   {{ Form::label('Delivery Boy', 'Delivery Boy') }}
                   <span class="text text-danger">*</span>
                    <div>      
                 <select class="form-control select2" name="delivery_id" >
                  <option value="" >-Select User-</option>
                    @foreach($delevery_boy as $key => $values)
                    <option value=<?= $values->id ?> >{{$values->name}}</option>
                    @endforeach
                  </select> 
                    </div>
                  </div>
                </div>

      </div>
      <div class="modal-footer">
       <button type="submit" class="btn btn-warning btn-primary--icon" id="kt_search">Submit</button>  
       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
 {!! Form::close() !!}

@endsection


@section('extrajs')
<script src="{{ asset('assets/backend') }}/js/pages/custom/user/list-datatable.js?v=7.0.6"></script>
</script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"/>
 <!-- BEGIN PAGE LEVEL PLUGINS -->
       
        <!-- END PAGE LEVEL PLUGINS -->
<script type="text/javascript">
  $(document).ready(function(){
  $(".getcheckbox").click(function(){
  var searchIDs = $('input:checked').map(function(){
      return $(this).val();
    });
    var orderid_arry = searchIDs.get();
    if(orderid_arry.length==0)
    {
      alert('Please select atleast one order.');
      return false;
    }
    var orderid = orderid_arry.toString();
    console.log(orderid,'orderid');
    $("#orderids").val(orderid);

  });
});

  

//   $(document).ready(function(){
//   $(".delivery_checkbox").click(function(){
//     if($("#delivery_checkbox").is(':checked')){
//             console.log('checked');
//             console.log($(this).attr('value'));
//             $('#assignorder').removeAttr('disabled');
//     } else {
//             console.log('un checked');
//             console.log($(this).attr('value'));
//     }
//   });

// });


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

 $( function() {
    $('.select2').select2({ width: '100%' });  
  });
  
$(".exampleModal1").on('click', function(event){
$('#Order_Status_Modal').modal('hide');
$('#exampleModal').modal('show');
});

$(".Order_Status_Modal").on('click', function(event){
var cid = $(this).attr('data_val');
console.log(cid);
$("#orderid").val(cid);
$('#exampleModal').modal('hide');	
$('#Order_Status_Modal').modal('show');
});

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
			  
           // $('#subcategory'+rid).html(obj.result);
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


$(document).on('change','.delivery_status',function(){
	var id=$(this).val();
	console.log(id);
	if(id=='5'){
		$("#payment_status").show();
	}else{
		$("#payment_status").hide();
	}
});
  
</script>
<script src="{{ asset('assets/backend') }}/js/pages/custom/user/list-datatable.js?v=7.0.6"></script>
</script>

@endsection