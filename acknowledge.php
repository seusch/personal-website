
<?php
if (isset($_POST['send'])) {
	$to = 'seusch@charter.net';
	$subject = 'Feedback from my site';
	$message = 'Name: ' . $_POST['name'] . "\r\n\r\n";
	$message .= 'Email: ' . $_POST['email'] . "\r\n\r\n";
	$message .= 'Comments: ' . $_POST['comments'];
	$headers = "From: contactpage@saraeusch.com\r\n";
	$headers .= 'Content-Type: text/plain; charset=utf-8';
	$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
	if ($email) {
		$headers .= "\r\nReply-To: $email";
	}
	$success = mail($to, $subject, $message, $headers, '-fseusch@charter.net');
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">


</head>

<body>
<?php if (isset($success) && $success){ ?>
<h1>Thank You</h1>
<p>Your message has be sent. To get back to my site please click <a href="http://www.saraeusch.com/">here</a></p>
<?php } else { ?>
<h1>Opps!</h1>
<p>Sorry, there was a problem sending your message. </p>
 <?php } ?>
</body>

</html>