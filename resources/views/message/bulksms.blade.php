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
  .viewarea{
    background: lightgray;
    width: 50%;
    margin-left: 27%;
    margin-top: 3%;
    padding: 18px;
    border-radius: 13px;
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
               {{ Form::open(array('url' => 'admin/sendbulksms', 'enctype'=>'multipart/form-data','id' => 'userForm')) }}
        			  <div class="row">
        			     
        				  <div class="col-md-6">


                <div class="form-group">
                   {{ Form::label('Select store/Customer', 'Select Store/Customer') }}
                   <span class="text text-danger">*</span>
                    <div>     
                 <select class="form-control select2 select_type" name="select_type" class="select_type" required="">
                      <option   value="2">Customer</option>
                     <option   value="1">Store</option>
				           </select>
                    </div>
                  </div>

                  <div class="form-group">
                   {{ Form::label('Sms Template', 'Sms Template') }}
                   <span class="text text-danger">*</span>
                    <div>     
                 <select class="form-control select2 smstemplate" name="smstemplate" required="">
                    <option value="" >Select Sms Template</option>
                    @foreach($sms_template as $key => $smstemplate)
                    <option <?php if(isset($_GET['smstemplate'])){ if($_GET['smstemplate']==$smstemplate->id){ echo "selected";}} ?> value="{{$smstemplate->id}}">{{$smstemplate->title}}</option>
                    @endforeach
                  </select>
                    </div>
                  </div>
             
                  <div class="form-group customers">
                   {{ Form::label('Customers', 'Customers') }}
                   <span class="text text-danger">*</span>
                    <div>
                   <select class="form-control select2 customers" name="customers[]" multiple="" required="">
                    <option value="" >Select SCustomers</option>
                    @foreach($customer as $key => $customers)
                    <option <?php if(isset($_GET['customers'])){ if($_GET['customers']==$customers->id){ echo "selected";}} ?> value="{{$customers->id}}">{{$customers->name}}</option>
                    @endforeach
                  </select>
                    </div>
                  </div>

                  
                  <div class="form-group stores" style="display:none;" >
                   {{ Form::label('Stores', 'Stores') }}
                   <span class="text text-danger">*</span>
                    <div>
                   <select class="form-control select2 stores" name="stores[]" multiple="" >
                    <option value="all" >All</option>
                    @foreach($store as $key => $store_val)
                    <option <?php if(isset($_GET['store_val'])){ if($_GET['store_val']==$store_val->id){ echo "selected";}} ?> value="{{$store_val->id}}">{{$store_val->name}}</option>
                    @endforeach
                  </select>
                    </div>
                  </div>

                <div class="form-group">
					          <button type="submit" class="btn btn-success" >Submit</button>
					      </div>
                </div>
				
				 <div class="col-md-6">
				 <div class="viewarea" style="display:none;" >
				 <p class="temp_body"></p>
				 </div>
				  </div>
				  
				</div>
				
				
		   {!! Form::close() !!}
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
  $(".viewarea").hide();
  
  $('input[name="date_filter"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
  });

});

 $( function() {
    $('.select2').select2({ width: '100%' });  
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



$(document).on('change','.smstemplate',function(){
	var id=$(this).val();
	console.log(id);
	  $.ajax({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{URL('admin/getSmsTemplate')}}",
        type: 'POST',
        data: {id:id},
        success:function(response) { 
          var obj = JSON.parse(response);
		
          if(obj.status){
			  $(".viewarea").show();
			  $( ".temp_body" ).text(obj.temp_details[0]['body']);
          } 

        },
        error:function(){ alert('error');}
        }); 
});


$(document).on('change','.select_type',function(){
 var id = $(".select_type").val();
 
 if(id==1){
  $('.customers').hide(); 
  $('.stores').show();
 }else{
  $('.stores').hide(); 
  $('.customers').show();
 }

});
</script>
<script src="{{ asset('assets/backend') }}/js/pages/custom/user/list-datatable.js?v=7.0.6"></script>
</script>

@endsection