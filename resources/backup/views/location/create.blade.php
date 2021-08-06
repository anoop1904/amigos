@extends('layouts.master')


@section('content')
<div class="container-fluid">
  <!-- Page-Title -->
  <div class="row">
    <div class="col-sm-12">
      <div class="page-title-box">
        <h4 class="page-title">Add Location </h4>
      </div>
    </div>
  </div>
  @if (count($errors) > 0)
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  @if(Session::has('message'))
  <div class="alert alert-success login-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('message') !!} </div>
  @endif
  <!-- end page title end breadcrumb -->
  <div class="row">
    <div class="col-lg-12">
      <div class="card m-b-30">
        <div class="card-body"> @if(Request::segment(4)==='edit')
          {{ Form::model($location, array('route' => array('location.update', $location->id), 'method' => 'PUT')) }}
          <?php  
               $city_id = $location->city_id;
               $state_id = $location->state_id;
               $screen_name = $location->screen_name;
               $screen_id = $location->screen_id;
               $deviceId = $location->deviceId;
               $location_field = $location->location;
               $screen_size = $location->screen_size;
               $screen_type = $location->screen_type;
               $latitude = $location->lat;
               $longitude = $location->lng;
            ?>
          @else
          {{ Form::open(array('url' => 'admin/location')) }}
          
          <?php 
               $deviceId = $screen_id= $screen_name=$state_id= $city_id = '';
               $location_field = '';
               $screen_size = '';
               $screen_type = '';
               $latitude = '';
               $longitude = '';
            ?>
          @endif

         
          <div class="row">
            
            <div class="col-md-12">
             <div class="row">

               <div class="col-md-6">
                <div class="form-group"> 
                   {{ Form::label('State', 'State') }}
                  <div> 
                    <select class="form-control selectpicker" id="state" name="state_id"> 
                      <option>Select State</option>
                      @if($states)
                        @foreach ($states as $key => $state) 
                          <option value="{{ $state->state_id }}" <?php if($state_id == $state->state_id){ echo 'selected'; } ?>>{{ $state->name }}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group"> 
                   {{ Form::label('City', 'City') }}
                  <div> 
                    <select class="form-control selectpicker" id="city_id" name="city_id"> 
                      <option>Select City</option>
                      @if($cities)
                        @foreach ($cities as $key => $value) 
                          <option value="{{ $value->city_id }}" <?php if($city_id == $value->city_id){ echo 'selected'; } ?> >{{ $value->name }}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>
                </div>
              </div>

              

               <div class="col-md-6">
                <div class="form-group"> 
                   {{ Form::label('Screen Size', 'Screen Size') }}
                  <div> 

                  <select class="form-control selectpicker" id="screen_size" name="screen_size"> 
                      <option value="0" selected="" disabled="">Screen Size</option>
                      @if($sizes)
                        @foreach ($sizes as $key => $value) 
                          <option value="{{ $value->id }}" <?php if($screen_size == $value->id){ echo 'selected'; } ?>>{{ $value->size }}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>
                </div>
              </div>
               <div class="col-md-6">
                <div class="form-group"> 
                   {{ Form::label('Screen Type', 'Screen Type') }}
                  <div> 
                    
                    <select class="form-control selectpicker" id="screen_type" name="screen_type"> 
                      <option value="0" selected="" disabled="">Screen Type</option>
                      @if($types)
                        @foreach ($types as $key => $value) 
                          <option value="{{ $value->id }}" <?php if($screen_type == $value->id){ echo 'selected'; } ?>>{{ $value->type }}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>
                </div>
              </div>

               <div class="col-md-6">
                <div class="form-group"> 
                   {{ Form::label('Screen Name', 'Screen Name') }}
                  <div> {{ Form::text('screen_name', $screen_name, array('class' => 'form-control','placeholder'=>'Screen Name','required'=>'required')) }} </div>
                </div>
              </div>

               <div class="col-md-3">
                <div class="form-group"> 
                   {{ Form::label('Screen Id', 'Screen Id') }}
                  <div> {{ Form::text('screen_id', $screen_id, array('class' => 'form-control','placeholder'=>'Screen Id','required'=>'required')) }} </div>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group"> 
                   {{ Form::label('Device Id', 'Device Id') }}
                  <div> {{ Form::text('deviceId', $deviceId, array('class' => 'form-control','placeholder'=>'Device Id','required'=>'required')) }} </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group"> 
                   {{ Form::label('Address', 'Address') }}
                  <div> {{ Form::textarea('location', $location_field, array('class' => 'form-control','placeholder'=>'Address','required'=>'required','rows'=>'3')) }} </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group"> 
                   {{ Form::label('latitude', 'latitude') }}
                  <div> {{ Form::text('latitude', $latitude, array('class' => 'form-control','placeholder'=>'Latitude','required'=>'required')) }} </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group"> 
                   {{ Form::label('longitude', 'longitude') }}
                  <div> {{ Form::text('longitude', $longitude, array('class' => 'form-control','placeholder'=>'Longitude','required'=>'required')) }} </div>
                </div>
              </div>


                  {{-- <div class="col-md-12">
                      <div class="form-group">
                                            <label for="add_name">Location</label>
                                           
                                    <input id="search1" class="controls form-control" type="text" placeholder="Search Box" name="location" required="">
                                       </div>
                                      <div id="mapContainer">
                                           
                                      <div id="map1" class="map"></div>
                                      </div>
                    </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="user_address">Address</label>
                      <textarea class="form-control"  id="address" name="address" placeholder="Enter Address" required=""></textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Enter City" required="">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                    <label for="state">State</label>
                    <input type="text" class="form-control" id="state" name="state" placeholder="Enter State" required="">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" id="country" name="country" placeholder="Enter Country" required="">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                    <label for="zip">Zip</label>
                    <input type="text" class="form-control" id="zip" name="zip" placeholder="Enter Zip" required="">
                    </div>
                  </div>
                  <div class="col-md-12" style="padding:0px">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>lat :</label>
                        <input type="text" class="form-control" name="lat" id="lat_01" readonly="" required="">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group"><label>lng :</label>
                      <input type="text" class="form-control" name="lng" id="lng1" readonly="" required="">
                      </div>
                    </div>
                  </div> --}}






             <div class="col-md-4">
                <div class="form-group"> <button type="submit" class="btn btn-primary waves-effect waves-light"> Submit </button>
              <button type="reset" class="btn btn-secondary waves-effect m-l-5"> Cancel </button>   </div>
                </div>
              </div>

              </div>
              

             

              
             

             

              
            </div>

          </div>
          
          </div>
          {!! Form::close() !!} </div>
      </div>
    </div>
    <!-- end col -->
   
  </div>
  <!-- end row -->
</div>
<!-- end container -->
@endsection
@section('extrajs')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
  
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2P_IEzR-VpYosCv8GVj9Xdng-eLu9f7o&libraries=places"></script>

  <script type="text/javascript">

function initAutocomplete(divid) {
     
        var map = new google.maps.Map(document.getElementById('map'+divid), {
          center: {lat: 23.2332992, lng: 77.4316238},
          zoom: 13,
          mapTypeId: 'roadmap'
        });

        // Create the search box and link it to the UI element.
        var input = document.getElementById('search'+divid);
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();
          var latLng=searchBox.getBounds();
          if (places.length == 0) {
            return;
          }

         
          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();

          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };
             

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              placeId: place.place_id,
              position: place.geometry.location
            }));
            
            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
           var obj1=JSON.stringify(bounds);
          var obj2=JSON.parse(obj1);
          var pl=JSON.stringify(places)
          var pl1=JSON.parse(pl);

          console.log(pl1[0].formatted_address);
          for(var i=0;i<pl1[0].address_components.length;i++)
          {
            //console.log(pl1[0].address_components[i]['types']);
            if($.inArray("administrative_area_level_2" ,pl1[0].address_components[i]['types'] )==0)
            {
              //console.log(pl1[0].address_components[i]['long_name']);
              var city=pl1[0].address_components[i]['long_name']
            }
            if($.inArray("administrative_area_level_1" ,pl1[0].address_components[i]['types'] )==0)
            {
              //console.log(pl1[0].address_components[i]['long_name']);
              var state=pl1[0].address_components[i]['long_name']
            }
            if($.inArray("country" ,pl1[0].address_components[i]['types'] )==0)
            {
              //console.log(pl1[0].address_components[i]['long_name']);
              var country=pl1[0].address_components[i]['long_name']
            }
            if($.inArray("postal_code" ,pl1[0].address_components[i]['types'] )==0)
            {
              //console.log(pl1[0].address_components[i]['long_name']);
              var zip=pl1[0].address_components[i]['long_name']
            }
            //console.log($.inArray("administrative_area_level_2" ,pl1[0].address_components[i]['types']));
          }
         // alert(place.place_id);
          $('#lat_0'+divid).val(obj2.south);
          $('#lng'+divid).val(obj2.west);
          $('#city').val(city);
          $('#state').val(state);
          $('#country').val(country);
          $('#zip').val(zip);
          $('#address').val(pl1[0].formatted_address);
         // $('#lng2').val(obj2.west);
         //alert(obj2.west);
          //console.log(obj2.west);
          map.fitBounds(bounds);
        });
}

$(document).ready(function () {
    initAutocomplete(1);
});


    $('.selectpicker').select2({
        width: '100%',
        // placeholder: "Select Transaction Type",
      });

$('#state').change(function(event) {
  var id = $(this).val();
  $.ajax({
    type: "GET", 
    url: "{{ URL('/admin/getCity') }}", 
    data: {id:id}, 
    success: function(result){
      //console.log(result);
      var htm = "";
      var obj = JSON.parse(result);
        if(obj.length>0){
          htm += "<option value='0' selected disabled>Select City</option>";
          for(var i=0;i<obj.length;i++){
            var obj1 = obj[i];
            //console.log(obj1.city_id);
            htm += "<option value='"+obj1.city_id+"'>"+obj1.name+"</option>";
          }
        }else{
           htm += "<option value='0' selected disabled>No City</option>";
        }
        
        $("#city_id").html(htm);
      
      }
  }); // ajax closing tag

});


  </script>
@endsection