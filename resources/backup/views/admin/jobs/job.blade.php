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
            <li class="breadcrumb-item active">Jobs</li>
          </ol>
        </div>
        <h4 class="page-title">JOBS</h4>
      </div>
    </div>
  </div>
  <!-- end page title end breadcrumb -->
  <div id="page_section">
      
   <!--Accordion wrapper-->
<div class="accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
<h4 class="mt-0 header-title">Job List
    @can('Create Job Post')
    <a href="{!!URL('admin/jobmaster/create')!!}" class="btn btn-primary pull-right" style="color:#ffffff !important"><i class="fa fa-plus"></i>Add Job</a>
    @endcan 
</h4>
<hr/>
    <!-- Accordion card -->
    <div class="card">
@if(Session::has('message'))
  <div class="alert alert-success login-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('message') !!} </div>
@endif
@if(Session::has('error'))
  <div class="alert alert-danger login-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('error') !!} </div>
@endif
        <!-- Card header -->
        <div class="card-header" role="tab" id="headingOne">
         
                <div class="section">
                    
                    <div class="left">
                        <div class="section_data">
                        
<!--                             <div class="dropdown">
                                 <button role="button" data-toggle="dropdown"> 
                                    <i class="ti-list"></i> Filter
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">HTML</a></li>
                                    <li><a href="#">CSS</a></li>
                                    <li><a href="#">JavaScript</a></li>
                                </ul>
                            </div>-->

                        </div>
                        <!-- <button onclick="searchBox()">Search</button> -->
                        <input type="hidden" id="activeStatus" value="1">
                        <div class="section_data ui-widget" id="searchContainer" >

                            <form onsubmit="return false;">
                                <input type="search" id="tags" class="mysearch" placeholder="Search"/>
                                <button class="btn btn-default" onclick="searchFilter();" disabled="" id="jobSearchBtn">Search</button>
                            </form>

                        </div>
                    </div>
                    <div class="right">
                        <div class="section_data">
                            <span class="search_label">Show Jobs : </span> 
                            <select class="mysearch jobStatus" id="jobStatus" onchange="searchFilter(this)">
                                <option value="" selected="">All</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="section_data">
                            <span  class="search_label">Sort : </span>
                            <select class="mysearch sort" id="sort" onchange="searchFilter(this)" >
                                <option value="0" selected="">Sort</option>
                                <option value="1">A-Z</option>
                                <option value="2">Z-A</option>
                                <option value="3">Recent Activity</option>
                            </select>
                        </div>
                    </div>
                </div>
               <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"></a>
        </div>

        <!-- Card body -->
        <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordionEx">
            <div class="card-body">
               
            <div id="job_list">         
               
                
                  @php $count = 1; @endphp
            @if(isset($jobmasterall) && !empty($jobmasterall))
            @foreach ($jobmasterall as $key=>$jobmasteralls)
           
                
                
                <div class="row condidate_list">         
                  <div class="col-sm-3 condidate_item one">
                      <a href="{!! URL('/admin/job_detail/').'/'.$jobmasteralls->id !!}"><div class="title">{{ $jobmasteralls->JobTitle }}</div></a>
                      <!--<div class="sub_title">Address</div>-->
                      <div class="sub_title">
                          <span>Created By : </span>
                          
                          <span>@php  echo $jobmasteralls->user->name; @endphp</span>
                      </div>
                      <div class="sub_title">
                          <span>Hiring Manager : </span>
                          <span>@php  echo $jobmasteralls->manager->name; @endphp</span>
                      </div>
                      <div class="sub_title">
                        <span>Created on : </span>
                          <span>@php  echo date('d-M-Y',strtotime( $jobmasteralls->created_at ) ); @endphp</span>
                      </div>
                      <div>
                         @can('Create Job Post')
                         <div class="dropdown">
                               <button class="btn btn-primary dropdown-toggle" role="button" data-toggle="dropdown"> 
                                    Action
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('jobmaster.edit', $jobmasteralls->id) }}">Edit</a> 
                                    </li>
                                    <li>
                                        <a href="{!! URL('/admin/job_detail/').'/'.$jobmasteralls->id !!}">Candidate List</a> 
                                    </li>
                                    
                                    @if($jobmasteralls->IsActive) 
                                    <li><a href="{{ URL::to('admin/statusUpdate', array($jobmasteralls->id,'inactive') ) }}" class="">De-Active</a></li>
                                    @else 
                                     <li><a href="{{ URL::to('admin/statusUpdate', array($jobmasteralls->id,'active')) }}" class="">Active</a></li>
                                    @endif 
                                </ul>
                             
                                @if($jobmasteralls->IsActive) 
                               <span class="text text-success btn">Active</span>
                               @else 
                               <span class="text text-danger btn">In Active</span>
                               @endif 
                            </div>
                          @endif
                      </div>
                  </div>         
                  <div class="col-sm-9 condidate_item two">
                      <div class="box">
                          <div class="data">{{ $count_data[$key]['new'] }}</div>
                          <a href="{!! URL('/admin/job_detail/'.$jobmasteralls->id.'?filter[]=').encrypt('1') !!}"><div class="title">New</div></a>
                      </div>
                      <div class="box">
                          <div class="data">{{ $count_data[$key]['in_review'] }}</div>
                          <a href="{!! URL('/admin/job_detail/'.$jobmasteralls->id.'?filter[]=').encrypt('2') !!}"><div class="title">In-Review</div></a>
                      </div>
                      <div class="box">
                          <div class="data">{{ $count_data[$key]['shortlist'] }}</div>
                          <a href="{!! URL('/admin/job_detail/'.$jobmasteralls->id.'?filter[]=').encrypt('3') !!}"><div class="title">Shortlist</div></a>
                      </div>
                      <div class="box">
                          <div class="data">{{ $count_data[$key]['interview'] }}</div>
                          <a href="{!! URL('/admin/job_detail/'.$jobmasteralls->id.'?filter[]=').encrypt('4') !!}"><div class="title">Interview</div></a>
                      </div>
                      <div class="box">
                          <div class="data">{{ $count_data[$key]['offered'] }}</div>
                          <a href="{!! URL('/admin/job_detail/'.$jobmasteralls->id.'?filter[]=').encrypt('5') !!}"><div class="title">Offered</div></a>
                      </div>
                      <div class="box">
                          <div class="data">{{ $count_data[$key]['hired'] }}</div>
                          <a href="{!! URL('/admin/job_detail/'.$jobmasteralls->id.'?filter[]=').encrypt('6') !!}"><div class="title">Hired</div></a>
                      </div>
                      <div class="box">
                          <div class="data">{{ $count_data[$key]['leads'] }}</div>
                          <a href="{!! URL('/admin/job_detail/'.$jobmasteralls->id.'?filter[]=').encrypt('7') !!}"><div class="title">Leads</div></a>
                      </div>
                  </div>         
                  
                  
              </div> 
             
            
              @php $count++; @endphp
            @endforeach
             @else
             <div>
               <span class="text text-danger">No Records</span>
             </div>
            @endif
            
            
                
             
          </div> 
                
                
                
            </div>
        </div>
    </div>
    <!-- Accordion card -->

  
</div>
<!--/.Accordion wrapper-->
                
      
      
      
 
  
 
  </div>
  <!-- end row -->
</div>
@endsection 


@section('extrajs') 
<script type="text/javascript">
var base_url = "{{  URL('/') }}";
//jQuery.noConflict( true );
function selectAll(obj){
    var flag = ($(obj).prop('checked'));
    
        $('.checkBoxClass').each(function (){
            $(this).prop('checked',flag);
        })
}
function searchFilter(){
  //alert();
    searchBox();
    getJobs();
}

$(document).ready(function (){
  // getJobs(); 
});


function getJobs(){
    var jobStatus = $('#jobStatus').val();
    var tags = $('#tags').val();
    var sort = $('#sort').val();
    
    //alert(tags +' '+sort);
      $.ajax({
        url: base_url+"/admin/getAllJob",
        data : {'jobStatus':jobStatus,'tags':tags,'sort':sort},
        beforeSend(xhr){
                $('#job_list').html('');
             },
         success: function(result){
             //alert();
             console.log(result);
            $('#job_list').html(result);
         }	
    });
    
    
    $('#job_list').html('');
    $('#jobSearchBtn').prop('disabled',true);
}






</script>


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
 
  $( function() {

    $( "#tags" ).autocomplete({
      source: base_url+"/admin/getJob?active="+$('#activeStatus').val()+"&",
      select: function( event, ui ) {
        //alert(ui.item.label);
        if(event.keyCode == undefined){
          $('#jobSearchBtn').prop('disabled',false);
          //$('#tags').val(ui.item.label);
        }else{
          //$('#jobSearchBtn').prop('disabled',false);
          searchFilter();
        }
                
      }, change: function( event, ui ) {
          //alert('autocompletechange'+event.type);
          if(event.type == 'autocompletechange'){
             searchFilter();
          }
      }
    });
  } );


function searchBox(){
  var value;
  if($('#jobStatus').val() == ''){
    value = '1';
  }else{
    value = $('#jobStatus').val();
  }
  $('#activeStatus').val((value));
  var url = base_url+"/admin/getJob?active="+$('#activeStatus').val()+"&";
  $('#tags').autocomplete("option", { source: url });
  //$('#searchContainer').show();
}


  </script>

<link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/respontive.css') }}" rel="stylesheet">
<!--<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">-->
<!--<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>-->


@endsection 

