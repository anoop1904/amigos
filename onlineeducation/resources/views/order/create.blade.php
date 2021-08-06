@extends('layouts.master')

@section('title', '| Users')

@section('content')


<!--begin::Main-->


<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

          <!--begin::Entry-->
            <div class="d-flex flex-column-fluid">
               <!--begin::Container-->
               <div class="container ">
                  <!--begin::Dashboard-->
                  <div class="container-fluid">
  <!-- Page-Title -->
  <div class="row">
    <div class="col-sm-12">
      <div class="page-title-box">
        
        {{-- <h4 class="page-title"><i class="fa fa-key"></i>Users Administration</h4> --}}
      </div>
    </div> 
  </div>
      @if (count($errors) > 0)
      <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
          </ul>
      </div>
    @endif
  
  
  @if(Session::has('message'))
    <div class="alert alert-success login-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('message') !!} </div>
  @endif
  <!-- end page title end breadcrumb -->
  
  <div class="row">
    <div class="col-lg-12">
      <div class="card m-b-30">
        <div class="card-body">
          
           @if(Request::segment(4)==='edit')
           {{ Form::model($order, array('route' => array('order.update', $order->id), 'method' => 'PUT', 'id' => 'storeForm',  'enctype'=>'multipart/form-data')) }} 
            
            <?php  
                $store_id        = $order->coupon;
                $offer_id        = $order->from_date;
                $offer_amount    = $order->to_date;
                $order_amount    = $order->min_amount;
                $payable_amount  = $order->max_amount;
                $order_detail = explode(',', $order->store_ids); 				
            ?>
            {!! Form::hidden('id',$order->id) !!}
            
            @else
            {{ Form::open(array('url' => 'admin/order', 'enctype'=>'multipart/form-data','id' => 'userForm')) }}
            <?php 
               
                $store_id       = '';
                $offer_id       = '';
                $offer_amount   = '';
                $order_amount   = '';
                $payable_amount = ''; 
                $order_detail   = [];			
            ?> 
            @endif

          
            <div class="row"> 
			 <?php $rid=1 ?>
             <div class="col-md-4">
              <div class="form-group">
               {{ Form::label('Coupon Type', 'Coupon Type') }}
               <span class="text text-danger">*</span>
                <div>
                   
                <select class="form-control select2 couponType" rid="<?= $rid; ?>" name="coupon_type" required="">
                  <option selected="selected" value="" disabled="">Select Type</option>
                  
				  <option   value="1">Store</option>
				  <option   value="2">Product</option>
                   
                </select>

                </div>
              </div>
            </div>
			
			 <div class="col-sm-4" >
			   <div class="form-group">
			     {{ Form::label('Store / Product', 'Store / Product') }}
               <span class="text text-danger">*</span>
              <select class="form-control select2" name="store_product[]" id="store_product<?= $rid; ?>" multiple="" required="">
                <option value="" selected="" disabled="">Select Store/Product</option>
                {{-- <option>One</option> --}}
              </select>
            </div>
			</div>
			


            <div class="col-md-4">
              <div class="form-group">
               {{ Form::label('Coupon', 'Coupon') }}
               <span class="text text-danger">*</span>
                <div>
                   
               {{ Form::text('coupon', $coupon, array('class' => 'form-control','placeholder'=>'Coupon','id'=>'coupon')) }}
                </div>
              </div>
            </div>
			
			
			    <div class="col-md-4">
              <div class="form-group">
                  {{ Form::label('Discount Type', 'Discount Type') }}
               <span class="text text-danger">*</span>
                <div>
                   
                <select class="form-control select2 discount_type" rid="<?= $rid; ?>" name="discount_type" required="">
                  <option selected="selected" value="" disabled="">Select Type</option>
                  
				  <option   value="1">flat</option>
				  <option   value="2">%</option>
                   
                </select>

                </div>
              </div>
            </div>
			
			
			 <div class="col-md-4">
              <div class="form-group">
               {{ Form::label('Discount Amount', 'Discount Amount') }}
               <span class="text text-danger">*</span>
                <div>
                   
               {{ Form::text('discount_amount', $discount_amount, array('class' => 'form-control','placeholder'=>'Discount Amount','id'=>'discount_amount')) }}
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
               {{ Form::label('From Date', 'From Date') }}
               <span class="text text-danger">*</span>
                <div>
               <input type="date" class="form-control" name="from_date" id="from_date" value={{$from_date}} placeholder="From Date"  />    
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
               {{ Form::label('To Date', 'To Date') }}
               <span class="text text-danger">*</span>
                <div>
                   <input type="date" class="form-control" name="to_date" id="to_date" value={{$to_date}} placeholder="To Date"  />      
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
               {{ Form::label('Min Amount', 'Min Amount') }}
               <span class="text text-danger">*</span>
                <div>
                   
               {{ Form::number('min_amount', $min_amount, array('class' => 'form-control','placeholder'=>'min Amount','id'=>'min_amount')) }}
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
               {{ Form::label('Max Amount', 'Max Amount') }}
               <span class="text text-danger">*</span>
                <div>
                   
               {{ Form::number('max_amount', $max_amount, array('class' => 'form-control','placeholder'=>'Max Amount','id'=>'max_amount')) }}
                </div>
              </div>
            </div>

             
            </div>
			  <div class="row" style="margin-bottom:10px;" > 
			  <div class="col-md-12">
         <textarea name="editor1" class="textarea_editor" id="textarea_editor" rows="6", cols="100" >{{$body}}</textarea>
		  @if ($errors->has('body')) <p class="help-block text text-danger"  >{{ $errors->first('body') }}</p> @endif
        <script>
            CKEDITOR.replace( 'editor1' );
        </script>
		 </div>	
		 </div>
		 
            
           
            <div class="form-group m-b-0">
              <div>
                <button type="submit" class="btn btn-primary waves-effect waves-light"> Submit </button>
                <a href="{{ URL('admin/offer') }}" type="reset" class="btn btn-secondary waves-effect m-l-5"> Cancel </a>
              </div>
            </div>
         {!! Form::close() !!}
        </div>
      </div>
    </div>
    <!-- end col -->
   
    <!-- end col -->
  </div>
  <!-- end row -->
</div>
<!-- end container -->
               </div>
               <!--end::Container-->
            </div>
          <!--end::Entry-->
         
<!--end::Main-->

@endsection

@section('extrajs')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.datetimepicker.css') }}">
<script src="{{ asset('assets/js/jquery.datetimepicker.js') }}"></script>
<script src="{{ asset('assets/js/jquery.datetimepicker.full.min.js') }}"></script>

<style type="text/css">
   .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 12px !important;
}
 </style> 
<script type="text/javascript">
  $( function() {
    $('.select2').select2({ width: '100%' });  
  });

$('#from_date').datetimepicker();
$('#to_date').datetimepicker();

jQuery(function(){
 jQuery('#from_date').datetimepicker({
  format:'Y/m/d',
  onShow:function( ct ){
   this.setOptions({
    maxDate:jQuery('#to_date').val()?jQuery('#to_date').val():false
   })
  },
  timepicker:false
 });
 jQuery('#to_date').datetimepicker({
  format:'Y/m/d',
  onShow:function( ct ){
   this.setOptions({
    minDate:jQuery('#from_date').val()?jQuery('#from_date').val():false
   })
  },
  timepicker:false
 });
});
 
 
 $(document).on('change','.couponType',function(){
	
    var rid = $(this).attr('rid');
    var cid = $(this).val();
    console.log("cid = "+cid+" rid = "+rid);
     $.ajax({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{URL('admin/getProductByCategory')}}",
        type: 'POST',
        data: {cid:cid},
        success:function(response) { 
          var obj = JSON.parse(response);
          if(obj.status){
            $('#store_product'+rid).html(obj.result);
          }

        },
        error:function(){ alert('error');}
        }); 

  });
</script>
@endsection