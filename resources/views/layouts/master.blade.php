<!DOCTYPE html>
<html>
<head>
    <title>Amigos</title>
    @include('includes.head')
    <link rel="stylesheet" href="{{ asset('assets/chart') }}/dist/css/admin1lte.min.css">">
</head>


    <body id="kt_body"  class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

        <!-- Navigation Bar-->
        @include('includes.left_nav')
<div class="d-flex flex-column flex-root">
   <!--begin::Page-->
   <div class="d-flex flex-row flex-column-fluid page">

        @include('includes.site_menu')
        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
         
            @include('includes.header')
            <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
                @include('includes.sub_header')
                <!-- End Navigation Bar-->
                @yield('content')
                <!-- end wrapper -->
            </div>
            @include('includes.footer')
        </div>
        <!-- Footer -->
        {{--  --}}
 </div>
   <!--end::Page-->
</div>

<div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text text-left" id="myModalLabel">Confirmation</h4>
      </div>
      <div class="modal-body">
        Are you sure you want to change this?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary confirmBtn" id="confirmBtn">Confirm</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="verifyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text text-left" id="myModalLabel">Confirmation</h4>
      </div>
      <input type="hidden" name="product_id" id="product_id">
      <div class="modal-body">
        Are you sure you want to verify this product?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="verifyConfirmBtn" onclick="productVerify()">Confirm</button>
      </div>
    </div>
  </div>
</div>


<!--begin::Global Theme Bundle(used by all pages)-->
<script src="{{ asset('assets/backend') }}/plugins/global/plugins.bundle.js?v=7.0.6"></script>
<script src="{{ asset('assets/backend') }}/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.6"></script>
<script src="{{ asset('assets/backend') }}/js/scripts.bundle.js?v=7.0.6"></script>
<!--end::Global Theme Bundle-->

<script src="{{ asset('assets/backend') }}/assets/js/pages/crud/forms/editors/summernote.js?v=7.0.6"></script>

<!--begin::Page Vendors(used by this page)-->
<script src="{{ asset('assets/backend') }}/plugins/custom/fullcalendar/fullcalendar.bundle.js?v=7.0.6"></script>
<!--end::Page Vendors-->

<!--begin::Page Scripts(used by this page)-->
<script src="{{ asset('assets/backend') }}/js/pages/widgets.js?v=7.0.6"></script>
<!--end::Page Scripts-->
        @yield('extrajs')

<script type="text/javascript">
   $(".myswitch").bootstrapSwitch();
var currentFlag;
var cid;
var type;
$('.myswitch').on('switchChange.bootstrapSwitch', function (e, data) {
        currentFlag = data;
        cid = $(this).attr('cid');
        type = $(this).attr('status');
        $(this).bootstrapSwitch('state', !data, true);
        $('#showModal').modal({
         backdrop: 'static',
         keyboard: false
     });
});

$(".confirmBtn").click(function(){
    console.log('call',type); 
    $('#confirmBtn').prop('disabled',true);   
    if(currentFlag){
      if(type=='homepage')
      {
        showOnhome(cid,1);
      }
      else
      {
        changeStatus(cid,1);  
      }
      
    }else{
      if(type=='homepage')
      {
        showOnhome(cid,0);
      }
      else
      {
        changeStatus(cid,0); 
      }
      
    }
});
var url = '<?php echo URL('/') ?>/admin';
 @if(Request::segment(2) === 'category')
   url += '/changeCategoryStatus';
 @elseif(Request::segment(2) === 'unit')
   url += '/changeUnitStatus';
 @elseif(Request::segment(2) === 'product')
   url += '/changeProductStatus';
 @elseif(Request::segment(2) === 'store')
   url += '/changeStoreStatus';
 @elseif(Request::segment(2) === 'customer')
   url += '/changeCustomerStatus';
 @elseif(Request::segment(2) === 'brand')
   url += '/changeBrandStatus';
   @elseif(Request::segment(2) === 'banner')
   url += '/changeBannerStatus';
 @elseif(Request::segment(2) === 'offer')
   url += '/changeOfferStatus';
    @elseif(Request::segment(2) === 'emailtemplate')
   url += '/changeEmailTemplateStatus';
    @elseif(Request::segment(2) === 'messages')
   url += '/changeMessageTemplateStatus'; 
   @elseif(Request::segment(2) === 'staticpages')
   url += '/changeStaticPagesStatus';
 @endif

function showOnhome(cat_id,status){
   $.ajax({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '<?php echo URL('/') ?>/admin/showOnhome',
        type: 'POST',
        data: {cat_id:cat_id,status:status},
        success:function(response) { 
          var obj = JSON.parse(response);
          if(obj.status){
            $('#homemyswitch'+cid).bootstrapSwitch('state', currentFlag, true);
            $('#showModal').modal('hide');
            $('#confirmBtn').prop('disabled',false);
          }

        },
        error:function(){ alert('error');}
        }); 
}

function changeStatus(cat_id,status){
   $.ajax({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        type: 'POST',
        data: {cat_id:cat_id,status:status},
        success:function(response) { 
          var obj = JSON.parse(response);
          if(obj.status){
            $('#myswitch'+cid).bootstrapSwitch('state', currentFlag, true);
            $('#showModal').modal('hide');
            $('#confirmBtn').prop('disabled',false);
          }

        },
        error:function(){ alert('error');}
        }); 
}
function openPopup(product_id){
  $('#product_id').val(product_id)
  $('#verifyModal').modal('show');  
}

function productVerify(){
  var product_id = $('#product_id').val();
  var url = '<?php echo URL('/admin/verifyProduct') ?>';
  $('#verifyConfirmBtn').prop('disabled',true);
   $.ajax({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        type: 'POST',
        data: {product_id:product_id},
        success:function(response) { 
          var obj = JSON.parse(response);
          if(obj.status){
            $('#product_'+product_id).remove();
            $('#verifyModal').modal('hide');
            window.location.reload();
            $('#verifyConfirmBtn').prop('disabled',false);
          }

        },
        error:function(){ alert('error');}
        }); 
}
</script>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
{{ csrf_field() }}
</form>    
    <!-- begin::User Panel-->
<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
   <!--begin::Header-->
   <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
      <h3 class="font-weight-bold m-0">
         User Profile
         {{-- <small class="text-muted font-size-sm ml-2">12 messages</small> --}}
      </h3>
      <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
      <i class="ki ki-close icon-xs text-muted"></i>
      </a>
   </div>
   <!--end::Header-->
   <!--begin::Content-->
   <div class="offcanvas-content pr-5 mr-n5">
      <!--begin::Header-->
      <div class="d-flex align-items-center mt-5">
         <div class="symbol symbol-100 mr-5">
            <div class="symbol-label" style="background-image:url('../assets/images/user.png')"></div>
            <i class="symbol-badge bg-success"></i>
         </div>
         <div class="d-flex flex-column">
            <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">
            {{Auth::user()->name}}
            </a>
            <div class="text-muted mt-1">
               {{Auth::user()->roles()->pluck('name')->implode(' ') }}
            </div>
            <div class="navi mt-2">
               <a href="#" class="navi-item">
                  <span class="navi-link p-0 pb-2">
                     <span class="navi-icon mr-1">
                        <span class="svg-icon svg-icon-lg svg-icon-primary">
                           <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
                           <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                 <rect x="0" y="0" width="24" height="24"/>
                                 <path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000"/>
                                 <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5"/>
                              </g>
                           </svg>
                           <!--end::Svg Icon-->
                        </span>
                     </span>
                     <span class="navi-text text-muted text-hover-primary">{{Auth::user()->email}}</span>
                  </span>
               </a>
               <a href="{{ route('logout') }}" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign Out</a>
               {{-- <a href="{{ route('logout') }}" class="menu-text" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a> --}}
            </div>
         </div>
      </div>
      <!--end::Header-->
      <!--begin::Separator-->
      <div class="separator separator-dashed mt-8 mb-5"></div>
      <!--end::Separator-->
      <!--begin::Nav-->
      <div class="navi navi-spacer-x-0 p-0">
         <!--begin::Item-->
         <a href="{!!URL('/')!!}/admin/profile" class="navi-item">
            <div class="navi-link">
               <div class="symbol symbol-40 bg-light mr-3">
                  <div class="symbol-label">
                     <span class="svg-icon svg-icon-md svg-icon-success">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Notification2.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                           <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <rect x="0" y="0" width="24" height="24"/>
                              <path d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z" fill="#000000"/>
                              <circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5"/>
                           </g>
                        </svg>
                        <!--end::Svg Icon-->
                     </span>
                  </div>
               </div>
               <div class="navi-text">
                  <div class="font-weight-bold">
                     My Profile
                  </div>
                  <div class="text-muted">
                     Account settings and more
                     <span class="label label-light-danger label-inline font-weight-bold">update</span>
                  </div>
               </div>
            </div>
         </a>
         <!--end:Item-->
         <!--begin::Item-->
         @php $roles = Auth::user()->roles()->pluck('name')->implode(' '); @endphp
         @if($roles=='Super Admin')   
                {{-- <a class="dropdown-item" href="{!!URL('/')!!}/admin/websitesetting"><span class="badge badge-success pull-right m-t-5"></span><i class="dripicons-gear text-muted"></i> Settings</a>  --}}
            <a href="{!!URL('/')!!}/admin/websitesetting"  class="navi-item">
               <div class="navi-link">
                  <div class="symbol symbol-40 bg-light mr-3">
                     <div class="symbol-label">
                        <span class="svg-icon svg-icon-md svg-icon-warning">
                           <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Chart-bar1.svg-->
                           <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                 <rect x="0" y="0" width="24" height="24"/>
                                 <rect fill="#000000" opacity="0.3" x="12" y="4" width="3" height="13" rx="1.5"/>
                                 <rect fill="#000000" opacity="0.3" x="7" y="9" width="3" height="8" rx="1.5"/>
                                 <path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" fill="#000000" fill-rule="nonzero"/>
                                 <rect fill="#000000" opacity="0.3" x="17" y="11" width="3" height="6" rx="1.5"/>
                              </g>
                           </svg>
                           <!--end::Svg Icon-->
                        </span>
                     </div>
                  </div>
                  <div class="navi-text">
                     <div class="font-weight-bold">
                        Settings
                     </div>
                     <div class="text-muted">
                        Internal setting
                     </div>
                  </div>
               </div>
            </a>
         @endif
         <!--end:Item-->
        
      </div>
      <!--end::Nav-->
      <!--begin::Separator-->
      <div class="separator separator-dashed my-7"></div>
      <!--end::Separator-->
      
   </div>
   <!--end::Content-->
</div>
<!--end::Sticky Toolbar-->
    

    </body>

</html>