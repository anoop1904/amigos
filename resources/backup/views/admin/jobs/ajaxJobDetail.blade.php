      
                  @php $count = 1; @endphp
            @if(isset($candidates) && !empty($candidates) && count($candidates)>0 )
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
                            <a href="{!! URL('/admin/candidate_detail').'/'.encrypt($job_id).'/'.$candidate->id.'?tabs=1' !!}"><div class="title">{{ $candidate->FirstName.' '.$candidate->LastName }}</div></a>
                             @if ($candidate->Email)
                            <div class="sub_title">{{ $candidate->Email }}</div>
                            @endif
                            
                            <div class="sub_title"> @php  echo date('d-M-Y',strtotime($candidate->created_at)) @endphp</div>
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
                                    
                                     @if($candidate->stageStatus !='6')
                                    <li><a href="javascript:0" onclick="userReject({{ $candidate->id }})">Reject Candidate</a></li>
                                    <li><a href="javascript:0" onclick="userWithdrawn({{ $candidate->id }})">Withdrawn Candidate</a></li>
                                    @endif
                                    
                                </ul>
                            </div>
                        </div>
                            
                        </div>
                    </div> 
                
                     
               
               
            @endforeach
             
            @else
            <div class="col-xs-12 col-sm-12 col-md-12  alert alert-danger">No Records</div>
            @endif
            