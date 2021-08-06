<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<title>Beem Stack</title>
<meta content="Admin Dashboard" name="description" />
<meta content="Themesdesign" name="author" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<!-- App Icons -->
<link rel="shortcut icon" href="assets/images/favicon.ico">
<!-- App css -->
<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>
<body>
<!-- Begin page -->
<div class="accountbg"></div>
<div class="wrapper-page">
  <div class="card">
    <div class="card-body">
      <h3 class="text-center mt-0 m-b-15"> <a href="index.html" class="logo logo-admin"><img src="{!!URL('/')!!}/assets/frontend/img/logo-green.png" height="100" alt="logo"></a> </h3>
      <h4 class="text-muted text-center font-18"><b>New Password</b></h4>
      <div class="p-3">
        <form class="form-horizontal m-t-20" method="POST" action="{{ route('password.forgot') }}">
          {{ csrf_field() }}
          <div class="form-group row{{ $errors->has('password') ? ' has-error' : '' }}">
            <div class="col-12">
              <input type="hidden" name="userId" value="{{ $user->id }}">
              <input type="password" name="password" class="form-control" placeholder="New Password" value="{{ old('password') }}" required autofocus>
               @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
               @endif
            </div>
          </div>

          <div class="form-group row{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <div class="col-12">
              <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" value="{{ old('confirm_password') }}" required autofocus>
               @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
               @endif
            </div>
          </div>
         
         
          <div class="form-group text-center row m-t-20">
            <div class="col-12">
              <button type="submit" class="btn btn-info btn-block waves-effect waves-light" >Submit</button>
            </div>
          </div>
          <div class="form-group m-t-10 mb-0 row">
            <div class="col-sm-12 m-t-20"> 
                <p> 
                  @if(Session::has('message'))
    <div class="alert alert-success login-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! Session::get('message') !!} </div>
  @endif 
                </p> 
            </div>
            
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- jQuery  -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
<script src="{{ asset('assets/js/waves.js') }}"></script>
<script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('assets/js/jquery.scrollTo.min.js') }}"></script>
<!-- App js -->
<script src="{{ asset('assets/js/app.js') }}"></script>
</body>
</html>
