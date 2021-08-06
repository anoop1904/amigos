@extends('layouts.master')

@section('title', '| Users')

@section('content')


<!--begin::Main-->

      
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
                $coupon             = $offer->coupon;
                $from_date           = $offer->from_date;
                $to_date     = $offer->to_date;
                $min_amount      = $offer->min_amount;
                $max_amount             = $offer->max_amount;
                $selected_store = explode(',', $offer->store_ids);             
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
            ?>
            @endif

          
          <div class="row">
          
          </div>
            <div class="row"> 
            
            <div class="col-md-4">
              <div class="form-group">
               {{ Form::label('Store', 'Store') }}
               <span class="text text-danger">*</span>
                <div>
                   
                <select class="form-control select2" name="store[]" multiple="" required="">
                  <option value="" disabled="">Select Store</option>
                  @foreach($stores as $key => $store)
                    @if(in_array($store->id,$selected_store))
                      <option  selected="selected" value={{$store->id}}>{{$store->name}}</option>
                    @else
                      <option  value={{$store->id}}>{{$store->name}}</option>
                    @endif
                  {{-- <option value="{{$store->id}}">{{$store->name}}</option> --}}
                  @endforeach
                </select>

                </div>
              </div>
            </div>

            <textarea class="summernote" name="summernote" id="kt_summernote_1"></textarea>

            <div class="col-md-4">
              <div class="form-group">
               {{ Form::label('Coupon', 'Coupon') }}
               <span class="text text-danger">*</span>
                <div>
                   
               {{ Form::text('coupon', $coupon, array('class' => 'form-control','placeholder'=>'Coupon','id'=>'name')) }}
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
               {{ Form::label('From Date', 'From Date') }}
               <span class="text text-danger">*</span>
                <div>
                   
               {{ Form::text('from_date', $from_date, array('class' => 'form-control','placeholder'=>'From Date','id'=>'from_date')) }}
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
               {{ Form::label('To Date', 'To Date') }}
               <span class="text text-danger">*</span>
                <div>
                   
               {{ Form::text('to_date', $to_date, array('class' => 'form-control','placeholder'=>'To Date','id'=>'to_date')) }}
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
 
</script>
@endsection