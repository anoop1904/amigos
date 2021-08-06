  @extends('layouts.frontmaster')
  @section('content')

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
                          <h2>Order List </h2>
                          <hr>
<div class="cMipmx">
    @if(!empty($orderList))
          @php $i=1; @endphp
             @foreach($orderList as $order)
             @php 
               $status=getOrderStatus($order->order_status);
               $items=getUserOrderItems($order->id);
             @endphp
             @foreach($items as $item)
              <div class="bke1zw-1 ZkYIl">
                 <div class="sc-bJHhxl jtHnfj">
                    <div class="sc-fQkuQJ jNbmWu">
                       <div class="sc-epGmkI kKFaqG">
                          <div height="4.5rem" width="4.5rem" class="s1isp7-0 kIMtVu sc-fCPvlr ujUiM">
                             <div src="" class="s1isp7-2 dBjfsr"></div>
                              <?php
                                  $url = 'assets/images/user.png';
                                  if($item->image){
                                    $url = 'public/kitchenfood/'.$item->image;
                                  }
                                ?>

                             <img alt="image" src="{{asset($url)}}" style="width: 70px;height: 50px;" loading="lazy" class="s1isp7-4 bBALuk">
                            
                          </div>
                          <div class="sc-dphlzf iEjzYO">
                             <h4 class="sc-1hp8d8a-0 sc-gAmQfK jJOXTp">{{$item->name}}</h4>
                             
                          </div>
                       </div>
                       <p class="sc-1hez2tp-0 sc-cCVOAp iPshSv">{{$status}}</p>
                    </div>
                    <hr class="sc-iHhHRJ YkSgn">
                    <div class="sc-hCaUpS bvRPjl">
                      <!--  <div class="sc-kDhYZr eCuiCI">
                          <p class="sc-koErNt foAxII">Order Number</p>
                          <p class="sc-gJqsIT gNHFYz">2131486981</p>
                       </div> -->
                       <div class="sc-kDhYZr eCuiCI">
                          <p class="sc-koErNt foAxII">Total Amount</p>
                          <p class="sc-gJqsIT gNHFYz">Kr {{$item->price}}</p>
                       </div>
                       <div class="sc-kDhYZr eCuiCI">
                          <p class="sc-koErNt foAxII">Description</p>
                          <p class="sc-gJqsIT gNHFYz">{{$item->description}}</p>
                       </div>
                       <div class="sc-kDhYZr eCuiCI">
                          <p class="sc-koErNt foAxII">Ordered on</p>
                          <p class="sc-gJqsIT gNHFYz">{{ $order->created_at->format('F d, Y H:i A') }}</p>
                       </div>
                    </div>
                   
                 </div> 
              </div>

                 @php $i++; @endphp
              @endforeach
             @endforeach
          @endif

</div>


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