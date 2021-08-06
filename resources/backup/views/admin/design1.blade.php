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
        <h4 class="page-title">Design one</h4>
      </div>
    </div>
  </div>
  <!-- end page title end breadcrumb -->
  <div id="page_section">
  <div class="row top_section">
      <div id="leftSection">
          <div class="box">
              <div class="data">10</div>
              <a href="{!! URL('/admin/job_list?filter=new') !!}" title="New"><div class="title text-info">New</div></a>
          </div>
          <div class="box">
               <div class="data">10</div>
               <a href="{!! URL('/admin/job_list?filter=in_review') !!}" title="In Review"><div class="title text text-info">in review</div></a>
          </div>
          <div class="box">
               <div class="data">10</div>
               <a href="{!! URL('/admin/job_list?filter=interview') !!}" title="Interview"><div class="title text-info">Interview</div></a>
          </div>
          <div class="box">
               <div class="data">-</div>
               <a href="{!! URL('/admin/job_list?filter=offerd') !!}" title="Offered"><div class="title text-info">Offered</div></a>
          </div>
          <div class="box">
               <div class="data">-</div>
               <a href="{!! URL('/admin/job_list?filter=hired') !!}" title="Hired"><div class="title text-info">Hired</div></a>
          </div>
          <div class="box">
               <div class="data">50</div>
               <a href="{!! URL('/admin/job_list?filter=active') !!}" title="All Active" ><div class="title text-info">All Active</div></a>
          </div>
          
          
           </div>
     
      <div id="rightSection">
          <div class="box">
              <div class="data">10</div>
              <a href="{!! URL('/admin/job_list?filter=leads') !!}" title="Leads"><div class="title text-primary">Leads</div></a>
          </div>
          <div class="box">
               <div class="data">10</div>
               <a href="{!! URL('/admin/job_list?filter=withdrawn') !!}" title="Withdrawn" >  <div class="title text-primary">Withdrawn</div></a>
          </div>
          <div class="box">
               <div class="data">10</div>
               <a href="{!! URL('/admin/job_list?filter=reject') !!}" title="Rejected" > <div class="title text-danger">Rejected</div></a>
          </div>
          
        </div>
     
  </div>
  
  
  <div class="" style="margin-top: 50px;">
      <ul class="nav nav-tabs" role="tablist">
  <li class="nav-item">
    
    <a class="nav-link active" href="#profile" role="tab" data-toggle="tab">
        <i class="ti-user"></i>
        <span class="tab_name">PROFILE</span>
    </a>
  </li>
  <li class="nav-item">
      
    <a class="nav-link" href="#sourcing" role="tab" data-toggle="tab">
        <i class="ti-user"></i>
        <span class="tab_name">SOURCING</span> 
    </a>
  </li>
  <li class="nav-item">
      
    <a class="nav-link" href="#activity" role="tab" data-toggle="tab">
        <i class="ti-user"></i>
        <span class="tab_name">ACTIVITY</span>
    </a>
  </li>
  <li class="nav-item">
     
    <a class="nav-link" href="#job_ad" role="tab" data-toggle="tab">
         <i class="ti-user"></i>
         <span class="tab_name">JOB AD</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#job_detail" role="tab" data-toggle="tab">
         <i class="ti-user"></i>
         <span class="tab_name">JOB DETAIL</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#hiring_process" role="tab" data-toggle="tab">
         <i class="ti-user"></i>
         <span class="tab_name">HIRING PROCESS</span>
    </a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane fade  show active" id="profile">
        
        <div class="panel_data">
        
        <div class="profile_search_section">
            <input type="text" class="col-sm-10 mysearchBtn" placeholder="Search People">
            <span class="ti-search searchIcon" ></span>
            <button class="btn btn-default">Add Candidate</button>
        </div>
            <div class="clearfix"></div>
        <div id="profile_section">
            <div id="profile_left_section">
            
                <div class="row">
                    
                <div class="col-xs-6 col-sm-12">
                    <input type="search" class="form-control" placeholder="Search">
                </div>
                <div class="col-xs-6 col-sm-12">
                <h6>Status</h6>
                <div class="searchFillter">
                    <div class="checkbox">
                        <label><input type="checkbox" value="">Option ( 1 )</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value="">Option ( 1 )</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value="">Option ( 1 )</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value="">Option ( 1 )</label>
                    </div>
                </div>
                </div>
                </div>
                <div class="row">
                <div class="col-xs-6 col-sm-12">
                <h6>Filter Title</h6>
                
                <div class="searchFillter">
                    <div class="checkbox">
                        <label><input type="checkbox" value="">Option ( 1 )</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value="">Option ( 1 )</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value="">Option ( 1 )</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value="">Option ( 1 )</label>
                    </div>
                </div>
                </div>
                </div>
                
                <div class="row">
                <div class="col-xs-6 col-sm-12">
                <h6>Rating</h6>
                
                <div class="searchFillter">
                    <div class="checkbox">
                        <label><input type="checkbox" value="">Option ( 1 )</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value="">Option ( 1 )</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value="">Option ( 1 )</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value="">Option ( 1 )</label>
                    </div>
                </div>
                </div>
                </div>
                
              
            </div>
            <div id="profile_right_section">
                
                <div class="row" id="filter_section">
                   <div class="col-xs-10 col-sm-10 col-md-10" id="filter_name_section">
                            <span class="filter_name">filter Name</span>
                            <span class="filter_name">filter Name</span>
                            <span class="filter_name">Name</span>
                        </div>
                        <div class="col-xs-2 col-sm-10 col-md-2">
                            <a href="{!! URL('/admin/job_list') !!}" class="text text-danger">Clear All</a>
                        </div>
               </div>
                
                <div id="profile_top">
                    <div class="profile_top_left">
                        <div class="checkbox">
                            <label><input type="checkbox" onchange="selectAll(this)" value="">Select All </label>
                        </div>
                    </div>
                    <div class="profile_top_right">
                        <span class="searchMessage"> Showing 50 of 70</span>
                        <span> Sort By : </span>
                        <select class="sortFillter">
                            <option>Add To Job</option>
                        </select>
                    </div>
                    
                </div>               

              
              
 
               
                    
               
                <div id="profile_list">
                    <div class="row profile_list_item">
                        <div class="col-xs-4 col-sm-1 col-md-1 profile_list_data">
                            <div class="checkbox">
                                <label><input type="checkbox" class="checkBoxClass" value=""></label>
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-1 col-md-1 profile_list_data">
                         <div class="alert alert-success sort_name">AD</div>
                        </div>
                        <div class="col-xs-4 col-sm-5 col-md-3 profile_list_data">
                            <a href="{!! URL('/admin/candidate_detail') !!}"><div class="title">Name</div></a>
                            <div class="sub_title">Designation</div>
                            <div class="sub_title">Address</div>
                            <div class="sub_title">Date</div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-3 profile_list_data">
                            <div class="title">New</div>
                            <div class="sub_title">Status</div>
                            <div class="sub_title">From</div>
                        </div>
                        <div class="col-xs-4 col-sm-10 col-md-3 profile_list_data">
                            <span class="ti-star active"></span>
                            <span class="ti-star"></span>
                            <span class="ti-star"></span>
                            <span class="ti-star"></span>
                            <span class="ti-star"></span>
                        </div>
                        <div class="col-xs-4 col-sm-2 col-md-1 profile_list_data">


                            <div class="dropdown">
                                <span role="button" style="cursor: pointer" data-toggle="dropdown"> <i class="ti-list"></i>
                                </span>
                                <ul class="dropdown-menu">

                                    <li><a href="#">HTML</a></li>
                                    <li><a href="#">CSS</a></li>
                                    <li><a href="#">JavaScript</a></li>
                                </ul>
                            </div>
                        </div>
                            
                        </div>
                    </div>
                    
               
               
                <div id="profile_list">
                    <div class="row profile_list_item">
                        <div class="col-xs-4 col-sm-1 col-md-1 profile_list_data">
                            <div class="checkbox">
                                <label><input type="checkbox" class="checkBoxClass" value=""></label>
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-1 col-md-1 profile_list_data">
                         <div class="alert alert-success sort_name">AD</div>
                        </div>
                        <div class="col-xs-4 col-sm-5 col-md-3 profile_list_data">
                            <a href="{!! URL('/admin/candidate_detail') !!}"><div class="title">Name</div></a>
                            <div class="sub_title">Designation</div>
                            <div class="sub_title">Address</div>
                            <div class="sub_title">Date</div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-3 profile_list_data">
                            <div class="title">New</div>
                            <div class="sub_title">Status</div>
                            <div class="sub_title">From</div>
                        </div>
                        <div class="col-xs-4 col-sm-10 col-md-3 profile_list_data">
                            <span class="ti-star active"></span>
                            <span class="ti-star"></span>
                            <span class="ti-star"></span>
                            <span class="ti-star"></span>
                            <span class="ti-star"></span>
                        </div>
                        <div class="col-xs-4 col-sm-2 col-md-1 profile_list_data">


                            <div class="dropdown">
                                <span role="button" style="cursor: pointer" data-toggle="dropdown"> <i class="ti-list"></i>
                                </span>
                                <ul class="dropdown-menu">

                                    <li><a href="#">HTML</a></li>
                                    <li><a href="#">CSS</a></li>
                                    <li><a href="#">JavaScript</a></li>
                                </ul>
                            </div>
                        </div>
                            
                        </div>
                    </div>
                    
               
               
                   
              
 
            </div>
        </div>
            
        </div>
        
    </div>
  <div role="tabpanel" class="tab-pane fade" id="sourcing">
  
      <div>
          
           <div class="row">
    <div class="col-md-6 col-xl-4">
      <div class="mini-stat clearfix bg-white"> 
          <span class="ti-star"></span>
          <span>List</span>
          <div class="col-sm-12" >         
              <div class="col-sm-6 box">
                  <div  class="data">10</div>
                  <div>data</div>
              </div>         
          <div class="col-sm-6 box">
               <div  class="data">10</div>
                  <div>data</div>                 
          </div>         
          </div>
          <div class="col-sm-12">         
          <div class="col-sm-6 box">
              <div class="data">10</div>
                  <div>data</div>
          </div>         
          <div class="col-sm-6 box">
              <div class="data">10</div>
                  <div>data</div>
          </div>         
          </div>
      </div>
    </div>
    
               
     <div class="col-md-6 col-xl-4">
      <div class="mini-stat clearfix bg-white"> 
          <div class="sourcingSectionThird">
          <span class="text text-success ti-star"></span>
          <span>Top Candidate</span>
          <button class="btn btn-default pull-right">Compare</button>
          </div>
          <div class="clearfix"></div>
          <div id="condidate">         
          <div class="condidate_list">         
              <div class="condidate_item">
                  <div class="alert alert-danger short_name">AD</div>
              </div>         
              <div class="condidate_item name_section">
                  <div class="name">Candidate Name</div>
                  <div>
                      <span class="ti-star active"></span>
                      <span class="ti-star"></span>
                      <span class="ti-star"></span>
                      <span class="ti-star"></span>
                  </div>
              </div>         
              <div class="condidate_item">Interview</div>         
          </div>
          <div class="condidate_list">         
              <div class="condidate_item">
                  <div class="alert alert-danger short_name">AD</div>
              </div>         
              <div class="condidate_item name_section">
                  <div class="name">Candidate Name</div>
                  <div>
                      <span class="ti-star active"></span>
                      <span class="ti-star"></span>
                      <span class="ti-star"></span>
                      <span class="ti-star"></span>
                  </div>
              </div>         
              <div class="condidate_item">Interview</div>         
          </div>    
              
          </div>
        
      </div>
    </div>
     <div class="col-md-6 col-xl-4">
      <div class="mini-stat clearfix bg-white"> 
          <div class="sourcingSectionThird">
          <span class="text text-success ti-star"></span>
          <span>Top Candidate</span>
          <button class="btn btn-default pull-right">Compare</button>
          </div>
          <div class="clearfix"></div>
          <div id="condidate">         
          <div class="condidate_list">         
              <div class="condidate_item">
                  <div class="alert alert-danger short_name">AD</div>
              </div>         
              <div class="condidate_item name_section">
                  <div class="name">Candidate Name</div>
                  <div>
                      <span class="ti-star active"></span>
                      <span class="ti-star"></span>
                      <span class="ti-star"></span>
                      <span class="ti-star"></span>
                  </div>
              </div>         
              <div class="condidate_item">Interview</div>         
          </div>
          <div class="condidate_list">         
              <div class="condidate_item">
                  <div class="alert alert-danger short_name">AD</div>
              </div>         
              <div class="condidate_item name_section">
                  <div class="name">Candidate Name</div>
                  <div>
                      <span class="ti-star active"></span>
                      <span class="ti-star"></span>
                      <span class="ti-star"></span>
                      <span class="ti-star"></span>
                  </div>
              </div>         
              <div class="condidate_item">Interview</div>         
          </div>    
              
          </div>
        
      </div>
    </div>
<!--    <div class="col-md-6 col-xl-3">
      <div class="mini-stat clearfix bg-info"> <span class="mini-stat-icon bg-light"><i class="mdi mdi-currency-btc text-info"></i></span>
        <div class="mini-stat-info text-right text-light"> <span class="counter text-white">20544</span> Unique Visitors </div>
        <p class="mb-0 m-t-20 text-light">Total income: $22506 <span class="pull-right"><i class="fa fa-caret-up m-r-5"></i>10.25%</span></p>
      </div>
    </div>-->
  </div>
  
          
          
      </div>
      <div>
      
          
<!--Accordion wrapper-->
<div class="accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

    <!-- Accordion card -->
    <div class="card">

        <!-- Card header -->
        <div class="card-header" role="tab" id="headingOne">
            <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <h5 class="mb-0">
                    Job Board <i class="fa fa-angle-down rotate-icon pull-right"></i>
                </h5>
            </a>
        </div>

        <!-- Card body -->
        <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordionEx">
            <div class="card-body">
               
            <div id="job_board">         
              <div class="condidate_list">         
                  <div class="condidate_item one">
                      <div class="icon ">
                          <span class="fa fa-shopping-cart"></span>
                      </div>
                  </div>         
                  <div class="condidate_item two">
                      <div class="name">Logo</div>
                  </div>         
                  <div class="condidate_item three">Interview</div>         
                  <div class="condidate_item four">Interview</div>         
              </div> 
              <div class="condidate_list">         
                  <div class="condidate_item one">
                      <div class="icon ">
                          <span class="fa fa-shopping-cart"></span>
                      </div>
                  </div>         
                  <div class="condidate_item two">
                      <div class="name">Logo</div>
                  </div>         
                  <div class="condidate_item three">Interview</div>         
                  <div class="condidate_item four">Interview</div>         
              </div> 
          </div> 
                
                
                
            </div>
        </div>
    </div>
    <!-- Accordion card -->

    <!-- Accordion card -->
    <div class="card">

        <!-- Card header -->
        <div class="card-header" role="tab" id="headingTwo">
            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                <h5 class="mb-0">
                    Organic <i class="fa fa-angle-down rotate-icon pull-right"></i>
                </h5>
            </a>
        </div>

        <!-- Card body -->
        <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordionEx">
            <div class="card-body">
              
                   <div id="organic">         
              <div class="condidate_list">         
                  <div class="condidate_item one">
                      <div class="icon ">
                          <span class="fa fa-shopping-cart"></span>
                      </div>
                  </div>         
                  <div class="condidate_item two">
                      <div class="name">Logo</div>
                  </div>         
                  <div class="condidate_item three">Interview</div>         
                  <div class="condidate_item four">Interview</div>         
              </div> 
              <div class="condidate_list">         
                  <div class="condidate_item one">
                      <div class="icon ">
                          <span class="fa fa-shopping-cart"></span>
                      </div>
                  </div>         
                  <div class="condidate_item two">
                      <div class="name">Logo</div>
                  </div>         
                  <div class="condidate_item three">Interview</div>         
                  <div class="condidate_item four">
                  Advertise
                  </div>         
              </div> 
          </div> 
                
                
            </div>
        </div>
    </div>
    <!-- Accordion card -->
    
    <!-- Accordion card -->
    <div class="card">

        <!-- Card header -->
        <div class="card-header" role="tab" id="headingThree">
            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                <h5 class="mb-0">
                    CRM
                    <i class="fa fa-angle-down rotate-icon pull-right"></i>
                </h5>
            </a>
        </div>

        <!-- Card body -->
        <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordionEx">
            <div class="card-body">
                
                   <div id="crm">         
              <div class="condidate_list">         
                  <div class="condidate_item one">
                      <div class="icon ">
                          <span class="fa fa-shopping-cart"></span>
                      </div>
                  </div>         
                  <div class="condidate_item two">
                      <div class="name">Logo</div>
                  </div>         
                  <div class="condidate_item three">Interview</div>         
                  <div class="condidate_item four">Interview</div>         
              </div> 
              <div class="condidate_list">         
                  <div class="condidate_item one">
                      <div class="icon ">
                          <span class="fa fa-shopping-cart"></span>
                      </div>
                  </div>         
                  <div class="condidate_item two">
                      <div class="name">Logo</div>
                  </div>         
                  <div class="condidate_item three">Interview</div>         
                  <div class="condidate_item four">Interview</div>         
              </div> 
          </div> 
                
                
            </div>
        </div>
    </div>
    <!-- Accordion card -->
</div>
<!--/.Accordion wrapper-->
                
      
      
      </div>
     
      
  
  </div>
  <div role="tabpanel" class="tab-pane fade" id="activity">
  
      
      <div id="activity_panel" class="container-fluid">
      <div class="row activity_item">
               <div class="col-md-2 col-xl-2 text-right my_text-right">
                   <div class="sort_name">AD</div>
               </div>
               <div class="col-md-10 col-xl-10">
                   <p class="title">Candidate Name</p>
                   <p>This is the test message</p>
               </div>
              
     </div>
      
      <div class="row activity_item">
               <div class="col-md-2 col-xl-2 text-right my_text-right">
                   <div class="sort_name">AD</div>
               </div>
               <div class="col-md-10 col-xl-10">
                   <p class="title">Candidate Name</p>
                   <p>This is the test message</p>
               </div>
              
     </div>
      
      <div class="row activity_item">
               <div class="col-md-2 col-xl-2 text-right my_text-right">
                   <div class="sort_name">AD</div>
               </div>
               <div class="col-md-10 col-xl-10">
                   <p class="title">Candidate Name</p>
                   <p>This is the test message</p>
               </div>
              
     </div>
      
          
     </div>
      
      
      
     
  </div>
    
    
  <div role="tabpanel" class="tab-pane fade" id="job_ad">
   
      
        
      <div id="job_ad_panel" class="container-fluid">
      <div class="row activity_item">
               <div class="col-md-10 col-xl-10">
                   <div class="title">Job Ad</div>
               </div>
               <div class="col-md-2 col-xl-2">
                   <button>Edit Jobs</button>
               </div>
              
     </div>
      
      <div class="row">
               <div class="col-md-8 col-xl-8 ">
                   
                   
                   <div class="row container-fluid job_item">
                       <div class="col-md-12 col-xl-12 job_item">PHP Developer</div>
                       <div class="col-md-12 col-xl-12 job_item">Address</div>
                       <div class="col-md-12 col-xl-12 job_item">
                           <h5>Company Description</h5>
                           <p>Company Description Company Description</p>
                       </div>
                       <div class="col-md-12 col-xl-12 job_item">
                           <h5>Company Description</h5>
                           <p>Company Description Company Description</p>
                       </div>
                   </div>
                   
               </div>
               <div class="col-md-4 col-xl-4">
                   <div class="row container-fluid job_item">
                       <div class="col-md-12 col-xl-12 job_item">Link</div>
                       <div class="col-md-12 col-xl-12 job_item">Publish</div>
                       <div class="col-md-12 col-xl-12 job_item">Publish</div>
                       
                   </div>
               </div>
              
     </div>
      
  
              
     </div>
      
          
     </div>
      
  
  <div role="tabpanel" class="tab-pane fade" id="job_detail">
  Job Detail
       <div class="row">
    <div class="col-md-6 col-xl-3">
      <div class="mini-stat clearfix bg-white"> <span class="mini-stat-icon bg-light"><i class="mdi mdi-cart-outline text-danger"></i></span>
        <div class="mini-stat-info text-right text-muted"> <span class="counter text-danger">15852</span> Total Sales </div>
        <p class="mb-0 m-t-20 text-muted">Total income: $22506 <span class="pull-right"><i class="fa fa-caret-up m-r-5"></i>10.25%</span></p>
      </div>
    </div>
    <div class="col-md-6 col-xl-3">
      <div class="mini-stat clearfix bg-success"> <span class="mini-stat-icon bg-light"><i class="mdi mdi-currency-usd text-success"></i></span>
        <div class="mini-stat-info text-right text-white"> <span class="counter text-white">956</span> New Orders </div>
        <p class="mb-0 m-t-20 text-light">Total income: $22506 <span class="pull-right"><i class="fa fa-caret-up m-r-5"></i>10.25%</span></p>
      </div>
    </div>
    <div class="col-md-6 col-xl-3">
      <div class="mini-stat clearfix bg-white"> <span class="mini-stat-icon bg-light"><i class="mdi mdi-cube-outline text-warning"></i></span>
        <div class="mini-stat-info text-right text-muted"> <span class="counter text-warning">5210</span> New Users </div>
        <p class="mb-0 m-t-20 text-muted">Total income: $22506 <span class="pull-right"><i class="fa fa-caret-up m-r-5"></i>10.25%</span></p>
      </div>
    </div>
    <div class="col-md-6 col-xl-3">
      <div class="mini-stat clearfix bg-info"> <span class="mini-stat-icon bg-light"><i class="mdi mdi-currency-btc text-info"></i></span>
        <div class="mini-stat-info text-right text-light"> <span class="counter text-white">20544</span> Unique Visitors </div>
        <p class="mb-0 m-t-20 text-light">Total income: $22506 <span class="pull-right"><i class="fa fa-caret-up m-r-5"></i>10.25%</span></p>
      </div>
    </div>
  </div>
  </div>
  <div role="tabpanel" class="tab-pane fade" id="hiring_process">Hiring Process
  
      <div class="container-fluid">
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading active" role="tab" id="headingOne">
      <h4 class="panel-title text-right">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
<!--            <span class="fa fa-plus show experienceIcon" onclick="show()" title="Add Experience"></span>
            <span class="fa fa-minus hide experienceIcon" style="display: none;" onclick="show()"></span>-->
            show
            
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        
          
          <form class="form-horizontal">
              
                  <div class="row form-group">
                      <div class="col-sm-6">
                          <label>Title</label>
                          <input type="text" class="form-control" placeholder="Name">
                      </div>
                      <div class="col-sm-6">
                          <label>Title</label>
                          <input type="text" class="form-control" placeholder="Name">
                      </div>
                  </div>
                 
                  <div class="row form-group">
                      <div class="col-sm-6">
                          <label>Title</label>
                          <input type="text" class="form-control" placeholder="Name">
                      </div>
                      <div class="col-sm-6">
                          <label>Title</label>
                          <input type="text" class="form-control" placeholder="Name">
                      </div>
                  </div>
                 
                  <div class="row form-group">
                      <div class="col-sm-6">
                          <label>Title</label>
                          <input type="text" class="form-control" placeholder="Name">
                      </div>
                      <div class="col-sm-6">
                          <label>Title</label>
                          <input type="text" class="form-control" placeholder="Name">
                      </div>
                  </div>
                 
                  <div class="row form-group">
                      <div class="col-sm-6">
                          <label>Title</label>
                          <input type="text" class="form-control" placeholder="Name">
                      </div>
                      <div class="col-sm-6">
                          <label>Title</label>
                          <input type="text" class="form-control" placeholder="Name">
                      </div>
                  </div>
                 
                  <div class="row form-group">
                      <div class="col-sm-12">
                          
                          <input type="submit" disabled="" class="btn btn-warning" value="Save">
                      </div>
                  </div>
                 
                  
          </form>
          
          
      </div>
    </div>
  </div>
  
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

<script type="text/javascript">
//jQuery.noConflict( true );
function selectAll(obj){
    //alert( $(obj).prop('checked') );
    var flag = ($(obj).prop('checked'));
    
        $('.checkBoxClass').each(function (){
            $(this).prop('checked',flag);
        })
    
    //$(".checkBoxClass").prop('checked', $(this).prop('checked'));
}


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
myfunction(window.location.href);
</script>



<link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/respontive.css') }}" rel="stylesheet">
@endsection 
