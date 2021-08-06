@extends('layouts.master')


@section('content')
<div class="container-fluid">
  <!-- Page-Title -->
  <div class="row">
    <div class="col-sm-12">
      <div class="page-title-box">
        <h4 class="page-title"><i class="fa fa-key"></i>Jobs Avilable
        </h4>
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
          <h4 class="mt-0 header-title">Job List @can('Create Job Post')<a href="{!!URL('admin/jobmaster/create')!!}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>Add Job</a>@endcan </h4><hr/>
          <table class="table table-dark">
            <thead>
              <tr>
                <th width="5%">#</th>
               
                <th width="10%">Job Title</th>
                <th width="10%">Job Description</th>
                <th width="10%">Department</th>
                <th width="10%">Positions</th>
                <th width="10%">Skills</th>
                <th width="10%">Keywords</th>
                <th width="10%">Location</th>
                <th width="10%">View</th>
                @can('Create Job Post')
                <th width="20%">Operations</th>
                @endcan
              </tr>
            </thead>
            <tbody>
            
           
            @php $count = 1; @endphp
            @if(isset($jobmasterall) && !empty($jobmasterall))
            @foreach ($jobmasterall as $jobmasteralls)
           
            <tr>
              <td>{{ $count }}</td>
             
              <td>{{ $jobmasteralls->JobTitle }}</td>
              <td>{{ $jobmasteralls->Description }}</td>
              <td>{{ $jobmasteralls->Department }}</td>
              <td>{{ $jobmasteralls->Positions }}</td>
              <td>{{ $jobmasteralls->Skills }}</td>
              <td>{{ $jobmasteralls->Keywords }}</td>
              <td>{{ $jobmasteralls->Location }}</td>
               <td>
                   <a href="{{ URL::to('admin/job-detail', array($jobmasteralls->id,str_slug($jobmasteralls->JobTitle))) }}" class="btn btn-success pull-left" style="margin-right: 3px;">View</a> 
               </td>
              @can('Create Job Post')
              <td>
                  <a href="{{ route('jobmaster.edit', $jobmasteralls->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a> 
                  {!! Form::open(['method' => 'DELETE', 'route' => ['jobmaster.destroy', $jobmasteralls->id] ]) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!} </td>
                @endcan
            </tr>
            
            
            @php $count++; @endphp
            @endforeach
            @endif
            
            </tbody>
            
          </table>
        </div>
      </div>
    </div>
    <!-- end col -->
  </div>
  <!-- end row -->
</div>
<!-- end container -->
@endsection