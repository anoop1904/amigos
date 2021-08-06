  @extends('layouts.frontmaster')
  @section('content')
<style type="text/css">
  .table td,.table th {
    border: 1px solid #EBEDF3 ! important;
  }
</style>
      <section class="section pt-5 pb-5" style="background: white;">
         <div class="container">
            <div class="row profile">
                <div class="col-md-3">
                  <div class="profile-sidebar">
                    <!-- SIDEBAR MENU -->
                    <div class="profile-usermenu">
                      @include('includes.usermenu') 
                    </div>
                    <!-- END MENU -->
                  </div>
                </div>
                <div class="col-md-9">
                      <div class="profile-content">
                          <h2>Referral List </h2>
                          <hr>
                         <table class="table" id="myTable" style="margin-top: 20px;">
                              <thead>
                                <tr>
                                  <th width="5%">Sr. No.</th>
                                  <th width="10%">Referred By </th>
                                  <th width="10%">Referred To </th>
                                  <th width="5%">Referred By credit</th>
                                  <th width="2%">Referred To credit</th>
                                  <th width="3%">Approval Status</th>
                                  <th width="5%">Date</th>
                                </tr>
                              </thead>
                              <tbody>
                                  @php $count = 1; $totalreferraby=0;
                                  $totalreferrato=0;@endphp
                                  @foreach($referrallist as $key=> $referra)
                                      <?php 
                                      $reffbyname=singledata('student','id',$referra->referred_by);
                                      $refftoname=singledata('student','id',$referra->referred_to);
                                      $referraby='-';
                                      $referrato='-';
                                      if($student==$referra->referred_by)
                                      {
                                        $referraby=$referra->referred_by_credit;
                                        $totalreferraby=$totalreferraby+$referraby;
                                      }
                                      else
                                      {
                                        $referrato=$referra->referred_to_credit;
                                        $totalreferrato=$totalreferrato+$referrato;
                                      }
                                      ?>
                                      <tr>
                                          <td>{{$count}}</td>
                                          <td>
                                            @if(Auth::guard('student')->user()->name==$reffbyname->name)
                                             Me
                                            @else
                                              {{ !empty($reffbyname->name) ? $reffbyname->name:''  }}
                                            @endif
                                            
                                          </td>
                                          <td>
                                             @if(Auth::guard('student')->user()->name==$refftoname->name)
                                             Me
                                             @else
                                             {{ !empty($refftoname->name) ? $refftoname->name:''  }}
                                             @endif

                                           </td>
                                          <td>{{ $referraby }}</td>
                                          <td>{{ $referrato }}</td>
                                          <td>
                                          @if($referra->approval_status =='1')
                                          Approved
                                          @else
                                          Not Approved
                                          @endif
                                          </td>
                                          <td>{{  $referra->created_at->format('F d, Y') }}</td>
                                      </tr>
                                      @php $count++; @endphp
                                  @endforeach
                                  <tr>
                                      <td colspan="3" style="text-align: right;">
                                        <b>Total : </b>
                                      </td>
                                      <td> 
                                        <b>{{ $totalreferraby}}</b>
                                      </td>
                                      <td> 
                                        <b>{{ $totalreferrato}}</b>
                                      </td>
                                       <td colspan="2">
                                         <b>{{$totalreferraby+$totalreferrato}}</b>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td colspan="7">
                                        {{$referrallist->links()}}
                                      </td>
                                  </tr>
                              </tbody> 
                             
                            </table>


                        </div>
                </div>
              </div>

         </div>
      </section>

 @endsection 
@section('extrajs')
<script type="text/javascript">

  function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#imgInp").change(function() {
  readURL(this);
});

</script>
@endsection