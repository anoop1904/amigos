<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<title>First Ad - Control Panel</title>
<meta content="Admin Dashboard" name="description" />
<meta content="Themesdesign" name="author" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- App Icons -->
<link rel="shortcut icon" href="{{URL('/')}}/assets/images/favicon.ico">

<!--Morris Chart CSS -->
<link href="{{-- asset('assets/plugins/morris/morris.css') --}}" rel="stylesheet">
<!-- App css -->
<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">

<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

<script>
    

  setIdleTimeout(<?= $logout_time; ?>, function() {
    window.location.href = '<?= URL::to('/admin/screenlock'); ?>/<?= time();?>/<?= $email = Auth::user()->id; ?>/<?= MD5(str_random(10)) ?>';
  }, function() {});
  
  function setIdleTimeout(millis, onIdle, onUnidle) {
      var timeout = 0;
      $(startTimer);

    function startTimer() {
        timeout = setTimeout(onExpires, millis);
        $(document).on("mousemove keypress", onActivity);
    }
    
    function onExpires() {
        timeout = 0;
        onIdle();
    }

    function onActivity() {
        if (timeout) clearTimeout(timeout);
        else onUnidle();
        $(document).off("mousemove keypress", onActivity);
        setTimeout(startTimer, 1000);
    }
}
</script>