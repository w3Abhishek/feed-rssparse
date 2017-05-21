<?php

require_once '../vendor/mailin-api/mailin-api-php/V2.0/Mailin.php';

// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['phone']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }
	
$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));
	
// Create the email and send the message
$to = 'alex.roan@hotmail.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$toName = "Alex Roan";
$email_subject = "Website Contact Form:  $name";
$email_body = "You have received a new message from your website contact form.<br>"."Here are the details:<br>Name: $name<br>Email: $email_address<br>Phone: $phone<br>Message:<br>$message";

$mailin = new Mailin("https://api.sendinblue.com/v2.0",$_ENV['SENDIN_API_KEY']);
$data = array("to" => array($to => $toName), "from" => array("noreply@alexroan.co.uk", "Alex Roan"), "subject" => $email_subject, "html" => $email_body);

$result = $mailin->send_email($data);
if($result['code'] == "success"){
   return true;
}
else{
   return false;
}		
?>
