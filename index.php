<?php

// include SMTP Email Validation Class
require_once('smtp_validateEmail.class.php');

$q = filter_var($_REQUEST['q'], FILTER_VALIDATE_EMAIL);

if( !$q ) {
  header('HTTP/1.0 400 Bad Request');
  exit('<h1>400 Bad Request</h1>'); 
}

$email = $q; 

// an optional sender
$sender = 'postmaster@nindl.net';
// instantiate the class
$SMTP_Validator = new SMTP_validateEmail();
// turn on debugging if you want to view the SMTP transaction
$SMTP_Validator->debug = false;
// do the validation
$results = $SMTP_Validator->validate(array($email), $sender);

// send email? 
if ($results[$email]) {
  header('HTTP/1.0 200 OK');
  exit('<h1>OK<h1>');
} 
else {
  header('HTTP/1.0 404 Not Found');
  exit('<h1>404 Not Found<h1>');
}

?>
