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
          <form method="POST" action="{{URL('/admin/updateInventory')}}">
            
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
             <input type="hidden" name="eid" value="{{$edit_data->id}}">
            <div class="row"> 
            
                <div class="col-md-3">
                  <div class="form-group">
                   {{ Form::label('Store', 'Store') }}
                   <span class="text text-danger">*</span>
                    <div>
                       
                 <select class="form-control select2" name="store" required="">
                    <option value="" selected="" disabled="">Select Store</option>
                    @foreach($stores as $key => $store)
                    <option <?php  if($edit_data->store_id==$store->id){ echo "selected";} ?> value="{{$store->id}}">{{$store->name}}</option>
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
                     @foreach($categoties as $key => $categoty)
                    <option <?php  if($edit_data->category_id==$categoty->id){ echo "selected";} ?> value="{{$categoty->id}}">{{$categoty->name}}</option>
                    @endforeach
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
                      @foreach($subcategorylist as $key => $subcategory)
                    <option <?php  if($edit_data->sub_category_id==$subcategory->id){ echo "selected";} ?> value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                    @endforeach
                    </select>
                    </div>
                  </div>
                </div>
           
           
                <div class="col-md-3">
                  <div class="form-group">
                  {{ Form::label('Product', 'Product') }}
                  <span class="text text-danger">*</span>
                  <div>
                     
                 <select class="form-control select2" name="product" id="product" required="required">
                    <option value="" selected="" disabled="">Select Product</option>
                    @foreach($products as $key => $product)
                    <option <?php  if($edit_data->product_id==$product->id){ echo "selected";} ?> value="{{$product->id}}">{{$product->name}}</option>
                    @endforeach
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
                    {{ Form::text('weight',$edit_data->weight, array('class' => 'form-control only-numeric','placeholder'=>'Weight')) }}
                  </td>
                  <td style="width: 10%;"> 
                     <select class="form-control select2"  name="unit" required="">
                      <option value="" selected="" disabled="">Unit</option>
                      @foreach($unitlist as $key => $unit)
                      <option <?php  if($edit_data->unit==$unit->id){ echo "selected";} ?> value="{{$unit->id}}">{{$unit->name}}</option>
                      @endforeach
                     </select>
                   </td>
                  <td style="width: 10%;">
                    {{ Form::text('quantity',$edit_data->qty, array('class' => 'form-control only-numeric','placeholder'=>'Quantity')) }}
                  </td>
                  <td style="width: 10%;">
                     {{ Form::text('price',$edit_data->price, array('class' => 'form-control only-numeric','placeholder'=>'Price')) }}
                  </td>
                  <td style="width: 15%;">
                     {{ Form::text('internalprice',$edit_data->internal_price, array('class' => 'form-control only-numeric','placeholder'=>'Internal Price')) }}
                  </td>
                  <td style="width: 10%;">
                    {{ Form::text('discount',$edit_data->discount, array('class' => 'form-control only-numeric','placeholder'=>'Discount')) }}
                  </td>
                  <td> 
                    <select class="form-control" name="discount_type" id="discount_type">
                      <option value="0" <?php  if($edit_data->discount_type==0){ echo "selected";} ?>>No Discount</option>
                      <option value="1" <?php  if($edit_data->discount_type==1){ echo "selected";} ?>>Flat</option>
                      <option value="2" <?php  if($edit_data->discount_type==2){ echo "selected";} ?>>Percentage</option>
                    </select>
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
                
                <button type="submit" class="btn btn-primary waves-effect waves-light"> Submit </button>
                
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
  $(document).on('change','.subcategory',function(){
    var category = $('#category').val();
    var subcategory = $(this).val();
    console.log("category = "+category+" subcategory = "+subcategory);
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
   // var rid = $(this).attr('rid');
  //  var new_rid = parseInt(rid) + parseInt($(this).attr('rid'));
    var html = '<table style="width: 100%"><tr><td style="width: 20%;">{{ Form::text("weight[]","", array("class" => "form-control only-numeric","placeholder"=>"Weight")) }}</td><td style="width: 10%;"><select class="form-control select2"  name="unit[]" required=""><option value="" selected="" disabled="">Unit</option>@foreach($unitlist as $key => $unit)<option value="{{$unit->id}}">{{$unit->name}}</option> @endforeach</select> </td><td style="width: 10%;"> {{ Form::text("quantity[]", "", array("class" => "form-control only-numeric","placeholder"=>"Quantity")) }} </td><td style="width: 10%;"> {{ Form::text("price[]","", array("class" => "form-control only-numeric","placeholder"=>"Price")) }} </td><td style="width: 15%;"> {{ Form::text("internalprice[]","", array("class" => "form-control only-numeric","placeholder"=>"Internal Price")) }} </td><td style="width: 10%;">{{ Form::text("discount[]","", array("class" => "form-control only-numeric","placeholder"=>"Discount")) }}</td><td> <select class="form-control" name="discount_type[]" id="discount_type"> <option value="0">No Discount</option><option value="1">Flat</option><option value="2">Percentage</option></select></td><td style="width: 5%;"><button class="btn btn-info pull-left la la-trash"  onclick="removeRow(this)"</td></tr></table>';
        // html += '<div class="row form-group" rid="'+new_rid+'">';
        // html += '<div class="col-sm-4">';
        // html += '<select class="form-control category select2" rid="'+new_rid+'" name="category[]" required="">';
        // html += '<option value="" selected="" disabled="">Select Category</option>';
        // @foreach($categoties as $key => $categoty)
        //   html += '<option value="{{$categoty->id}}">{{$categoty->name}}</option>';
        // @endforeach
        // html += '</select>';
        // html += '</div>';
        // html += '<div class="col-sm-4">';
        // html += '<select class="form-control select2" name="product[]" id="product'+new_rid+'" required="">';
        // html += '<option>Select Product</option>';
        // // html += '<option>One</option>';
        // html += '</select>';
        // html += '</div>';
        // html += '<div class="col-sm-3">';
        // html += '<input type="number" class="form-control" name="qty[]" placeholder="QTY" required="">';
        // html += '</div>';
        // html += '<div class="col-sm-1">';
        // html += '<button class="btn btn-info pull-left la la-trash" rid="'+new_rid+'" onclick="removeRow(this,'+new_rid+')">&#xf014;</button>';
        // html += '</div>';
        // html += '</div>';
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
@endsection