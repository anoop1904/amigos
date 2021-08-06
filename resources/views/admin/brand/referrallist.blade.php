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
     <div class=" container ">
        <!--begin::Card-->
        <div class="card card-custom">
           <!--begin::Header-->
           <div class="card-header flex-wrap border-0 pt-6 pb-0">
              <div class="card-title">
                 <h3 class="card-label">
                    Referral List ({{$student['name']}})
                    <span class="d-block text-muted pt-2 font-size-sm">Student Referral List</span>
                 </h3>
              </div>
             <div class="card-toolbar">
              <a class="btn btn-success" href="<?php echo URL('/') ?>/admin/student"><i class="icon-2x text-dark-50 flaticon-reply"></i> Go To Back</a>
             </div>
           </div>
           <!--end::Header-->
           <!--begin::Body-->
                <div class="card-body">
          
          {{-- @if(in_array("19", $modulePermission)) --}}
         
            </div>
            <div style="width: 100%" id="message">
              
            </div>
        <table class="table" id="myTable" style="margin-top: 20px;">
             <thead>
              <tr>
                <th width="5%">Sr. No.</th>
                <th width="10%">Referred By Name</th>
                <th width="10%">Referred To Name </th>
                <th width="5%">Referred By credit</th>
                <th width="2%">Referred To credit</th>
                <th width="3%">Approval Status</th>
                <th width="5%">Date</th>
                
                </tr>
            </thead>
             <tbody>
           @php $count = 1; $totalreferraby=0;$totalapprove=0;$totalunapprove=0;
            $totalreferrato=0;@endphp
            @foreach ($referrallist as $key=> $referra)
            <?php 
            $reffbyname=singledata('student','id',$referra->referred_by);
            $refftoname=singledata('student','id',$referra->referred_to);
            $referraby='-';
            $referrato='-';
            if($student['id']==$referra->referred_by)
            {
              $referraby=$referra->referred_by_credit;
              $totalreferraby=$totalreferraby+$referraby;
              if($referra->approval_status =='1')
              {
                $totalapprove=$totalapprove+$referraby;
              }else
              {
                $totalunapprove=$totalunapprove+$referraby;
              }
            }
            else
            {
              $referrato=$referra->referred_to_credit;
              $totalreferrato=$totalreferrato+$referrato;
              if($referra->approval_status =='1')
              {
                $totalapprove=$totalapprove+$referrato;
              }else
              {
                $totalunapprove=$totalunapprove+$referrato;
              }
            }
            ?>
            <tr>
                    <td>{{$count}}</td>
                    <td>{{ !empty($reffbyname->name) ? $reffbyname->name:''  }}</td>
                    <td>{{ !empty($refftoname->name) ? $refftoname->name:''  }}</td>
                    <td> {{ $referraby!='-' ? 'Kr '.$referraby : $referraby}}</td>
                    <td>{{ $referrato!='-' ? 'Kr '.$referrato : $referrato}} </td>
                    <td >
                    @if($referra->approval_status =='1')
                    <i class="text text-success fa fa-check"></i>
                    @else
                    <i class="text text-danger fa fa-remove"></i>
                    @endif
                    </td>
                    <td>{{  $referra->created_at->format('F d, Y') }}</td>
            </tr>
              @php $count++; @endphp
              @endforeach
            </tbody>
             <tr>
              <td colspan="3" style="text-align: right;">
                <b>Total : </b>
              </td>
              <td> <b>Kr {{ number_format($totalreferraby,2)}}</b></td>
              <td> <b>Kr {{ number_format($totalreferrato,2)}}</b></td>
               <td colspan="2">
                 <b>Kr {{ number_format($totalreferraby+$totalreferrato,2)}}</b> 
              </td>
            </tr>
            <tr>
              <td colspan="3" style="text-align: right;">
                <b>Unapproved Total : </b>
              </td>
              <td> <b>Kr {{ number_format($totalunapprove,2)}}</b></td>
              <td> <b>Approved Total : </b></td>
               <td colspan="2">
                  <b>Kr {{ number_format($totalapprove,2)}}</b>
              </td>
            </tr>
            <tr>
              <td colspan="7">
                <?php 
             if(isset($_GET['date'])&&  isset($_GET['status']))
               {
               ?>
                 {{ $referrallist->appends(['date' => $_GET['date'],'status' => $_GET['status']])->links() }}
              <?php  }
             else
             {
              ?>
             {{$referrallist->links()}}
            <?php } ?>
              </td>
            </tr>
          </table>
          
          {{-- @endif --}}
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