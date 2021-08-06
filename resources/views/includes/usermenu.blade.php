 <ul class="nav">
    <li @if($pagename=='dashboard') class="active" @endif >
      <a href="{{url('/student/dashboard')}}"> Dashboard </a>
    </li>
    <li @if($pagename=='subscriptions') class="active" @endif>
      <a href="{{url('/student/subscriptions')}}">Plan Subscriptions </a>
    </li>
    <li  @if($pagename=='profile') class="active" @endif>
      <a href="{{url('/student/profile')}}">Profile</a>
    </li>
     <li @if($pagename=='change_password') class="active" @endif>
      <a href="{{url('/student/change-password')}}">Change Password</a>
    </li>
     <li @if($pagename=='wallet') class="active" @endif>
      <a href="{{url('/student/wallet')}}">Referral List</a>
    </li>
    <li>
      <a class="dropdown-item" href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Logout</a>
    </li>
</ul>