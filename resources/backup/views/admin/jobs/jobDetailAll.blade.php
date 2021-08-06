@extends('layouts.master')

@section('content')
<div class="container-fluid">
  <!-- Page-Title -->
  <div class="row">
    <div class="col-sm-12">
      <div class="page-title-box">
        <div class="btn-group pull-right">
          <ol class="breadcrumb hide-phone p-0 m-0">
            <li class="breadcrumb-item"><a href="{{URL('/admin/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Candidate List</li>
          </ol>
        </div>
        <h4 class="page-title">Candidate List</h4>
         
      </div>
    </div>
  </div>
  <!-- end page title end breadcrumb -->
  <div id="page_section">
  <div class="row top_section">
      <div id="leftSection">
          <div class="box">
              <div class="data">{{ $count_data['new'] }}</div>
              <a href="{!! URL('/admin/applylist'.'?filter[]=').encrypt('1') !!}" title="New"><div class="title text-info">New</div></a>
          </div>
          <div class="box">
               <div class="data">{{ $count_data['in_review'] }}</div>
               <a href="{!! URL('/admin/applylist/'.'?filter[]=').encrypt('2') !!}" title="In Review"><div class="title text text-info">in review</div></a>
          </div>
          <div class="box">
               <div class="data">{{ $count_data['shortlist'] }}</div>
               <a href="{!! URL('/admin/applylist'.'?filter[]=').encrypt('3') !!}" title="Short List"><div class="title text text-info">Shortlist</div></a>
          </div>
          <div class="box">
               <div class="data">{{ $count_data['interview'] }}</div>
               <a href="{!! URL('/admin/applylist/'.'?filter[]=').encrypt('4') !!}" title="Interview"><div class="title text-info">Interview</div></a>
          </div>
          <div class="box">
               <div class="data">{{ $count_data['offered'] }}</div>
               <a href="{!! URL('/admin/applylist/'.'?filter[]=').encrypt('5') !!}" title="Offered"><div class="title text-info">Offered</div></a>
          </div>
          <div class="box">
               <div class="data">{{ $count_data['hired'] }}</div>
               <a href="{!! URL('/admin/applylist/'.'?filter[]=').encrypt('6') !!}" title="Hired"><div class="title text-info">Hired</div></a>
          </div>
          <div class="box">
               <div class="data">{{ $count_data['active'] }}</div>
               <a href="{!! URL('/admin/applylist/'.'?filter[]=').encrypt('10') !!}" title="All Active" ><div class="title text-info">All Active</div></a>
          </div>
          
          
           </div>
     
      <div id="rightSection">
          <div class="box">
              <div class="data">{{ $count_data['leads'] }}</div>
              <a href="{!! URL('/admin/applylist/'.'?filter[]=').encrypt('7') !!}" title="Leads"><div class="title text-primary">Leads</div></a>
          </div>
          <div class="box">
               <div class="data">{{ $count_data['withdrawn'] }}</div>
               <a href="{!! URL('/admin/applylist/'.'?filter[]=').encrypt('8') !!}" title="Withdrawn" >  <div class="title text-primary">Withdrawn</div></a>
          </div>
          <div class="box">
               <div class="data">{{ $count_data['reject'] }}</div>
               <a href="{!! URL('/admin/applylist/'.'?filter[]=').encrypt('9') !!}" title="Rejected" > <div class="title text-danger">Rejected</div></a>
          </div>
          
        </div>
     
  </div>
  
  
  <div class="" style="margin-top: 50px;">
      <ul class="nav nav-tabs" role="tablist">
  <li class="nav-item">
    
    <a class="nav-link active" href="#profile" role="tab" data-toggle="tab">
        <i class="ti-user"></i>
        <span class="tab_name">Candidate</span>
    </a>
  </li>
  
 
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane fade  show active" id="profile">
        
        <div class="panel_data">
        
        <div class="profile_search_section ui-widget">
            
            <input type="text" id="searchtags" class="col-sm-10 mysearchBtn" placeholder="Search Candidate">
            
            <span class="ti-search searchIcon" ></span>
            <button class="btn btn-default" onclick="userAdd()">Add Candidate</button>
        </div>
            <div class="clearfix"></div>
        <div id="profile_section">
         
            <div id="profile_left_section">
             <form id="myForm">
                <div class="row">
                    
                  <div class="col-xs-6 col-sm-12">
                      <!-- <input type="search" class="form-control" placeholder="Search"> -->
                  </div>
                  <div class="col-xs-6 col-sm-12">
                    <h6>Status</h6>
                    <div class="searchFillter">
                       
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" class="filter stage" name="filter[]" value="{{ encrypt('1') }}" @php if(in_array('1',$filler)){ echo 'checked'; } @endphp >New ( {{ $count_data['new'] }}  )
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" class="filter stage" name="filter[]" value="{{ encrypt('2') }}" @php if(in_array('2',$filler)){ echo 'checked'; } @endphp>In-Review( {{ $count_data['in_review'] }} )
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" class="filter stage" name="filter[]" value="{{ encrypt('3') }}" @php if(in_array('3',$filler)){ echo 'checked'; } @endphp>Shortlist( {{ $count_data['shortlist'] }} )
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" class="filter stage" name="filter[]" value="{{ encrypt('4') }}" @php if(in_array('4',$filler)){ echo 'checked'; } @endphp>Interview ( {{ $count_data['interview'] }} )
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" class="filter stage"  name="filter[]" value="{{ encrypt('5') }}" @php if(in_array('5',$filler)){ echo 'checked'; } @endphp>Offered ( {{ $count_data['offered'] }} )
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" class="filter stage"  name="filter[]" value="{{ encrypt('6') }}" @php if(in_array('6',$filler)){ echo 'checked'; } @endphp>Hired ( {{ $count_data['hired'] }} )
                            </label>
                        </div>
    
                        <div class="checkbox">
                            <label>
                              <input type="checkbox" class="filter stage"  name="filter[]" value="{{ encrypt('9') }}" @php if(in_array('9',$filler)){ echo 'checked'; } @endphp  >Rejected ( {{ $count_data['reject'] }} )
                            </label>
                        </div>
                    
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-6 col-sm-12">
                  <h6>Filter Tags</h6>
                   <div class="searchFillter">
                  @foreach($tagall as $key=>$row)
                     <div class="checkbox">
                          <label>
                            <input type="checkbox" class="filter tags" name="tags[]"  value="{{ $row->id }}" 
                            @php 
                            if(isset($_REQUEST['tags']))
                              if(in_array($row->id,$_REQUEST['tags']))
                              { echo 'checked'; } 
                            @endphp
                            >
                            {{ $row->name }}
                          </label>
                      </div>
                  @endforeach
                    
                  </div>
                  </div>
                </div>
                
                <div class="row">
                <div class="col-xs-6 col-sm-12">
                <h6>Rating</h6>
                
                <div class="searchFillter">
                    <div class="checkbox">
                        <label><input type="checkbox" class="filter rating" name="rating[]"
                            @php 
                            if(isset($_REQUEST['rating']))
                              if(in_array('1',$_REQUEST['rating']))
                              { echo 'checked'; } 
                            @endphp

                          value="1">1</label>
                        <label>
                          <input type="checkbox" class="filter rating" name="rating[]"
                            @php 
                            if(isset($_REQUEST['rating']))
                              if(in_array('2',$_REQUEST['rating']))
                              { echo 'checked'; } 
                            @endphp
                         value="2">2</label>
                        <label>
                          <input type="checkbox" class="filter rating" name="rating[]" 
                             @php 
                            if(isset($_REQUEST['rating']))
                              if(in_array('3',$_REQUEST['rating']))
                              { echo 'checked'; } 
                            @endphp
                           value="3">3</label>
                        <label>
                          <input type="checkbox" class="filter rating" name="rating[]" 
                             @php 
                            if(isset($_REQUEST['rating']))
                              if(in_array('4',$_REQUEST['rating']))
                              { echo 'checked'; } 
                            @endphp
                           value="4">4</label>
                        <label><input type="checkbox" class="filter rating" name="rating[]"
                           @php 
                            if(isset($_REQUEST['rating']))
                              if(in_array('5',$_REQUEST['rating']))
                              { echo 'checked'; } 
                            @endphp
                         value="5">5</label>
                    </div>
                </div>
                </div>
                </div>
                
               </form>
            </div>
         
            <div id="profile_right_section">
                 @if($filler || isset($_REQUEST['rating']) || isset($_REQUEST['tags']) )
                <div class="row" id="filter_section">
                   <div class="col-xs-10 col-sm-10 col-md-10" id="filter_name_section">
                       @if(isset($_REQUEST['filter'])) 
                       <span>Stage : </span>
                        @foreach ($filler as $fillers)
                       <span class="filter_name">{{ $filterArr[$fillers]  }}</span>
                        @endforeach
                        @endif

                      @if(isset($_REQUEST['tags']) ) 
                       @php $tags = $_REQUEST['tags']; @endphp
                       <span>Tags : </span>
                         @foreach ($selectTags as $tag)
                         <span class="filter_name">{{ $tag  }}</span>
                          @endforeach
                      @endif

                      @if(isset($_REQUEST['rating']) ) 
                       @php $rating = $_REQUEST['rating']; @endphp
                       <span>Rating : </span>
                         @foreach ($_REQUEST['rating'] as $r)
                         <span class="filter_name">{{ $r  }}</span>
                          @endforeach
                      @endif
                       
                        </div>
                        <div class="col-xs-2 col-sm-10 col-md-2">
                            <a href="{!! URL('/admin/applylist') !!}" class="text text-danger">Clear All</a>
                        </div>
               </div>
                @endif
                
                <div id="profile_top">
                    <div class="row">
                        <div class="col-sm-2">
                            <span class="checkbox">
                                <label><input type="checkbox" id="checkAll" onchange="selectAll(this)" value="">Select All </label>
                            </span>
                        </div>
                        <div class="col-sm-5 text-right">
                            <form id="actionForm" onsubmit="return actionForm(this);">
                               {!! Form::token() !!}
                            <select class="sortFillter action" id="action" disabled="">
                                <option value="0" selected="">Action</option>
                               
                                <option value="1">Reject Candidate</option>
                                <option value="3">Delete Candidate</option>
                                <option value="4">Mark To Withdrawn</option>
                               
                            </select>
                                <button type="submit" id="actionBtn" class="btn btn-default" disabled="">Action</button>
                            </form>
                        </div>
                        <div class="col-sm-5">
                              <span class="searchMessage">  Showing {{ $data['count'] }} of {{ $data['total_record'] }}</span>
                        <span> Sort By : </span>
                             <select class="sortFillter sort" id="sort" onchange="searchFilter(this)" >
                                <option value="0" selected="">Sort</option>
                                <option value="1">A-Z</option>
                                <option value="2">Z-A</option>
                                <option value="3">Recent Activity</option>
                            </select>
                        </div>
                        
                    </div>
                    
                </div>               

              
              
 
               
                    
               
	<div id="condidate_list_detail">   
	    @php $count = 1; @endphp
	    @if(isset($candidates) && !empty($candidates) && count($candidates)>0)
	    
	    @foreach ($candidates as $candidate)
	       
	                
	                
	                
	        		<div class="profile_list">
	                    <div class="row profile_list_item">
	                        <div class="col-sm-1 profile_list_data">
	                          @if($candidate->stageStatus < '6')
	                            <div class="checkbox">

	                                <label><input type="checkbox" class="checkBoxClass" value="{{ $candidate->id }}"></label>
	                            </div>
	                            @else
	                            <span>&nbsp;</span>
	                            @endif
	                        </div>
	                        <div class="col-sm-1 profile_list_data">
	                         <div class="alert alert-success sort_name">
	                         @php echo strtoupper(substr($candidate->FirstName, 0, 1)).strtoupper(substr($candidate->LastName, 0, 1))  @endphp
	                         </div>
	                        </div>
	                        <div class="col-sm-4 profile_list_data">
	                            <a href="{!! URL('/admin/candidate_detail').'/'.encrypt($candidate->JobID).'/'.$candidate->id.'?tabs=1' !!}"><div class="title">{{ $candidate->FirstName.' '.$candidate->LastName }}</div></a>
	                             @if ($candidate->Email)
	                            <div class="sub_title">{{ $candidate->Email }}</div>
	                            @endif
	                            
	                            <div class="sub_title"> @php  echo date('d-M-Y',strtotime($candidate->created_at)) @endphp
	                            </div>

	                             @if ($candidate->jobname->JobTitle)
	                            <div class="sub_title">Job Title : {{ $candidate->jobname->JobTitle }}</div>
	                            @endif
	                        </div>
	                        <div class="col-sm-2 profile_list_data">
	                            <div class="title">{{ $filterArr[$candidate->stageStatus]  }}</div>
	                            <!--<div class="sub_title">Status</div>-->
	                             @if ($candidate->Location)
	                            <div class="sub_title">From : {{ $candidate->Location }}</div>
	                            @endif


	                            
	                        </div>
	                        
	                        <div class="col-sm-2 profile_list_data">
	                        @if($candidate->interview && count($candidate->interview)>0 )
	                        @php  $total = 0; $count=0; @endphp
	                         
	                         @foreach ($candidate->interview as $k=>$interview)
	                             @php 
	                                $total = $total+ $interview->rating;
	                                $count++;
	                             @endphp
	                         @endforeach
	                         <p>
	                           @php  echo $total/$count .' Out Of 5'; @endphp
	                         </p>
	                         
	                        @else
	                            <span>No Review</span>
	                        @endif
	                      </div>
	                        
	                        <div class="col-sm-1 profile_list_data">


	                            <div class="dropdown">
	                                <span role="button" style="cursor: pointer" data-toggle="dropdown"> <i class="ti-list"></i>
	                                </span>
	                                <ul class="dropdown-menu">
	                                   
                                     <li>
                                      <a href="javascript:0" onclick="userEdit({{ $candidate->id }})">Edit Candidate</a>
                                     </li> 

	                                     @if($candidate->stageStatus !='6')
	                                    <li><a href="javascript:0" onclick="userReject({{ $candidate->id }})">Reject Candidate</a></li>
	                                    <li><a href="javascript:0" onclick="userWithdrawn({{ $candidate->id }})">Withdrawn Candidate</a></li>
	                                    @endif
	                                    
	                                </ul>
	                            </div>
	                        </div>
	                            
	                        </div>
	                </div>
	                    
	    @php $count++; @endphp
	    @endforeach

	   	    @else
	        <div class="profile_list">
	                <div class="col-xs-12 col-sm-12 col-md-12 alert alert-danger">No Records</div>
	        </div>
	    @endif
	</div>

   <div class="pull-right">
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <!-- <li class="page-item"><a class="page-link" href="#">Previous</a></li> -->

          <?php
          $str = '?';
          if(isset($_REQUEST['filter']) ){
            $str .= http_build_query( array('filter' => $_REQUEST['filter']));
            $str.="&";
          }
          if(isset($_REQUEST['tags']) ){
            $str .= http_build_query( array('tags' => $_REQUEST['tags']));
             $str.="&";
          }
          if(isset($_REQUEST['rating']) ){
            $str .= http_build_query( array('rating' => $_REQUEST['rating']));
             $str.="&";
          }
          ?>


          @for($i = 1;$i<=$data['page'];$i++)
          <li class="page-item"><a class="page-link" href="{!! URL('/admin/applylist').$str.'page='.$i !!}">{{$i}}</a></li>
          @endfor
          <!-- <li class="page-item"><a class="page-link" href="#">Next</a></li> -->
        </ul>
      </nav>
    </div>

	            

            </div>
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
        
        <div class="row form-group" id="resumeUploadingSection">
          <div class="col-sm-12" >
            <div class="col-sm-12">
                  <form id="resumeForm" enctype= "multipart/form" onsubmit="return resumeForm(this)">

                      <input type="hidden"  name="_token" id="csrf-token" value="{{ Session::token() }}" />
                      <input type="file" class="form-control" id="selectfile"  name="UploadedCVPath" onchange="fileChange(this)">
                      <!-- <label for="selectfile">Select file</label>       -->

                  </form>

                  <div class="col-sm-12 form-group">
                      <div class="text text-danger" id="errorMessage"></div>
                      <i id="show" class="text text-success fa fa-check" aria-hidden="true"> Success</i>
                      <i id="hide" class="text text-danger fa fa-times" aria-hidden="true"> Failed</i>
                  </div>
            </div>
          </div>
        </div>



        <form class="form-horizontal" enctype="multipart/form-data" id="candidateForm"  onsubmit="return candidateForm(this)">
          <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
          <input type="hidden" name="candidate_id" id="candidate_id" value="" />
          <input type="hidden" name="fileName" id="file_name0" class="addForm parserField">
          <div class="row form-group exp">
              <div class="col-sm-12">
              <label class="control-label col-sm-10" for="jobid">Job ( <span class="text text-danger">*</span> ):</label>
              <div class="col-sm-12">
             <select class="form-control addForm myForm" name="jobid" id="jobid">
               <option value="0" disabled="" selected="">select Job</option>
               @foreach($jobmaster as $joblist)
                  <option value="{{ $joblist->id }}">{{ $joblist->JobTitle }}</option>
               @endforeach
             </select>
              </div>
              </div>
          </div>

         

          <div class="row form-group">
            <div class="col-sm-6">
              <label class="control-label col-sm-10" for="fname">First Name ( <span class="text text-danger">*</span> ):</label>
              <div class="col-sm-12">
                  <input type="text" class="form-control myForm addForm editForm parserField" id="name0" name="name0" placeholder="Enter First Name" >
              </div>
            </div>
            <div class="col-sm-6">
              <label class="control-label col-sm-10" for="lanme">Last Name( <span class="text text-danger">*</span> ):</label>
              <div class="col-sm-12"> 
                  <input type="text" class="form-control addForm editForm myForm parserField" id="name1" name="name1" placeholder="Enter Last Name">
              </div>
            </div>
          </div>

          <div class="row form-group">
            <div class="col-sm-6">
                <label class="control-label col-sm-10" for="email">Email( <span class="text text-danger">*</span> ):</label>
              <div class="col-sm-12">
                  <input type="email" class="form-control myForm addForm editForm parserField" id="email0" name="email0"  placeholder="Enter email">
              </div>
            </div>
            <div class="col-sm-6">
              <label class="control-label col-sm-10" for="pwd">Phone( <span class="text text-danger">*</span> ):</label>
              <div class="col-sm-12"> 
                  <input type="number" class="form-control myForm addForm editForm parserField" id="mobile0" name="mobile0" placeholder="Enter Phone" >
              </div>
            </div>
          </div>

          <div class="row form-group">
            <div class="col-sm-6">
              <label class="control-label col-sm-10" for="alternate_email">Alternate Email:</label>
              <div class="col-sm-12">
                  <input type="email" class="form-control addForm parserField" id="email1" name="email1" placeholder="Enter Alternate Email">
              </div>
            </div>
            <div class="col-sm-6">
              <label class="control-label col-sm-10" for="alternate_phone">Alternate Phone:</label>
              <div class="col-sm-12"> 
                  <input type="number" class="form-control addForm parserField" id="mobile1" name="mobile1" placeholder="Enter Alternate Phone">
              </div>
            </div>
          </div>

          <div class="row form-group">
            <div class="col-sm-6">
              <label class="control-label col-sm-10" for="location">Location( <span class="text text-danger">*</span> ):</label>
              <div class="col-sm-12">
                  <input type="text" class="form-control addForm editForm myForm" id="location" name="location" placeholder="Enter Location">
              </div>
            </div>
            <div class="col-sm-6 exp">
              <label class="control-label col-sm-10" for="notic period">Notice Period( <span class="text text-danger">*</span> ):</label>
              <div class="col-sm-12"> 
                  <input type="number" class="form-control addForm myForm " id="notic_period" name="notic_period" placeholder="Enter Notice period">
              </div>
            </div>
          </div>
          
          <div class="row form-group exp" >
            <div class="col-sm-6">
              <label class="control-label col-sm-10" for="ctc">Current CTC:</label>
              <div class="col-sm-12">
                  <input type="number" class="form-control addForm myForm" id="ctc" name="ctc" placeholder="Enter Current CTC" >
              </div>
            </div>
            <div class="col-sm-6">
              <label class="control-label col-sm-10" for="current_cumpany">Current Company:</label>
              <div class="col-sm-12"> 
                  <input type="text" class="form-control addForm myForm" id="current_cumpany" name="current_cumpany" placeholder="Enter Current Company" >
              </div>
            </div>
          </div>
          <div class="row form-group exp">
            <div class="col-sm-6">
              <label class="control-label col-sm-10" for="designation">Designation:</label>
              <div class="col-sm-12">
                  <input type="text" class="form-control addForm myForm" id="designation" name="designation" placeholder="Enter Designation" >
              </div>
            </div>
            <div class="col-sm-6 row">
                <div class="col-sm-12"><label>Total Experience</label></div>
                  <div class="col-sm-6">
                      <select class="form-control addForm myForm" name="year" id="year">
                        <option value="0" selected="" disabled="">Year</option>
                            <option value="0">0</option>    
                            <option value="1">1</option>    
                            <option value="2">2</option>    
                            <option value="3">3</option>    
                            <option value="4">4</option>    
                            <option value="5">5</option>    
                            <option value="6">6</option>    
                            <option value="7">7</option>    
                            <option value="8">8</option>    
                            <option value="9">9</option>    
                            <option value="10">10</option>    
                            <option value="11">11</option>    
                            <option value="12">12</option>    
                      </select>
                  </div>
                  <div class="col-sm-6">
                      <select class="form-control addForm myForm" name="month" id="month">
                          <option value="0" selected="" disabled="">Month</option>
                          <option value="0">0</option>    
                          <option value="1">1</option>    
                          <option value="2">2</option>    
                          <option value="3">3</option>    
                          <option value="4">4</option>    
                          <option value="5">5</option>    
                          <option value="6">6</option>    
                          <option value="7">7</option>    
                          <option value="8">8</option>    
                          <option value="9">9</option>    
                          <option value="10">10</option>    
                          <option value="11">11</option>    
                          <option value="12">12</option>    
                      </select>
                  </div>
            </div>
          </div>
                      
          <div class="row form-group">
            <div class="col-sm-6">
              <label class="control-label col-sm-10" for="source_type">Source Type:</label>
              <div class="col-sm-12">
                   <select class="form-control addForm"  id="source_type" name="source_type" >
                        <option value="0"  disabled="" selected="">Select Tag</option>
                          @foreach($sourceall as $sourcealls)
                          <option value="{{ $sourcealls->id }}" >{{ $sourcealls->name }}</option>
                          @endforeach
                        </select>

              </div>
            </div>
            <div class="col-sm-6">
              <label class="control-label col-sm-10" for="pwd">Tags:</label>
              <div class="col-sm-12"> 
                    <select class="form-control addForm"  id="Tags" name="Tags" >
                        <option value="0"  disabled="" selected="">Select Tag</option>
                          @foreach($tagall as $tagalls)
                          <option value="{{ $tagalls->id }}" >{{ $tagalls->name }}</option>
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
                  
                   <select class="select2 form-control addForm"  id="skill" name="skill[]" multiple>
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
                   <select  class="select2 form-control addForm" name='keyword[]' id="keyword" multiple>
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
              <label class="control-label col-sm-2 " for="email">Notes:</label>
              <div class="col-sm-12">
                  <textarea placeholder="Notes" name="notes" id="notes" class="form-control addForm"></textarea>
              </div>
            </div>
          </div>
         
          <div class="col-sm-12 form-group"> 
            <div class="col-sm-offset-12 col-sm-12">
                <button type="submit" id="saveBtn" class="btn btn-default">
                  <i class="fa-li fa fa-spinner fa-spin" id="saveLoader" style="position: relative;left: 0px;display: none;"></i>
                  Submit</button>
                  <span id="addCandidateMessage"></span>
            </div>
          </div>
        </form>
      </div>

    </div>

  </div>
</div>




  </div>
  </div>
  <!-- end row -->
</div>
@endsection 

@section('extrajs') 




<style type="text/css">
#errorMessage,#show,#hide{
  display: none;
}
#selectfile{
   background-color: #EEE; 
      border: #999 3px dashed;
      width: 100%; 
      height: 100%;
      padding: 25px;
      padding-left: 40%;
      font-size: 18px;
      position: relative;
}
  
  #drag_upload_file {
    width:50%;
    margin:0 auto;
  }
  #drag_upload_file p {
    text-align: center;
  }
  
</style>

<style type="text/css">

    #editLink a:hover{
        text-decoration: underline;
        color: #3366ff !important;
        color: #0c96e6;
        font-weight: bolder;
    }
</style>


<script type="text/javascript">
//jQuery.noConflict( true );
var base_url = "{{  URL('/') }}";


function fileChange(obj){
    // alert('file select');
    $('#show').hide();
    $('#hide').hide();
    $('#errorMessage').html("");
    var formObj = $('#candidateForm').find('.parserField'); 
        $(formObj).each(function (){
        $(this).val('');
    });
    var fileName, fileExtension;
    fileName = $(obj).val();
    fileExtension = fileName.substr((fileName.lastIndexOf('.') + 1));
    //console.log (fileExtension);

      if(fileExtension == 'doc' || fileExtension=='docx' || fileExtension== 'pdf'){
        $('#resumeForm').submit();
          //alert('form submit');
      }else{
        //$('#errorMessage').html('Invalid Format. Allow only Pdf or Docx file').fadeIn();
        $('#errorMessage').html('Invalid File Format. Allow only Pdf or Doc file').fadeIn();
        //alert('invalid');
        $(obj).val('');
      }
    //$('#resumeForm').submit();
}


function resumeForm(obj){
    var formData = new FormData(obj);
    //alert('form submit');
    $.ajax({
        type: "POST",
        url: base_url+"/doUpload",
        cache:false,
        contentType: false,
        processData: false,
         data:formData,
        beforeSend(xhr){
           // alert('before');
           $('#show').hide();
           $('#hide').hide();
               // $('#saveBtn').html('Loding.....');
               // $('#saveBtn').prop('disabled',true);
               // $('#saveLoader').show();
        },
        success: function(result){
            //alert(result);
             //console.log(result);
            var obj = JSON.parse(result);
           
             if(obj['result'] == 'success'){
                 var len = (obj['data'].length);
                    for (var key in obj['data']) {
                        
                        var len1 = (obj['data'][key].length);
                       
                            for(var i=0;i<len1; i++){
                                $('#'+key+(i)).val(obj['data'][key][i]);
                                //alert(key+(i)+' '+obj['data'][key][i]);
                            }
                       
                    }
                  if(obj['status'] == "0"){
                        $('#show').hide();
                        $('#hide').show();
                    }
                    if(obj['status'] == "1"){
                        $('#show').show();
                        $('#hide').hide();
                    }  
             }
            if(obj['result'] == 'failed'){
                //alert(obj['status']);
                    if(obj['status'] == "0"){
                        $('#show').hide();
                        $('#hide').show();
                    }
                    if(obj['status'] == "1"){
                        $('#show').show();
                        $('#hide').hide();
                    }
             }
             


        },error: function(data){
                //alert("error");
                console.log(data);
        },complete: function(){
                //alert('complete');
               // $('#saveBtn').html('Add Candidate');
               // $('#saveBtn').prop('disabled',false);
               // $('#saveLoader').hide();
        }  
    });
    return false;
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
                   alert(obj['message']);
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



function userOffered(id){
 //$('#candidateModal .modal-title').html('Edit'); 
 
 var r = confirm("Do You Want Offered!");
 if(r){
      if(id){
        
            $.ajax({
             url: base_url+"/admin/offeredEmployee/"+id, 
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
                   alert(obj['message']);
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

function userHire(id){
 //$('#candidateModal .modal-title').html('Edit'); 
 
 var r = confirm("Do You Want hire!");
 if(r){
      if(id){
        
            $.ajax({
             url: base_url+"/admin/hireEmployee/"+id, 
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
                   alert(obj['message']);
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


function userEdit(id){
   $('#candidateModal .modal-title').html('Edit'); 
   
    if(id){
          $('.exp').hide();
          $('#resumeUploadingSection').hide();
          $.ajax({
             url: base_url+"/admin/getCandidateById/"+id, 
             beforeSend(xhr){
                 //alert('before');
             },
             success: function(result){
                 //$("#div1").html(result);
                 var obj = JSON.parse(result);
                 //alert(obj['data'].OrgID);
                 //alert(result);
                 $('#candidate_id').val(obj['data'].id);
                 $('#jobid').val(obj['data'].JobID);


                 $('#name0').val(obj['data'].FirstName);
                 $('#name1').val(obj['data'].LastName);
                 $('#email0').val(obj['data'].Email);
                 $('#mobile0').val(obj['data'].Phone);
                 $('#email1').val(obj['data'].AlternateEmail);
                 $('#mobile1').val(obj['data'].AlternatePhone);
                 $('#location').val(obj['data'].Location);
                
                if( obj['data'].Skills != '' && obj['data'].Skills != null){
                    $('#skill').val( (obj['data'].Skills).split(',') );
                }
                $('#skill').trigger('change'); // Notify any JS components that the value changed

                if( obj['data'].CVKeywords != '' && obj['data'].CVKeywords != null){
                    //alert('inside');
                    $('#keyword').val( (obj['data'].CVKeywords).split(',') );
                }
                $('#keyword').trigger('change'); // Notify any JS components that the value changed
                 $('#source_type').val(obj['data'].Source);
                 $('#Tags').val(obj['data'].Tags);
                 $('#notes').val(obj['data'].Status);
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

function userAdd(){
  //alert();
   $('#candidateModal .modal-title').html('Add'); 
   $('#candidate_id').val('');
   $('.exp').show();
   $('#resumeUploadingSection').show();
   var formObj = $('#candidateForm').find('.addForm'); 
    $(formObj).each(function (){
      $(this).val('');
    });
 $('#keyword').trigger('change');
 $('#skill').trigger('change');
   $('#candidateModal').modal('show');
}



function candidateForm(obj){
    var formFlag = true;
    var flag = false;    
    if($('#candidate_id').val() == ''){
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
    }else{
      var formObj = $(obj).find('.editForm'); 
        $(formObj).each(function (){
            if($(this).val() == '' || $(this).val() == null ){
                //alert($(this).val());
                $(this).css('border','1px solid red');
                formFlag = false;
            }else{
                $(this).css('border','1px solid #ccc');

            }
        });
    }

   
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
          $('#saveBtn').html('Loading.....');
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
           $('#addCandidateMessage').html('<span class="text text-success">'+obj['message']+'</span>');
           location.reload();  
           //getCandidate();
           //$('#candidateModal').modal('hide');
          }
          //getCandidate();

        },error: function(data){
          //alert("error");
          console.log(data);
        },complete: function(){
          $('#saveBtn').html('Submit');
          $('#saveBtn').prop('disabled',false);
          $('#saveLoader').hide();
        }	
      });
    }else{
        //alert('Please Filled required filled...');
         $('#addCandidateMessage').html('<span class="text text-danger">Please Filled required filled</span>');
    }
  return false;    
}

function actionForm(obj){
    var action = ($('#action').val());
    var userList = [];
    if(action !='' && action !='0'){
         $('.checkBoxClass').each(function (){
            if ($(this).is(":checked")) {
                userList.push($(this).val());
            }
            
    });
        //alert(user);
        $.ajax({
        type: "POST",
        url: base_url+"/admin/action",
        data : {"_token": "{{ csrf_token() }}",'action':action,'userList':userList},
        beforeSend(xhr){
               //alert('before');
        },
         success: function(result){
             //alert(result);
             console.log(result);
             getCandidate();
             
         }	
    });
        
    }
    return false;
    
}
function selectAll(obj){
    //alert( $(obj).prop('checked') );
    var flag = ($(obj).prop('checked'));
    
        $('.checkBoxClass').each(function (){
            $(this).prop('checked',flag);
        })
    
    $("#action").prop('disabled', !flag);
    $("#actionBtn").prop('disabled', !flag);
}

$(document).ready(function (){
$('#page_section').on('change','.checkBoxClass',function (){
    var userList = [];
    $('.checkBoxClass').each(function (){
            if ($(this).is(":checked")) {
                userList.push($(this).val());
            }
    });
        if(userList.length !='0'){
            $("#action").prop('disabled', false);
            $("#actionBtn").prop('disabled', false);
            $("#checkAll").prop('checked', false);
            
        }else{
            $("#action").prop('disabled', true);
            $("#actionBtn").prop('disabled', true);
        }
    });
})

function myfunction(myvar){
  var urls = myvar;
  var myurls = urls.split("?filter=");
  var mylasturls = myurls[1];
  if(myurls.length > 1){
     var mynexturls = mylasturls.split("&");
     var url = mynexturls[0];
  $('#filter_name_section').html('');
  for(var i = 0; i<mynexturls.length;i++){
    $('#filter_name_section').append('<span class="filter_name">'+mynexturls[i]+'</span>');
  }
  }else{
  
   $('#filter_section').hide();
  }
}
//myfunction(window.location.href);


function searchFilter(){
    getCandidate();
    //alert('change');
}



function getCandidate(){
//$('#condidate_list_detail').html('');
//var job_id = $('#jobId').val(); 
 var searchtags = $('#searchtags').val();
 var sort = $('#sort').val();
 var filter = [];
 var tags = [];
 var rating = [];
 $('.stage').each(function (){
    if ($(this).is(":checked")) {
        filter.push($(this).val());
    }
 });
 $('.tags').each(function (){
    if ($(this).is(":checked")) {
        tags.push($(this).val());
    }
 });
 $('.rating').each(function (){
    if ($(this).is(":checked")) {
        rating.push($(this).val());
    }
 });
 //alert(searchtags);
    $.ajax({
        url: base_url+"/admin/applylistAllCandidate",
        data : {
          'searchtags'  :searchtags,
          'sort'        :sort,
          'filter'      :filter,
          'tags'        :tags,
          'rating'      :rating
        },
        beforeSend(xhr){
               $('#condidate_list_detail').html('');
               //alert('before');
             },
         success: function(result){
             //alert(result);
             console.log(result);
            $('#condidate_list_detail').html(result);
         }	
    });
}


$(document).ready(function (){
    //getCandidate(); 
 
  $('.filter').change(function (){
     $('#myForm').submit();
  });
});


</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2({
      width: '100%',
     // placeholder: "Select Transaction Type",
  });
//  $('#skill').select2({
//      width: '100%',
//     // placeholder: "Select Transaction Type",
//  });
});
</script>


  <script>
 
  $( function() {
var filter = [];
// $('.filter').each(function (){
//    if ($(this).is(":checked")) {
//        filter.push($(this).val());
//    }
//});
var jobId = ($('#jobId').val());
//alert(jobId);
    $( "#searchtags" ).autocomplete({
      source: base_url+"/admin/applylistCandidate",
      select: function( event, ui ) {
      	//alert();
          searchFilter();
      }, change: function( event, ui ) {
         // alert();
      }
    });
  } );
  </script>

<link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/respontive.css') }}" rel="stylesheet">
@endsection 
