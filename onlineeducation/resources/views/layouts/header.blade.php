<header id="topnav">
    
@if(Auth::check())
  @php  
    $roles = Auth::user()->roles()->pluck('name')->implode(' ');
    $role_id = Auth::user()->roles()->pluck('id')->implode(' ');
    $modulePermission = Illuminate\Support\Facades\DB::table('role_has_permissions')->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')->where('permissions.parent_id','0')->where('role_id',$role_id)->select('permissions.id')->get()->pluck('id')->toArray();
    //print_r($modulePermission);

   // Aadya@123456789 
  @endphp
@endif
  
  <div class="topbar-main">
    <div class="container-fluid">
      <!-- Logo container-->
      <div class="logo">
        
        <a href="{!!URL('/')!!}/admin/dashboard" class="logo"> 
          <img src="{{ asset('assets/frontend')}}/images/logo.png" alt="" height="22" class="logo-small"> 
          <img src="{{ asset('assets/frontend')}}/images/logo.png" alt="" style="width: 60%;" class="logo-large">
           </a> </div>
      <!-- End Logo container-->
      <div class="menu-extras topbar-custom">
        <!-- Search input -->
        <div class="search-wrap" id="search-wrap">
          <div class="search-bar">
            <input class="search-input" type="search" placeholder="Search" />
            <a href="#" class="close-search toggle-search" data-target="#search-wrap"> <i class="mdi mdi-close-circle"></i> </a> </div>
        </div>
        <ul class="list-inline float-right mb-0">
          <!-- Search -->
          
          
         

          <!-- User-->
          @if(Auth::check())
          <li class="list-inline-item dropdown notification-list">   {{Auth::user()->name}} 
            <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                           aria-haspopup="false" aria-expanded="false"
                           style="background: #bdbbb7;border-radius: 25px;padding: 0px 20px;" > 
                           @php
                           $arr = explode(' ',Auth::user()->name);
                            if($arr[0] ){
                              echo strtoupper(substr($arr[0], 0, 1));
                            }
                            if(isset($arr[1])){
                              echo ' '.strtoupper(substr($arr[1], 0, 1));
                            }
                           @endphp
                           <!-- <img src="{!!URL('/')!!}/assets/images/users/avatar-1.jpg" alt="user" class="rounded-circle">  -->
                         </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown "> 
                <a class="dropdown-item" href="{!!URL('/')!!}/admin/profile"><i class="dripicons-user text-muted"></i> Profile</a> 
                @if($roles=='Super Admin')   
                <a class="dropdown-item" href="{!!URL('/')!!}/admin/websitesetting"><span class="badge badge-success pull-right m-t-5"></span><i class="dripicons-gear text-muted"></i> Settings</a> 
                @endif
               
                 <div class="dropdown-divider"></div>
              <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="dripicons-exit text-muted"></i>Logout</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </div>
          </li>@endif
          <li class="menu-item list-inline-item">
            <!-- Mobile menu toggle-->
            <a class="navbar-toggle nav-link">
            <div class="lines"> <span></span> <span></span> <span></span> </div>
            </a>
            <!-- End mobile menu toggle-->
          </li>
        </ul>
      </div>
      <!-- end menu-extras -->
      <div class="clearfix"></div>
    </div>
    <!-- end container -->
  </div>
  <!-- end topbar-main -->
  <!-- MENU Start -->
  
  <div class="navbar-custom">
    <div class="container-fluid">
      <div id="navigation">
        <!-- Navigation Menu-->
        <ul class="navigation-menu">
          <li class="has-submenu"> <a href="{{ URL('admin/dashboard') }}"><i class="ti-home"></i>Dashboard</a> </li>
          @if($roles=='Super Admin')
          <li class="has-submenu"> <a href="{{ route('users.index') }}"><i class="ti-user"></i>Users</a> </li>
        
          <li class="has-submenu"> <a href="{{ route('school.index') }}"><i class="ti-user"></i>School</a> </li>
          @endif

        </ul>
        <!-- End navigation menu -->
      </div>
      <!-- end #navigation -->
    </div>
    <!-- end container -->
  </div>
  <!-- end navbar-custom -->
</header>
