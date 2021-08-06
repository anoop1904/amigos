<!-- Header -->
<header>
  <nav class="navbar navbar-fixed-top nav-base light-bg" id="minify_nav">
    <div class="container">
      <div class="navbar-header">
        <!-- Responsive Menu Button -->
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
          <span class="sr-only">Navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

        <!-- Logo Image -->
        <a href="{{ URL('/') }}" class="navbar-brand logo-default">
          <img src="{{ asset('assets/frontend/img/logo-green.png') }}" alt="logo">
        </a>
        <a href="{{ URL('/') }}" class="navbar-brand logo-alt">
          <img src="{{ asset('assets/frontend/img/logo-dark.png') }}" alt="logo">
        </a>
                

      </div>

       

      <div id="navigation" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
@if(Request::segment(1) != 'list')  
         <li><a href="#about">About us</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#image-gallery">Portfolio</a></li>
          <li><a href="#client">Client</a></li>
          
          <li><a href="#contact">Contact</a></li>
@endif

@if(session()->has('front-login'))
                    <li><a href="{{ URL('list') }}">My Screen</a></li>
                    <li> <span class="btn radius green-2 ">Welcome {{ session()->get('front-login')[0]['fname'] }} </span></li>
                    <li> <a href="{{ URL('/user_logout') }}" class="btn radius green-2 ">Logout</a></li>
@else
          
               <li> <a href="#" class="btn radius green-2 " data-toggle="modal" data-target="#myModal">USER LOGIN</a></li>
@endif
                   
        </ul>
      </div>

    </div>
  </nav>
</header>
<!-- End Header -->
