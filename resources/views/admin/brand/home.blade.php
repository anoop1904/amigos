  @extends('layouts.frontmaster')
  @section('content')
      <div class="container-fluid">
         <div class="row no-gutter">
            <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
            <div class="col-md-8 col-lg-6">
               <div class="login d-flex align-items-center py-5">
                  <div class="container">
                     <div class="row">
                       <h4>Welcome {{$student->name}} {{$student->last_name}}</h4>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
 @endsection 
@section('extrajs')

@endsection