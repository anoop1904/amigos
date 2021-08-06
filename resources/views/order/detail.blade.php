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
       <!-- BEGIN PAGE LEVEL PLUGINS -->
       <style type="text/css">
  .table td,.table th {
    border: 1px solid #EBEDF3 ! important;
  }
</style>
        <!-- END PAGE LEVEL PLUGINS -->
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
   <!--begin::Container-->
     <div class="container">
        <!--begin::Card-->
        <div class="card card-custom">
          <div class="card-header flex-wrap border-0 pt-6 pb-0">
              <div class="card-title">
          
              </div>
              <div class="card-toolbar">
                <!--end::Dropdown-->
                 <!--begin::Button-->
                 <a href="{!!URL('admin/abandoned')!!}" class="btn btn-primary font-weight-bolder">
                    <span class="svg-icon svg-icon-md">Back</span>
                 </a>
                 <!--end::Button-->
              </div>
           </div>
           <!--begin::Body-->
           <div class="card-body">
              <table class="table" id="myTable" style="margin-top: 20px;">
                  <thead>
                    <tr>
                      <th width="5%">Sr. No.</th>
                      <th width="10%">Image</th>
                      <th width="10%">Product Name</th>
                      <th width="10%">Quantity</th>
                      <th width="10%">Price</th>
                      <th width="10%">Discount Amount</th>
                      <th width="10%">Amount</th>
                      {{-- <th width="10%">User Name</th>
                      <th width="10%">Store Name</th> --}}
                      <th width="10%">Date</th>
                      {{-- <th width="5%">Operation</th> --}}
                      </tr>
                  </thead>
                  <tbody>
                    @php $count = 1; $link='';$total=0;$discount_total=0; @endphp
                    @foreach ($carts as $key=> $value)
                      <tr>
                              <td>{{$count}}</td>
                              <td>
                                  <?php
                                  $url = 'assets/images/user.png';
                                  if($value->product && $value->product->profile_pic){
                                    $url = '/public/assets/img/product/'.$value->product->profile_pic;
                                  }
                                  ?>
                                  <img src="{{asset($url)}}" style="height: 80px;width: 80px;">
                              </td>
                              <td>{{ $value->product->name }}</td>
                              <td>{{ $value->qty }}</td>
                              <td>{{ $value->product->price }}</td>
                              <td>
                                @php 
                                  $payble_price = (int)$value->product->price; 
                                  $total += $payble_price;
                                  $discount_amount = 0; 
                                   
                                @endphp
                                  @if($value->product->discount_type == 1)
                                    @php $discount_amount = $value->product->discount;
                                    $payble_price = (int)$value->product->price -$discount_amount; @endphp
                                  @elseif($value->product->discount_type == 2)
                                    @php 
                                    $discount_amount = ((int)$value->product->price*$value->product->discount)/100;
                                    $payble_price = (int)$value->product->price - $discount_amount; 
                                    @endphp
                                  @endif
                                  @php $discount_total += $discount_amount; @endphp
                                {{$discount_amount}}
                              </td>
                              <td>{{$payble_price}}</td>
                              {{-- <td>{{ $value->product->name }}</td> --}}
                              {{-- <td>{{ $value->store?$value->store->name:"NA" }}</td> --}}
                              <td>{{ $value->created_at->format('F d, Y') }}</td>
                              
                      </tr>
                      @php $count++; @endphp
                    @endforeach
                    <tr>
                      <td colspan="5"></td>
                      <td colspan="3">
                        <table class="table">
                          <tr>
                            <td>Total</td>
                            <td>{{$total}}</td>
                          </tr>

                          <tr>
                            <td>Discount</td>
                            <td>{{$discount_total}}</td>
                          </tr>

                          <tr>
                            <td>Grand Total</td>
                            <td>{{$total - $discount_total}}</td>
                          </tr>

                        </table>
                      </td>
                    </tr>
                  </tbody>
                  
              </table>
            </div>
          {{-- @endif --}}
        </div>
           <!--end::Body-->
      </div>
         
        <!--end::Card-->
</div>
   <!--end::Container-->

@endsection


@section('extrajs')

<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"/>
 <!-- BEGIN PAGE LEVEL PLUGINS -->
       
        <!-- END PAGE LEVEL PLUGINS -->
<script type="text/javascript">

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

function ambassador_status(userid,status)
{
  var msg='';
  var ambassadorstatus='';
  var alert='';
  var val='';
  var html='';
  if(status==0)
  {
    msg='Student successfully remove from ambassador list.';
    ambassadorstatus='<i class="text text-danger fa fa-remove"></i>';
    alert=' remove from ambassador list?';
    val=1;
    html='<i class="text fa fa-plus"></i>';
  }
  else
  {
    msg='Student successfully added in ambassador list.';
    ambassadorstatus='<i class="text text-success fa fa-check"></i>';
    alert=' added in ambassador list?';
    val=0;
    html='<i class="text fa fa-remove"></i>';
  }
  var r=confirm('Do you want'+alert);
  if(r)
  {
    $.ajax({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '<?php echo URL('/') ?>/admin/make_ambassador',
        type: 'POST',
        data: {userid:userid,status:status},
        success:function(response) { 
          $('#ambassadoratt'+userid).removeAttr('onclick');
          $('#ambassadoratt'+userid).attr('onclick', 'ambassador_status('+userid+','+val+')');
          $('#ambassadoratt'+userid).html(html);
         $('#message').html('<div class="alert alert-custom alert-success  mb-5" role="alert"> <div class="alert-icon">\
              <i class="flaticon-warning"></i>\
            </div>\
            <div class="alert-text">'+msg+'</div>\
            <div class="alert-close">\
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
                <span aria-hidden="true">\
                  <i class="ki ki-close"></i>\
                </span>\
              </button>\
            </div>\
          </div>') ;
         $('#ambassadorstatus'+userid).html(ambassadorstatus);
        },
        error:function(){ alert('error');}
        }); 
  }
  
    
    
}
    </script>
  <script>
        
        $(function() {
            $('.chk_boxes').click(function() {
                $('.checkbox').prop('checked', this.checked);
            });
        });
    </script>
  <script> 
    $( document ).ready(function() {
      $( ".table" ).wrap( "<div class='table_inner'></div>" );
    });
  </script>
@endsection