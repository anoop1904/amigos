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
  .select2-selection--single
  {
    height: 40px ! important;
  }
   .select2-container--default .select2-selection--single .select2-selection__rendered
  {
    line-height: 19px !important;
  }
</style>   
<style> 
.new_row{
  margin-top: 14px;
    margin-bottom: 8px;
    border: 2px solid black;
    margin: 12px;
    padding: 22px;
    background:#e6dfdf4d;
}
</style> 
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
   <!--begin::Container-->
     <div class=" container ">



        <!--begin::Card-->
        <div class="card card-custom">
           <!--begin::Header-->
                      <div class="row new_row">
                      <div class="col-sm-5" >
                      </div>
                      <div class="col-sm-5" >
                      <h3 style="margin: 8px 0px 0px 72px;font-size: 16px;" >Update Menual Stock/Inventory</h3>
                      </div>
                          <div class="col-sm-2" >
                          <a type="button" class="btn btn-primary inventory_btn_title "  href="{{URL('/admin/inventory/create')}}"> + &nbsp;Inventory</a>
                          </div>
                      </div>

                     <h4 style="text-align:center;margin-bottom:0px;" > OR </h4>
                    

                      <form action="{{ URL('admin/file_format') }}" method="POST" enctype="multipart/form-data" style="margin-bottom:20px;" >
                      <div class="row new_row" >
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="col-sm-2 " >
                      <p style="margin-bottom: -7px;" > Download format category and subcategory wise for bulk upload </p>
                      </div>

                       <div class="col-sm-4">
                         <select class="form-control select2 downloadcategory"  required name="downloadcategory">
                          <option value="">Select Category</option>
                           @foreach($categoties as $key => $categoty)
                            <option value="{{$categoty->id}}">{{$categoty->name}}</option>
                            @endforeach
                         </select>
                       </div> 
                        <div class="col-sm-4" >
                         <select class="form-control select2 downloadsubcategory" name="downloadsubcategory" required="required" id="downloadsubcategory">
                          <option value="">Select Subcategory</option>
                         </select>
                       </div>
                      
                         <div class="col-sm-2 " >
                          <button class="btn btn-primary"  type="submit">Format</button>
                         </div>
                               
                      </div>
                       </form>
                       <h4 style="text-align:center;margin-bottom:0px;margin: -19px 0px 0px 0px;" > AND </h4>
                       <form action="{{ URL('admin/uploadProduct') }}" method="POST" enctype="multipart/form-data" style="margin-bottom:20px;">
                      <div class="row new_row"  >
                      <div class="col-sm-2">
                      <p style="margin-bottom: -7px;" > Upload csv file </p>
                     
                      </div>
                        <div class="col-sm-4">
                          <select class="form-control select2" name="store_id" required="" >
                            @foreach($stores as $key => $store)
                            <option value="{{$store->id}}">{{$store->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-sm-4">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="file" name="file" required="">
                        </div>
                        <div class="col-sm-2 " >
                          <button class="btn btn-warning">Upload</button>
                        </div>
                      </div>
                    </form>
                 
       

           <!--end::Header-->
           <!--begin::Body-->
           <div class="card-body">
              @if(Session::has('message'))
                <div class="alert alert-success login-success">
                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('message') !!} 
                </div>
              @endif
              @if(Session::has('error'))
                <div class="alert alert-danger login-success">
                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('error') !!} 
                </div>
              @endif
              <form class="kt-form kt-form--fit mb-15" method="get">
                      <div class="row">
                       
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
                <div class="col-md-3">
                     <div class="form-group">
                    {{ Form::label('Category', 'Category') }}
                    <span class="text text-danger">*</span>
                    <div>
                     <select class="form-control category select2" name="category" required="" id="category">
                    <option value="all" selected="required" >All</option>
                     @foreach($categoties as $key => $categoty)
                    <option <?php if(isset($_GET['category'])){ if($_GET['category']==$categoty->id){ echo "selected";}} ?> value="{{$categoty->id}}">{{$categoty->name}}</option>
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
                     <select class="form-control subcategory select2" name="subcategory" id="subcategorylist">
                     <option value="all"  >All</option>
                      @foreach($subcategorylist as $key => $subcategory)
                    <option <?php if(isset($_GET['subcategory'])){ if($_GET['subcategory']==$subcategory->id){ echo "selected";}} ?> value="{{$subcategory->id}}">{{$subcategory->name}}</option>
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
                     
                 <select class="form-control select2" name="product" id="product" >
                    <option value="all" >All</option>
                     @foreach($productlist as $key => $product)
                    <option <?php if(isset($_GET['product'])){ if($_GET['product']==$product->id){ echo "selected";}} ?> value="{{$product->id}}">{{$product->name}}</option>
                    @endforeach
                  </select>
                  </div>
                  </div>
                </div>
                         <div class="col-lg-3 mb-lg-0 mb-6" style="margin-top: 25px;">
                          <button type="submit" class="btn btn-primary btn-primary--icon" id="kt_search">
                          <span>
                            <i class="la la-search"></i>
                            <span>Search</span>
                          </span>
                        </button>&nbsp;&nbsp;  <a class="btn btn-danger btn-secondary--icon" id="kt_reset" href="<?php echo URL('/') ?>/admin/inventory">
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
                <th width="10%">Store</th>
                <th width="10%">Category</th>
                <th width="10%">Subcategory</th>
                <th width="20%">Product</th>
                <th width="20%">Weight</th>
                <th width="20%">Price</th>
                <th width="15%">Current Stock</th>
               <!--  <th width="15%">Operations</th> -->
                </tr>
            </thead>
            <tbody>
           @php $count = 1; @endphp
            @foreach ($inventories as $inventory)
            @php  
              $categoryname=singledata('tbl_category','id',$inventory->category_id);
             $subcategoryname=singledata('tbl_category','id',$inventory->sub_category_id);
             $unit=singledata('tbl_unit','id',$inventory->unit);
            @endphp
            <tr>
                    
                    <td>{{@$inventory->store->name}}</td>
                    <td>{{@$categoryname->name}}</td>
                    <td>{{@$subcategoryname->name}}</td>
                    <td>
                      {{@$inventory->product->name}}
                     
                    </td>
                    <td>{{@$inventory->weight.$unit->name}}</td>
                    <td>{{$inventory->price}}</td>
                    <td>{{$inventory->stock}}</td>
                    
                   <!--  <td>
                       <a href="{{ route('inventory.edit', $inventory->inventory_entry_id) }}" class="btn btn-info pull-left fa fa-pencil-square-o" style="margin-right: 3px;" title="Edit"></a>

                    </td> -->
            </tr>
            @php $count++; @endphp
            @endforeach
             <tr>
              <td colspan="7">
                <?php 
             if(isset($_GET['name'])&& isset($_GET['email']) && isset($_GET['status']))
               {
               ?>
                 {{ $inventories->appends(['name' => $_GET['name'],'email' => $_GET['email'],'status' => $_GET['status']])->links() }}
              <?php  }
             else
             {
              ?>
             {{ $inventories->links() }}
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


@endsection


@section('extrajs')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="{{ asset('assets/backend') }}/js/pages/custom/user/list-datatable.js?v=7.0.6"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"/>
 <!-- BEGIN PAGE LEVEL PLUGINS -->
 <style type="text/css">
   .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
   /* line-height: 12px !important;*/
}
 </style>      
        <!-- END PAGE LEVEL PLUGINS -->
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2({ width: '100%' });
  });
 $(document).on('change','.downloadcategory',function(){
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
         
          if(obj.status){
           $('#downloadsubcategory').html(obj.result);
          }

        },
        error:function(){ alert('error');}
        }); 

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
         $('#subcategorylist').html('<option value="all">All</option>');
          if(obj.status){
           $('#subcategorylist').append(obj.result);
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
          $('#product').html('<option value="all">All</option>');
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