<button id = "rzp-button1" style="display: none;">Pay</button>
<input type="hidden" id="store_id" name="store_id" value="{{$data['store_id']}}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src = "https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
 $(document).ready(function(){
     $('#rzp-button1').trigger('click'); 
  });
  
   
  var options = {
    "key": "rzp_test_j4Qly3lpNWA6ai",
    "subscription_id": "{{$data['subscription_id']}}",
    "name": "Amigos",
    // "description": "Monthly Test Plan",
    "image": "{{asset('/public/assets/img/logo.png')}}",
    //"callback_url": "{{URL('/api')}}/paymentdone/",
    "handler": function(response) {
      var store_id=$('#store_id').val();
      // alert(store_id),
      // alert(response.razorpay_subscription_id),
      // alert(response.razorpay_signature);
      window.location="{{URL('/api')}}/paymentdone/?payment_id="+response.razorpay_payment_id+"&subscription_id="+response.razorpay_subscription_id+"&signature="+response.razorpay_signature+"&store_id="+store_id+"";
    },
     "prefill": {
      "name": "{{$store->name}}",
      "email": "{{$store->email}}",
      "contact": "+91{{$store->mobile_number}}"
    },
  };
var rzp1 = new Razorpay(options);
document.getElementById('rzp-button1').onclick = function(e) {
  rzp1.open();
  e.preventDefault();
}

$('#modal-close').hide();
</script>

<!-- <button id = "rzp-button1">Pay</button>
<script src = "https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  var options = {
    "key": "key_id",
    "subscription_id": "sub_00000000000001",
    "name": "Acme Corp.",
    "description": "Monthly Test Plan",
    "image": "/your_logo.png",
    "callback_url": "https://eneqd3r9zrjok.x.pipedream.net/",
    "prefill": {
      "name": "Gaurav Kumar",
      "email": "gaurav.kumar@example.com",
      "contact": "+919876543210"
    },
    "notes": {
      "note_key_1": "Tea. Earl Grey. Hot",
      "note_key_2": "Make it so."
    },
    "theme": {
      "color": "#F37254"
    }
  };
var rzp1 = new Razorpay(options);
document.getElementById('rzp-button1').onclick = function(e) {
  rzp1.open();
  e.preventDefault();
}
</script> -->

<style type="text/css">
  .close
  {
    display: none ! important;
  }
</style>