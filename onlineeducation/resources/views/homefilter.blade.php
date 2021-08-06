   <div class="owl-carousel owl-carousel-four owl-theme">
                     @foreach($kitchenFood As $food)
                     <div class="item">
                      <a href="{{URL('/signin/')}}">
                        <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">

                           <div class="list-card-image">
                              <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i> 3.1 (300+)</span></div>
                             <img src="{{url('/public/kitchenfood')}}/{{$food->image}}" class="img-fluid item-img">
                              <!-- </a> -->
                           </div>
                           <div class="p-3 position-relative">
                              <div class="list-card-body">
                                 <h6 class="mb-1"><a href="{{URL('/signin/')}}" class="text-black">{{$food->name}}</a></h6>
                                 <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i> <!-- 20–25 min --></span> <span class="float-right text-black-50"> Kr {{$food->price}} <!-- FOR TWO --></span></p>
                              </div>
                             
                           </div>
                        </div>
                        </a>
                     </div>
                     @endforeach
                  
                  </div>
    
<script src="{{url('/public/assets/vendor/owl-carousel/owl.carousel.js')}}"></script>
<script type="text/javascript">

        // Homepage Owl Carousel  
var fiveobjowlcarousel = $(".owl-carousel-four");
  if (fiveobjowlcarousel.length > 0) {
     fiveobjowlcarousel.owlCarousel({
        responsive: {
        0:{
            items:1,
        },
        600:{
            items:2,
        },
        1000: {
          items: 4,
        },
        1200: {
          items: 4,
        },
      },

        lazyLoad: true,
        pagination: false,
        loop: true,
        dots: false,
        autoPlay: 2000,
        nav: true,
        stopOnHover: true,
        navText: ["<i class='icofont-thin-left'></i>", "<i class='icofont-thin-right'></i>"]
    });
}

     </script>