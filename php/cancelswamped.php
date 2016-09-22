<?php


//echo "AskAway is closed until January 23, 2012."; exit();
//if (trim($_POST['password']) != 'askawaylibrarian') { echo "Incorrect password. Cancel Swamped message was not sent."; exit(); }
$staffemail=substr(trim($_POST['staffemail']), 0, 100);
if (!isset($staffemail) || $staffemail == "") { echo "Please enter your AskAway listserv email address. Cancel Swamped message was not sent."; exit(); }

// Make a MySQL Connection

//$staffemail = preg_replace('/[A-Za-z0-9@._-]/', '', $staffemail);
$action_type='cancel';

$con=mysqli_connect(localhost,"bceln_swamped","swamped","bceln_drupal");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if(!filter_var($staffemail, FILTER_VALIDATE_EMAIL))
  {
  echo "E-mail is not valid.";
  mysqli_query($con,"INSERT INTO aadrupal_swamped_button 
(datetime, email_address, action_type) VALUES (now(), 'invalid email', '$action_type') ");
  }
else
  {
  mail ( "eln-vrefservprov@sfu.ca" , "AskAway CANCEL Swamped - Assistance Not Needed" , "Hello,\r\n\r\nAskAway is handling the current volume of users.\r\n\r\nWe appreciate the assistance of the AskAway Providers who logged on to help us.\r\n\r\nThanks!\r\n\r\n\r\n[Message sent from ELN Cancel Swamped Form: <http://www.askaway.org/staff/cancel-swamped>; Submitting email entered: <".$staffemail.">]\r\n", "From: AskAwayProvider : <".$staffemail.">" );
echo "Cancel Swamped message sent to listserv from: ".$staffemail.".<br> Only authorised AskAway listserv email addresses will send a cancel swamped message. Please check your email to confirm that the message was received.";

  mysqli_query($con,"INSERT INTO aadrupal_swamped_button 
(datetime, email_address, action_type) VALUES (now(), '$staffemail', '$action_type') ");


mysqli_close($con);
  }

?>