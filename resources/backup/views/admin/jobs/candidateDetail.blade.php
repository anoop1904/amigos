@extends('layouts.master')

@section('content')
<div class="container-fluid">
  <!-- Page-Title -->
  <div class="row">
    <div class="col-sm-12">
      <div class="page-title-box">
        <div class="btn-group pull-right">
          <ol class="breadcrumb hide-phone p-0 m-0">
            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
            @can('Create Job Post')
            <li class="breadcrumb-item"><a href="{{ url('admin/job') }}">Job</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/job_detail').'/'.$candidate->JobID }}">Job Detail</a></li>
            @else
            <li class="breadcrumb-item"><a href="{{ url('admin/interviewlist') }}">Interview List</a></li>
            @endcan
            <li class="breadcrumb-item active">Candidate Detail</li>
          </ol>
        </div>
        <h4 class="page-title">Candidate Detail</h4>
      </div>
    </div>
  </div>
  <!-- end page title end breadcrumb -->
  
   
   
<div id="page_section" class="">
 
  @if(Session::has('message'))
        <div class="alert alert-success login-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('message') !!} </div>
  @endif 
  
  @if(Session::has('error'))
        <div class="alert alert-danger login-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('error') !!} </div>
  @endif 
      
      
      
      <div id="candidate_list">
          <div class="row">
              <div class="col-sm-8">
              
              
                  <div style="background: #bd6408;">
                  
                      
                   <div class="row" style="padding: 10px 1px;">   
                    <div class="col-sm-1 text-right my_text-right">
                        <div class="section_data">
                            <div  class="sort_name">
                                
                                @php echo strtoupper(substr($candidate->FirstName, 0, 1)).strtoupper(substr($candidate->LastName, 0, 1))  @endphp
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
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
    
    @php 
    $class ='';
      if( isset($_REQUEST['tabs'])){
        if($_REQUEST['tabs'] == '1'){
          $class ='active'; 
        }
       }
     @endphp
    
      <a class="nav-link {{ $class }}" href="#emailTab" role="tab" data-toggle="tab">
        Email 
        
          @if(isset($emails) && !empty($emails) && count($emails)>0)
           @php
            echo ' ( '.count($emails).' ) ';
           @endphp
          @endif


    </a>
  </li>
  <li class="nav-item">
       @php 
    $class ='';
      if( isset($_REQUEST['tabs'])){
        if($_REQUEST['tabs'] == '2'){
          $class ='active'; 
        }
       }
     @endphp
    <a class="nav-link {{ $class }}" href="#sourcing" role="tab" data-toggle="tab">
       
        Review @php  echo ' ( '.(count($reviews)).' ) '; @endphp
    </a>
  </li>
  @can('Create Job Post')
  <li class="nav-item">
    @php 
      $class ='';
        if( isset($_REQUEST['tabs'])){
          if($_REQUEST['tabs'] == '3'){
            $class ='active'; 
          }
         }
     @endphp
    <a class="nav-link {{ $class }}" href="#activity" role="tab" data-toggle="tab">
        Interviews @php  echo ' ( '.(count($interviews)).' ) '; @endphp
    </a>
  </li>
@endcan
  <li class="nav-item">
     @php 
      $class ='';
        if( isset($_REQUEST['tabs'])){
          if($_REQUEST['tabs'] == '4'){
            $class ='active'; 
          }
         }
     @endphp
    <a class="nav-link {{ $class }}" href="#job_ad" role="tab" data-toggle="tab">
        Activity  @php  echo ' ( '.(count($activity)).' ) '; @endphp
      </a>
  </li>
 @can('Create Job Post')
  <li class="nav-item">
    @php 
      $class ='';
        if( isset($_REQUEST['tabs'])){
          if($_REQUEST['tabs'] == '5'){
            $class ='active'; 
          }
         }
     @endphp
    <a class="nav-link {{ $class }}" href="#job_detail" role="tab" data-toggle="tab">
        Offer</a>
  </li>
  <li class="nav-item">
    @php 
      $class ='';
        if( isset($_REQUEST['tabs'])){
          if($_REQUEST['tabs'] == '6'){
            $class ='active'; 
          }
         }
     @endphp
    <a class="nav-link {{ $class }}" href="#hiring_process" role="tab" data-toggle="tab">
        Hire</a>
  </li>
 
  <li class="nav-item">
    @php 
      $class ='';
        if( isset($_REQUEST['tabs'])){
          if($_REQUEST['tabs'] == '7'){
            $class ='active'; 
          }
         }
     @endphp
      <a href="#" class="nav-link {{ $class }}" onclick="userEdit({{ $candidate->id }})"><i class="ti-user"></i>
        Edit Candidate</a>
    
  </li>
  @endcan
  <li class="nav-item">
    @php 
      $class ='';
        if( isset($_REQUEST['tabs'])){
          if($_REQUEST['tabs'] == '8'){
            $class ='active'; 
          }
         }
     @endphp
    <a class="nav-link {{ $class }}" href="#otherDetail" role="tab" data-toggle="tab">
        Other</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
   @php 
      $class1 =$class2=$class3=$class4 =$class5=$class6=$class7 =$class8=$class9 ='';
        if( isset($_REQUEST['tabs'])){
          if($_REQUEST['tabs'] == '1'){
            $class1 ='show active'; 
          }

          if($_REQUEST['tabs'] == '2'){
            $class2 ='show active'; 
          }

          if($_REQUEST['tabs'] == '3'){
            $class3 ='show active'; 
          }

          if($_REQUEST['tabs'] == '4'){
            $class4 ='show active'; 
          }

          if($_REQUEST['tabs'] == '5'){
            $class5 ='show active'; 
          }

          if($_REQUEST['tabs'] == '6'){
            $class6 ='show active'; 
          }

          if($_REQUEST['tabs'] == '8'){
            $class7 ='show active'; 
          }
         }
     @endphp
    <div role="tabpanel" class="tab-pane fade {{ $class1 }}" id="emailTab">
        
        
      <div class="container-fluid">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
          <div class="panel panel-default">
            <div class="panel-heading active" role="tab" id="headingOne">
              <h4 class="panel-title text-right">
                 @can('Create Job Post')
                 @if($candidate->stageStatus < '6')
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#email" aria-expanded="true" aria-controls="email">
                    <span class="fa fa-plus show emailIcon" onclick="emailShow()" title="New Email"></span>
                    <span class="fa fa-minus hide emailIcon" style="display: none;"  title="New Email" onclick="emailShow()"></span>
                    
                </a>
                @endif
                @endcan
              </h4>
            </div>
            <div id="email" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
              <div class="panel-body">
                
                  
                  <form class="form-horizontal" id="emailForm" onsubmit="return emailForm(this)">
                      
                      <div class="row form-group">
                          <div class="col-sm-12">
                              <label>Subject :</label>
                              <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                              <input type="hidden" name="candidate_id" value="{{ $candidate->id }}">
                              <input type="hidden" name="jobid"  value="{{ $candidate->JobID }}" />
                              <input type="hidden" name="emailTo"  value="{{ $candidate->Email }}" />
                              <input type="hidden" name="emailFrom"  value="manish@nrt.co.in" />
                              <!--<input type="hidden" class="form-control" name="exprience_id" id="candidate_id" value="">-->
                              <input type="text" class="form-control myForm" name="subject" id="subject" placeholder="Subject">
                          </div>
                      </div>
                         
                         
                      <div id="candidateExperience">
                        <div class="row form-group">
                                <div class="col-sm-12">
                                    <label>Message : </label>
                                    <textarea placeholder="Description" name="message" class="form-control myForm ckeditor" id="message"></textarea>
                                </div>
                        </div>
                         
                        
                         
                        <div class="row form-group">
                                <div class="col-sm-12">
                                  
                                    
                                    <button type="submit" id="emailSaveBtn" class="btn btn-default">
                                        <i class="fa-li fa fa-spinner fa-spin" id="emailSaveLoader" style="position: relative;left: 0px;display: none;"></i>
                                        Send</button>
                                        <span id="emailMessage"></span>
                                    
                                </div>
                        </div>
                      </div>
                          
                  </form>
              </div>
            </div>
          </div>
        </div>
      </div>
        
      <div class="panel_data">
          @php $count = 1; @endphp
          @if(isset($emails) && !empty($emails) && count($emails)>0)
          @foreach ($emails as $key=>$email)
                <div class="row">
                    <div class="col-md-6 col-xl-2 text-right my_text-right">
                        <div class="sort_name">
                          @php 
                          $arr = explode(' ',$email->user->name); 
                          if(isset($arr[0])){
                            echo strtoupper(substr($arr[0], 0, 1));
                          }
                          if(isset($arr[1])){
                            echo strtoupper(substr($arr[1], 0, 1));
                          }
                          @endphp
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-8">
                      <p class="title">From : {{ $email->user->name .' ( '. $email->user->email .' )' }}</p>
                        <p class="title">Subject : {{ $email->subject  }}</p>

                        <p>@php echo $email->message @endphp</p>
                    </div>
                    <div class="col-md-6 col-xl-2 sub_title">
                         @php echo date('d M , Y',strtotime($email->created_at)) @endphp
                    </div>
                </div>
            
            @php $count++; @endphp
            @endforeach
            @else
            <div class="text text-danger">No Email</div>
            @endif
      </div>
        
    </div>

  <div role="tabpanel" class="tab-pane fade {{ $class2 }}" id="sourcing">
  
       <div class="panel_data">
        
           <div class="text-right panel well" style="margin-bottom: 10px;">
                @if($candidate->stageStatus < 6)

                  <button class="btn btn-default" data-toggle="modal" data-target="#reviewModal">
                    <i class="ti-plus"></i> 
                    Add New Review
                  </button> 
                @endif  
           </div>
           
                        
                    @php $count = 1; @endphp
                    @if(isset($reviews) && !empty($reviews) && count($reviews)>0)
                    @foreach ($reviews as $key=>$review)
                      
                    <div class="row">
                        <div class="col-md-6 col-xl-2 text-right">
                            <div class="sort_name">
                               @php 
                          $arr = explode(' ',$review->name); 
                          if(isset($arr[0])){
                            echo strtoupper(substr($arr[0], 0, 1));
                          }
                          if(isset($arr[1])){
                            echo strtoupper(substr($arr[1], 0, 1));
                          }
                          @endphp
                             
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-8">
                            <p class="title">By : {{ $review->name }}</p>
                            <p>{{ $review->Reviews }}</p>
                        </div>
                        <div class="col-md-6 col-xl-2 sub_title">
                             @php echo date('d M , Y',strtotime($review->created_at)) @endphp
                        </div>
                    </div>
            
              @php $count++; @endphp
            @endforeach
            @else
            <div class="text text-danger">No Review</div>
            @endif
            
                  
                  
                  
    
            
        </div>
      
  
  </div>
  <div role="tabpanel" class="tab-pane fade {{ $class3 }}" id="activity">
  
       <div class="panel_data">
        
           <div class="text-right panel well" style="margin-bottom: 20px;">
             @can('Create Job Post')
                @if($candidate->stageStatus < 6)
                  @if(empty($candidate->interview_id))
                      <button class="btn btn-default" data-toggle="modal" data-target="#interviewModal">
                        <i class="ti-plus"></i> Add Interview
                      </button> 
                @endif
               @endif
              @endcan 
            </div>
           
           <div id="interviewList">
           
              @php $count = 1; @endphp
                    @if(isset($interviews) && !empty($interviews) && count($interviews)>0)
                    @foreach ($interviews as $key=>$interview)
                      
                    <div class="row">
                        <div class="col-md-1 col-xl-1 text-right">
                            <div class="title">{{ $count }}</div>
                        </div>
                        <div class="col-md-2 col-xl-2">
                            <p class="title">{{ $interview->user->name }}</p>
                        </div>
                        <div class="col-md-2 col-xl-2">
                            <p class="title">@php
                             echo date('d-M-Y',strtotime($interview->interview_date)) @endphp
                           </p>
                        </div>
                        <div class="col-md-2 col-xl-2">
                            <p class="title">
                            @php
                                echo date("g:i A", strtotime($interview->interview_time));
                            @endphp
                            </p>
                        </div>
                        
                        <div class="col-md-5 col-xl-5">
                        @if($interview->feadback)
                            @if($interview->rating)
                              <p class="title">
                                @for($i=0;$i< 5;$i++)
                                @if($interview->rating > $i)
                                    <span class="ti-star active"></span>
                                @else
                                    <span class="ti-star"></span>
                                @endif
                                @endfor
                                </p>
                            @endif
                            <p class="title">{{ $interview->feadback }}</p>
                       
                        @else
                            @if($interview->status==1 && empty($candidate->interview_id) ) 
                                <a href="javascript:;" class="btn btn-warning">Pending</a>

                                 <a href="javascript:;" onclick="interviewEdit({{$interview->id}});" class="btn btn-default">Edit</a>

                            @else 
                                <a href="javascript:;" class="btn btn-success">Done</a> 
                            @endif
                        @endif
                        </div> 
                    
                      
                        
                       
                        
                        
                        
                    </div>
            
              @php $count++; @endphp
            @endforeach
            @else
            <div class="text text-danger">No Interview </div>
            @endif
           
           </div> 
           <!--end interviewList Section-->
         
            
        </div>
  </div>
  <div role="tabpanel" class="tab-pane fade {{ $class4 }}" id="job_ad">
               <div class="panel_data">
                    @php $count = 1; @endphp
                    @if(isset($activity) && !empty($activity) && count($activity)>0)
                    @foreach ($activity as $key=>$activitys)
                      
                    <div class="row">
                        <div class="col-md-6 col-xl-2 text-right my_text-right">
                            <div class="sort_name">
                               @php 
                          $arr = explode(' ',$activitys->user->name); 
                          if(isset($arr[0])){
                            echo strtoupper(substr($arr[0], 0, 1));
                          }
                          if(isset($arr[1])){
                            echo strtoupper(substr($arr[1], 0, 1));
                          }
                          @endphp
                            </div>
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
            <div class="text text-danger">No Activity </div>
            @endif
            
                  
                  
                  
    
            
        </div>
      
      
  </div>
  <div role="tabpanel" class="tab-pane fade {{ $class5 }}" id="job_detail">
<!--  Offer Detail-->
     
  
  <div class="panel_data">
      
      @if($candidate->stageStatus == '4')
      <button class="btn btn-default" data-toggle="modal" data-target="#offeredModal" title="Add Offer"><i class="ti-plus"></i> Add Offered</button> 
      @else
        @if($candidate->stageStatus >= '5')
            <span>Offer release process done</span>
            <div>
            <span>Salary Offer : </span>    
            <span> {{ $candidate->OfferedSalary  }} </span>    
            </div>
            <div>
            <span>Joining Date : </span>    
            <span>{{ $candidate->OfferedJoiningDate  }}</span>    
            </div>
            
        @endif
          @if($candidate->stageStatus < '6' && $candidate->OfferedSalary != null)
            <button class="btn btn-default" onclick="return editOffer({{ $candidate->id }})"><i class="ti-edit"></i> Edit</button>
          @endif 
      @endif
      
      
  </div>
      
  
  
  </div>
  <div role="tabpanel" class="tab-pane fade {{ $class6 }}" id="hiring_process">Hiring Process
  
      <div class="panel_data">
          
      @if($candidate->stageStatus == '5')
        <button class="btn btn-default" data-toggle="modal" data-target="#hiredModal"><i class="ti-plus"></i> Hired Candidate</button> 
      @else
        @if($candidate->stageStatus >= '6')
            <span>Hire process done</span>
            <div>
            <span>Salary Offer : </span>    
            <span> {{ $candidate->OfferedSalary  }} </span>    
            </div>
            <div>
            <span>Joining Date : </span>    
            <span>{{ $candidate->OfferedJoiningDate  }}</span>    
            </div>
            <div>
            <span>Joining On : </span>    
            <span>{{ $candidate->JoinOn  }}</span>    
            </div>
            
        @endif
      @endif
          
          
          
          
          
      </div>
  
  </div>
  <div role="tabpanel" class="tab-pane fade {{ $class8 }}" id="otherDetail">
  
      <table class="table">
            <tbody>
                <tr>
                    <td>Source</td>
                    <td>:</td>
                    <td>
                      @if($candidate->sourcename )
                      {{ $candidate->sourcename->name }}
                      @endif
                      
                    </td>
                </tr>
                <tr>
                    <td>Location</td>
                    <td>:</td>
                    <td>{{ $candidate->Location }}</td>
                </tr>
                <tr>
                    <td>Tags</td>
                    <td>:</td>
                    <td> 
                      @php
                      if($candidate->Tags){
                        $arr = explode(',',$candidate->Tags);
                        $tagList = App\Tag::whereIn('id',$arr)->pluck('name')->toArray();
                       echo implode(',',$tagList);
                      }
                      @endphp

                      </td>
                </tr>
                <tr>
                    <td>Skills</td>
                    <td>:</td>
                    <td>
                      @php
                        if($candidate->Skills){
                          $arr = explode(',',$candidate->Skills);
                          $tagList = App\Skill::whereIn('id',$arr)->pluck('name')->toArray();
                         echo implode(',',$tagList);
                        }
                      @endphp
                    </td>
                </tr>
                 <tr>
                    <td>Keyword</td>
                    <td>:</td>
                    <td>{{ $candidate->CVKeywords }}
                        @php
                        if($candidate->CVKeywords){
                          $arr = explode(',', $candidate->CVKeywords);
                          $tagList = App\Keyword::whereIn('id',$arr)->pluck('name')->toArray();
                         echo implode(',',$tagList);
                        }
                      @endphp

                    </td>
                </tr>
                
                
            </tbody>
                
        </table>
            
          
          
  </div>
</div>
      
  </div>
              
               <!--//////////////-->
                  
                      
               <div class="container-fluid">
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
     @can('Create Job Post')
    <div class="panel-heading active" role="tab" id="headingOne">
      <h4 class="panel-title text-right">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <span class="fa fa-plus show experienceIcon" onclick="show()" title="Add Experience"></span>
            <span class="fa fa-minus hide experienceIcon" style="display: none;" onclick="show()"></span>
        </a>
      </h4>
    </div>
    @endcan
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
                  <div class="mini-stat clearfix bg-white">
                  <div class="row">
                      <div class="col-md-12 col-xl-12 ">
                        <?php //print_r($jobs->JobTitle ) ?>
                          <div class="title">
                            <a href="{{URL('admin/job_detail').'/'.$jobs->id}}">{{ $jobs->JobTitle }}</a>
                            
                          </div>
                      </div>
                      
                          
                      @if($candidate->interview && count($candidate->interview)>0)
                      <div class="col-md-12 col-xl-12 text-right">
                         @foreach ($candidate->interview as $k=>$interview)
                         <p>
                             @for($i=0;$i< 5;$i++)
                             @if($interview->rating > $i)
                             <span class="ti-star active" style="color: red"></span>
                             @else
                             <span class="ti-star"></span>
                             @endif
                             @endfor
                         </p>
                         @endforeach
                         </div>
                        @else
                        <div class="col-md-12 col-xl-12 text-right">
                            <span>No Review</span>
                        </div>
                        @endif
                          
<!--                          <span class="ti-star star-active"></span>
                          <span class="ti-star"></span>
                          <span class="ti-star"></span>
                          <span class="ti-star"></span>
                          <span class="ti-star"></span>-->
                      <div class="col-md-12 col-xl-12 ">
                          <div class="">{{ $candidate->Location }}</div>
                      </div>
                      
                      <div class="col-md-12 col-xl-12 ">
                          <div class="sub_title">@php echo date('d M , Y',strtotime($candidate->created_at))  @endphp</div>
                      </div>
                      <div class="col-md-12 col-xl-12 ">
                          <div class="sub_title">Current Stage</div>
                      </div>
                      <div class="col-md-12 col-xl-12 ">
                          
                          <div class="progress new_margin">
                              

  @if($candidate->stageStatus >= '1' && $candidate->stageStatus <= '6' )                            
  <div class="progress-bar bg-success" style="width:15%">
    New
  </div>
  @endif
  @if($candidate->stageStatus >= '2' && $candidate->stageStatus <= '6' ) 
  <div class="progress-bar bg-warning" style="width:15%">
    Review
  </div>
  @endif
  @if($candidate->stageStatus >= '3' && $candidate->stageStatus <= '6' ) 
  <div class="progress-bar bg-danger" style="width:20%">
    Short list
  </div>
  @endif
   @if($candidate->stageStatus >= '4' && $candidate->stageStatus <= '6' ) 
  <div class="progress-bar bg-success" style="width:15%">
    interview
  </div>
  @endif 
  @if($candidate->stageStatus >= '5' && $candidate->stageStatus <= '6' ) 
  <div class="progress-bar bg-primary" style="width:15%">
    Offered
  </div>
  @endif
  @if($candidate->stageStatus >= '6' && $candidate->stageStatus <= '6' ) 
  <div class="progress-bar bg-primary" style="width:20%" >
    Hired
  </div>
  @endif
  
  @if($candidate->stageStatus == '9') 
  <div class="progress-bar bg-danger" style="width:100%" >
    Reject
  </div>
  @endif
  @if($candidate->stageStatus == '8') 
  <div class="progress-bar bg-warning" style="width:100%" >
    Reject
  </div>
  @endif
  
</div>
                      </div>
                  </div>
                      
                      
                       @can('Create Job Post')
                      <div class="row" style="margin-top: 20px;padding-bottom: 20px;border-bottom-style: inset;">
                       
                         @if($candidate->stageStatus < 6)
                          <div class="col-md-6 col-xl-6">
                              <select class="form-control" id="operationForAction">
                                 @if($candidate->stageStatus < 3)
                                  <option value="0">Move forward</option>
                                 @endif 
                                  <option value="3">Short List</option>
                                  <option value="1">Reject</option>
                                  <option value="2">Withdrawn</option>
                              </select>
                          </div>
                          <div class="col-md-6 col-xl-2">
                              <button class="btn btn-default" onclick="action({{ $candidate->id }});">Action</button>
                          </div>
                          <div class="col-md-6 col-xl-4 text-right">
                                <div class="dropdown">
                            </div>
                          </div>
                          @endif

                      </div>
                      <div class="row" style="margin-top: 20px;padding-bottom: 20px;border-bottom-style: inset;">
                          
                          
                          @if(!$candidate->UploadedCVPath)
                        
                          
                          <form id="resumeUpload" onsubmit="return resumeUpload(this)"  enctype="multipart/form-data" >
                              <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                              <input type="hidden" name="candidate_id" value="{{ $candidate->id }}" />
                              <input type="file" id="resume" name="resume">
                              
                                    <button type="submit" id="resumeBtn" class="btn btn-default">
                                            <i class="fa-li fa fa-spinner fa-spin" id="resumeLoader" style="position: relative;left: 0px;display: none;"></i>
                                    Upload
                                    </button>
                          </form>
		
                          
                          @endif
                          
                          <div class="col-md-6 col-xl-8">
                              <!--<i class="fa fa-user-circle"></i>-->
                              @if($candidate->UploadedCVPath)
                              <a target="_blank" href="{{ URL('assets/assets/img/pages/').'/'.$candidate->UploadedCVPath }}" >
                              Resume
                             </a>
                              
                              <a href="{{ URL('admin/resumeDownloader').'/'.$candidate->id }}">
                              <i class="fa fa-download"></i>
                              </a>
                              @else
                              <span>Resume Not upload</span>
                              @endif
                              
                              
                          </div>
                          
<!--                          <div class="col-md-6 col-xl-4 text-right">
                              <span role="button" style="cursor: pointer" data-toggle="dropdown"> <i class="ti-plus"></i>
                                </span>
                          </div>-->
                      </div>
                       @endcan
                      <div class="row" style="margin-top: 20px;padding-bottom: 20px;">
                          <div class="row new_row" id="tag_section">
                              <div class="col-md-12 col-xl-12">
                                  
                                      @php  $selected_tags = array(); @endphp
                                      @if($selectedTags && count($selectedTags)>0)
                                     
                                      @foreach($selectedTags  as $selectedTag)
                                      <span class="tag">
                                      <span>{{ $selectedTag->name }}</span>
                                      @php $selected_tags[] = $selectedTag->id @endphp
                                      </span>                              
                                      @endforeach
                                           
                                      @endif
                                    
                                      <!--<span>No Tag</span>-->
                                  
                              </div>
                          </div>
                      </div>
                      <div class="row new_row">
                          <div class="col-md-6 col-xl-6">

                              <select class="select2 form-control"  id="candidateTag" name="Tag[]" multiple="">
                                  <option value="0"  disabled="">Select Tag</option>
                                  @if($tagall)
                                  @foreach($tagall as $tagalls)
                                  <option value="{{ $tagalls->id }}" @php if(in_array($tagalls->id, $selected_tags)){ echo 'selected'; }  @endphp >{{ $tagalls->name }}</option>
                                  @endforeach
                                  @endif
                              </select>

                          </div>

                          <div class="col-md-6 col-xl-4">
                              <button class="btn btn-default" onclick="updateTag({{ $candidate->id }})" >Add/ Change Tag</button>

                          </div>
                      </div>
                      
                      
                      
                          
                      
                      
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
          <span id="revireMessage"></span>
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
        <h4 class="modal-title">Add Interview</h4>
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

  <div class="row form-group">
  <div class="col-sm-6">
    <label class="control-label col-sm-10" for="email">Interview Type : </label>
    <div class="col-sm-12">
       <select class="form-control" name="interview_type" id="interview_type">
        <option value="0">Interview Type</option>
         <option value="Screening">Screening</option>
          <option value="Telephonic">Telephonic</option>
           <option value="Face2Face">Face2Face</option>
            <option value="Q&A">Q&A</option>
             <option value="Video Interview">Video Interview</option>
              <option value="HR">HR</option>
       </select>
    </div>
  </div>
  <div class="col-sm-6">
    <label class="control-label col-sm-10" for="email">Interview Location : </label>
    <div class="col-sm-12">
       <input type="text" name="interviewLocation" id="interviewLocation" placeholder="Interview Location" class="form-control">
    </div>
  </div>
  
  </div>

 
  <div class="col-sm-12 form-group"> 
    <div class="col-sm-offset-12 col-sm-12">
        <button type="submit" id="interviewSaveBtn" class="btn btn-default">
          <i class="fa-li fa fa-spinner fa-spin" id="interviewSaveLoader" style="position: relative;left: 0px;display: none;"></i>
          Add</button>
          <span id="interviewMessage"></span>

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
        <h4 class="modal-title">Add Notes</h4>
      </div>
      <div class="modal-body">
        
          <form class="form-horizontal" enctype="multipart/form-data" id="candidateForm1"  onsubmit="return candidateForm1(this)">
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
        <h4 class="modal-title">Add</h4>
      </div>
      <div class="modal-body">
        
          <form class="form-horizontal" enctype="multipart/form-data" id="offeredForm"  onsubmit="return offeredForm(this)">
              <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
              <input type="hidden" name="jobid" id="csrf-token" value="{{ $candidate->JobID }}" />
              <input type="hidden" name="candidate_id" id="candidate_id" value="{{ $candidate->id }}" />
              <input type="hidden" name="offerIsEdit" id="offerIsEdit" value="" />


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

              <div class="col-sm-12 form-group"> 
                  <div class="col-sm-offset-12 col-sm-12">
                      <button type="submit" id="offereSaveBtn" class="btn btn-default">
                          <i class="fa-li fa fa-spinner fa-spin" id="offereSaveLoader" style="position: relative;left: 0px;display: none;"></i>
                          Save</button>
                          <span id="offerMessage"></span>
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
                          <input type="text" name="joinOn" id="hireJoinOn" placeholder="Join On Date" class="form-control myForm" value="@php echo date('m/d/Y',strtotime($candidate->OfferedJoiningDate))  @endphp">
                      </div>
                  </div>

              </div>

              <div class="col-sm-6 form-group"> 
                  <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" id="hireSaveBtn" class="btn btn-default">
                          <i class="fa-li fa fa-spinner fa-spin" id="hireSaveLoader" style="position: relative;left: 0px;display: none;"></i>
                          Save</button>
                          <span id="hireMessage"></span>
                  </div>
              </div>
          </form>
      </div>
    </div>

  </div>
</div>



<div id="candidateModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
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
              <input type="hidden" name="jobid" value="{{ $candidate->JobID }}" />
              <input type="hidden" name="candidate_id" value="{{ $candidate->id }}" />
  <div class="row form-group">
  <div class="col-sm-6">
    <label class="control-label col-sm-10" for="fname">First Name ( <span class="text text-danger">*</span> ):</label>
    <div class="col-sm-12">
        <input type="text" class="form-control myForm" id="name0" name="name0" placeholder="Enter First Name" >
    </div>
  </div>
  <div class="col-sm-6">
    <label class="control-label col-sm-10" for="lanme">Last Name( <span class="text text-danger">*</span> ):</label>
    <div class="col-sm-12"> 
        <input type="text" class="form-control myForm" id="name1" name="name1" placeholder="Enter Last Name">
    </div>
  </div>
  
  </div>
  <div class="row form-group">
  <div class="col-sm-6">
      <label class="control-label col-sm-10" for="email">Email( <span class="text text-danger">*</span> ):</label>
    <div class="col-sm-12">
        <input type="email" class="form-control myForm" id="email0" name="email0"  placeholder="Enter email">
    </div>
  </div>
  <div class="col-sm-6">
    <label class="control-label col-sm-10" for="pwd">Phone( <span class="text text-danger">*</span> ):</label>
    <div class="col-sm-12"> 
        <input type="number" class="form-control myForm" id="mobile0" name="mobile0" placeholder="Enter Phone" >
    </div>
  </div>
  </div>
  <div class="row form-group">
  <div class="col-sm-6">
    <label class="control-label col-sm-10" for="alternate_email">Alternate Email:</label>
    <div class="col-sm-12">
        <input type="email" class="form-control" id="email1" name="email1" placeholder="Enter Alternate Email">
    </div>
  </div>
  <div class="col-sm-6">
    <label class="control-label col-sm-10" for="alternate_phone">Alternate Phone:</label>
    <div class="col-sm-12"> 
        <input type="number" class="form-control" id="mobile1" name="mobile1" placeholder="Enter Alternate Phone">
    </div>
  </div>
  </div>
  <div class="row form-group">
  <div class="col-sm-6">
    <label class="control-label col-sm-10" for="location">Location( <span class="text text-danger">*</span> ):</label>
    <div class="col-sm-12">
        <input type="text" class="form-control myForm" id="candidate_location" name="location" placeholder="Enter Location">
    </div>
  </div>
      <div class="col-sm-6">
    <label class="control-label col-sm-10" for="source_type">Source Type:</label>
    <div class="col-sm-12">

        <!-- <input type="text" class="form-control" id="candidate_source_type" name="source_type" placeholder="Enter Source Type">
 -->
        <select class="form-control"  id="source_type" name="source_type" >
              <option value="0"  disabled="" selected="">Select Source</option>
                @foreach($sourceall as $sourcealls)
                <option value="{{ $sourcealls->id }}" >{{ $sourcealls->name }}</option>
                @endforeach
              </select>
    </div>
  </div>
  </div>
            
  
  <div class="row form-group">
  <div class="col-sm-6">
    <label class="control-label col-sm-10" for="source_type">Skills:</label>
    <div class="col-sm-12">
        <!--<input type="text" class="form-control" id="skill" name="skill" placeholder="Enter Skill">-->
        
         <select class="select2 form-control"  id="candidate_skill" name="skill[]" multiple>
              <option value=""  disabled="">Select Skill</option>
                @foreach($skillall as $skillalls)
                <option value="{{ $skillalls->id }}" >{{ $skillalls->name }}</option>
                @endforeach
              </select>
    </div>
  </div>
  <div class="col-sm-6">
    <label class="control-label col-sm-10" for="pwd">Keywords:</label>
    <div class="col-sm-12"> 
         <select  class="select2 form-control" name='keyword[]' id="candidate_keyword" multiple>
             <option value=""  disabled="">Select Keywords</option>
                @foreach($keywordall as $keywordalls)
                <option value="{{ $keywordalls->id }}" >{{ $keywordalls->name }}</option>
                
                @endforeach
              </select>
    </div>
  </div>
  </div>
 
  <div class="row form-group">
  <div class="col-sm-12">
    <label class="control-label col-sm-2" for="email">Notes:</label>
    <div class="col-sm-12">
        <textarea placeholder="Notes" name="notes" id="candidate_notes" class="form-control"></textarea>
    </div>
  </div>
  
  </div>
 
  <div class="col-sm-6 form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" id="saveBtn" class="btn btn-default">
          <i class="fa-li fa fa-spinner fa-spin" id="saveLoader" style="position: relative;left: 0px;display: none;"></i>
          Update Candidate</button>
          <span id="candidateMessage"></span>
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


<div id="resumeUploadModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
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
                      <label class="control-label col-sm-10" for="email">Select Resume( <span class="text text-danger">* </span> ) :</label>
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

<!-- <button onclick="getUrl()">Click</button> -->
 <input type="hidden" id="jobId" value="{{ $candidate->JobID }}">
 <input type="hidden" id="token" value="{{ Session::token() }}">
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
    .tag{
            padding: 10px 20px;
    background: #ce8624;
    border-radius: 15px;
    color: #ffffff;
    font-family: serif;
    font-weight: bolder;
    }
    
    
    #drop_file_zone {
	    background-color: #EEE; 
	    border: #999 5px dashed;
	    width: 290px; 
	    height: 200px;
	    padding: 8px;
	    font-size: 18px;
	}
	#drag_upload_file {
		width:50%;
		margin:0 auto;
	}
	#drag_upload_file p {
		text-align: center;
	}
	#drag_upload_file #selectfile {
		display: none;
	}
</style>

<link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/respontive.css') }}" rel="stylesheet">

<script type="text/javascript">
var base_url = "{{  URL('/') }}";

function resumeUpload(obj){
    
    
    
     var formData = new FormData(obj);
       $.ajax({
        type: "POST",
        url: base_url+"/admin/updateResume",
        cache:false,
        contentType: false,
        processData: false,
         data:formData,
        beforeSend(xhr){
               $('#resumeBtn').html('Loding.....');
               $('#resumeBtn').prop('disabled',true);
               $('#resumeLoader').show();
        },
         success: function(result){
//             alert(result);
//             console.log(result);

                var obj = JSON.parse(result);
                  if(obj['result'] == "failed"){
                      alert(obj['message']);
                   }
                 if(obj['result'] == "success"){
                   //alert(obj['message']);
                   location.reload();  
                  }
             
         },error: function(data){
                //alert("error");
                console.log(data);
            },complete: function(){
                //alert('complete');
               $('#resumeBtn').html('Upload');
               $('#resumeBtn').prop('disabled',false);
               $('#resumeLoader').hide();
         }	
    });
    
    return false;
}



function interviewEdit(id){
  $('#interviewModal .modal-title').html('Edit'); 
    if(id){
      $.ajax({
        url: base_url+"/admin/getInterviewById/"+id, 
        beforeSend(xhr){
                 //alert('before');
        },
        success: function(result){
                 //$("#div1").html(result);
                 var obj = JSON.parse(result);
                 //alert(obj['data'].Interview_type);
                 //alert(result);
                 $('#interview_id').val(obj['data'].id);
                 $('#user_id').val(obj['data'].user_id);
                 $('#interview_date').val(obj['data'].interview_date);
                 $('#interview_time').val(obj['data'].interview_time);
                 $('#interview_type').val(obj['data'].Interview_type);
                 $('#interviewLocation').val(obj['data'].InterviewLocation);
                 // $('#email0').val(obj['data'].Email);
                 // $('#mobile0').val(obj['data'].Phone);
                 // $('#email1').val(obj['data'].AlternateEmail);
                 // $('#mobile1').val(obj['data'].AlternatePhone);
                 // $('#candidate_location').val(obj['data'].Location);
                
                // if( obj['data'].Skills != '' && obj['data'].Skills != null){
                //     $('#candidate_skill').val( (obj['data'].Skills).split(',') );
                // }
                // $('#candidate_skill').trigger('change'); // Notify any JS components that the value changed

                // if( obj['data'].CVKeywords != '' && obj['data'].CVKeywords != null){
                //     //alert('inside');
                //     $('#candidate_keyword').val( (obj['data'].CVKeywords).split(',') );
                // // }
                // $('#candidate_keyword').trigger('change'); // Notify any JS components that the value changed
                //  $('#candidate_source_type').val(obj['data'].Source);
                //  $('#candidate_Tags').val(obj['data'].Tags);
                //  $('#candidate_notes').val(obj['data'].Status);
                  $('#interviewModal').modal('show');
                 
        },
        complete(xhr,status){
                //alert('complete');
        }
      });
    }else{
        alert('Somethisg Wrong for edit..........');
    }
}



function userEdit(id){
  $('#candidateModal .modal-title').html('Edit'); 
    if(id){
      $.ajax({
        url: base_url+"/admin/getCandidateById/"+id, 
        beforeSend(xhr){
                 //alert('before');
        },
        success: function(result){
                 var obj = JSON.parse(result);
                 $('#name0').val(obj['data'].FirstName);
                 $('#name1').val(obj['data'].LastName);
                 $('#email0').val(obj['data'].Email);
                 $('#mobile0').val(obj['data'].Phone);
                 $('#email1').val(obj['data'].AlternateEmail);
                 $('#mobile1').val(obj['data'].AlternatePhone);
                 $('#candidate_location').val(obj['data'].Location);
                
                if( obj['data'].Skills != '' && obj['data'].Skills != null){
                    $('#candidate_skill').val( (obj['data'].Skills).split(',') );
                }
                $('#candidate_skill').trigger('change'); // Notify any JS components that the value changed

                if( obj['data'].CVKeywords != '' && obj['data'].CVKeywords != null){
                    //alert('inside');
                    $('#candidate_keyword').val( (obj['data'].CVKeywords).split(',') );
                }
                $('#candidate_keyword').trigger('change'); // Notify any JS components that the value changed
                 $('#candidate_source_type').val(obj['data'].Source);
                 $('#candidate_Tags').val(obj['data'].Tags);
                 $('#candidate_notes').val(obj['data'].Status);
                 $('#candidateModal').modal('show');
                 
        },
        complete(xhr,status){
                //alert('complete');
        }
      });
    }else{
        alert('Somethisg Wrong for edit..........');
    }
}


function candidateForm(obj){
    
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
    if(formFlag){ 
     var formData = new FormData(obj);
      $.ajax({
        type: "POST",
        url: base_url+"/admin/addCandidate",
        cache:false,
        contentType: false,
        processData: false,
         data:formData,
        beforeSend(xhr){
               $('#saveBtn').html('Loding.....');
               $('#saveBtn').prop('disabled',true);
               $('#saveLoader').show();
        },
         success: function(result){
             //alert(result);
             console.log(result);
               var obj = JSON.parse(result);
                //alert(obj['result']);
                if(obj['result'] == "failed"){
                    for (var key in obj['data']) {
                        $("#"+key).css('border','1px solid red');
                    }
                    

                    //alert('inside');
                   //location.reload();  
                 }
                 if(obj['result'] == "success"){
                  //alert(obj['message']);
                   //console.log(obj['data']);
                   $('#candidateMessage').html('<span class ="text text-success"> '+obj['message']+'</span>');
                   location.reload();  
                   //getCandidate();
                   //$('#candidateModal').modal('hide');
                 }
             //getCandidate();
             
         },error: function(data){
                //alert("error");
                console.log(data);
            },complete: function(){
               $('#saveBtn').html('Add Candidate');
               $('#saveBtn').prop('disabled',false);
               $('#saveLoader').hide();
         }	
      });
    }else{
        //alert('Please Filled required filled...');
    }
    return false;    
}



function action(emp_id){
    var id = ($('#operationForAction').val());
    if(id=='1'){
        userReject(emp_id);
    }else if(id=='2'){
        userWithdrawn(emp_id);
    }else if(id=='3'){
      userShortList(emp_id);
    }
}

function getTag(condidate_id){
    if(condidate_id != '0' && condidate_id != null){
        //alert(condidate_id);
       
     
        
            $.ajax({
             url: base_url+"/admin/getTag/"+condidate_id, 
             beforeSend(xhr){
                 //alert('before');
             },
             success: function(result){
                 //$("#div1").html(result);
                 //alert('aaaaaaa'+result);
                 $('#tag_section').html(result);
            },
            complete(xhr,status){
                //alert('complete');
            }
        });
    }
}
function updateTag(emp_id){
    var id = $('#candidateTag').val();
    //alert(id);
    if(id != '0' && id != null){
        
        var r = confirm("Do You Want Add!");
        if(r){
      if(emp_id){
        
            $.ajax({
             url: base_url+"/admin/updateTag/"+emp_id+'/'+id, 
             beforeSend(xhr){
                 //alert('before');
             },
             success: function(result){
                 //$("#div1").html(result);
                 var obj = JSON.parse(result);
                  if(obj['result'] == "failed"){
                      alert(obj['message']);
                   }
                 if(obj['result'] == "success"){
                   //alert(obj['data']);
                   //alert(obj['message']);
                   getTag(emp_id);
                   //location.reload();  
                  }
            },
            complete(xhr,status){
                //alert('complete');
            }
        });
    }else{
        alert('Somethisg Wrong for edit..........');
    }
        }
    }else{
        alert('Please Select Tag.');
    }

}

function userReject(id){
 //$('#candidateModal .modal-title').html('Edit'); 
 
 var r = confirm("Do You Want Reject Candidate!");
 if(r){
      if(id){
        
            $.ajax({
             url: base_url+"/admin/rejectEmployee/"+id, 
             beforeSend(xhr){
                 //alert('before');
             },
             success: function(result){
                 //$("#div1").html(result);
                 var obj = JSON.parse(result);
                  if(obj['result'] == "failed"){
                      alert(obj['message']);
                   }
                 if(obj['result'] == "success"){
                   //alert(obj['message']);
                   location.reload();  
                  }
            },
            complete(xhr,status){
                //alert('complete');
            }
        });
    }else{
        alert('Somethisg Wrong for edit..........');
    }
 }
 

}
function userShortList(id){
 //$('#candidateModal .modal-title').html('Edit'); 
 
 var r = confirm("Do You Want Short-List Candidate!");
 if(r){
      if(id){
        
            $.ajax({
             url: base_url+"/admin/shortlistEmployee/"+id, 
             beforeSend(xhr){
                 //alert('before');
             },
             success: function(result){
                 //$("#div1").html(result);
                 var obj = JSON.parse(result);
                  if(obj['result'] == "failed"){
                      alert(obj['message']);
                   }
                 if(obj['result'] == "success"){
                   //alert(obj['message']);
                   location.reload();  
                  }
            },
            complete(xhr,status){
                //alert('complete');
            }
        });
    }else{
        alert('Somethisg Wrong for edit..........');
    }
 }
}

function userWithdrawn(id){
 //$('#candidateModal .modal-title').html('Edit'); 
 
 var r = confirm("Do You Want Withdrawn Candidate!");
 if(r){
      if(id){
        
            $.ajax({
             url: base_url+"/admin/withdrawnEmployee/"+id, 
             beforeSend(xhr){
                 //alert('before');
             },
             success: function(result){
                 //$("#div1").html(result);
                 var obj = JSON.parse(result);
                  if(obj['result'] == "failed"){
                      alert(obj['message']);
                   }
                 if(obj['result'] == "success"){
                   //alert(obj['message']);
                   location.reload();  
                  }
            },
            complete(xhr,status){
                //alert('complete');
            }
        });
    }else{
        alert('Somethisg Wrong for edit..........');
    }
 }
}



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
                  //location.reload();  
                 }
                 if(obj['result'] == "success"){
                  //alert(obj['message']);
                   //console.log(obj['data']);
                   $('#hireMessage').html('<span class ="text text-success"> '+obj['message']+'</span>');
                    window.location.href = getUrl()+"?tabs=6";
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







function editOffer(id){
  //alert();
  // alert($('#offerMessage').html());
  $('#offeredModal .modal-title').html('Edit'); 
    if(id){
      $.ajax({
        url: base_url+"/admin/getCandidateById/"+id, 
        beforeSend(xhr){
                 //alert('before');
               $('#offereSaveBtn').html('Loading.....');
               $('#offereSaveBtn').prop('disabled',true);
               $('#offereSaveLoader').show();
        },
        success: function(result){
                 var obj = JSON.parse(result);
                 //alert(obj['data'].OrgID);
                 //alert(result);
                 $('#candidate_id').val(obj['data'].id);
                 $('#offerIsEdit').val('1');
                 $('#offeredSalary').val(obj['data'].OfferedSalary);
                 $('#offeredDate').val(obj['data'].OfferedJoiningDate);
                 //$('#offeredDate').datepicker('setDate', new Date('2018-05-25'));
                 $('#offeredModal').modal('show');
        },
        complete(xhr,status){
                //alert('complete');
              $('#offereSaveBtn').html('Save');
              $('#offereSaveBtn').prop('disabled',false);
              $('#offereSaveLoader').hide();
        }
      });
    }else{
        alert('Somethisg Wrong for edit..........');
    }


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
                  //location.reload();  
                 }
                 if(obj['result'] == "success"){
                   //alert($('#offerMessageNew').html());
                   //console.log(obj['data']);
                   $('#offerMessage').html('<span class ="text text-success">'+obj['message']+'</span>');
                    window.location.href = getUrl()+"?tabs=5";

                    // $('#interviewMessage').html('<span class ="text text-success"> +'+obj['message']+'</span>');
                    // window.location.href = getUrl()+"?tabs=3";
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
               $('#interviewSaveBtn').html('Loading.....');
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
                  //location.reload();  
                 }
                 if(obj['result'] == "success"){
                  //alert(obj['message']);
                   //console.log(obj['data']);
                   $('#interviewMessage').html('<span class ="text text-success">'+obj['message']+'</span>');
                    window.location.href = getUrl()+"?tabs=3";
                  // getCandidate();
                   //$('#candidateModal').modal('hide');
                 }
             //getCandidate();
             
        },error: function(data){
                console.log("error");
                alert('error');
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
    $('#revireMessage').html('');
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
    ///if(false){ 
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
                    $('#revireMessage').html('<span class="text text-danger" >'+obj['message']+'</span>');
                      for (var key in obj['data']) {
                          $("#"+key).css('border','1px solid red');
                      }
                      //alert('inside');
        //                  //location.reload();  
                   }
                   if(obj['result'] == "success"){
                     //alert();
                     $('#revireMessage').html('<span class="text text-success" >'+obj['message']+'</span>');
                     //$('#popupModal').modal('show');
                       //console.log(obj['data']);
                       //location.reload();   
                       //alert(getUrl());
                      window.location.href = getUrl()+"?tabs=2";
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
             //alert(result);
             //console.log(result);
               var obj = JSON.parse(result);
                //alert(obj['result']);
                if(obj['result'] == "failed"){
                     //alert(obj['message']);
                    for (var key in obj['data']) {
                        $("#"+key).css('border','1px solid red');
                    }
                    //alert('inside');
                  //location.reload();  
                 }
                 if(obj['result'] == "success"){
                   //alert(obj['message']);
                   $('#emailMessage').html('<span class="text text-success">'+obj['message']+'</span>');
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
            $(this).css('border','1px solid red');
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
                  //location.reload();  
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
        //alert('Please Filled required filled...');
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
        changeYear: true,
        changeMonth: true,
        minDate: 0
      });


         $("#hireJoinOn").datepicker({
            changeYear: true,
            changeMonth: true,
            maxDate: new Date(),
      });
 

});

 
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

  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script type="text/javascript">

function getUrl(){
    var query = window.location.search.substring(1);
    var full_url = window.location.href;
    var url = full_url.split("?");
    return (url[0]);
}


$(document).ready(function() {
  $('.select2').select2({
      width: '100%',
      placeholder: "Select Item",
  });
  //  $('#skill').select2({
  //      width: '100%',
  //     // placeholder: "Select Transaction Type",
  //  });
});
</script>

<script src="{{ asset('assets/js/dropzone.js') }}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>

@endsection 