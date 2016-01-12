<?php
// use the tutorial from http://code.tutsplus.com/tutorials/build-a-neat-html5-powered-contact-form--net-20426
//currently up to step 7

//use https://rogerdudler.github.io/git-guide/ for easy

//form data
if(isset($_POST) ) {
	//form validation variables    
	$formok = true;
    $errors = array();
	
	//day the comment was submitted
	$datetime = date('d/m/Y H:i:s');
	
	//user submitted variables
	$name = $_POST['name'];
	$email = $_POST['email'];
	$comment = $_POST['comment'];
		
	//form field validation
	if(empty($name)){
		$formok = false;
		$errors[] = "Please enter a name";
	}
	
	//validates email address, first for non-blank then for standard name@domain.whatever
	if(empty($email)){
		$formok = false;
		$errors[] = "Please enter an email";
	}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$formok = false;
		$errors[] = "Please Enter a valid email";
	}
	
	//validate comments
	if(empty($comment)){
		$formok = false;
		$errors[] = "Please enter a comment";
	}elseif(strlen($comment) < 10){
		$formok = false;
		$errors[] = "please enter a message greater than 10 characters";
	}
	
	//if validation passes, create and send email
	if($formok){
		//email variables
		$to = 'seusch@charter.net';
		/* $to = 'seusch@charter.net';*/
		$subject = 'Site Comment';//email header
		
		//if you're using a windows server, uncomment the following line
		//ini_set("sendmail_from","info@example.com");
		$headers = "From: $email" . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$body = "Sent: $datetime\n From: $name\n Email: $email\n $comment";
		
		mail($to,$subject,$body,$headers);
	}
	
	//return data back to user
	$returnedData = array(
		'posted_form_data' => array(
			'name' => $name,
			'email' => $email,
			'comment' => $comment
		),
		'form_ok' => $formok,
		'errors' => $errors
	);
	
	//if this is not an ajax request
	if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest'){
		//set session variables
		session_start();
		$_SESSION['cf_returndata'] = $returnedData;
		
		//redirect back to form
		header('location: ' . $_SERVER['HTTP_REFERER']);
 
	}
} 
?>