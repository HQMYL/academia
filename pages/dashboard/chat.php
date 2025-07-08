<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/dashboard/plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/dashboard/dist/css/adminlte.min.css">
</head>
<body>
<div class="container mt-4 chat-container">
	<h1>Realtime Chat Room</h1>
	<div class="chat-room mb-3" id="chat-room"></div>
	<form id="chatForm">
		<input type="text" name="user" id="user" class="form-control mb-2" placeholder="Name" required>
		<input type="text" name="message" id="message" class="form-control mb-2" placeholder="Message" required>
		<button type="submit" id="btnSend" class="btn btn-success w-100">Send</button>
	</form>
</div>
<script type="text/javascript">
	$(document).ready(function(){
	var websocket = new WebSocket("ws://localhost:5000/php-realtime-chat-using-websocket/php-socket.php"); 
	websocket.onopen = function(event) { 
		displayMessage("<div class='text-success-message'>Connection is established!</div>");
	};
	websocket.onmessage = function(event) {
		var messageData = JSON.parse(event.data);            
		let message = messageData.message;
		if(messageData.user) {
			message = messageData.user+" "+message;
		}
		let style = '';
		if(messageData.user && messageData.user == $('#user').val()) {
			style = 'text-align:right;';
		} else {
			style = 'color:orange;';
		}
		displayMessage("<div class='chat-message' style='"+style+"'>" + message + "</div>");
		$('#message').val('');
	};
	websocket.onerror = function(event){
		displayMessage("<div class='text-danger'>Problem due to some Error</div>");
	};
	websocket.onclose = function(event){
		displayMessage("<div class='text-warning'>Connection Closed</div>");
	};
	$('#chatForm').on("submit", function(event){
		event.preventDefault();
		var messageData = {
			chat_user: $('#user').val(),
			chat_message: $('#message').val()
		};
		websocket.send(JSON.stringify(messageData));
	});
});

function displayMessage(messageHTML) {
	$('#chat-room').append(messageHTML);
}
</script>
</body>
</html>