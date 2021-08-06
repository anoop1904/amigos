@extends('layouts.master')

@section('title', '| Users')

@section('content')

<!--begin::Main-->
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

<style>
.wrapper { width:100%; margin:50px auto; }
.char-textarea { width:100%; height:100px; resize:none; }
.char-count { font-weight:bold; }
h4 { font-weight:normal; }
.row1{
	margin-bottom:12px;
}
</style>      
          <!--begin::Entry-->
            <div class="d-flex flex-column-fluid">
               <!--begin::Container-->
               <div class="container ">
                  <!--begin::Dashboard-->
                  <div class="container-fluid">
  <!-- Page-Title -->
  @if(Session::has('message'))
    <div class="alert alert-success login-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('message') !!} </div>
  @endif
  <!-- end page title end breadcrumb -->
  
  <div class="row">
    <div class="col-lg-12">
      <div class="card m-b-30">
      @if(Request::segment(4)==='edit')

      <?php 
          $array_count = $static_page->array_count;
          $page_type = $static_page->page_type;
          $title =$static_page->title;
          $page_title =$static_page->page_title;
          $content =$static_page->content; 
      
        ?>

          {{ Form::model($static_page, array('route' => array('staticpages.update', $static_page->id), 'method' => 'PUT', 'id' => 'storeForm',  'enctype'=>'multipart/form-data')) }} 

      <div class="card-header" style="padding-bottom:0px;" >
                  <div class="row row1  ">
                    <div class="col-md-6">
                        <div class="form-group">
                          {{ Form::label('Page Type', 'Page Type') }}
                          <span class="text text-danger">*</span>
                                    <div>
                          <select class="form-control page_tppe" name="page_type" value={{$page_type}} id="page_tppe" >
                          @if($page_type==1)
                            <option value="1" selected >Simple Page</option>
                          @else
                            <option value="2" >FAQ Page</option>
                          @endif

                          @if($page_type==1)
                          <option value="2"  >FAQ Page</option>
                          @else
                          <option value="1"  >Simple Page</option>
                          @endif

                          </select>
                                  </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        {{ Form::label('Page Title', 'Page Title') }}
                        <span class="text text-danger">*</span>
                        <div>
                        <input type="text" name="page_title" class="form-control" value="<?php echo $page_title; ?>"   required />        
                        </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">

                      @if($page_type==1)
                      <button class="btn btn-primary float-right addMorebtn" style="margin-top:27px;display:none;" id="addMore" class="addMore"  type="button" >+Add More</button>
                      @else
                      <button class="btn btn-primary float-right addMorebtn" style="margin-top:27px;" type="button" id="addMore" class="addMore"  >+Add More</button>
                      @endif

              
                    </div>
                    </div>
                  </div>
           </div>
           <div class="card-body" >
             <div class="form_data" id="form_data">
             @php 
                   $datatitle=unserialize($title);  
                   $description=unserialize($content);  
                  
              @endphp
              <input type="hidden" id="editer_hidden_value" name="count_arr" class="editer_hidden_value" value="<?= count($datatitle); ?>"  />
             @for($i=0;$i<count($datatitle);$i++) 
             <div id="dyname_editory_id<?= $i ?>" >
            <div class="row row1 ">
              
                  <div class="col-md-6">
                        <div class="form-group">
                          {{ Form::label('Title', 'Title') }}
                          <span class="text text-danger">*</span>
                                    <div>
                            <input type="text" name="template_title[]" class="form-control" value="<?php echo $datatitle[$i] ?>"  id="template1" required />        
                                  </div>
                        </div>
                    </div>
                    <div class="col-md-5" >
                    </div>
                    @if($i != 0)
                    <div class="col-md-1" onclick="remove_editor(<?= $i ?>)" >
                    <span class="fa fa-remove remove_editor" style="color: red;font-size: 29px;margin-top: 40px;float: right;cursor: pointer;" value="'+editor_hidd_id+'"  ></span>
                    </div>
                    @endif

            </div>

             <div class="row row1" >
                      <div class="col-md-12">
                            <div class="form-group">
                              {{ Form::label('Discraption', 'Discraption') }}
                            <span class="text text-danger">*</span>
                            <textarea name="editor[]" class="textarea_editor<?= $i ?>" id="textarea_editor<?= $i ?>" rows="6", cols="100" required ><?= $description[$i] ?></textarea>
                            <script>
                            CKEDITOR.replace( 'textarea_editor<?= $i ?>' );
                            </script>
                            </div>
                      </div>	    		  
             </div>
             </div>
             @endfor
           </div>
            
           <div class="form-group m-b-0">
                <div>
                <button type="submit" class="btn btn-primary waves-effect waves-light"> Submit </button>
                <a href="{{ URL('admin/offer') }}" type="reset" class="btn btn-secondary waves-effect m-l-5"> Cancel </a>
                </div>
             </div>


       {!! Form::close() !!}
          @else
        <?php 
          $title ='';
          $content =''; 
          $page_title =''; 
        ?>
        {{ Form::open(array('url' => 'admin/staticpages', 'enctype'=>'multipart/form-data','id' => 'userForm')) }}
           <div class="card-header" style="padding-bottom:0px;" >
                  <div class="row row1  ">
                    <div class="col-md-6">
                        <div class="form-group">
                          {{ Form::label('Page Type', 'Page Type') }}
                          <span class="text text-danger">*</span>
                                    <div>
                          <select class="form-control page_tppe" name="page_type" id="page_tppe" >
                            <option value="1">Simple Page</option>
                            <option value="2">FAQ Page</option>
                          </select>
                                  </div>
                            @if ($errors->has('title')) <p class="help-block text text-danger"  >{{ $errors->first('title') }}</p> @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        {{ Form::label('Page Title', 'Page Title') }}
                        <span class="text text-danger">*</span>
                        <div>
                        <input type="text" name="page_title" class="form-control" value="<?php echo $page_title; ?>"   required />        
                        </div>
                        </div>
                    </div>
                    
                  </div>
           </div>
           <div class="card-body" >
             <div class="form_data" id="form_data">
             <div class="row row1 ">
             <input type="hidden" id="editer_hidden_value" name="count_arr" class="editer_hidden_value" value="1"  />
                   
                    <div class="col-md-6">
                        <div class="form-group">
                          {{ Form::label('Title', 'Title') }}
                          <span class="text text-danger">*</span>
                                    <div>
                                    {{ Form::text('template_title[]', $title, array('class' => 'form-control','placeholder'=>'Title','id'=>'to_date')) }}
                                  </div>
                            @if ($errors->has('title')) <p class="help-block text text-danger"  >{{ $errors->first('title') }}</p> @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary float-right addMorebtn" style="margin-top:27px;display:none;" id="addMore" class="addMore" type="button"  >+Add More</button>
                    </div>

             </div>	
             <div class="row row1" @if ($errors->has('content')) has-error @endif >
                      <div class="col-md-12">
                            <div class="form-group">
                              {{ Form::label('Discraption', 'Discraption') }}
                            <span class="text text-danger">*</span>
                            <textarea name="editor[]" class="textarea_editor" id="textarea_editor" rows="6", cols="100" >{{$content}}</textarea>
                            @if ($errors->has('content')) <p class="help-block text text-danger"  >{{ $errors->first('content') }}</p> @endif
                            <script>
                            CKEDITOR.replace( 'textarea_editor' );
                            </script>
                            </div>
                      </div>	    		  
             </div>
             </div>
             <div class="form-group m-b-0">
                <div>
                <button type="submit" class="btn btn-primary waves-effect waves-light"> Submit </button>
                <a href="{{ URL('admin/offer') }}" type="reset" class="btn btn-secondary waves-effect m-l-5"> Cancel </a>
                </div>
             </div>
           </div>
        {!! Form::close() !!}
            @endif




		  </div>
    </div>
  </div>
</div>
               </div>
            </div>
         
<!--end::Main-->

@endsection

@section('extrajs')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.datetimepicker.css') }}">
<script src="{{ asset('assets/js/jquery.datetimepicker.js') }}"></script>
<script src="{{ asset('assets/js/jquery.datetimepicker.full.min.js') }}"></script>

<style type="text/css">
   .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 12px !important;
}
 </style> 
 
 <script >

   $('#addMore').click(function(){
   var editor_hidd_id = editoridInc();
   var editor_id = 'textarea_editor'+editor_hidd_id;
   var editor_name = 'editor'+editor_hidd_id;
   var editor_class = 'textarea_editor'+editor_hidd_id;
   var dyn_editor_id = 'dyname_editory_id'+editor_hidd_id;
   var temp_name = 'template_title'+editor_hidd_id;
   var remove_btn = 'style="color: red;font-size: 29px;margin-top: 40px;float: right;cursor: pointer;"'+' id="remove_btn_id"';
   
     var name = '<div id="'+dyn_editor_id+'" ><div class="row row1 " ><div class="col-md-6"><div class="form-group"><div>{{ Form::label("Title", "Title") }}<span class="text text-danger">*</span><input type="text" name="template_title[]" class="form-control template_title[]" placeholder="Template" required /></div></div></div><div class="col-md-5" ></div> <div class="col-md-1 " onclick="remove_editor('+editor_hidd_id+')" ><span class="fa fa-remove remove_editor" '+remove_btn+' value="'+editor_hidd_id+'"  ></span></div> </div><div class="row row1"  ><div class="col-md-12"><div class="form-group">{{ Form::label("Discraption", "Discraption") }}<span class="text text-danger">*</span><textarea  name="editor[]"  class="'+editor_class+'" id="'+editor_id+'"  rows="6" cols="100" required ></textarea></div></div></div></div>';
    $('#form_data').append(name);
    var descript = CKEDITOR.replace(editor_id);
    $('.select2').select2({ width: '100%' });
  });


  function editoridInc(){
   var editor_id = $(".editer_hidden_value").val();
   editor_id++;
   $(".editer_hidden_value").val(editor_id)
   return editor_id;

  }
 
 function remove_editor(id){
   console.log(id);
   $("#dyname_editory_id"+id).remove();

 }
  $(".page_tppe").on('change', function(event){
   var page_id = $("#page_tppe").val();
   if(page_id==2){
    $(".addMorebtn").show();
   }else{
    $(".addMorebtn").hide();
   }
   
   });

 </script>

@endsection