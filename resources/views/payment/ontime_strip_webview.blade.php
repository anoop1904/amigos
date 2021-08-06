


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
        <h2 class="title">Payment Detail</h2>
        <hr/>
        <br/>
    
        <div class="row form-group">
          <div class="col-sm-4">Name : {{$items->name}}</div>
        </div>
        <div class="row form-group">
          <div class="col-sm-4">Price: DKK {{$items->price}} </div>
        </div>
       
       <div class="sr-root">
      <div class="sr-main">
               
        <div class="sr-payment-form payment-view">
          <div class="sr-form-row">
            
            <div class="sr-combo-inputs">
              <div class="sr-combo-inputs-row form-group">
                <input
                  type="text"
                  id="name"
                  class="form-control"
                  placeholder="Name"
                  autocomplete="cardholder"
                  class="sr-input"
                />
              </div>
              <div class="sr-combo-inputs-row form-group">
                <div class="sr-input sr-card-element" id="card-element"></div>
              </div>
            </div>
            <div class="sr-field-error" id="card-errors" role="alert"></div>
            <div class="sr-form-row">
              <label class="sr-checkbox-label"><input type="checkbox" id="save-card"><span class="sr-checkbox-check"></span> Save card for future payments</label>
            </div>
          </div>
          <button id="submit"><div class="spinner hidden" id="spinner"></div><span id="button-text">Pay</span></button>
          <div class="sr-legal-text">
            Your card will be charge DKK{{$items->price}}<span id="save-card-text"> and your card details will be saved to your account</span>.
          </div>
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
var item_id = {{$item_id}};
// var handle = urlParams.get('handle');
var user_id = {{$user_id}};
var customerId = '{{$student->customerId}}';
var priceId = 'price_1HHaGLCHKNBUNpgka9AubEx7';
document.querySelector("#name").value = '{{$student->name}}';

function showCardError(event) {
  let displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
}

var orderData = {
  item_id: item_id,
  user_id: user_id,
  currency: "dkk"
};

fetch(base_url+"/api/create_payment_intent", {
  method: "POST",
  headers: {
    "Content-Type": "application/json"
  },
  body: JSON.stringify(orderData)
})
  .then(function(result) {
    return result.json();
  })
  .then(function(data) {
    return setupElements(data);
  })
  .then(function(stripeData) {
    document.querySelector("#submit").addEventListener("click", function(evt) {
      evt.preventDefault();
      // Initiate payment
      pay(stripeData.stripe, stripeData.card, stripeData.clientSecret);
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

var pay = function(stripe, card, clientSecret) {
  var cardholderName = document.querySelector("#name").value;
  var isSavingCard = document.querySelector("#save-card").checked;

  var data = {
    card: card,
    billing_details: {}
  };

  if (cardholderName) {
    data["billing_details"]["name"] = cardholderName;
  }

  changeLoadingState(true);

  // Initiate the payment.
  // If authentication is required, confirmCardPayment will automatically display a modal

  // Use setup_future_usage to save the card and tell Stripe how you plan to charge it in the future
  stripe.confirmCardPayment(clientSecret, {
      payment_method: data,
      setup_future_usage: isSavingCard ? "off_session" : ""
    })
    .then(function(result) {
      if (result.error) {
        changeLoadingState(false);
        var errorMsg = document.querySelector(".sr-field-error");
        errorMsg.textContent = result.error.message;
        setTimeout(function() {
          errorMsg.textContent = "";
        }, 4000);
      } else {
        orderComplete(clientSecret);
        // There's a risk the customer will close the browser window before the callback executes
        // Fulfill any business critical processes async using a 
        // In this sample we use a webhook to listen to payment_intent.succeeded 
        // and add the PaymentMethod to a Customer
      }
    });
};
// Shows a success / error message when the payment is complete
var orderComplete = function(clientSecret) {
  stripe.retrievePaymentIntent(clientSecret).then(function(result) {
    var paymentIntent = result.paymentIntent;
    var paymentIntentJson = JSON.stringify(paymentIntent, null, 2);
    console.log(paymentIntent);
    if(paymentIntent.status === "succeeded"){
      opderPlace(paymentIntent);
    }else{
      document.getElementById("errors_message").innerHTML ="did not complete";
    }
    // document.querySelectorAll(".payment-view").forEach(function(view) {
    //   view.classList.add("hidden");
    // });
    // document.querySelectorAll(".completed-view").forEach(function(view) {
    //   view.classList.remove("hidden");
    // });
    // document.querySelector(".status").textContent =
    //   paymentIntent.status === "succeeded" ? "succeeded" : "did not complete";
    //   alert(paymentIntent.status);
    // document.querySelector("pre").textContent = paymentIntentJson;
  });
};
// window.ReactNativeWebView.postMessage({status:0});

var setupElements = function(data) {
  // stripe = Stripe(data.publicKey);
  var elements = stripe.elements();
  var style = {
    base: {
      color: "#32325d",
      fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
      fontSmoothing: "antialiased",
      fontSize: "16px",
      "::placeholder": {
        color: "#aab7c4"
      }
    },
    invalid: {
      color: "#fa755a",
      iconColor: "#fa755a"
    }
  };

  var card = elements.create("card", { style: style });
  card.mount("#card-element");

  return {
    stripe: stripe,
    card: card,
    clientSecret: data.clientSecret,
    id: data.id
  };
};
function opderPlace(paymentIntentJson){
    //   console.log('----',paymentIntentJson.payment_method);
    //   var orderDetail = {
    //   item_id: item_id,
    //   user_id: user_id,
    //   currency: "dkk",
    //   payment_method:paymentIntentJson.payment_method
    // };
    var isSavingCard = document.querySelector("#save-card").checked;

    var payment_method = isSavingCard?paymentIntentJson.payment_method:'';
    orderData.payment_method = payment_method;
    fetch(base_url+"/api/opderPlace", {
        method: "POST",
        headers: {
        "Content-Type": "application/json"
        },
        body: JSON.stringify(orderData)
      }).then((response) => response.json()).then(function(json) {
        console.log(json);
        if(json.status){
            //Need to show error
            // 
            document.getElementById("errors_message").innerHTML =json.message;
            window.ReactNativeWebView.postMessage(200);    
        }else{
           // 
           document.getElementById("errors_message").innerHTML =json.message;
           window.ReactNativeWebView.postMessage(204);
        }
    })
    .then(function(stripeData) {
    document.querySelector("#submit").addEventListener("click", function(evt) {
      evt.preventDefault();
      // Initiate payment
      pay(stripeData.stripe, stripeData.card, stripeData.clientSecret);
    });
    });

}
</script>
</html>