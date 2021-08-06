@extends('layouts.frontmaster')



@section('content')


<div class="innerbgcontainer">

 @include('includes.frontheader')
<div class="searchcontiner wow fadeInUp">
  <h5>Search</h5>
  <div class="searchcon">
    <div class="row">
      <div class="col-md-5">
        <div class="form-group">
          <input class="form-control" placeholder="What are you Looking for"/>
        </div>
      </div>
      <div class="col-md-5">
        <div class="form-group">
          <select class="form-control">
            <option>Select Category</option>
          </select>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <button class="btn btn-primary w-100">Search</button>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
  
<section class="maincategorylist pt-5 pb-5">
<div class="container">
  <h2><span>All</span> Categories</h2>
  <div class="row mt-5">
  <div class="col-sm-6 col-md-3 col-lg-3">
  <div class="categorylistbox wow fadeInUp">
    <a href="#">
  <div class="cateimg"><img src="images/product_0005__-700x700.png" class="img-fluid"/></div>
    <h6>Boom Lift</h6>
      </a>
  </div>  
  </div>
    
  <div class="col-sm-6 col-md-3 col-lg-3">
  <div class="categorylistbox wow fadeInUp">
    <a href="#">
  <div class="cateimg"><img src="images/product_0005__-700x700.png" class="img-fluid"/></div>
    <h6>Articulating Boom Lift</h6>
    </a>
  </div>  
  </div>
    
  <div class="col-sm-6 col-md-3 col-lg-3">
  <div class="categorylistbox wow fadeInUp">
    <a href="#">
  <div class="cateimg"><img src="images/product_image_2-424-600x518.png" class="img-fluid"/></div>
    <h6>Telescopic Boom Lift </h6>
    </a>
  </div>  
  </div>
    
  <div class="col-sm-6 col-md-3 col-lg-3">
  <div class="categorylistbox wow fadeInUp">
    <a href="#">
  <div class="cateimg"><img src="images/product_image_4-71-600x518-(1).png" class="img-fluid"/></div>
    <h6>Scissor Lift</h6>
    </a>
  </div>  
  </div>
    
    
  <div class="col-sm-6 col-md-3 col-lg-3">
  <div class="categorylistbox wow fadeInUp">
    <a href="#">
  <div class="cateimg"><img src="images/product_image_4-71-600x518-(1).png" class="img-fluid"/></div>
    <h6>Electric Scissor Lift </h6>
      </a>
  </div>  
  </div>
    
  <div class="col-sm-6 col-md-3 col-lg-3">
  <div class="categorylistbox wow fadeInUp">
    <a href="#">
  <div class="cateimg"><img src="images/product_image_4-403-700x700.png" class="img-fluid"/></div>
    <h6>Rough Terrain Scissor Lift </h6>
    </a>
  </div>  
  </div>
    
  <div class="col-sm-6 col-md-3 col-lg-3">
  <div class="categorylistbox wow fadeInUp">
    <a href="#">
  <div class="cateimg"><img src="images/product_image_11-230-600x518-(1).png" class="img-fluid"/></div>
    <h6>  Forklift </h6>
    </a>
  </div>  
  </div>
    
  <div class="col-sm-6 col-md-3 col-lg-3">
  <div class="categorylistbox wow fadeInUp">
    <a href="#">
  <div class="cateimg"><img src="images/product_image_10-3-600x518.png" class="img-fluid"/></div>
    <h6>Pallet Jack </h6>
    </a>
  </div>  
  </div>
    
    
    
  <div class="col-sm-6 col-md-3 col-lg-3">
  <div class="categorylistbox wow fadeInUp">
    <a href="#">
  <div class="cateimg"><img src="images/product_0027__-700x700.png" class="img-fluid"/></div>
    <h6>Telehandler</h6>
      </a>
  </div>  
  </div>
    
  <div class="col-sm-6 col-md-3 col-lg-3">
  <div class="categorylistbox wow fadeInUp">
    <a href="#">
  <div class="cateimg"><img src="images/product_image_7-34-600x518.png" class="img-fluid"/></div>
    <h6>Manlift</h6>
    </a>
  </div>  
  </div>
    
  <div class="col-sm-6 col-md-3 col-lg-3">
  <div class="categorylistbox wow fadeInUp">
    <a href="#">
  <div class="cateimg"><img src="images/br_pusharound.png" class="img-fluid"/></div>
    <h6>Self Propelled Manlift</h6>
    </a>
  </div>  
  </div>
    
  <div class="col-sm-6 col-md-3 col-lg-3">
  <div class="categorylistbox wow fadeInUp">
    <a href="#">
  <div class="cateimg"><img src="images/product_image_27-120-600x518.png" class="img-fluid"/></div>
    <h6>Earthmoving Equipment</h6>
    </a>
  </div>  
  </div>
    
  </div>
  
  
  <div class="text-center mt-5"><a href="#" class="btn btn-primary">Load More</a></div>
  
</div>  
</section>

@include('includes.contactForm')

@endsection 

@section('extrajs')
@endsection