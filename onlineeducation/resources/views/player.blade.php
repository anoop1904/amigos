

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  {{-- <link href="//amp.azure.net/libs/amp/latest/skins/amp-default/azuremediaplayer.min.css" rel="stylesheet">
<script src= "//amp.azure.net/libs/amp/latest/azuremediaplayer.min.js"></script>
 --}}

<link rel="stylesheet" href="https://releases.flowplayer.org/7.2.7/skin/skin.css">
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>  
  <script src="https://releases.flowplayer.org/7.2.7/flowplayer.min.js"></script>

<div class="load">
  <div class="loader">
  </div>
</div>




{{--<video id="vid 1" class="azuremediaplayer amp-default-skin" autoplay controls width="640" height="400" poster="poster.jpg" data-setup='{"nativeControlsForTouch": false}'>
    <source src="public/tmp/demo.mp4" type="video/mp4" />
    <p class="amp-no-js">
        To view this video please enable JavaScript, and consider upgrading to a web browser that supports HTML5 video
    </p>
</video>  --}}
 {{--<div class="player11">
<video >
      <source type="application/x-mpegurl"
              src="public/tmp/demo.mp4">
      <source type="video/mp4"
              src="public/tmp/demo.mp4">
      </video>
    </div> 
 --}}


<div id="player"></div>
   manish
{{-- <div class="col-sm-12">
<div class="col-sm-3">
 <div class="player" src="public/tmp/Apoorti_Demo.mp4" ></div>
</div>
<div class="col-sm-3"> 
  <div class="player" src="public/tmp/demo.mp4" ></div>
</div>
<div class="col-sm-3"> 
  <div class="player" src="public/tmp/2.mp4" ></div>
</div>
<div class="col-sm-3">
 <div class="player" src="public/tmp/1.mp4" ></div>
</div>
</div> --}}
    
      {{-- <div class="player" src="public/tmp/demo.mp4" style="height: 300px;width: 500px"></div> --}}
<!-- End Slider Section -->
{{-- <section >
  <div class="container p-t-60">
    <div class="row p-t-150 p-b-150" style="height:600px">
      <div class="col-md-7">
        <h1 class="text-white l-h-1p2">Let's make some digital identity together</h1>
         
      </div>
    </div>
  </div>
</section> --}}
<!-- End Hero Section -->

<!-- Portfolio Section -->












<script>
// run script after document is ready
$(function () {

   // install flowplayer into all elements with CSS class="player"
   var container = document.getElementById("player");

// install flowplayer into selected container
flowplayer(container, {
    clip: {
        sources: [
              { type: "application/x-mpegurl",
                src:  "public/tmp/Apoorti_Demo.mp4" },
              { type: "video/mp4",
                src:  "public/tmp/Apoorti_Demo.mp4" }
        ]
    }
});

});
</script>

