
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="http:/socket.io/socket.io.js"></script>
<script>
   var data='{{$formdata}}';
   //console.log(data);
   var socket=io();
     socket.on ('message', function (data) {
	 socket.emit('messageSuccess', data);
	});
</script>
