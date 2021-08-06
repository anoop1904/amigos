
  <script src="https://checkout.reepay.com/checkout.js"></script>
  
  <h1><div  id='error' style='color:red'></div></h1>
      <div id='rp_container' style="width: 500px; height: 730px;"></div>
     
      
   
<script>

//Messenger sdk
(function(d, s, id){
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/messenger.Extensions.js";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'Messenger'));


   var rp = new Reepay.EmbeddedCheckout("<?php echo @$_GET['session_id'] ?>", { html_element: 'rp_container' } );



rp.addEventHandler(Reepay.Event.Accept, function(data) {

   const urlParams = new URLSearchParams(window.location.search);
   
   var item_id = urlParams.get('item_id');
   var handle = urlParams.get('handle');
   var user_id = urlParams.get('user_id');
   var base_url  = "{{URL('/');}}";

  
     let payload={
      "customer":data.customer,
      "payment_method":data.payment_method,
      "item_id":item_id,
      "handle":handle,
      "user_id":user_id
     }

  
    
      fetch(base_url+"/api/charge_onetime_payment", { 
            
            // Adding method type 
            method: "POST", 
            
            // Adding body or contents to send 
            body: JSON.stringify(payload), 
            
            // Adding headers to the request 
            headers: { 
               "Content-type": "application/json; charset=UTF-8"
            } 
      }) 
         
      // Converting to JSON 
      .then(response =>response.json()) 
      .then(json => {
         // console.log(json)
         if(json.status_code == 0)
         {
            //Need to show error
            document.getElementById("error").innerHTML =json.message;
         }


         //Function to close webview
         MessengerExtensions.requestCloseBrowser(function success() {
         // webview closed
         }, function error(err) {
         // an error occurred
         });

         }); 
     
  
});
  
  </script>

  