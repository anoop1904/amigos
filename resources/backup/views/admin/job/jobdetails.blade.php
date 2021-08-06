@extends('layouts.master')


@section('content')
<div class="container-fluid">
  <!-- Page-Title -->
  <div class="row">
    <div class="col-sm-12">
      <div class="page-title-box">
        
        <h4 class="page-title"><i class="fa fa-key"></i>Jobs Deatils
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
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    @can('Create Job Post')
                    <a href="{!!URL::to('admin/candidate-create',array($jobs->id,str_slug($jobs->JobTitle)))!!}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>Add People</a>
                   @endcan
                    <h4 class="mt-0 header-title">{{$jobs->JobTitle}}</h4>
                    <p class="text-muted m-b-30 font-14">{{$jobs->Description}}.</p>
                    <hr>
                    @if(isset($candidatemaster) && !empty($candidatemaster))
                    @foreach($candidatemaster as $rowcandidatemaster)
                    @php $innterview = App\InterviewSchedule::where('OrgID',$rowcandidatemaster->OrgID)->where('student_id',$rowcandidatemaster->id)->where('jobid',$rowcandidatemaster->JobID)->first(); @endphp
                    <div class="media m-b-30">
                    <a href="{!!URL::to('admin/candidate/edit',array($jobs->id))!!}">
                        <img class="d-flex align-self-start mr-3 rounded-circle" src="{!!URL('/')!!}/assets/images/users/avatar-1.jpg" alt="user" height="64"></a>
                        
                        <div class="media-body">
                            <h5 class="mt-0 font-18">{{$rowcandidatemaster->FirstName}}</h5>
                            <p>{{$rowcandidatemaster->FirstName}}</p>
                            @if(count($innterview) > 0)
                            <a href="javascript:;" class="btn btn-success pull-right">Interview Booked</a>
                            @else
                            <a href="{{ URL::to('admin/interview-schedule',array($jobs->id,str_slug($jobs->JobTitle),$rowcandidatemaster->id,str_slug($rowcandidatemaster->FirstName))) }}" class="btn btn-primary pull-right">Interview Schedule</a>
                            @endif
                             <p>{{$rowcandidatemaster->created_at}}</p>
                            <p>{{$rowcandidatemaster->Source}}</p>
                        </div>
                    </div>
                    @endforeach
                    @endif

                    
                </div>
            </div>
        </div>
    </div><!--end row-->
</div>
<!-- end container -->
@endsection