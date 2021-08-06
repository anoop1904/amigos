<div class="col-sm-12 form-group">
  <div class="row">
    <div class="col-sm-4">{{ $page_title }}</div>
    <div class="col-sm-8">
       <a href="{{ URL('admin/clientWiseReport') }}"><span class="badge badge-success">Client Wise</span></a>
      <a href="{{ URL('admin/locationWiseReport') }}"><span class="badge badge-danger">Location Wise</span></a>
      <a href="{{ URL('admin/advertiseWiseReport') }}"><span class="badge badge-primary">Advertise Wise</span></a>
      <a href="{{ URL('admin/scheduleWiseReport') }}"><span class="badge badge-info">Schedule Wise</span></a>
    </div>
  </div>
</div>

<style type="text/css">
	.dt-buttons{
		display: inline-table;
	}
	#report_filter{
		display: inline-table;
	    float: right;
	}
</style>