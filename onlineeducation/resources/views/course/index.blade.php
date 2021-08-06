@extends('layouts.master')

@section('title', '| Users')

@section('content')


<!--begin::Main-->
 @php  
    $role_name = Auth::user()->roles()->pluck('name')->implode(' ');
    $role_id = Auth::user()->roles()->pluck('id')->implode(' ');
    $modulePermission = Illuminate\Support\Facades\DB::table('role_has_permissions')->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')->where('permissions.parent_id','1')->where('role_id',$role_id)->select('permissions.id')->get()->pluck('id')->toArray();
    
    //print_r($myData);
  @endphp
       <!-- BEGIN PAGE LEVEL PLUGINS -->
       <style type="text/css">
  .table td,.table th {
    border: 1px solid #EBEDF3 ! important;
  }
</style>
        <!-- END PAGE LEVEL PLUGINS -->
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
   <!--begin::Container-->
     <div class=" container ">
        <!--begin::Card-->
        <div class="card card-custom">
           <!--begin::Header-->
           <div class="card-header flex-wrap border-0 pt-6 pb-0">
              <div class="card-title">
          
              </div>
              <div class="card-toolbar">
                <!--end::Dropdown-->
                 <!--begin::Button-->
                 <a href="{!!URL('admin/course/create')!!}" class="btn btn-primary font-weight-bolder">
                    <span class="svg-icon svg-icon-md">
                       
                       <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                             <rect x="0" y="0" width="24" height="24"/>
                             <circle fill="#000000" cx="9" cy="15" r="6"/>
                             <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3"/>
                          </g>
                       </svg>
                      
                    </span>
                    New Record
                 </a>
                 <!--end::Button-->
              </div>
           </div>
           <!--end::Header-->
           <!--begin::Body-->
                <div class="card-body">
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
          {{-- @if(in_array("19", $modulePermission)) --}}
         
               <form class="kt-form kt-form--fit mb-15" method="get">
                      <div class="row">
                       
                        <div class="col-lg-3 mb-lg-0 mb-6">
                          <label>Name</label>
                           <input type="text" name="name" class="form-control" value="<?php if(isset($_GET['name'])){  echo $_GET['name']; } ?>" placeholder="Name" >
                        </div>
                       <!--  <div class="col-lg-3 mb-lg-0 mb-6">
                          <label>Category</label>
                          <select class="form-control category" name="category_id" id="category" target-data="sub_category">
                          <option value="all" selected="">All</option>
                          @foreach($categories as $key=>$category)
                          <option value="{{$category->id}}" <?php if(isset($_GET['category_id'])){ if($category->id == $_GET['category_id']){ echo "selected"; } } ?>>{{$category->name}}</option> 
                          @endforeach
                          </select>
                        </div> -->
                         
                         
                      

                        <div class="col-lg-3 mb-lg-0 mb-6">
                          <label>Status</label>
                          <select class="form-control status" name="status" id="status" target-data="status">
                            <option value="all" selected="">All</option>
                            <option value="active" <?php if(isset($_GET['status'])){ if('active' == $_GET['status']){ echo "selected"; } } ?>>Active</option>
                            <option value="deactive" <?php if(isset($_GET['status'])){ if('deactive' == $_GET['status']){ echo "selected"; } } ?>>Deactive</option>
                          </select>
                        </div>
                          
                       
                         <div class="col-lg-3 mb-lg-0 mb-6" style="margin-top: 25px;">
                          <button type="submit" class="btn btn-primary btn-primary--icon" id="kt_search">
                          <span>
                            <i class="la la-search"></i>
                            <span>Search</span>
                          </span>
                        </button>&nbsp;&nbsp;  <a class="btn btn-danger btn-secondary--icon" id="kt_reset" href="<?php echo URL('/') ?>/admin/product">
                          <span>
                            <i class="la la-close"></i>
                            <span>Reset</span>
                          </span>
                        </a>
                        </div>
                  </form>
            </div>
            <div style="width: 100%" id="message">
              
            </div>
        <table class="table" id="myTable" style="margin-top: 20px;">
             <thead>
              <tr>
                <th width="5%">Sr. No.</th>
                <th width="10%">Image</th>
                <th width="10%">Name</th>
                <!-- <th width="10%">Category</th>
                <th width="10%">Subcategory</th> -->
                <th width="10%">Sale Status</th>
                <th width="3%">Status</th>
                <th width="5%">Date</th>
                <th width="15%">Operations</th>
                </tr>
            </thead>
             <tbody>
           @php $count = 1; $link=''; @endphp
            
            @foreach ($courselist as $key=> $course)
            <tr>
                    <td>{{$count}}</td>
                    <td>
                          <?php
                          $url = 'assets/images/user.png';
                          if($course->image){
                          $url = '/public/assets/img/course/'.$course->image;
                          }
                          ?>
                          <img src="{{asset($url)}}" style="height: 80px;width: 80px;">
                    </td>
                    <td>
                      {{ $course->name }}
                     
                    
                    </td>
                  <!--   <td>{{ $course->category_list?$course->category_list->name:'NA' }}</td>
                    <td>{{ $course->sub_category_list?$course->sub_category_list->name:'NA' }}</td> -->
                    <td >
                    @if($course->IsSale)
                         <label class="text-success" style="font-size: 16px;">Sale</label>
                        @else
                          <label class="text-danger" style="font-size: 16px;" >Not Sale</label>
                        @endif
                    </td>
                    <td >
                    @if($course->IsActive)
                          {{-- <i class="text text-success fa fa-check"></i> --}}
                          <div>
                            <input type="checkbox" class="switch myswitch" cstate="" id="myswitch{{$course->id}}" cid="{{$course->id}}"  data-backdrop="static" data-keyboard="false" checked />
                          </div>
                        @else
                          {{-- <i class="text text-danger fa fa-remove"></i> --}}
                          <div>
                            <input type="checkbox" class="switch myswitch" cstate="" id="myswitch{{$course->id}}" cid="{{$course->id}}"  data-backdrop="static" data-keyboard="false"/>
                          </div>
                        @endif
                    </td>
                    <td>{{  $course->created_at->format('F d, Y') }}</td>
                    <td>
                    @if($course->IsSale==0)
                    <a href="{{ route('course.edit', $course->id) }}" class="btn btn-info pull-left fa fa-pencil-square-o" style="margin-right: 3px;" title="Edit"></a>
                   {{ Form::open(['method' => 'DELETE','style'=>'margin-right: 3px;float: left;', 'route' => ['course.destroy', $course->id] ]) }}
                    <button type="submit" class="btn btn-danger la la-trash" title="Delete" onclick="return confirm('Do You want to Delete?')"></button>
                    {{ Form::close() }}
                   @endif 
                   
                   
                    </td>
            </tr>
              @php $count++; @endphp
              @endforeach
            </tbody>
            <tr>
              <td colspan="11">
                <?php 
             if(isset($_GET['name'])&& isset($_GET['category_id']) && isset($_GET['brand_id']) && isset($_GET['status']))
               {
               ?>
                 {{ $courselist->appends(['name' => $_GET['name'],'category_id' => $_GET['category_id'],'status' => $_GET['status']])->links() }}
              <?php  }
             else
             {
              ?>
             {{ $courselist->links() }}
            <?php } ?>
              </td>
            </tr>
          </table>
          
          {{-- @endif --}}
        </div>
           <!--end::Body-->
        </div>
         
        <!--end::Card-->
     </div>
   <!--end::Container-->
</div>
<!--end::Entry-->
         
<!--end::Main-->


@endsection


@section('extrajs')

<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"/>
 <!-- BEGIN PAGE LEVEL PLUGINS -->
       
        <!-- END PAGE LEVEL PLUGINS -->
<script type="text/javascript">

$(function() {

  $('input[name="date_filter"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
  });

});

    </script>
  <script>
        
        $(function() {
            $('.chk_boxes').click(function() {
                $('.checkbox').prop('checked', this.checked);
            });
        });
    </script>
  <script> 
    $( document ).ready(function() {
      $( ".table" ).wrap( "<div class='table_inner'></div>" );
    });
  </script>
@endsection