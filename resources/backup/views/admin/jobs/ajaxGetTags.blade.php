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