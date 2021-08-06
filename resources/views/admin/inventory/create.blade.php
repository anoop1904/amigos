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
        
          <div class="row">
          
          </div>
          <form method="POST" action="{{URL('/admin/saveInventory')}}">
            
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row"> 
            
                <div class="col-md-3">
                  <div class="form-group">
                   {{ Form::label('Store', 'Store') }}
                   <span class="text text-danger">*</span>
                    <div>
                       
                 <select class="form-control select2 store" name="store" id="store" required="">
                    <option value="" selected="" disabled="">Select Store</option>
                    @foreach($stores as $key => $store)
                    <option value="{{$store->id}}">{{$store->name}}</option>
                    @endforeach
                  </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                     <div class="form-group">
                    {{ Form::label('Category', 'Category') }}
                    <span class="text text-danger">*</span>
                    <div>
                     <select class="form-control category select2" name="category" required="" id="category">
                    <option value="" selected="required" disabled="">Select Category</option>
                   
                  </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                     <div class="form-group">
                    {{ Form::label('Subcategory', 'Subcategory') }}
                    <span class="text text-danger">*</span>
                    <div>
                     <select class="form-control subcategory select2" name="subcategory" required="required" id="subcategorylist">
                     <option value="" selected="" disabled="">Select Subcategory</option>
                    </select>
                    </div>
                  </div>
                </div>
           
           
                <div class="col-md-3">
                  <div class="form-group">
                  {{ Form::label('Product', 'Product') }}
                  <span class="text text-danger">*</span>
                  <div>
                     
                 <select class="form-control product select2" name="product" id="product" required="required">
                    <option value="" selected="" disabled="">Select Product</option>
                    {{-- <option>One</option> --}}
                  </select>
                  </div>
                  </div>
                </div>
            </div>
            <div  >
             <div class="row">
              <table style="width: 100%">
                <tr>
                  <td style="text-align: center;">Weight</td>
                  <td style="text-align: center;">Unit</td>
                  <td style="text-align: center;">Quantity</td>
                  <td style="text-align: center;">Price</td>
                  <td style="text-align: center;">Internal Price</td>
                  <td style="text-align: center;">Discount</td>
                  <td  style="text-align: center;">Discount Type</td>
                  <td></td>
                </tr>
                 <tr>
                  <td style="width: 20%;"> 
                    <!-- <input type="hidden" name="stock_id[]" value="" />
                    {{ Form::text('weight[]','', array('class' => 'form-control only-numeric','placeholder'=>'Weight')) }} -->
                  </td>
                  <td style="width: 10%;"> 
                     <!-- <select class="form-control select2"  name="unit[]" required="">
                      <option value="" selected="" disabled="">Unit</option>
                      @foreach($unitlist as $key => $unit)
                      <option value="{{$unit->id}}">{{$unit->name}}</option>
                      @endforeach
                     </select> -->
                   </td>
                  <td style="width: 15%;">
                    <!-- {{ Form::text('quantity[]','', array('class' => 'form-control only-numeric','placeholder'=>'Quantity')) }} -->
                  </td>
                  <td style="width: 10%;">
                    <!--  {{ Form::text('price[]','', array('class' => 'form-control only-numeric','placeholder'=>'Price')) }} -->
                  </td>
                  <td style="width: 15%;">
                    <!--  {{ Form::text('internalprice[]', '', array('class' => 'form-control only-numeric','placeholder'=>'Internal Price')) }} -->
                  </td>
                  <td style="width: 10%;">
                    <!-- {{ Form::text('discount[]', "", array('class' => 'form-control only-numeric','placeholder'=>'Discount')) }} -->
                  </td>
                  <td> 
                   <!--  <select class="form-control" name="discount_type[]" id="discount_type">
                      <option value="0">No Discount</option>
                      <option value="1">Flat</option>
                      <option value="2">Percentage</option>
                    </select> -->
                  </td>
                  <td style="width: 5%;"></td>
                </tr>
              </table>
              <div id="inventory-data">

              </div>
             </div>

            </div>
             <div class="form-group m-b-0" style="margin-top: 10px;">
              <div>
                 <button type="button" class="btn btn-warning"  id="addMore">Add </button>
                <button type="submit" class="btn btn-primary waves-effect waves-light"> Submit </button>
                <a href="{{ URL('admin/inventory') }}" type="reset" class="btn btn-secondary waves-effect m-l-5"> Cancel </a>
              </div>
             </div>
         </form>
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
<script src="{{ asset('assets/backend') }}/js/pages/custom/user/list-datatable.js?v=7.0.6"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"/>
 <style type="text/css">
   .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 20px !important;
}
.select2-selection--single{
  height: 38px !important;
}

 </style>      
        <!-- END PAGE LEVEL PLUGINS -->
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2({ width: '100%' });
  });
    $(document).on('change','.category',function(){
    //var rid = $(this).attr('rid');
    var category_id = $(this).val();
    console.log("cid = "+category_id);
     $.ajax({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{URL('admin/getSubcategory')}}",
        type: 'POST',
        data: {category_id:category_id},
        success:function(response) { 
          var obj = JSON.parse(response);
          console.log(obj);
          if(obj.status){
           $('#subcategorylist').html(obj.result);
          }

        },
        error:function(){ alert('error');}
        }); 

  });
     $(document).on('change','.product',function(){
    
    var category = $('#category').val();
    var store = $('#store').val();
    var subcategory = $('#subcategorylist').val();
    var product = $(this).val();
     $.ajax({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{URL('admin/getStock')}}",
        type: 'POST',
        data: {store:store,category_id:category,subcategory:subcategory,product:product},
        success:function(response) { 
         var obj = JSON.parse(response);
           console.log("category",obj.result);
           $('#inventory-data').html('');
           $.each(obj.result, function(index, val) {
            var nodiscount='';
            var flat='';
            var percent='';
             if(val.discount_type==0){nodiscount='selected';} else if(val.discount_type==1){flat='selected';}else{percent='selected';}
             if(val.discount==null){val.discount='';}
            $('#inventory-data').append('<table style="width: 100%"><tr><td style="width: 20%;"><input type="hidden" name="stock_id[]" value="'+val.id+'" /><input type="text" class="form-control only-numeric" name="weight[]" placeholder="Weight" value="'+val.weight+'" readonly /></td><td style="width: 10%;"><input type="text" class="form-control only-numeric" name="unit[]" placeholder="Unit" value="'+val.unit.name+'" readonly /></td><td style="width: 15%;"> <input type="text" class="form-control only-numeric" name="current_quantity[]" placeholder="Quantity" value="'+val.stock+'" readonly style="width: 70px;float: left;"/><input type="text" class="form-control only-numeric" name="quantity[]" placeholder="Quantity" value="" style="width: 70px;float: left;"/> </td><td style="width: 10%;"> <input type="text" class="form-control only-numeric" name="price[]" placeholder="Price" value="'+val.price+'" />  </td><td style="width: 15%;"> <input type="text" class="form-control only-numeric" name="internalprice[]" placeholder="Internal Price" value="'+val.internal_price+'"  /> </td><td style="width: 10%;"><input type="text" class="form-control only-numeric" name="discount[]" placeholder="Discount" value="'+val.discount+'"  /></td><td> <select class="form-control" name="discount_type[]" id="discount_type"> <option value="0" '+nodiscount+'>No Discount</option><option value="1" '+flat+'>Flat</option><option value="2" '+percent+'>Percentage</option></select></td><td style="width: 5%;"></td></tr></table>');
           });
          $('.select2').select2({ width: '100%' });
        },
        error:function(){ alert('error');}
        }); 

  });
    
  $(document).on('change','.subcategory',function(){
    var category = $('#category').val();
    var subcategory = $(this).val();
   
     $.ajax({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{URL('admin/getProductByCategory')}}",
        type: 'POST',
        data: {category:category,subcategory:subcategory},
        success:function(response) { 
          var obj = JSON.parse(response);
          if(obj.status){
            $('#product').html(obj.result);
          }

        },
        error:function(){ alert('error');}
        }); 

  });
  function inventoryForm(obj){
    console.log('form submit');
    $( obj ).serialize()
    $('#saveBtn').html('loading....');
    $('#saveBtn').prop('disabled',true);
    $.ajax({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{URL('admin/saveInventory')}}",
        type: 'POST',
        data: $( obj ).serialize(),
        success:function(response) { 
          console.log(response);
          var obj = JSON.parse(response);
          $('#saveBtn').html('Save Changes');
          $('#saveBtn').prop('disabled',false);
          if(obj.status){
            window.location.reload();
          }

        },
        error:function(){ 
          $('#saveBtn').html('Save Changes');
          $('#saveBtn').prop('disabled',false);
          alert('error');
        }
        }); 

    return false;
  }
  $('#addMore').click(function(){
     var html = '<table style="width: 100%"><tr><td style="width: 20%;"><input type="hidden" name="stock_id[]" value="" />{{ Form::text("weight[]","", array("class" => "form-control only-numeric","placeholder"=>"Weight")) }}</td><td style="width: 10%;"><select class="form-control select2"  name="unit[]" required=""><option value="" selected="" disabled="">Unit</option>@foreach($unitlist as $key => $unit)<option value="{{$unit->id}}">{{$unit->name}}</option> @endforeach</select> </td><td style="width: 15%;"> {{ Form::text("quantity[]", "", array("class" => "form-control only-numeric","placeholder"=>"Quantity")) }} </td><td style="width: 10%;"> {{ Form::text("price[]","", array("class" => "form-control only-numeric","placeholder"=>"Price")) }} </td><td style="width: 15%;"> {{ Form::text("internalprice[]","", array("class" => "form-control only-numeric","placeholder"=>"Internal Price")) }} </td><td style="width: 10%;">{{ Form::text("discount[]","", array("class" => "form-control only-numeric","placeholder"=>"Discount")) }}</td><td> <select class="form-control" name="discount_type[]" id="discount_type"> <option value="0">No Discount</option><option value="1">Flat</option><option value="2">Percentage</option></select></td><td style="width: 5%;"><button class="btn btn-info pull-left la la-trash"  onclick="removeRow(this)"</td></tr></table>';
      
    $('#inventory-data').append(html);
    //$(this).attr('rid',new_rid);
    $('.select2').select2({ width: '100%' });
  });
  function removeRow(obj,id){
    $(obj).parent().parent().remove();
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

 $(document).on('change','.store',function(){
    var store_id = $('#store').val();
	console.log(store_id,'store');
    var subcategory = $(this).val();
   
     $.ajax({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{URL('admin/getCatgoryByStore')}}",
        type: 'POST',
        data: {store_id:store_id},
        success:function(response) { 
          var obj = JSON.parse(response);
		  console.log(obj,'obj');
          if(obj.status){
            $('#category').html(obj.result);
          }

        },
        error:function(){ alert('error');}
        }); 

  });
  
</script>
@endsection