@extends('layouts.master')


@section('content')
<div class="container-fluid">
  <!-- Page-Title -->
  <div class="row">
    <div class="col-sm-12">
      <div class="page-title-box">
        <h4 class="page-title"> </h4>
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
        <div class="card-body"> @if(Request::segment(4)==='edit')
          {{ Form::model($adve, array('route' => array('advertise.update', $adve->id), 'method' => 'PUT')) }}
          <?php  
                $client_id = $adve->client_id;
                $location_id = $adve->location_id;
                $advertise_name = $adve->advertise_name;
            ?>
          @else
          {{ Form::open(array('url' => 'admin/advertise')) }}
          
          <?php 
               $advertise_name=$location_id=$client_id = '';
            ?>
          @endif

         
          <div class="row">
            
            <div class="col-md-12">
             <div class="row">

              <div class="col-md-12">
                <div class="form-group"> 
                  <label>Advertisement Name: <span class="text text-danger">*</span></label>
                  <div> 
                    <input type="text" placeholder="Enter Advertisement Name" name="advertise_name" id="advertise_name" class="form-control" value="{{  $advertise_name }}">
                   </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group"> 
                  <label>Client : <span class="text text-danger">*</span></label>
                  <div> 
                    <select class="form-control selectpicker" name="client_id"> 
                      <option>Select Client</option>
                      @if($clients)
                        @foreach ($clients as $key => $client) 
                          <option value="{{ $client->id }}"
<?php if($client_id ==$client->id ){ echo 'selected'; } ?>
                            >{{ $client->fname }}</option>
                        @endforeach
                      @endif
                    </select>
                   </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group"> 
                  <div> 
                    <label>Location : <span class="text text-danger">*</span></label>
                     <select class="form-control selectpicker" name="location_id"> 
                      <option>Select Client</option>
                      @if($locations)
                        @foreach ($locations as $key => $location) 
                          <option value="{{ $location->id }}"
                  <?php if($location_id ==$location->id ){ echo 'selected'; } ?>
                            >{{ $location->location }}</option>
                        @endforeach
                      @endif
                    </select>
                   </div>
                </div>
              </div>

              {{-- <div class="col-md-6">
                <div class="form-group"> 
                  <div> 
                    <label>Start Date : <span class="text text-danger">*</span></label>
                     <input type="text" class="form-control datepicker" name="startDate"> 
                   </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group"> 
                  <div> 
                    <label>End Date : <span class="text text-danger">*</span></label>
                     <input type="text" class="form-control datepicker" name="endDate"> 
                  </div>
                </div>
              </div> --}}

            
             <div class="col-md-4">
                <div class="form-group"> 
                  <button type="submit" class="btn btn-primary waves-effect waves-light"> Submit </button>
                  <button type="reset" class="btn btn-secondary waves-effect m-l-5"> Cancel </button>   
                </div>
                </div>
              </div>

            </div>
              




             

              
             

             

              
            </div>


          </div>
          {!! Form::close() !!}



  <!-- end page title end breadcrumb -->
  <div class="row">

   <div class="col-lg-12">
      <div class="card m-b-30">
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th width="5%">#</th>
                <th width="25%">Client Name</th>
                <th width="25%">Location</th>
                <th width="20%">Name</th>
                <th width="5%">Status</th>
                <th width="20%">Operations</th>
              </tr>
            </thead>
            <tbody>
            
            @php $count = 1; @endphp
            @if(isset($advertise) && !empty($advertise))
            @foreach ($advertise as $key=>$value)
            <tr>
              <td>{{ $count }}</td>
             
              <td>{{ $value->client->fname.' '.$value->client->lname }}</td>
              <td>{{ $value->location->location }}</td>
              <td>{{ $value->advertise_name }}</td>
              <td>{{ $value->IsActive }}</td>
              
              <td><a href="{{ route('advertise.edit', $value->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a> {!! Form::open(['method' => 'DELETE', 'route' => ['location.destroy', $value->id] ]) !!}
                  
                     <?php
                   if($value->IsActive){ ?>
                <a href="{{ URL::to('admin/updateLocation/'.$value->id.'/deactive') }}" class="btn btn-warning pull-left" style="margin-right: 3px;" onclick="return confirm('Are You Sure To Dctivated?')" title="Click to Deactive">Deactive</a>
                   <?php }else{ ?>
                <a href="{{ URL::to('admin/updateLocation/'.$value->id.'/active') }}" class="btn btn-success pull-left" style="margin-right: 3px;" onclick="return confirm('Are You Sure To Activated?')" title="Click to Active">Aactive</a>
                   <?php } ?>
                              
              </td>
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
           </div>




          
      </div>
    </div>
    <!-- end col -->
   
  </div>
  <!-- end row -->
</div>
<!-- end container -->
@endsection
@section('extrajs')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script type="text/javascript">
  
  $( function() {
    $( ".datepicker" ).datepicker({
      changeYear: true,changeMonth: true
    });

    $('.selectpicker').select2({
      width: '100%',
      // placeholder: "Select Transaction Type",
    });
  });

</script>

@endsection