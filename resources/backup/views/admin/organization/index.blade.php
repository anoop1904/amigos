@extends('layouts.master')


@section('content')
<div class="container-fluid">
  <!-- Page-Title -->
  <div class="row">
    <div class="col-sm-12">
      <div class="page-title-box">
        
        <h4 class="page-title"><i class="fa fa-key"></i>Available Organization
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
   
    <div class="col-lg-12">
      <div class="card m-b-30">
        <div class="card-body">
          <h4 class="mt-0 header-title">Organization List
          <a href="{!!URL('admin/organization/create')!!}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>Add Organization</a>
          </h4>
          
          <table class="table">
            <thead>
              <tr>
                <th width="5%">#</th>
                <th width="10%">OrgName</th>
                <th width="15%">Address1</th>
                <th width="10%">Address2</th>
                <th width="5%">City</th>
                <th width="5%">State</th>
                <th width="10%">Admin Email</th>
                <th width="15%">Image</th>
                <th width="5%">Status</th>
                <th width="35%">Operation</th>
              </tr>
            </thead>
            <tbody>
           @php $count = 1; @endphp
           @if(!empty($organizationall))
           @foreach ($organizationall as $organizations)
            <tr>
                <td>{{ $count }}</td>
                <td>{{ $organizations->OrgName }}</td> 
                <td>{{ $organizations->Address1 }}</td> 
                <td>{{ $organizations->Address2 }}</td> 
                <td>{{ $organizations->City }}</td> 
                <td>{{ $organizations->State }}</td>
                <td>{{ $organizations->AdminEmailID }}</td>
                
                <td><img src="{{URL('/')}}/assets/images/organization/{{$organizations->image}}" style="width:100px; height:100px;"></td> 
                <td>
                   <?php
                   if($organizations->IsActive){ ?>
                       <span class="badge badge-success">Active</span>
                   <?php }else{ ?>
                    <span class="badge badge-danger">Deactive</span>
                   <?php } ?>
                </td>
                <td>
                <a href="{{ URL::to('admin/organization/'.$organizations->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                <?php
                   if($organizations->IsActive){ ?>
                <a href="{{ URL::to('admin/deActive/'.$organizations->id) }}" class="btn btn-danger pull-left" style="margin-right: 3px;" onclick="return confirm('Are You Sure To Deativated?')" title="Click to Deactive">Deactive</a>
                   <?php }else{ ?>
                       <a href="{{ URL::to('admin/active/'.$organizations->id) }}" class="btn btn-success pull-left" style="margin-right: 3px;" onclick="return confirm('Are You Sure To Activated?')" title="Click to Active">Active</a>
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
<!-- end container -->
@endsection