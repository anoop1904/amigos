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

<?php
 $line_chart_val = json_encode($chart_arr['line_chart']); 
 ?>
<div class="row">

            <!-- Earnings (Monthly) Card Example -->
            @if(Auth::user()->user_type == 1)
            
			 <div class="col-xl-3 col-md-6 mb-4 ">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a href="{{URL('/admin/customer')}}">Total Customers</a></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Customer::where('IsActive','1')->count() }}</div>
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
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Product::where('IsActive','1')->count()}}</div>
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
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a href="{{URL('/admin/store')}}">Total Store</a></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Store::where('IsActive','1')->count() }}</div>
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
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Category::where('IsActive','1')->count()}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-school fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

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
                  <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- DONUT CHART -->
            <div class="card card-danger">
              <div class="card-header" style="padding: 10px 20px;color: #fff;background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(38,138,26,1) 22%, rgba(55,201,21,1) 37%, rgba(0,212,255,1) 100%);" >
                <h3 class="card-title" style="margin-bottom:0px;" >Product Status</h3>

              </div>
              <div class="card-body">
                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- PIE CHART -->
            <div class="card card-danger" style="display:none;" >
              <div class="card-body">
                <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              </div>
          </div>
          <!-- /.col (LEFT) -->
          <div class="col-md-6" style="padding-right:0px;" >
            <!-- LINE CHART -->
            <div class="card card-info" style="display:none;" >
              <div class="card-header">
                <h3 class="card-title">Line Chart</h3>

              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- BAR CHART -->
            <div class="card card-success">
            <div class="card-header" style="color:#fff;padding: 10px 20px;background: linear-gradient(90deg, rgba(55,201,21,1) 0%, rgba(77,145,145,0.9808298319327731) 0%, rgba(53,116,207,1) 0%, rgba(139,163,170,0.9976365546218487) 56%);" >
                <h3 class="card-title" style="margin-bottom:0px;" >Delivery Status</h3>
              </div>  
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


          </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
<!--end::Main-->  
      </div>
      <div class="row" style="margin-left: 2px;" >
      <div id="curve_chart" style="width: 1265px; height: 500px"></div>  
      </div>
        <!--end::Dashboard-->
        
        </div>
        <!--end::Container-->
        </div>
        <!--end::Entry-->

<!-- chart js -->
<script src="{{ asset('assets/chart') }}/plugins/jquery/jquery.min.js" > </script>
<script src="{{ asset('assets/chart') }}/plugins/chart.js/Chart.min.js" > </script>

<script>
 $(function () {

    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
    var areaChartData = {
      labels  : [<?= implode(",",$chart_arr['month']) ?>],
      datasets: [
        {
          label               : 'Pending',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?= implode(",",$chart_arr['pending']) ?>]
        },
        {
          label               : 'delivered',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?= implode(",",$chart_arr['done']) ?>]
        },
        {
          label               : 'Cancel',
          backgroundColor     : 'rgba(248, 78, 48, 1)',
          borderColor         : 'rgba(248, 78, 48, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(248, 78, 48, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?= implode(",",$chart_arr['cancel']) ?>]
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'Pending', 
          'Preparing',
          'Picked', 
          'Cancel',
      ],
      datasets: [
        {
          data: [<?= $product_status['Pending'] ?>,<?= $product_status['Accept'] ?>,<?= $product_status['Placed'] ?>,<?= $product_status['Discard'] ?>],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions      
    })

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = donutData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions      
    })

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = jQuery.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    var barChart = new Chart(barChartCanvas, {
      type: 'bar', 
      data: barChartData,
      options: barChartOptions
    })

  
  })
</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable(<?= $line_chart_val ?>);

        var options = {
          title: 'Amigos Revenus',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>

@endsection 
