@extends('layouts.master')

@section('content')

<!--begin::Main-->
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
<!--begin::Container-->
<div class="container">
<!--begin::Dashboard-->
   <style type="text/css">
  .table td,.table th {
    border: 1px solid #EBEDF3 ! important;
  }
 
 
</style>


<div class="row">

            <!-- Earnings (Monthly) Card Example -->
            @if(Auth::user()->user_type == 1)
            
			     <!--  <div class="col-xl-3 col-md-6 mb-4 ">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a href="{{URL('/admin/customer')}}">Total Customers</a></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">23</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users  fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a href="{{URL('/admin/product')}}">Total Product</a></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">23</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-school fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a href="#">Total Store</a></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">23</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users  fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a href="{{URL('/admin/category')}}">Category</a></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">23</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-school fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->

            @endif
            

</div>
        <div class="row">

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6" style="padding-left: 0px;"  >
            <!-- AREA CHART -->
            <div class="card card-primary" style="display:none;" >
              <div class="card-header">
                <h3 class="card-title">Area Chart</h3>

              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="areaChart1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

         
          </div>
         
        
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
<!--end::Main-->  
      </div>
   
        <!--end::Dashboard-->
        
        </div>
        <!--end::Container-->
        </div>
        <!--end::Entry-->



@endsection 
