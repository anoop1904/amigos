                  @php $count = 1; @endphp
            @if(isset($jobmasterall) && !empty($jobmasterall) && count($jobmasterall)>0 )
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
                                        <a href="{{ URL::to('admin/job-detail', array($jobmasteralls->id,str_slug($jobmasteralls->JobTitle))) }}">Candidate List</a> 
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
                
              