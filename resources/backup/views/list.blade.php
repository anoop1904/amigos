@extends('layouts.frontmaster')

@section('content')





<!-- Team Members Section -->
<section id="team" class="light-bg">
  <h2 class="text text-center">List</h2>
  <div class="container">
    <div class="row">
      <div class="col-md-12 well">
          <form autocomplete="off">
            {{-- <div class="col-md-3">
              <select class="form-control" name="location_id">
                <option>Select Location</option>
              </select>
            </div> --}}
            <div class="col-md-3">
              <input type="text" name="from" id="from" autocomplete="off" placeholder="From Date" class="form-control" value="<?php if(isset($_GET['from'])){ echo date('m/d/Y',strtotime($_GET['from'])); } ?>">
            </div>
              <div class="col-md-3">
              <input type="text" name="to" id="to" value="<?php if(isset($_GET['to'])){echo date('m/d/Y',strtotime($_GET['to'])); } ?>" placeholder="To Date" class="form-control" >
            </div>
            
            <input type="submit" name="" class="btn btn-default" value="Search">
          </form>
          {{-- <button onclick="playPlayer()">Play</button> --}}
          {{-- <button onclick="stopPlayer()">Stop</button> --}}
        </div>
      <div class="col-md-12">
        <!-- Title -->
        
        <!-- Description -->
        @if(count($schedules) >0)
        
@foreach($schedules as $key=>$schedule)
@if($client_id == $schedule->client_id)
          <div class="col-md-4" style="padding: 15px;border-style: groove;">
            <div id="screen_name"></div>
            <div class="row">
              <div class="col-sm-12">
                <label>Location : 
                  <span id="locationEdit">{{ $schedule->advertise->location->location }}</span>
                </label>
              </div>
               <div class="col-sm-12">
                <label>Name : 
                  <span id="locationEdit">{{ $schedule->advertise->advertise_name }}</span>
                </label>
              </div>
              <div class="col-sm-12">
                <video onclick="playclick();" id="video{{$key}}" class="video" width="100%" controls>
                <source id="sourceEdit" src="{{ URL('public/tmp').'/'.$schedule->videoUrl }}" type="video/mp4">Your browser does not support HTML5 video.</video>
              </div> 
              <div class="col-md-12">
                  <div> 
                    <label>Start Date : <span class="text text-danger">: </span>@php echo date('d M Y',strtotime($schedule->fromDate)) @endphp</label>
                   </div>
              </div>
              <div class="col-md-12">
                  <div> 
                    <label>End Date : <span class="text text-danger">: </span>@php echo date('d M Y',strtotime($schedule->toDate)) @endphp</label>
                  </div>
              </div>
             <div class="col-sm-12">
                <label>File Size - </label>
                <label id="durationLabelEdit">{{ $schedule->videoLength }} Seconds</label>
              </div>
               <div class="col-sm-6">
                <label>Iteration : 
                  <span id="locationEdit">{{ $schedule->iteration }}</span>
                </label>
              </div>
              <div class="col-sm-6">
                <label>At End : 
                  <span id="locationEdit">@php if($schedule->at_end == '1'){ echo "Delete"; }else{
                    echo "Remaining";
                  } @endphp</span>
                </label>
              </div>
              
               
           </div>
          </div>
@endif
@endforeach
@else
<div class="container">
  <div class="row">
    <div class="alert alert-danger">No Results</div>
  </div>
</div>

@endif


{{--  <div class="col-md-4">
            <div id="screen_name"></div>
            <div class="row">
              <div class="col-sm-12">
                <label>Location : 
                  <span id="locationEdit"></span>
                </label>
              </div>
              <div class="col-sm-12">
                <video id="playerEdit"  width="100%" controls>
                <source id="sourceEdit" src="" type="video/mp4">Your browser does not support HTML5 video.</video>
              </div> 
              <div class="col-md-12">
                  <div> 
                    <label>Start Date : <span class="text text-danger">*</span></label>
                   </div>
              </div>
              <div class="col-md-12">
                  <div> 
                    <label>End Date : <span class="text text-danger">*</span></label>
                  </div>
              </div>
             
               <div class="col-sm-12">
                <label>Iteration : 
                  <span id="locationEdit"></span>
                </label>
              </div>
              <div class="col-sm-12">
                <label>At End : 
                  <span id="locationEdit"></span>
                </label>
              </div>
              <div class="col-sm-12">
                <label>File Size in Second -</label>
                <label id="durationLabelEdit"></label>
              </div>
               
           </div>
          </div>
 --}}
         
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
      alert('aaaaaa');
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