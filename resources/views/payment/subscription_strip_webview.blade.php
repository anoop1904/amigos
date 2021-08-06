


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
        <h2 class="title">Subscription Payment</h2>
        <hr/>
        <br/>
    
        <div class="row form-group">
          <div class="col-sm-4">Name : {{$plan->name}}</div>
        </div>
        <div class="row form-group">
          <div class="col-sm-4">Price: DKK {{$plan->price}} </div>
        </div>
       
        <form id="subscription-form">
          <div class="form-group">
            {{-- <input type="text" class="form-control" name="name" id="name" value="manish" /> --}}
          </div>
        <br/>
        <div id="card-element" class="MyCardElement">
        <!-- Elements will create input elements here -->
        </div>

        <!-- We'll put the error messages in this element -->
        <div id="card-errors" role="alert"></div>
        <div class="form-group text text-center w-10" style="margin-top: 20px;">
        <button type="submit" id="submit_button" class="btn btn-primary">Subscribe</button>
        </div>
        </form>
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
var plan_id = {{$plan_id}};
// var handle = urlParams.get('handle');
var user_id = {{$user_id}};
var customerId = '{{$student->customerId}}';
var priceId = '{{$plan->plan_id}}';

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
// var cardElement = elements.create("name", { style: style });
card.mount("#card-element");
card.on('change', showCardError);

function showCardError(event) {
  let displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
}

// var card = document.getElementById('card');



var form = document.getElementById('subscription-form');
form.addEventListener('submit', function (ev) {
  

  ev.preventDefault();
  // If a previous payment was attempted, get the latest invoice
  const latestInvoicePaymentIntentStatus = localStorage.getItem(
    'latestInvoicePaymentIntentStatus'
  );
  if (latestInvoicePaymentIntentStatus === 'requires_payment_method') {
    const invoiceId = localStorage.getItem('latestInvoiceId');
    const isPaymentRetry = true;
    // create new payment method & retry payment on invoice with new payment method
    createPaymentMethod({
      card,
      isPaymentRetry,
      invoiceId,
    });
  } else {
    // create new payment method & create subscription
    createPaymentMethod({ card });
  }
});



function createPaymentMethod({ card, isPaymentRetry, invoiceId }) {
  // document.getElementById('submit_button').innerHTML = 'Loading.....';
  // document.getElementById('submit_button').disabled = true;
  // Set up payment method for recurring usage
  document.getElementById('submit_button').innerHTML = 'Loading.....';
  let billingName = 'manish';

  stripe.createPaymentMethod({
      type: 'card',
      card: card
    })
    .then((result) => {
      if (result.error) {
        displayError(result);
        document.getElementById('submit_button').innerHTML = 'Subscribe';
        document.getElementById('submit_button').disabled = false;
      } else {
        if (isPaymentRetry) {
          // Update the payment method and retry invoice payment
          retryInvoiceWithNewPaymentMethod({
            customerId: customerId,
            paymentMethodId: result.paymentMethod.id,
            invoiceId: invoiceId,
            priceId: priceId,
          });
        } else {
          // Create the subscription
          createSubscription({
            customerId: customerId,
            paymentMethodId: result.paymentMethod.id,
            priceId: priceId,
          });
        }
      }
    });
}

function createSubscription({ customerId, paymentMethodId, priceId }) {
  document.getElementById('submit_button').innerHTML = 'Loading.....';
  document.getElementById('submit_button').disabled = true;
  let payload={
      "customerId":customerId,
      "paymentMethodId":paymentMethodId,
      "priceId":priceId,
      "plan_id":plan_id,
      "user_id":user_id
     }

  return (
    fetch(base_url+'/api/create_subscription', {
      method: 'post',
      headers: {
        'Content-type': 'application/json',
      },
      body: JSON.stringify(payload),
    }).then((response) => response.json()).then(json => {
        if(json.status){
            //Need to show error
            
            document.getElementById("errors_message").innerHTML =json.message;
            window.ReactNativeWebView.postMessage(200);    
        }else{
           
           document.getElementById("errors_message").innerHTML =json.message;
           window.ReactNativeWebView.postMessage(204);
        }
        document.getElementById("errors_message").innerHTML =json.message;
        
        document.getElementById('submit_button').innerHTML = 'Subscribe';
        document.getElementById('submit_button').disabled = false;

         //Function to close webview
         MessengerExtensions.requestCloseBrowser(function success() {
         // webview closed
         }, function error(err) {
         // an error occurred
         document.getElementById('submit_button').innerHTML = 'Subscribe';
        document.getElementById('submit_button').disabled = false;
         });

         }).catch((error) => {
          document.getElementById('submit_button').innerHTML = 'Subscribe';
          document.getElementById('submit_button').disabled = false;
        // An error has happened. Display the failure to the user here.
        // We utilize the HTML element we created.
        showCardError(error);
      })
  );
}

  </script>
</html>