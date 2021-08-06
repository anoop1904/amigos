@extends('layouts.frontmaster')

@section('content')

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<div class="load">
  <div class="loader">
  </div>
</div>


<!-- Slider Section -->
<section id="hero_11" class="no-p-t no-p-b" >
  
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">

      <div class="item active">
        <img src="{{ URL('assets/frontend/img/slider/1.jpg') }}" alt="Los Angeles" style="width:100%;">
        {{-- <div class="carousel-caption">
          <h3>Los Angeles</h3>
          <p>LA is always so much fun!</p>
        </div> --}}
      </div>

      <div class="item">
        <img src="{{ URL('assets/frontend/img/slider/2.jpg') }}" alt="Chicago" style="width:100%;">
        {{-- <div class="carousel-caption">
          <h3>Chicago</h3>
          <p>Thank you, Chicago!</p>
        </div> --}}
      </div>
    
      <div class="item">
        <img src="{{ URL('assets/frontend/img/slider/3.jpg') }}" alt="New York" style="width:100%;">
        {{-- <div class="carousel-caption">
          <h3>New York</h3>
          <p>We love the Big Apple!</p>
        </div> --}}
      </div>
  
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</section>
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

<!-- Feature Section -->
<section id="about">
  <div class="container">
    <div class="row">

      <div class="col-md-12 left-content">
        <h2>About us</h2>
        <p class="lead">we don’t simply view you as simply as a client, we believe your business success is our success too and we desire for you to go as far as you can image, for that reason, it is our responsibility to provide you with the best displays and services that work, both now and in the future.</p>
        <p><strong><b>FirstAd</b></strong> advertisement agency provides an innovative and creative way of Branding & Advertising in Bhopal. Advertisement will be displayed on LED screens Placed on different indoor public places like restaurants, Super-markets, hotels, shopping centers, GYM etc.</p>
        <p>Our Concept has been designed for people who beliefs in Effective Branding. Clients who all are doing the activities in other sources like, News paper, FM, Hoardings can get far more effective results by adding our services along with above mentioned activities.</p>
       
        <a href="{{ URL('public/FIRSTAD PRESENTATION.pdf') }}" target="_blank" class="btn radius green-2">Download PDF</a>
      </div>
      
      {{-- <div class="col-md-6">
        <img src="{{ asset('assets/frontend/') }}img/bg-1.jpg" class="img-radius" alt="">
      </div> --}}
    </div>
  </div>
</section>
<!-- End Feature Section -->

<!-- section name -->
<section id="services" class="light-bg">
  <div class="container">
    <div class="row">
      {{-- <div class="col-md-4 left-content-img">
        <img src="{{ asset('assets/frontend/') }}img/bg-4.jpg" alt="">
      </div> --}}
      <div class="col-md-12">
        <div class="col-md-12 text-center m-b-40">
          <h3>What makes us different</h3>
        </div>

        <div class="col-md-6 m-b-20" style="margin-bottom: 50px;height: 90px;">
          <div class="f-img"><span class="fa fa-file-video-o font-40 text-green-2"></span></div>
          <div class="f-content">
            <h5>Professional service </h5>
            <p>We got you covered from installation to troubleshooting to training to display maintenance and upkeep.</p>
          </div>
        </div>
        
        <div class="col-md-6 m-b-20" style="margin-bottom: 50px;height: 90px;">
          <div class="f-img"><span class="fa fa-video-camera font-40 text-green-2"></span></div>
          <div class="f-content">
            <h5>Exclusive customized service</h5>
            <p>Bringing any of your concept to life.</p>
          </div>
        </div>
        
        <div class="col-md-6 m-b-20" style="margin-bottom: 50px;height: 90px;">
          <div class="f-img"><span class="fa fa-industry font-40 text-green-2"></span></div>
          <div class="f-content">
            <h5>Expertise</h5>
            <p>More than 20 years of experience and more than 10,000 displays installed across madhya pradesh , india.</p>
          </div>
        </div>
        
        <div class="col-md-6 m-b-20" style="margin-bottom: 50px;height: 90px;">
          <div class="f-img"><span class="fa fa-user-circle font-40 text-green-2"></span></div>
          <div class="f-content">
            <h5>Audiences</h5>
            <p>Our screens are covering more than 15* thousand live audiences on daily   basis.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End section name -->

<!-- Portfolio Section -->
<section id="image-gallery" id="image-gallery">
  <div class="container">
    <div class="row m-b-40">
      <div class="col-md-8 col-md-offset-2 text-center">
        <h2>Screen Location</h2>
       
      </div>
    </div>

    <div class="row">
      <ul class="list-unstyled col-md-12" id="screenshots">

        <!-- Image #01 -->
        @foreach($schedules as $key=>$schedule)

         

          <li class="col-md-3 col-sm-6 no-p-r no-p-l">
           <div class="col-sm-12">
                <video onclick="playclick();" id="video{{$key}}" class="video" width="100%" controls>

                <source id="sourceEdit" src="{{ URL('public/tmp').'/'.$schedule->videoUrl}}" type="video/mp4">Your browser does not support HTML5 video.</video>

            </div> 
            <span>{{ $schedule->location }}</span>
          </li>


          {{-- $schedule->advertise->location->location --}}
        @endforeach

      </ul>
    </div>
  </div>
</section>
<!-- Portfolio Section -->

<!-- Statistics Counter Section -->
<section class="stat-count-1 green-2-bg">
  <div class="container">
    <div class="row text-center">
      <div class="col-sm-3 m-b-30-xs">
        <!-- First Number -->
        <div class="count">{{ App\Location::where('IsActive','1')->count()}}</div>
        <div class="title">Our Screen</div>
      </div>
      <div class="col-sm-3 m-b-30-xs">
        <!-- Second Number -->
        <div class="count">{{ App\Client::where('IsActive','1')->count()}}</div>
        <div class="title">Our Client</div>
      </div>
      <div class="col-sm-3 m-b-30-xs">
        <!-- Third Number -->
        <div class="count">{{ $slot }}</div>
        <div class="title">Total Slot</div>
      </div>
      <div class="col-sm-3">
        <!-- Fourth Number -->
        <div class="count">{{ (int)$availbleSlot }}</div>
        <div class="title">Available Slot</div>
      </div>
    </div>
  </div>
</section>
<!-- End Statistics Counter Section -->

<!-- Portfolio Section -->
<section id="client" id="client">
  <div class="container">
    <div class="row m-b-40">
      <div class="col-md-8 col-md-offset-2 text-center">
        <h2>Our Client</h2>
      </div>
    </div>

    <div class="row">
      <ul class="list-unstyled col-md-12" id="screenshots">
<?php 
foreach($clients as $key=>$client){ ?>
<li class="col-md-3 col-sm-6 no-p-r no-p-l" style="border-style: groove;">
          <a href="{{ asset('assets/client/').'/'.$client->logo }}" data-lightbox-gallery="screenshots-gallery">
            <span class="cover"></span>
            <img style="width: 100%;    height: 140px" src="{{ asset('assets/client/').'/'.$client->logo }}" class="img-responsive" alt="image-gallery">

          </a>
          <span style="font-size: 12px;font-weight: bold;">{{ $client->company_name }}</span>
        </li>
<?php } ?>
        <!-- Image #01 -->
      </ul>
    </div>
  </div>
</section>
<!-- Portfolio Section -->




<!-- Contact Form Section -->
<section id="contact" class="contact-1">
  <div class="container">
    <div class="row m-b-40">
      <div class="col-md-8 col-md-offset-2 col-sm-12 text-center">
        <!-- Contact Large Title -->
        <h3>Hey! are you ready?</h3>
        <!-- Description -->
        
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-sm-12 left-content">
      <!-- Contact form -->
        <form class="form-horizontal ajaxform1" id="contact1" onsubmit="return contact(this)">
          <input type="hidden"  name="_token" id="csrf-token" value="{{ Session::token() }}" />
                <input class="form-control" name="name" id="name" placeholder="Name" type="text" required="">
                <input class="form-control m-t-20" name="email" id="email" placeholder="Email" type="email">
                <input class="form-control m-t-20" name="number" id="number" placeholder="Number" type="text">
                <textarea name="message" id="message" rows="5" class="form-control m-t-20" placeholder="Your Message"></textarea>
               <p class="email-success-text" id="errorMessage">&nbsp;</p>

                <button id="submit" type="submit" class="btn green-2 radius">Sned</button>
                
        <p class="email-error-text hide">Please enter valid details</p>
            </form>
      </div>

      <div class="col-md-6 col-sm-12">

        <!-- Right Side Title -->
        <div class="font-20 f-w-400 m-b-10">We are always happy to help you</div>
        <!-- Text -->
        
        <!-- Address -->
        <div class="font-20 m-b-10 l-h-1p2"><span class="ti-location-pin text-green-2 p-r-20"></span> 12 Archana Complex ,Zone -2 ,MP Nagar Bhopal.</div>
        <!-- Phone -->
        <div class="font-20 m-b-10 l-h-1p2"><span class="ti-mobile text-green-2 p-r-20"></span> 9826702123,8770802242</div>
        <!-- Email -->
        <div class="font-20 m-b-10 l-h-1p2"><span class="ti-email text-green-2 p-r-20"></span> info@firstaddigital.com</div>
        <!-- Timing -->
        <div class="font-20 m-b-10 l-h-1p2"><span class="ti-time text-green-2 p-r-20"></span> Mon to Sat 7 AM to 10 PM</div>
      </div>
    </div>
  </div>
</section>
<!-- End Contact Form Section -->




@endsection 


@section('extrajs')
<script type="text/javascript">
  

$(document).ready(function() {


            var time = 100;
            var scale = 1;

            var video_obj = null;

<?php
        foreach($schedules as $key=>$schedule){ ?>

            document.getElementById('video<?= $key; ?>').addEventListener('loadedmetadata', function() {
                 this.currentTime = time;
                 video_obj = this;

            }, false);

            document.getElementById('video<?= $key; ?>').addEventListener('loadeddata', function() {
                 var video = document.getElementById('video<?= $key; ?>');

                 var canvas = document.createElement("canvas");
                 canvas.width = video.videoWidth * scale;
                 canvas.height = video.videoHeight * scale;
                 canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);

                 var img = document.createElement("img");
                img.src = canvas.toDataURL();
                $('#thumbnail').append(img);

                video_obj.currentTime = 0;

            }, false);

        <?php } ?>


        });
</script>

@endsection