@extends('layouts.frontmaster')
  @section('content')
       <section class="pt-5 pb-5 homepage-search-block position-relative">
         <div class="banner-overlay"></div>
         <div class="container">
            <div class="row d-flex align-items-center">
               <div class="col-md-8">
                  <div class="homepage-search-title">
                     <h1 class="mb-2 font-weight-normal"><span class="font-weight-bold">Find Awesome Deals</span> in Denmark</h1>
                     <h5 class="mb-5 text-secondary font-weight-normal"><!-- Lists of top restaurants, cafes, pubs, and bars in Melbourne, based on trends --></h5>
                  </div>
                  <div class="homepage-search-form">
                     <form class="form-noborder">
                        <div class="form-row">
                         @if(!Auth::guard('student')->user())
                           <div class="col-lg-3 col-md-3 col-sm-12 form-group">
                              <div class="location-dropdown">
                                 <i class="icofont-location-arrow"></i>
                                 <select class="custom-select form-control-lg vendor-select" name="vendor">
                                  <!--  <option selected="" disabled="">Select Vendor</option> -->
                                   @foreach($users as $vendor)
                                 <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                   @endforeach
                                 </select>
                              </div>
                           </div>
                          
                           <div class="col-lg-7 col-md-7 col-sm-12 form-group">
                               <select class="custom-select form-control-lg school-select" name="school">
                                   <option value="all">Select School</option>
                                   @foreach($school as $vendor)
                                 <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                   @endforeach
                                 </select>
                            
                           </div>
                          
                           <div class="col-lg-2 col-md-2 col-sm-12 form-group">
                              <a href="javascript:void(0);" class="btn btn-primary btn-block btn-lg btn-gradient searchfood">Search</a>
                             
                           </div>
                           @endif
                        </div>
                     </form>
                  </div>
                 <!--  <h6 class="mt-4 text-shadow font-weight-normal">E.g. Beverages, Pizzas, Chinese, Bakery, Indian...</h6>
                  <div class="owl-carousel owl-carousel-category owl-theme">
                     <div class="item">
                        <div class="osahan-category-item">
                           <a href="#">
                              <img class="img-fluid" src="public/assets/img/list/1.png" alt="">
                              <h6>American</h6>
                              <p>156</p>
                           </a>
                        </div>
                     </div>
                     <div class="item">
                        <div class="osahan-category-item">
                           <a href="#">
                              <img class="img-fluid" src="public/assets/img/list/2.png" alt="">
                              <h6>Pizza</h6>
                              <p>120</p>
                           </a>
                        </div>
                     </div>
                     <div class="item">
                        <div class="osahan-category-item">
                           <a href="#">
                              <img class="img-fluid" src="public/assets/img/list/3.png" alt="">
                              <h6>Healthy</h6>
                              <p>130</p>
                           </a>
                        </div>
                     </div>
                     <div class="item">
                        <div class="osahan-category-item">
                           <a href="#">
                              <img class="img-fluid" src="public/assets/img/list/4.png" alt="">
                              <h6>Vegetarian</h6>
                              <p>120</p>
                           </a>
                        </div>
                     </div>
                     <div class="item">
                        <div class="osahan-category-item">
                           <a href="#">
                              <img class="img-fluid" src="public/assets/img/list/5.png" alt="">
                              <h6>Chinese</h6>
                              <p>111</p>
                           </a>
                        </div>
                     </div>
                     <div class="item">
                        <div class="osahan-category-item">
                           <a href="#">
                              <img class="img-fluid" src="public/assets/img/list/6.png" alt="">
                              <h6>Hamburgers</h6>
                              <p>958</p>
                           </a>
                        </div>
                     </div>
                     <div class="item">
                        <div class="osahan-category-item">
                           <a href="#">
                              <img class="img-fluid" src="public/assets/img/list/7.png" alt="">
                              <h6>Dessert</h6>
                              <p>56</p>
                           </a>
                        </div>
                     </div>
                     <div class="item">
                        <div class="osahan-category-item">
                           <a href="#">
                              <img class="img-fluid" src="public/assets/img/list/8.png" alt="">
                              <h6>Chicken</h6>
                              <p>40</p>
                           </a>
                        </div>
                     </div>
                     <div class="item">
                        <div class="osahan-category-item">
                           <a href="#">
                              <img class="img-fluid" src="public/assets/img/list/9.png" alt="">
                              <h6>Indian</h6>
                              <p>156</p>
                           </a>
                        </div>
                     </div>
                  </div> -->
               </div>
               <div class="col-md-4">
                  <div class="osahan-slider pl-4 pt-3">
                     <div class="owl-carousel homepage-ad owl-theme">
                        <div class="item">
                           <a href="#"><img class="img-fluid rounded" src="public/assets/img/slider.png"></a>
                        </div>
                        <div class="item">
                           <a href="#"><img class="img-fluid rounded" src="public/assets/img/slider1.png"></a>
                        </div>
                        <div class="item">
                           <a href="#"><img class="img-fluid rounded" src="public/assets/img/slider.png"></a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
  
      <section class="section pt-5 pb-5 products-section">
         <div class="container">
            <div class="section-header text-center">
               <h2>Popular Items</h2>
               <p><!-- Top restaurants, cafes, pubs, and bars in Ludhiana, based on trends --></p>
               <span class="line"></span>
            </div>
            <div class="row">
               @php
                 $timelist=array();
                 $stylecss='style=display:none';
                 $message='';
                  if(Auth::guard('student')->user())
                  {
                    $timelist=getOrderTime(Auth::guard('student')->user()->school_id);  
                  }
                  if(!empty($timelist))
                  {
                     $starttime=strtotime($timelist->start_order_time);
                     $endtime=strtotime($timelist->last_order_time);
                     $currenttimt=time(); 
                    // if($currenttimt>=$starttime && $currenttimt<=$endtime)
                     if($endtime >= $currenttimt)
                     {
                        $stylecss='style=display:block';
                     }
                     else
                     {

                        $message="You can't place order before start order time.";
                     } 


                  }else
                  {
                    $stylecss='style=display:block'; 
                  }
                 @endphp
                 <div style="text-align: center;width: 100%;font-size: 17px;color: red;">{{$message}}</div>
                  <div class="col-md-12" id="all_list" {{$stylecss}}>
                    
                      <div class="owl-carousel owl-carousel-four owl-theme" >
                        @foreach($kitchenFood As $food)

                         <div class="item">
                           <a @if(Auth::guard('student')->user()) onclick="return confirm('Do You want to place order?')" href="{{URL('/student/placeorder/'.$food->id)}}"   @else href="{{URL('/signin/')}}"  @endif>
                              <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                 <div class="list-card-image">
                                    <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i> 3.1 (300+)</span></div>
                                  
                                     @if($food->image)
                                    <img src="{{url('/public/kitchenfood')}}/{{$food->image}}" class="img-fluid item-img">
                                     @else
                                    <img src="{{url('/public/kitchenfood/1596274022.png')}}" class="img-fluid item-img">
                                    @endif
                                    <!-- </a> -->
                                 </div>
                                 <div class="p-3 position-relative">
                                    <div class="list-card-body">
                                       <h6 class="mb-1"><a @if(Auth::guard('student')->user()) onclick="return confirm('Do You want to place order?')" href="{{URL('/student/placeorder/'.$food->id)}}"   @else href="{{URL('/signin/')}}"  @endif class="text-black">{{$food->name}}</a></h6>
                                     <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i> <!-- 20–25 min --></span> <span class="float-right text-black-50"> Kr {{$food->price}} <!-- FOR TWO --></span></p>
                                    </div>
                               
                                 </div>
                              </div>
                           </a>
                        </div>
                        @endforeach
                     
                         </div>
                  </div>
            </div>
         </div>
      </section>
      <section class="section pt-5 pb-5 bg-white becomemember-section border-bottom">
         <div class="container">
            <div class="section-header text-center white-text">
               <h2>Become a Member</h2>
               <p><!-- Lorem Ipsum is simply dummy text of --></p>
               <span class="line"></span>
            </div>
            <div class="row">
               <div class="col-sm-12 text-center">
                  <a href="{{url('/signup')}}" class="btn btn-success btn-lg">
                  Create an Account <i class="fa fa-chevron-circle-right"></i>
                  </a>
               </div>
            </div>
         </div>
      </section>
   <!--    <section class="section pt-5 pb-5 text-center bg-white">
         <div class="container">
            <div class="row">
               <div class="col-sm-12">
                  <h5 class="m-0">Operate food store or restaurants? <a href="public/assets/login.html">Work With Us</a></h5>
               </div>
            </div>
         </div>
      </section> -->
   <!--    <section class="footer pt-5 pb-5">
         <div class="container">
            <div class="row">
               <div class="col-md-4 col-12 col-sm-12">
                  <h6 class="mb-3">Subscribe to our Newsletter</h6>
                  <form class="newsletter-form mb-1">
                     <div class="input-group">
                        <input type="text" placeholder="Please enter your email" class="form-control">
                        <div class="input-group-append">
                           <button type="button" class="btn btn-primary">
                           Subscribe
                           </button>
                        </div>
                     </div>
                  </form>
                  <p><a class="text-info" href="public/assets/register.html">Register now</a> to get updates on <a href="public/assets/offers.html">Offers and Coupons</a></p>
                  <div class="app">
                     <p class="mb-2">DOWNLOAD APP</p>
                     <a href="#">
                     <img class="img-fluid" src="public/assets/img/google.png">
                     </a>
                     <a href="#">
                     <img class="img-fluid" src="public/assets/img/apple.png">
                     </a>
                  </div>
               </div>
               <div class="col-md-1 col-sm-6 mobile-none">
               </div>
               <div class="col-md-2 col-6 col-sm-4">
                  <h6 class="mb-3">About OE</h6>
                  <ul>
                     <li><a href="#">About Us</a></li>
                     <li><a href="#">Culture</a></li>
                     <li><a href="#">Blog</a></li>
                     <li><a href="#">Careers</a></li>
                     <li><a href="#">Contact</a></li>
                  </ul>
               </div>
               <div class="col-md-2 col-6 col-sm-4">
                  <h6 class="mb-3">For Foodies</h6>
                  <ul>
                     <li><a href="#">Community</a></li>
                     <li><a href="#">Developers</a></li>
                     <li><a href="#">Blogger Help</a></li>
                     <li><a href="#">Verified Users</a></li>
                     <li><a href="#">Code of Conduct</a></li>
                  </ul>
               </div>
               <div class="col-md-2 m-none col-4 col-sm-4">
                  <h6 class="mb-3">For Restaurants</h6>
                  <ul>
                     <li><a href="#">Advertise</a></li>
                     <li><a href="#">Add a Restaurant</a></li>
                     <li><a href="#">Claim your Listing</a></li>
                     <li><a href="#">For Businesses</a></li>
                     <li><a href="#">Owner Guidelines</a></li>
                  </ul>
               </div>
            </div>
         </div>
      </section>
      <section class="footer-bottom-search pt-5 pb-5 bg-white">
         <div class="container">
            <div class="row">
               <div class="col-xl-12">
                  <p class="text-black">POPULAR COUNTRIES</p>
                  <div class="search-links">
                     <a href="#">Australia</a> |  <a href="#">Brasil</a> | <a href="#">Canada</a> |  <a href="#">Chile</a>  |  <a href="#">Czech Republic</a> |  <a href="#">India</a>  |  <a href="#">Indonesia</a> |  <a href="#">Ireland</a> |  <a href="#">New Zealand</a> | <a href="#">United Kingdom</a> |  <a href="#">Turkey</a>  |  <a href="#">Philippines</a> |  <a href="#">Sri Lanka</a>  |  <a href="#">Australia</a> |  <a href="#">Brasil</a> | <a href="#">Canada</a> |  <a href="#">Chile</a>  |  <a href="#">Czech Republic</a> |  <a href="#">India</a>  |  <a href="#">Indonesia</a> |  <a href="#">Ireland</a> |  <a href="#">New Zealand</a> | <a href="#">United Kingdom</a> |  <a href="#">Turkey</a>  |  <a href="#">Philippines</a> |  <a href="#">Sri Lanka</a><a href="#">Australia</a> |  <a href="#">Brasil</a> | <a href="#">Canada</a> |  <a href="#">Chile</a>  |  <a href="#">Czech Republic</a> |  <a href="#">India</a>  |  <a href="#">Indonesia</a> |  <a href="#">Ireland</a> |  <a href="#">New Zealand</a> | <a href="#">United Kingdom</a> |  <a href="#">Turkey</a>  |  <a href="#">Philippines</a> |  <a href="#">Sri Lanka</a>  |  <a href="#">Australia</a> |  <a href="#">Brasil</a> | <a href="#">Canada</a> |  <a href="#">Chile</a>  |  <a href="#">Czech Republic</a> |  <a href="#">India</a>  |  <a href="#">Indonesia</a> |  <a href="#">Ireland</a> |  <a href="#">New Zealand</a> | <a href="#">United Kingdom</a> |  <a href="#">Turkey</a>  |  <a href="#">Philippines</a> |  <a href="#">Sri Lanka</a>
                  </div>
                  <p class="mt-4 text-black">POPULAR FOOD</p>
                  <div class="search-links">
                     <a href="#">Fast Food</a> |  <a href="#">Chinese</a> | <a href="#">Street Food</a> |  <a href="#">Continental</a>  |  <a href="#">Mithai</a> |  <a href="#">Cafe</a>  |  <a href="#">South Indian</a> |  <a href="#">Punjabi Food</a> |  <a href="#">Fast Food</a> |  <a href="#">Chinese</a> | <a href="#">Street Food</a> |  <a href="#">Continental</a>  |  <a href="#">Mithai</a> |  <a href="#">Cafe</a>  |  <a href="#">South Indian</a> |  <a href="#">Punjabi Food</a><a href="#">Fast Food</a> |  <a href="#">Chinese</a> | <a href="#">Street Food</a> |  <a href="#">Continental</a>  |  <a href="#">Mithai</a> |  <a href="#">Cafe</a>  |  <a href="#">South Indian</a> |  <a href="#">Punjabi Food</a> |  <a href="#">Fast Food</a> |  <a href="#">Chinese</a> | <a href="#">Street Food</a> |  <a href="#">Continental</a>  |  <a href="#">Mithai</a> |  <a href="#">Cafe</a>  |  <a href="#">South Indian</a> |  <a href="#">Punjabi Food</a>
                  </div>
               </div>
            </div>
         </div>
      </section> -->
  @endsection 
@section('extrajs')
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> -->
     
            <!-- Custom scripts for all pages-->
<script src="{{url('/public/assets/js/custom.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

<script type="text/javascript">
$(document).on('click','.searchfood ',function(e){
e.preventDefault();

var vendor = $( ".vendor-select option:selected" ).val();
var school = $( ".school-select option:selected" ).val();

// alert(school);
$.ajax({
type:'GET',
url:"{{ URL::route('searchfood') }}",
data:{'school' : school,'vendor':vendor},
beforeSend: function() {
},
success:function(res){
$('#all_list').html(' ');
$('#all_list').append(res);
$('.owl-carousel').show();
$('.owl-carousel').css('width: 100%; z-index: 1;');
document.querySelector('#all_list').scrollIntoView({behavior: 'smooth'});
// window.scroll({
// top: 300,
// left: 0,
// behavior: 'smooth'
// });

}
});


});
</script>

@endsection