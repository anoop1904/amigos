@extends('layouts.master')

@section('content')
<div class="container-fluid">
  <!-- Page-Title -->
  <div class="row">
    <div class="col-sm-12">
      <div class="page-title-box">
        <div class="btn-group pull-right">
          <ol class="breadcrumb hide-phone p-0 m-0">
            <li class="breadcrumb-item"><a href="#">Upcube</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
        <h4 class="page-title">JOBS</h4>
      </div>
    </div>
  </div>
  <!-- end page title end breadcrumb -->
  
   
   
<div id="page_section">
 
    
      
      
      
      <div id="candidate_list">
          <div class="row">
              <div class="col-sm-8 col-md-8 col-xl-8">
              
              
                  <div style="background: #bd6408;">
                  
                      
                       <div class="row" style="padding: 10px 1px;">   
                    <div class="col-md-6 col-xl-1 text-right my_text-right">
                        <div class="section_data">
                            <div  class="sort_name">
                                
                                @php echo strtoupper(substr($candidate->FirstName, 0, 1)).strtoupper(substr($candidate->LastName, 0, 1))  @endphp
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-8">
                        <div class="section_data" style="color: #ffffff">
                            <div>{{ $candidate->FirstName.' '.$candidate->LastName }}</div>
                            
                            @if($candidate->CurrentDesignation)
                            <div>{{ $candidate->CurrentDesignation }}</div>
                            @endif
                            
                             @if($candidate->Location)
                            <div>
                                <span class="fa fa-map-marker"></span>
                                {{ $candidate->Location }}
                            </div>
                            @endif
                           
                            @if($candidate->Phone || $candidate->AlternatePhone)
                                <div>
                                    <span class="fa fa-phone"></span>
                                    @if($candidate->Phone)
                                    {{ $candidate->Phone }}
                                    @endif
                                    @if($candidate->AlternatePhone)
                                    ,
                                    {{ $candidate->AlternatePhone }}
                                    @endif
                                </div>
                            @endif
                            
                             @if($candidate->Email || $candidate->AlternateEmail)
                            <div>
                                <span class="fa fa-envelope"></span>
                                    @if($candidate->Email)
                                        {{ $candidate->Email }}
                                    @endif
                                    
                                    @if($candidate->AlternateEmail)
                                    ,
                                        {{ $candidate->AlternateEmail }}
                                    @endif
                            </div>
                            @endif
                                    
                        </div>
                    </div>
                          
                          
                      </div>
                    
                    
                  
                  </div>
                  
                  <div class="">
      <ul class="nav nav-tabs" role="tablist">
  <li class="nav-item">
    
    <a class="nav-link active" href="#profile" role="tab" data-toggle="tab">
        Profile
    </a>
  </li>
  <li class="nav-item">
     
    <a class="nav-link" href="#job_ad" role="tab" data-toggle="tab">
        Activity</a>
  </li>

</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane fade  show active" id="profile">
        
        
     
        <table class="table">
            <tbody>
                <tr>
                    <td>Source</td>
                    <td>:</td>
                    <td>{{ $candidate->Source }}</td>
                </tr>
                <tr>
                    <td>Location</td>
                    <td>:</td>
                    <td>{{ $candidate->Location }}</td>
                </tr>
                <tr>
                    <td>Tags</td>
                    <td>:</td>
                    <td>{{ $candidate->Tags }}</td>
                </tr>
                <tr>
                    <td>Skills</td>
                    <td>:</td>
                    <td>{{ $candidate->Skills }}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>:</td>
                    <td>Data</td>
                </tr>
                <tr>
                    <td>CVText</td>
                    <td>:</td>
                    <td>{{ $candidate->Status }}</td>
                </tr>
                <tr>
                    <td>CVKeywords</td>
                    <td>:</td>
                    <td>{{ $candidate->CVText }}</td>
                </tr>
                <tr>
                    <td>CVKeywords</td>
                    <td>:</td>
                    <td>{{ $candidate->CVKeywords }}</td>
                </tr>
            </tbody>
                
        </table>
            
          
            
        
        
    </div>
  
  
  <div role="tabpanel" class="tab-pane fade" id="job_ad">
               <div class="panel_data">
                    @php $count = 1; @endphp
                    @if(isset($activity) && !empty($activity) && count($activity)>0)
                    @foreach ($activity as $key=>$activitys)
                      
                    <div class="row">
                        <div class="col-md-6 col-xl-2 text-right my_text-right">
                            <div class="sort_name">AD</div>
                        </div>
                        <div class="col-md-6 col-xl-8">
                            <p class="title">By : {{ $activitys->user->name }}</p>
                            <p>@php echo $activitys->message @endphp</p>
                        </div>
                        <div class="col-md-6 col-xl-2 sub_title">
                             @php echo date('d M , Y',strtotime($activitys->created_at)) @endphp
                        </div>
                    </div>
            
              @php $count++; @endphp
            @endforeach
            @else
            <div class="text text-danger">No Review Update</div>
            @endif
            
                  
                  
                  
    
            
        </div>
      
      
  </div>
 
</div>
      
  </div>
              
               <!--//////////////-->
                  
                      
               <div class="container-fluid">
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading active" role="tab" id="headingOne">
      <h4 class="panel-title text-right">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <span class="fa fa-plus show experienceIcon" onclick="show()" title="Add Experience"></span>
            <span class="fa fa-minus hide experienceIcon" style="display: none;" onclick="show()"></span>
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        
          
          <form class="form-horizontal" id="experienceForm" onsubmit="return experienceForm(this)">
              
                  <div class="row form-group">
                      <div class="col-sm-6">
                          <label>Designation</label>
                          <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                          <input type="hidden" class="form-control" name="candidate_id" id="candidate_id" value="{{ $candidate->id }}">
                          <input type="hidden" class="form-control" name="exprience_id" id="candidate_id" value="">
                          <input type="text" class="form-control myForm" name="designation" id="designation" placeholder="Enter Designation">
                      </div>
                      <div class="col-sm-6">
                          <label>Current Company</label>
                          <input type="text" class="form-control myForm" name="current_company" id="current_company" placeholder="Current Company">
                      </div>
                  </div>
                 
                  <div class="row form-group">
                      <div class="col-sm-6">
                          <label>Current CTC</label>
                          <input type="number" step="1.00"  class="form-control myForm" name="ctc" id="ctc" placeholder="Enter CTC">
                      </div>
                      <div class="col-sm-6">
                          <label>Notice Period</label>
                          <input type="text" class="form-control myForm" name="notice_period" id="notice_period" placeholder="Notice Period">
                      </div>
                  </div>
                 
                  <div class="row form-group">
                      <div class="col-sm-2">
                          <label>Total Experience</label>
                          
                      </div>
                      <div class="col-sm-2">
                          <select class="form-control myForm" name="year" id="year">
                              <option value="0" selected="" disabled="">Year</option>
                              <?php 
                              for($i=0; $i<=12;$i++){ ?>
                              <option value="<?php echo $i; ?>" ><?php echo $i; ?></option>    
                              <?php }
                              ?>
                          </select>
                      </div>
                      <div class="col-sm-2">
                          <select class="form-control myForm" name="month" id="month">
                              <option value="0" selected="" disabled="">Month</option>
                              <?php 
                              for($i=0; $i<=12;$i++){ ?>
                              <option value="<?php echo $i; ?>" ><?php echo $i; ?></option>    
                              <?php }
                              ?>
                          </select>
                      </div>
                  </div>
                 
              <div id="candidateExperience">
                  <div class="row form-group">
                      <div class="col-sm-12">
                          <label>Job Description</label>
                          <textarea placeholder="Description" name="description" class="form-control myForm" id="description"></textarea>
                      </div>
                  </div>
                 
                
                 
                  <div class="row form-group">
                      <div class="col-sm-12">
                          <input type="submit" class="btn btn-warning" value="Save">
                      </div>
                  </div>
              </div>
                  
          </form>
          
          
      </div>
    </div>
  </div>
  
</div>
</div>
                  
                  <!--////////////////////-->
                  
                  <div class="mini-stat bg-white">
                      <div class="row" style="padding: 10px 1px;">   
                          <div class="col-md-6 col-xl-3">
                              <div class=""><strong>Experience</strong></div>
                          </div>
                          <div class="col-md-6 col-xl-8">
                          </div>
                          <div class="col-md-6 col-xl-1">
                          </div>
                          
                      </div>
                      
                      
                      
                      
                      
                    @php $count = 1; @endphp
                    @if(isset($experiences) && !empty($experiences) && count($experiences)>0)
                    @foreach ($experiences as $key=>$experience)
                      
                      <div class="row my_exp">   
                          
                          <div class="col-md-6 col-xl-3">
                              <!--<div class="">May 2016 - Current</div>-->
                              <div class="sub_title">
                                  @if($experience->year)
                                  <span> {{ $experience->year }} Year</span>
                                  @endif
                                  @if($experience->month)
                                  <span> {{ $experience->month }} Month</span>
                                  @endif
                                  
                              </div>
                          </div>
                          <div class="col-md-6 col-xl-9">
                              <p class="title">{{ $experience->CurrentDesignation  .' ( '. $experience->CurrentCompany .' ) ' }}</p>
                              <p>{{ $experience->Description }}</p>
                          </div>
                      </div>
            
              @php $count++; @endphp
            @endforeach
            @else
            <div class="text text-danger">No Experience Update</div>
            @endif
            
                
              
                  </div>
              </div>
              
              
              <div class="col-md-4 col-xl-4">
                  <div class="mini-stat-small clearfix bg-white">
                  <div class="row">
                      <div class="col-md-2 col-xl-2 text-center">
                          <span class="fa fa-angle-left"></span>
                      </div>
                      <div class="col-md-8 col-xl-8">
                          <select class="form-control">
                              <option>Select</option>
                          </select>
                      </div>
                      <div class="col-md-2 col-xl-2 text-center">
                          <span class="fa fa-angle-right"></span>
                      </div>
                  </div>
                  </div>
                  <div class="mini-stat clearfix bg-white">
                  <div class="row">
                      <div class="col-md-12 col-xl-12 ">
                          <div class="title">Name</div>
                      </div>
                      <div class="col-md-12 col-xl-12 text-right">
                          <span class="ti-star star-active"></span>
                          <span class="ti-star"></span>
                          <span class="ti-star"></span>
                          <span class="ti-star"></span>
                          <span class="ti-star"></span>
                      </div>
                      <div class="col-md-12 col-xl-12 ">
                          <div class="">Address</div>
                      </div>
                      <div class="col-md-12 col-xl-12 ">
                          <div class="">From</div>
                      </div>
                      <div class="col-md-12 col-xl-12 ">
                          <div class="sub_title"><?php echo date('d-M-Y'); ?></div>
                      </div>
                      <div class="col-md-12 col-xl-12 ">
                          <div class="sub_title">Current Stage</div>
                      </div>
                      <div class="col-md-12 col-xl-12 ">
                          
                          <div class="progress new_margin">
  <div class="progress-bar bg-success" style="width:20%">
    New
  </div>
  <div class="progress-bar bg-warning" style="width:20%">
    interview
  </div>
  <div class="progress-bar bg-danger" style="width:20%">
    Short list
  </div>
  <div class="progress-bar bg-success" style="width:20%">
    Danger
  </div>
  <div class="progress-bar bg-primary" style="width:20%">
    Danger
  </div>
</div>
                      </div>
                  </div>
                      
                      
                      
                      <div class="row" style="margin-top: 20px;padding-bottom: 20px;border-bottom-style: inset;">
                          <div class="col-md-6 col-xl-6">
                              <select class="form-control">
                                  <option>Move forward</option>
                              </select>
                          </div>
                          <div class="col-md-6 col-xl-2">
                              <button class="btn btn-default">Reject</button>
                          </div>
                          <div class="col-md-6 col-xl-4 text-right">
                                <div class="dropdown">
<!--                                <span role="button" style="cursor: pointer" data-toggle="dropdown"> <i class="ti-list"></i>
                                </span>-->
<!--                                <ul class="dropdown-menu">

                                    <li><a href="#">HTML</a></li>
                                    <li><a href="#">CSS</a></li>
                                    <li><a href="#">JavaScript</a></li>
                                </ul>-->
                            </div>
                          </div>
                      </div>
                      <div class="row" style="margin-top: 20px;padding-bottom: 20px;border-bottom-style: inset;">
                          <div class="col-md-6 col-xl-8">
                             Attachment
                          </div>
                          
                          <div class="col-md-6 col-xl-4 text-right">
                              <span role="button" style="cursor: pointer" data-toggle="dropdown"> <i class="ti-plus"></i>
                                </span>
                          </div>
                          
                          
                          <div class="col-md-6 col-xl-8">
                              <!--<i class="fa fa-user-circle"></i>-->
                              @if($candidate->UploadedCVPath)
                             <a target="_blank" href="{{ URL('assets/assets/img/pages/').'/'.$candidate->UploadedCVPath }}">
                              Resume
                             </a>
                              
                              <a href="{{ URL('admin/resumeDownloader').'/'.$candidate->id }}">
                              <i class="fa fa-download"></i>
                              </a>
                              @else
                              <span>Resume Not upload</span>
                              @endif
                              
                              
                          </div>
                          
                          <div class="col-md-6 col-xl-4 text-right">
                              <span role="button" style="cursor: pointer" data-toggle="dropdown"> <i class="ti-plus"></i>
                                </span>
                          </div>
                      </div>
<!--                      <div class="row" style="margin-top: 20px;padding-bottom: 20px;">
                          <div class="col-md-6 col-xl-8">
                             Assessments
                          </div>
                          
                          <div class="col-md-6 col-xl-4 text-right">
                              
                          </div>
                          
                      </div>
                          <div class="row new_row">
                          <div class="col-md-6 col-xl-8">
                              <span>Background Check</span>
                          </div>
                          
                          <div class="col-md-6 col-xl-4 text-right">
                              <a href="#">Browse</a>
                              <button class="btn"> <i class="fa fa-angle-right"></i></button>
                          </div>
                          </div>
                          <div class="row new_row">
                          <div class="col-md-6 col-xl-8">
                              <span>Background Check</span>
                          </div>
                          
                          <div class="col-md-6 col-xl-4 text-right">
                              <a href="#">Browse</a>
                              <button class="btn"> <i class="fa fa-angle-right"></i></button>
                          </div>
                          </div>
                          <div class="row new_row">
                          <div class="col-md-6 col-xl-8">
                              <span>Background Check</span>
                          </div>
                          
                          <div class="col-md-6 col-xl-4 text-right">
                              <a href="#">Browse</a>
                              <button class="btn"> <i class="fa fa-angle-right"></i></button>
                          </div>
                          </div>
                          -->
                          
                      
                      
                  </div>
<!--                  <div class="mini-stat clearfix bg-white">
                  <div class="row">
                      <div class="col-md-6 col-xl-12 ">
                          <div class="">AD</div>
                      </div>
                  </div>
                  </div>-->
              </div>
          </div>
      </div>
      
  </div>
  <!-- end row -->
   
 
    <!-- end col -->
    
    <!-- end col -->
  </div>
 

<div id="reviewModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" >

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Candidate</h4>
      </div>
      <div class="modal-body">
        
          <form class="form-horizontal" id="reviewForm"  onsubmit="return reviewForm(this)">
              <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
              <input type="hidden" name="OrgID" id="csrf-token" value="{{ $candidate->OrgID }}" />
              <input type="hidden" name="JobID" id="csrf-token" value="{{ $candidate->JobID }}" />
              <input type="hidden" name="candidate_id" id="candidate_id" value="{{ $candidate->id }}" />
              <input type="hidden" name="review_id" id="review_id" value="" />
 
 
  <div class="row form-group">
  <div class="col-sm-12">
    <label class="control-label col-sm-2" for="email">Reviews:</label>
    <div class="col-sm-12">
        <textarea placeholder="Notes" name="Reviews" id="Reviews" class="form-control myForm"></textarea>
    </div>
  </div>
  
  </div>

 
  <div class="col-sm-6 form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" id="reviewSaveBtn" class="btn btn-default">
          <i class="fa-li fa fa-spinner fa-spin" id="reviewSaveLoader" style="position: relative;left: 0px;display: none;"></i>
          Add</button>
    </div>
  </div>
</form>
      </div>
<!--      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
    </div>

  </div>
</div>

<div id="interviewModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" >

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Candidate</h4>
      </div>
      <div class="modal-body">
        
          <form class="form-horizontal" id="interviewForm"  onsubmit="return interviewForm(this)">
              <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
              <input type="hidden" name="OrgID" id="csrf-token" value="{{ $candidate->OrgID }}" />
              <input type="hidden" name="JobID" id="JobID" value="{{ $candidate->JobID }}" />
              <input type="hidden" name="candidate_id" id="candidate_id" value="{{ $candidate->id }}" />
              <input type="hidden" name="interview_id" id="interview_id" value="" />
 
 
  <div class="row form-group">
  <div class="col-sm-12">
    <label class="control-label col-sm-10" for="email">Select Interviewer :</label>
    <div class="col-sm-12">
        <select name="user_id" id="user_id" class="form-control myForm">
            <option value="" selected disabled>Select Interviewr Name</option>
            @foreach($user as $userrow)
            <option value="{{$userrow->id}}">{{$userrow->name}}</option>
            @endforeach
        </select>
    </div>
  </div>
  
  </div>
  <div class="row form-group">
  <div class="col-sm-6">
    <label class="control-label col-sm-10" for="email">Date : </label>
    <div class="col-sm-12">
        {{ Form::text('interview_date', '', array('id'=>'interview_date','class' => 'form-control myForm datepicker','placeholder'=>'YY-MM-DD','required'=>'required')) }}
    </div>
  </div>
  <div class="col-sm-6">
    <label class="control-label col-sm-10" for="email">Time : </label>
    <div class="col-sm-12">
        {{ Form::time('interview_time','', array('id'=>'interview_time', 'class' => 'form-control myForm','placeholder'=>'Time','required'=>'required')) }}
    </div>
  </div>
  
  </div>

 
  <div class="col-sm-6 form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" id="interviewSaveBtn" class="btn btn-default">
          <i class="fa-li fa fa-spinner fa-spin" id="interviewSaveLoader" style="position: relative;left: 0px;display: none;"></i>
          Add</button>
    </div>
  </div>
</form>
      </div>
<!--      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
    </div>

  </div>
</div>

<div id="notesModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" >

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Candidate</h4>
      </div>
      <div class="modal-body">
        
          <form class="form-horizontal" enctype="multipart/form-data" id="candidateForm"  onsubmit="return candidateForm(this)">
              <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
              <input type="text" name="jobid" id="csrf-token" value="{{ $candidate->JobID }}" />
              <input type="text" name="candidate_id" id="candidate_id" value="" />
 
 
  <div class="row form-group">
  <div class="col-sm-12">
    <label class="control-label col-sm-2" for="email">Reviews:</label>
    <div class="col-sm-12">
        <textarea placeholder="Notes" name="notes" id="Reviews" class="form-control"></textarea>
    </div>
  </div>
  
  </div>
 
  <div class="col-sm-6 form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" id="saveBtn" class="btn btn-default">
          <i class="fa-li fa fa-spinner fa-spin" id="saveLoader" style="position: relative;left: 0px;display: none;"></i>
          Add</button>
    </div>
  </div>
</form>
      </div>
<!--      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
    </div>

  </div>
</div>


<div id="offeredModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" >

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Candidate Offer</h4>
      </div>
      <div class="modal-body">
        
          <form class="form-horizontal" enctype="multipart/form-data" id="offeredForm"  onsubmit="return offeredForm(this)">
              <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
              <input type="hidden" name="jobid" id="csrf-token" value="{{ $candidate->JobID }}" />
              <input type="hidden" name="candidate_id" id="candidate_id" value="{{ $candidate->id }}" />


              <div class="row">
                  <div class="col-sm-12 form-group">
                      <label class="control-label col-sm-10" for="email">Salary Offered( <span class="text text-danger">* </span> ) :</label>
                      <div class="col-sm-12">
                          <input type="number" step="1.00" name="offeredSalary" id="offeredSalary" placeholder="Enter Offered Salary " class="form-control">
                      </div>
                  </div>
                  <div class="col-sm-12 form-group">
                      <label class="control-label col-sm-10" for="email">Joining Date( <span class="text text-danger">* </span> ) :</label>
                      <div class="col-sm-12">
                          <input type="text" placeholder="Salary Offered" name="offeredDate" id="offeredDate" class="form-control datepicker">
                      </div>
                  </div>

              </div>

              <div class="col-sm-6 form-group"> 
                  <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" id="offereSaveBtn" class="btn btn-default">
                          <i class="fa-li fa fa-spinner fa-spin" id="offereSaveLoader" style="position: relative;left: 0px;display: none;"></i>
                          Save</button>
                  </div>
              </div>
          </form>
      </div>
    </div>

  </div>
</div>

 
<div id="hiredModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" >

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Candidate Hire</h4>
      </div>
      <div class="modal-body">
        
          <form class="form-horizontal" enctype="multipart/form-data" id="hireForm"  onsubmit="return hireForm(this)">
              <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
              <input type="hidden" name="jobid" id="csrf-token" value="{{ $candidate->JobID }}" />
              <input type="hidden" name="candidate_id" id="candidate_id" value="{{ $candidate->id }}" />


              <div class="row">
                
                  <div class="col-sm-12 form-group">
                      <label class="control-label col-sm-10" for="email">Joining ON( <span class="text text-danger">* </span> ) :</label>
                      <div class="col-sm-12">
                          <input type="text" name="joinOn" id="joinOn" placeholder="Join On Date" class="form-control datepicker myForm">
                      </div>
                  </div>

              </div>

              <div class="col-sm-6 form-group"> 
                  <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" id="hireSaveBtn" class="btn btn-default">
                          <i class="fa-li fa fa-spinner fa-spin" id="hireSaveLoader" style="position: relative;left: 0px;display: none;"></i>
                          Save</button>
                  </div>
              </div>
          </form>
      </div>
    </div>

  </div>
</div>

 
</div>
@endsection 


@section('extrajs') 
<style>
    .tab-pane{
            background: #f5f5f5 !important;
    }    
    .nav-tabs{
            background: #be6408 !important;
    }    
</style>

<link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/respontive.css') }}" rel="stylesheet">

<script type="text/javascript">
var base_url = "{{  URL('/') }}";

function hireForm(obj){
    
    var formFlag = true;
    var flag = false;
    var formObj = $(obj).find('.myForm'); 
    $(formObj).each(function (){
        if($(this).val() == '' || $(this).val() == null ){
            $(this).css('border','1px solid red');
            formFlag = false;
        }else{
            $(this).css('border','1px solid #ccc');
        }
    });
//if(formFlag){ 
if(formFlag){ 
 var formData = new FormData(obj);
       $.ajax({
        type: "POST",
        url: base_url+"/admin/addHire",
        cache:false,
        contentType: false,
        processData: false,
        data:formData,
        beforeSend(xhr){
            //alert();
               $('#hireSaveBtn').html('Loding.....');
               $('#hireSaveBtn').prop('disabled',true);
               $('#hireSaveLoader').show();
        },
         success: function(result){
             //alert(result);
             //console.log(result);
               var obj = JSON.parse(result);
                //alert(obj['result']);
                if(obj['result'] == "failed"){
                  //    alert(obj['message']);
                    for (var key in obj['data']) {
                        $("#"+key).css('border','1px solid red');
                    }
                    //alert('inside');
//                  //location.reload();  
                 }
                 if(obj['result'] == "success"){
                   alert(obj['message']);
                   //console.log(obj['data']);
                    location.reload();  
                  // getCandidate();
                   //$('#candidateModal').modal('hide');
                 }
             //getCandidate();
             
         },error: function(data){
                console.log("error");
                console.log(data);
            },complete: function(){
               $('#hireSaveBtn').html('Save');
               $('#hireSaveBtn').prop('disabled',false);
               $('#hireSaveLoader').hide();
         }	
    });
}else{
    alert('Please Filled required filled...');
}
    return false;    
}

function offeredForm(obj){
    
    var formFlag = true;
    var flag = false;
    var formObj = $(obj).find('.myForm'); 
    $(formObj).each(function (){
        if($(this).val() == '' || $(this).val() == null ){
            //alert($(this).val());
            $(this).css('border','1px solid red');
            formFlag = false;
        }else{
            $(this).css('border','1px solid #ccc');

        }
    });
//if(formFlag){ 
if(formFlag){ 
 var formData = new FormData(obj);
       $.ajax({
        type: "POST",
        url: base_url+"/admin/addOffered",
        cache:false,
        contentType: false,
        processData: false,
        data:formData,
        beforeSend(xhr){
           // alert();
               $('#offereSaveBtn').html('Loding.....');
               $('#offereSaveBtn').prop('disabled',true);
               $('#offereSaveLoader').show();
        },
         success: function(result){
            // alert(result);
             //console.log(result);
               var obj = JSON.parse(result);
                //alert(obj['result']);
                if(obj['result'] == "failed"){
                      alert(obj['message']);
                    for (var key in obj['data']) {
                        $("#"+key).css('border','1px solid red');
                    }
                    //alert('inside');
//                  //location.reload();  
                 }
                 if(obj['result'] == "success"){
                   alert(obj['message']);
                   //console.log(obj['data']);
                    location.reload();  
                  // getCandidate();
                   //$('#candidateModal').modal('hide');
                 }
             //getCandidate();
             
         },error: function(data){
                console.log("error");
                console.log(data);
            },complete: function(){
               $('#offereSaveBtn').html('Save');
               $('#offereSaveBtn').prop('disabled',false);
               $('#offereSaveLoader').hide();
         }	
    });
}else{
    alert('Please Filled required filled...');
}
    return false;    
}





function interviewForm(obj){
    
    var formFlag = true;
    var flag = false;
    var formObj = $(obj).find('.myForm'); 
    $(formObj).each(function (){
        if($(this).val() == '' || $(this).val() == null ){
            //alert($(this).val());
            $(this).css('border','1px solid red');
            formFlag = false;
        }else{
            $(this).css('border','1px solid #ccc');

        }
    });
//if(formFlag){ 
if(formFlag){ 
 var formData = new FormData(obj);
       $.ajax({
        type: "POST",
        url: base_url+"/admin/addInterview",
        cache:false,
        contentType: false,
        processData: false,
        data:formData,
        beforeSend(xhr){
           // alert();
               $('#interviewSaveBtn').html('Loding.....');
               $('#interviewSaveBtn').prop('disabled',true);
               $('#interviewSaveLoader').show();
        },
         success: function(result){
             //alert(result);
             //console.log(result);
               var obj = JSON.parse(result);
                //alert(obj['result']);
                if(obj['result'] == "failed"){
                  //    alert(obj['message']);
                    for (var key in obj['data']) {
                        $("#"+key).css('border','1px solid red');
                    }
                    //alert('inside');
//                  //location.reload();  
                 }
                 if(obj['result'] == "success"){
                  // alert(obj['message']);
                   //console.log(obj['data']);
                    location.reload();  
                  // getCandidate();
                   //$('#candidateModal').modal('hide');
                 }
             //getCandidate();
             
         },error: function(data){
                console.log("error");
                console.log(data);
            },complete: function(){
               $('#interviewSaveBtn').html('Save');
               $('#interviewSaveBtn').prop('disabled',false);
               $('#interviewSaveLoader').hide();
         }	
    });
}else{
    alert('Please Filled required filled...');
}
    return false;    
}

function reviewForm(obj){
    
    var formFlag = true;
    var flag = false;
    var formObj = $(obj).find('.myForm'); 
    $(formObj).each(function (){
        if($(this).val() == '' || $(this).val() == null ){
            //alert($(this).val());
            $(this).css('border','1px solid red');
            formFlag = false;
        }else{
            $(this).css('border','1px solid #ccc');

        }
    });
//if(formFlag){ 
if(formFlag){ 
 var formData = new FormData(obj);
       $.ajax({
        type: "POST",
        url: base_url+"/admin/addReview",
        cache:false,
        contentType: false,
        processData: false,
        data:formData,
        beforeSend(xhr){
           // alert();
               $('#reviewSaveBtn').html('Loding.....');
               $('#reviewSaveBtn').prop('disabled',true);
               $('#reviewSaveLoader').show();
        },
         success: function(result){
            // alert(result);
            // console.log(result);
               var obj = JSON.parse(result);
                //alert(obj['result']);
                if(obj['result'] == "failed"){
                  //    alert(obj['message']);
                    for (var key in obj['data']) {
                        $("#"+key).css('border','1px solid red');
                    }
                    //alert('inside');
//                  //location.reload();  
                 }
                 if(obj['result'] == "success"){
                   alert(obj['message']);
                   //console.log(obj['data']);
                    location.reload();  
                  // getCandidate();
                   //$('#candidateModal').modal('hide');
                 }
             //getCandidate();
             
         },error: function(data){
                console.log("error");
                console.log(data);
            },complete: function(){
               $('#reviewSaveBtn').html('Save');
               $('#reviewSaveBtn').prop('disabled',false);
               $('#reviewSaveLoader').hide();
         }	
    });
}else{
    alert('Please Filled required filled...');
}
    return false;    
}

function emailForm(obj){
    
    for(var name in CKEDITOR.instances)
         CKEDITOR.instances[name].updateElement();
    
    var formFlag = true;
    var flag = false;
    var formObj = $(obj).find('.myForm'); 
    $(formObj).each(function (){
        if($(this).val() == '' || $(this).val() == null ){
            //alert($(this).val());
            $(this).css('border','1px solid red');
            formFlag = false;
        }else{
            $(this).css('border','1px solid #ccc');

        }
    });
    //alert(formFlag);
//if(formFlag){ 
if(formFlag){ 
 var formData = new FormData(obj);
       $.ajax({
        type: "POST",
        url: base_url+"/admin/addEmail",
        cache:false,
        contentType: false,
        processData: false,
        data:formData,
        beforeSend(xhr){
            //alert();
               $('#emailSaveBtn').html('Loding.....');
               $('#emailSaveBtn').prop('disabled',true);
               $('#emailSaveLoader').show();
        },
         success: function(result){
             alert(result);
             console.log(result);
               var obj = JSON.parse(result);
                //alert(obj['result']);
                if(obj['result'] == "failed"){
                     //alert(obj['message']);
                    for (var key in obj['data']) {
                        $("#"+key).css('border','1px solid red');
                    }
                    //alert('inside');
//                  //location.reload();  
                 }
                 if(obj['result'] == "success"){
                   alert(obj['message']);
                   //console.log(obj['data']);
                   //location.reload();  
                  // getCandidate();
                   //$('#candidateModal').modal('hide');
                 }
             //getCandidate();
             
         },error: function(data){
                console.log("error");
                console.log(data);
            },complete: function(){
               $('#emailSaveBtn').html('Save');
               $('#emailSaveBtn').prop('disabled',false);
               $('#emailSaveLoader').hide();
         }	
    });
}else{
    alert('Please Filled required filled...');
}
    return false;    
}

function experienceForm(obj){
    
    var formFlag = true;
    var flag = false;
    var formObj = $(obj).find('.myForm'); 
    $(formObj).each(function (){
        if($(this).val() == '' || $(this).val() == null ){
            //alert($(this).val());
            //$(this).css('border','1px solid red');
            formFlag = false;
        }else{
            $(this).css('border','1px solid #ccc');

        }
    });
if(formFlag){ 
 var formData = new FormData(obj);
       $.ajax({
        type: "POST",
        url: base_url+"/admin/addExperience",
        cache:false,
        contentType: false,
        processData: false,
        data:formData,
        beforeSend(xhr){
           // alert();
               $('#saveBtn').html('Loding.....');
               $('#saveBtn').prop('disabled',true);
               $('#saveLoader').show();
        },
         success: function(result){
             //alert(result);
            //console.log(result);
               var obj = JSON.parse(result);
                //alert(obj['result']);
                if(obj['result'] == "failed"){
                  //    alert(obj['message']);
                    for (var key in obj['data']) {
                        $("#"+key).css('border','1px solid red');
                    }
                    //alert('inside');
//                  //location.reload();  
                 }
                 if(obj['result'] == "success"){
                   //alert(obj['message']);
                   //console.log(obj['data']);
                    location.reload();  
                  // getCandidate();
                   //$('#candidateModal').modal('hide');
                 }
             //getCandidate();
             
         },error: function(data){
                console.log("error");
                console.log(data);
            },complete: function(){
               $('#saveBtn').html('Save');
               $('#saveBtn').prop('disabled',false);
               $('#saveLoader').hide();
         }	
    });
}else{
    alert('Please Filled required filled...');
}
    return false;    
}




function show(){
   
   $('.experienceIcon').each(function (){
       $(this).toggle();
   })
}
function emailShow(){
   
   $('.emailIcon').each(function (){
       $(this).toggle();
   })
}
</script>

<script src="{{ asset('assets/pages/bootstrap-rating.min.js') }}"></script>
<script src="{{ asset('assets/pages/rating-init.js') }}"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script>
  $( function() {
    $( ".datepicker" ).datepicker({
  changeYear: true,changeMonth: true,minDate: 0
});
  } );
  </script>
  
    
  <script src="{{ asset('assets/plugins/editor/ckeditor.js') }}"></script>
  <!--<link rel="stylesheet" href="{{ asset('assets/plugins/editor/samples/sample.css') }}">-->
	<script>

		var editor, html = '';

		function createEditor() {
			if ( editor )
				return;

			// Create a new editor inside the <div id="editor">, setting its value to html
			var config = {};
			editor = CKEDITOR.appendTo( 'editor', config, html );
		}

		function removeEditor() {
			if ( !editor )
				return;

			// Retrieve the editor contents. In an Ajax application, this data would be
			// sent to the server or used in any other way.
			document.getElementById( 'editorcontents' ).innerHTML = html = editor.getData();
			document.getElementById( 'contents' ).style.display = '';

			// Destroy the editor.
			editor.destroy();
			editor = null;
		}

	</script>

  
@endsection 