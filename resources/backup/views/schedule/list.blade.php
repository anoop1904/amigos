@extends('layouts.master')


@section('content')
<div class="container-fluid">
  <!-- Page-Title -->
  <div class="row">
    <div class="col-sm-12">
      <div class="page-title-box">
        <h4 class="page-title"> </h4>
      </div>
    </div>
  </div>
  @if (count($errors) > 0)
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  @if(Session::has('message'))
  <div class="alert alert-success login-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('message') !!} </div>
  @endif
  <!-- end page title end breadcrumb -->
     
  <div class="row">

	   <div class="col-lg-12">
	      <div class="card m-b-30">
	        <div class="card-body">
	          <table id="example" class="display" style="width:100%">
		        <thead>
		            <tr>
		               
		                <th>SNO</th>
		                <th>client name</th>
		                <th>Location</th>
		                <th>Screen</th>
		                <th>Advertise</th>
		                <th>From Date</th>
		                <th>To Date</th>
		                <th>Duration</th>
		                <th>Status</th>
		                <th>Action</th>
		            </tr>
		        </thead>
		        <tbody>
		        	
		        	@foreach($schedules as $key=>$schedule)
		        	<tr>
		        		<td>1</td>
		        		<td>{{ $schedule->client->fname.' '.$schedule->client->lname }}</td>
		        		<td>{{ $schedule->advertise->location->location }}</td>
		        		<td>{{ $schedule->advertise->location->screen_name }}</td>
		        		<td>{{ $schedule->advertise->advertise_name }}</td>
		        		<td>1</td>
		        		<td>1</td>
		        		<td>1</td>
		        		<td>1</td>
		        		<td>1</td>
		        	</tr>
		        	@endforeach
		        </tbody>
	    	  </table>
	        </div>
	      </div>
	    </div>
    <!-- end col -->
  </div>
  <!-- end row -->

          </div>
           </div>




          
      </div>
    </div>
    <!-- end col -->
   
  </div>
  <!-- end row -->
</div>



<!-- end container -->
@endsection
@section('extrajs')

@endsection