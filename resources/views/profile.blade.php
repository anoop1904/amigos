@extends('layouts.frontmaster')

@section('content')





<!-- Team Members Section -->
<section id="team" class="light-bg">
  <h2 class="text text-center">Profile</h2>
  <div class="container">
    <div class="row">
      <div class="col-md-12 well">
          <form autocomplete="off">
        
            <div class="col-md-12 form-group">
              <div class="col-md-6">
                <label>First Name</label>
                <input type="text" name="fname" id="fname" autocomplete="off" placeholder="From Date" class="form-control" value="{{ $client->fname }}" readonly="">
              </div>
              <div class="col-md-6">
                <label>Last Name</label>
                <input type="text" name="lname" id="lname" autocomplete="off" placeholder="From Date" class="form-control" value="{{ $client->lname }}" readonly="">
              </div>
            </div>
            <div class="col-md-12 form-group">
              <div class="col-md-6">
                <label>Mobile</label>
                <input type="text" name="mobile" id="mobile" autocomplete="off" placeholder="From Date" class="form-control" value="{{ $client->mobile }}" readonly="">
              </div>
            </div>
            <div class="col-md-12 form-group">
              <div class="col-md-12">
                <label>Address</label>
                <textarea readonly="" class="form-control" placeholder="Address">{{ $client->address }}</textarea>
              </div>
            </div>
            
            {{-- <input type="submit" name="" class="btn btn-default" value="Search"> --}}
          </form>
          {{-- <button onclick="playPlayer()">Play</button> --}}
          {{-- <button onclick="stopPlayer()">Stop</button> --}}
        </div>
      <div class="col-md-12">
        <!-- Title -->
   



         
      </div>
    
    </div>
  </div>
</section>
<!-- End Team Members Section -->


@endsection 

@section('extrajs')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">
  jQuery( document ).ready(function($) {
    $('.video').click(function() {
      //alert('aaaaaa');
        this.paused ? this.play() : this.pause();
    });
  });
  $(document).ready(function(){

    // alert();
    // $('.playpause').click(function(index, el) {
    // alert('manish');
    // });
    $('.video').each(function(index, el) {
      var index = document.getElementById("video"+index);
      console.log(index);
      index.onplaying = function() {
        index.play(); 
      };
      //el.play();
    });
  });
  
  function playclick(){

  }
  function playPlayer(){
    $('.video').each(function(index, el) {
      el.play();
    });
  }
  function stopPlayer(){
    $('.video').each(function(index, el) {
      el.pause();
    });
  }
    $( function() {
      var dateFormat = "mm/dd/yy",

      from = $( "#from" )
        .datepicker({
          defaultDate: "+1w",
          minDate: new Date(),
          changeMonth: true,
          // numberOfMonths: 3
        }).on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#to" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        minDate: new Date(),
        // numberOfMonths: 3
      }).on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
      function getDate( element ) {
        var date;
        try {
          date = $.datepicker.parseDate( dateFormat, element.value );
        } catch( error ) {
          date = null;
        }
   
      return date;
      }
    });
</script>
@endsection 