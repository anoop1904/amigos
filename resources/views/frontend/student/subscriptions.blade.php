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
                          <h2>Plan Subscriptions </h2>
                          <hr>
                             <div id="products" class="row view-group">
                                <div class="item col-xs-5 col-lg-5">
                                    <div class="thumbnail card">
                                        <!-- <div class="img-event">
                                         @if($student->plan_name->image)
                                           <img src="{{url('/public/assets/img/plan/')}}/{{$student->plan_name->image}}"  class="group list-group-image img-fluid">
                                         @else
                                             <img src="{{url('/public/assets/img/plan/1596187052.jpg')}}"  class="group list-group-image img-fluid">
                                         @endif

                                        </div> -->
                                        <div class="caption card-body">
                                            <h4 class="group card-title inner list-group-item-heading">
                                                {{$student->plan_name->name}}</h4>
                                            <p class="group inner list-group-item-text">
                                               {{$student->plan_name->description}}</p>
                                            <div class="row">
                                              <div class="col-xs-12 col-md-12">
                                                   <p class="lead">Trial Period: {{$student->plan_name->trail_days}}</p>
                                                    <p class="lead">Max Meals/Week: Kr {{$student->plan_name->max_meals_per_week}}</p>
                                                    <p class="lead">Max Amount/Meal: Kr {{$student->plan_name->max_amount_per_meal}}</p>
                                               Plan Subscriptions date : 
                                               <p class="group inner list-group-item-text">
                                               {{$student->plan_start_date}}</p>

                                                Plan Expiry date : 
                                               <p class="group inner list-group-item-text">
                                               {{$student->plan_expiry_date}}</p>
                                              </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                </div>
              </div>

         </div>
      </section>

 @endsection 
@section('extrajs')
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {
    $('#example').DataTable();
} );
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