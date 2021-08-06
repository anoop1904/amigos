  @extends('layouts.frontmaster')
  @section('content')

      <section class="section pt-5 pb-5">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h4 class="font-weight-bold mt-0 mb-3">Available Plans</h4>
               </div>
               @foreach($plans as $plan)
               <div class="col-md-4">
                  <div class="card offer-card border-0 shadow-sm">
                     <div class="">
                    <!--     <h5 class="card-title"><img src=""> OSAHANEAT50</h5> -->
                    @if($plan->image)
                         <img src="{{url('/public/assets/img/plan/')}}/{{$plan->image}}" style="height:auto;width:100%">
                    @else
                           <img src="{{url('/public/assets/img/plan/1596187052.jpg')}}" style="height:auto;width:100%">
                    @endif
                    <div style="padding: 10px;">
                        <h6 class="card-subtitle mb-2 text-block">{{$plan->name}}</h6>
                        <hr>
                        <p class="card-text">{{$plan->description}}</p>
                        <p class="card-text">Trial Period: {{$plan->trail_days}}</p>
                        <p class="card-text">Max Meals/Week: {{$plan->max_meals_per_week}}</p>
                        <p class="card-text">Max Amount/Meal: {{$plan->max_amount_per_meal}}</p>
                        <!-- <a href="#" class="card-link">COPY CODE</a> -->
                       
                        <a @if(Auth::guard('student')->user()) href="{{URL('/subscribeplan/'.$plan->id)}}"  
                         @else 
                         href="{{URL('/signin/')}}"  
                         @endif class="card-link">Subscribe</a>
                     </div>
                     </div>
                  </div>
               </div>
               @endforeach
            
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