<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<title>Upcube - Responsive Flat Admin Dashboard</title>
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

                    <h3 class="text-center mt-0 m-b-15">
                        <a href="javascript:;" class="logo logo-admin"><img src="{!!URL('/')!!}/assets/images/logo2.png" height="80" alt="logo"></a>
                    </h3>

                    <div class="p-3">
                     <?php
                        
                        if($user_record)
                        { 
                     ?>
                        <form class="form-horizontal m-t-20" method="POST" action="{{ route('login') }}">
{{ csrf_field() }}
                            <div class="user-thumb text-center m-b-30">
                                <img src="{!!URL('/')!!}/assets/images/users/avatar-1.jpg" class="rounded-circle img-thumbnail" alt="thumbnail">
                            </div>
                            <input type="hidden" name="email"  value="{{$user_record->email}}" >

                            <div class="form-group row">
                                <div class="col-12">
                                    <input type="password" class="form-control" name="password"   required="" placeholder="Password">
                                </div>
                            </div>

                            <div class="form-group text-center row m-t-20">
                                <div class="col-12">
                                    <button class="btn btn-info btn-block waves-effect waves-light" type="submit">Log In</button>
                                </div>
                            </div>

                            
                        </form>
                        <?php } ?>
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
