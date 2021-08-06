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
           {{ Form::model($offer, array('route' => array('offer.update', $offer->id), 'method' => 'PUT', 'id' => 'storeForm',  'enctype'=>'multipart/form-data')) }} 
            
            <?php  
           
                $coupon              = $offer->coupon;
                $from_date           = $offer->from_date;
                $to_date             = $offer->to_date;
                $min_amount          = $offer->min_amount;
                $max_amount          = $offer->max_amount;
                $selected_store      = explode(',', $offer->store_ids); 
                $coupon_type         = $offer->coupon_type;;
                $discount_type       = $offer->discount_type;;
                $discount_amount     = $offer->discount_amount;
                $body                = $offer->description;
                $image               = $offer->image; 				
            ?>
            {!! Form::hidden('id',$offer->id) !!}
            
            @else
            {{ Form::open(array('url' => 'admin/offer', 'enctype'=>'multipart/form-data','id' => 'userForm')) }}
            <?php 
               
                $coupon             = '';
                $from_date           = '';
                $to_date     = '';
                $min_amount      = '';
                $max_amount             = ''; 
                $selected_store = []; 
                $coupon_type='';
                $discount_type='';
                $discount_amount='';	
                $body = '';				
                $image = '';       
            ?>
            @endif


            <div class="row"> 
			 <?php $rid=1 ?>
             <div class="col-md-4">
              <div class="form-group">
               {{ Form::label('Coupon Type', 'Coupon Type') }}
               <span class="text text-danger">*</span>
                <div>
                   
                <select class="form-control select2 couponType" rid="<?= $rid; ?>" name="coupon_type" value={{$coupon_type}} required="">
                  <option selected="selected" value="" disabled="">Select Type</option>
              	  <option   value="1" @if($coupon_type==1) selected @endif>Store</option>
        				  <option   value="2" @if($coupon_type==2) selected @endif>Offer</option>
                </select>

                </div>
              </div>
            </div>
			
			 <div class="col-sm-4" id="storediv" @if($coupon_type==2) style="display: none;" @endif >
			   <div class="form-group">
			     {{ Form::label('Store', 'Store') }}
               <span class="text text-danger">*</span>
              <select class="form-control select2" name="store_product[]" id="store_product" multiple=""  placeholder="Select Store" >
               
                @if(!empty($stores))

                   @foreach($stores as $store)
                    <option value="{{$store->id}}" @if(in_array($store->id,$selected_store)) selected @endif>{{$store->name}}</option>

                   @endforeach
                  @endif
              
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
                  
				  <option   value="1" @if($discount_type==1) selected @endif>flat</option>
				  <option   value="2" @if($discount_type==2) selected @endif>%</option>
                   
                </select>

                </div>
              </div>
            </div>
			
			
			 <div class="col-md-4">
              <div class="form-group">
               {{ Form::label('Discount Amount', 'Discount Amount') }}
               <span class="text text-danger">*</span>
                <div>
                   
               {{ Form::number('discount_amount', $discount_amount, array('class' => 'form-control','placeholder'=>'Discount Amount','id'=>'discount_amount')) }}
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
               {{ Form::label('From Date', 'From Date') }}
               <span class="text text-danger">*</span>
                <div>
               <input type="date" class="form-control" name="from_date" id="from_date" value=<?= $from_date ?> placeholder="From Date"  />    
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
               {{ Form::label('Up To Amount', 'Up To Amount') }}
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
      <div class="col-md-6">
                  <div class="form-group"> 
                    <label for="Language Code" id="code">Image</label>
                    <div> 
                      <?php
                        $url = 'assets/images/user.png';
                        if($image){
                        $url = 'public/assets/img/offer/'.$image;
                        }
                      ?>
                      <img id="blah" src="{{asset($url)}}" style="height: 150px;width: 150px;">
          @if(Request::segment(4)==='edit')
            <input id="imgInp" type="file" name="file" >
            @else
                <input id="imgInp" type="file" name="file"  required="" >
                    @endif        
          </div>
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



 
 
 $(document).on('change','.couponType',function(){
    var cid = $(this).val();
 
    if(cid==1)
    {
      $('#storediv').show();
     $.ajax({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{URL('admin/getStore')}}",
        type: 'POST',
        data: {cid:cid},
        success:function(response) { 
          var obj = JSON.parse(response);
          if(obj.status){
            $('#store_product').html(obj.result);
          }

        },
        error:function(){ alert('error');}
        }); 
    }
    else
    {
      $('#storediv').hide();
    }

  });
</script>
@endsection