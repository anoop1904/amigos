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
  
      
      <form>
          <input type="checkbox" name="item[]" value="1"><br>
          <input type="checkbox" name="item[]" value="2"><br>
          <input type="checkbox" name="new" value="3"><br>
          <input type="checkbox" name="new" value="4"><br>
          <input type="checkbox" name="new" value="5"><br>
          <input type="submit" name="save" value="Save"><br>
      </form>
      
      
      
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
