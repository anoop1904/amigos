


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Stripe Card Elements sample</title>
    <meta name="description" content="A demo of Stripe Payment Intents" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    {{-- <link rel="stylesheet" href="css/normalize.css" /> --}}
    {{-- <link rel="stylesheet" href="css/global.css" /> --}}
    <script src="https://js.stripe.com/v3/"></script>
    {{-- <script src="/script.js" defer></script> --}}
    {{-- <script src="{{ asset('assets/backend/js/client.js') }}"></script> --}}
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </head>

  <body>


    <div class="container">
<div class="row">
  <div class="col-lg-3 col-xs-12"></div>
  <div class="col-lg-6 col-xs-12">
    <div class="sr-root">
        
       
       <div class="sr-root">
        <h2 class="title">Card Detail</h2>
        <hr/>
        <br/>
      <div class="sr-main">
               
        <div class="sr-payment-form payment-view">
          <div class="sr-form-row">
            
            <div class="sr-combo-inputs">
              <div class="sr-combo-inputs-row form-group">
                <label>Name</label>
                <input
                  type="text"
                  id="cardholder-name"
                  class="form-control"
                  placeholder="Name"
                  autocomplete="cardholder"
                  class="sr-input"
                />
              </div>
              <div class="sr-combo-inputs-row form-group">
                <label>Card Detail</label>
                <div class="sr-input sr-card-element" id="card-element"></div>
              </div>
              <div id="card-result"></div>
            </div>
            <div class="sr-field-error" id="card-errors" role="alert"></div>
            <div class="sr-form-row">
              <label class="sr-checkbox-label">
                <span class="sr-checkbox-check"></span> Save card for future payments</label>
            </div>
           
          </div>
           <button id="card-button" class="btn btn-primary"><div class="spinner hidden" id="spinner"></div><span id="button-text">Save Card</span></button>
        </div>
    
      </div>
      
    </div>

        <div id="errors_message" class="errors text text-warning" role="alert"></div>
      </div>
  </div>
  <div class="col-lg-3 col-xs-12"></div>
</div>
  
</div>

       
  </body>

<style type="text/css">
  /**
  * Shows how you can use CSS to style your Element's container.
  */
  .title{
        font-size: 16px;
    text-align: center;
    margin-top: 10px;
    color: #0050ff;
  }
  .my-button{
  text-align: center;
    margin-top: 20px;
  }
  .MyCardElement {
  height: 40px;
  padding: 10px 12px;
  width: 100%;
  color: #32325d;
  background-color: white;
  border: 1px solid transparent;
  border-radius: 4px;

  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
  }

  .MyCardElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
  }

  .MyCardElement--invalid {
  border-color: #fa755a;
  }

  .MyCardElement--webkit-autofill {
  background-color: #fefde5 !important;
  }
</style>
  <script type="text/javascript">
var Publishable_KEY  = '{{ $Publishable_KEY }}';
var stripe = Stripe(Publishable_KEY);
var base_url = "{{URL('')}}";
const urlParams = new URLSearchParams(window.location.search);
var user_id = {{$user_id}};
var customerId = '{{$student->customerId?$student->customerId:''}}';
document.querySelector("#cardholder-name").value = '{{$student->name}}';

var elements = stripe.elements();
var cardElement = elements.create('card');
cardElement.mount('#card-element');

var cardholderName = document.getElementById('cardholder-name');
var cardButton = document.getElementById('card-button');
var resultContainer = document.getElementById('card-result');

cardButton.addEventListener('click', function(ev) {
  changeLoadingState(true);
  stripe.createPaymentMethod({
      type: 'card',
      card: cardElement,
      billing_details: {
        name: cardholderName.value,
      },
    }
  ).then(function(result) {
    if (result.error) {
      changeLoadingState(false);
      // Display error.message in your UI
      resultContainer.textContent = result.error.message;
    } else {
      // You have successfully created a new PaymentMethod
      saveCard(result.paymentMethod.id);
      // resultContainer.textContent = "Created payment method: " + result.paymentMethod.id;
    }
  });
});


// Show a spinner on payment submission
var changeLoadingState = function(isLoading) {
  if (isLoading) {
    document.querySelector("button").disabled = true;
    document.querySelector("#spinner").classList.remove("hidden");
    document.querySelector("#button-text").classList.add("hidden");
  } else {
    document.querySelector("button").disabled = false;
    document.querySelector("#spinner").classList.add("hidden");
    document.querySelector("#button-text").classList.remove("hidden");
  }
};

function saveCard(payment_method_id){
    //   console.log('----',paymentIntentJson.payment_method);
    var orderDetail = {
      user_id: user_id,
      payment_method_id:payment_method_id
    };
    // var isSavingCard = document.querySelector("#save-card").checked;

    // var payment_method = isSavingCard?paymentIntentJson.payment_method:'';
    // orderData.payment_method = payment_method;
    fetch(base_url+"/api/saveCardData", {
        method: "POST",
        headers: {
        "Content-Type": "application/json"
        },
        body: JSON.stringify(orderDetail)
      }).then((response) => response.json()).then(function(json) {
        console.log(json);
        if(json.status){
            //Need to show error
            // 
            changeLoadingState(false);
            document.getElementById("errors_message").innerHTML =json.message;
            window.ReactNativeWebView.postMessage(200);    
        }else{
           // 
           changeLoadingState(false);
           document.getElementById("errors_message").innerHTML =json.message;
           window.ReactNativeWebView.postMessage(204);
        }
    });
}


</script>
</html>