@extends('layouts.master')

@section('content')
<div class="container-fluid">
  <!-- Page-Title -->
  <div class="row">
    <div class="col-sm-12">
      <div class="page-title-box">
        <div class="btn-group pull-right">
          <ol class="breadcrumb hide-phone p-0 m-0">
            
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
        <h4 class="page-title">Dashboard</h4>
      </div>
    </div>
  </div>
  <!-- end page title end breadcrumb -->

 
    @if(Auth::check())
  @php  $roles = Auth::user()->roles()->pluck('name')->implode(' ');

   @endphp
  @endif

@if($roles=='Super Admin')
<div class="row">
<div class="col-md-6 col-xl-3">
      <div class="mini-stat clearfix bg-info"> <span class="mini-stat-icon bg-light"><i class="mdi mdi-cube-outline text-success"></i></span>
        <div class="mini-stat-info text-right text-light"> <span class="counter text-white">{{ App\User::where('IsActive','1')->get()->count() }}</span>
 <a href="" class="text-white">Active User </a>
         </div>
        
      </div>
    </div>

<div class="col-md-6 col-xl-3">
      <div class="mini-stat clearfix bg-danger"> <span class="mini-stat-icon bg-light"><i class="mdi mdi-cube-outline text-success"></i></span>
        <div class="mini-stat-info text-right text-light"> <span class="counter text-white">{{ App\Client::where('IsActive','1')->get()->count() }}</span>
 <a href="" class="text-white">Active Client </a>
         </div>
        
      </div>
    </div>

    <div class="col-md-6 col-xl-3">
      <div class="mini-stat clearfix bg-warning"> <span class="mini-stat-icon bg-light"><i class="mdi mdi-cube-outline text-success"></i></span>
        <div class="mini-stat-info text-right text-light"> <span class="counter text-white">{{ App\Location::where('IsActive','1')->get()->count() }}</span>
 <a href="" class="text-white">Active Location </a>
         </div>
        
      </div>
    </div>
    
    <div class="col-md-6 col-xl-3">
      <div class="mini-stat clearfix bg-info"> <span class="mini-stat-icon bg-light"><i class="mdi mdi-cube-outline text-success"></i></span>
        <div class="mini-stat-info text-right text-light"> <span class="counter text-white">{{ App\Advertise::where('IsActive','1')->get()->count() }}</span>
 <a href="" class="text-white">Active Advertisement </a>
         </div>
        
      </div>
    </div>

     <div class="col-md-6 col-xl-3">
      <div class="mini-stat clearfix bg-warning"> <span class="mini-stat-icon bg-light"><i class="mdi mdi-cube-outline text-success"></i></span>
        <div class="mini-stat-info text-right text-light"> <span class="counter text-white">{{ App\Schedule::where('IsActive','1')->get()->count() }}</span>
 <a href="" class="text-white">Advertisement Schedule </a>
         </div>
        
      </div>
    </div>
    

  </div>
@endif

  </div>
  
  <!-- end row -->
</div>
@endsection 