<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Demo Chat</title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
	<div id="data">
		@foreach( $messages as $message )
			<p id="{{$message->id}}"><b>{{$message->author}}</b>: {{$message->content}}</p>
		@endforeach
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	{{-- <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script> --}}
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
	<div class="container">
		<form action="send-message" method="POST" accept-charset="utf-8">
			{{csrf_field()}}
			Author: <input type="text" class="form-control" name="author">
			<br/>
			<br/>
			Message: <textarea name="content" class="form-control" rows="5" width="90%"></textarea>
			<button type="submit" class="btn btn-primary btn-sm">Send</button>
		</form>
	</div>
	<script >
		var socket = io('http://localhost:6001');
		socket.on('chat:message',function(data){
			// console.log(data)
			if( $('#'+data.id).length == 0 ){
				$('#data').append("<p><b>"+data.author+"</b>: "+data.content+"</p>")
			}
		})
	</script>
</body>
</html>