<?php
/*
 * Totally rewritten by Brandon Weigel 2014/08/06, based on the Cancel Swamped PHP file (also rewritten):
 * Added filters to make sure the email address is valid,
 * and inserts into a database table to record who is submitting swamped requests.
 */

$staffemail=substr(trim($_POST['staffemail']), 0, 100);
if (!isset($staffemail) || $staffemail == "") { echo "Please enter your AskAway listserv email address. Swamped message was not sent."; exit(); }

// Make a MySQL Connection

$action_type='swamped';

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
  mail ( "eln-vrefservprov@sfu.ca" , "AskAway Swamped - Assistance Needed" , "Hello,\r\n\r\nAskAway is receiving a high volume of users.\r\nIf possible, could you please log on to AskAway to assist?\r\nThanks!\r\n\r\n[Message sent from AskAway Swamped Form: <http://www.askaway.org/staff/swamped>; Submitting email entered: <".$staffemail.">]\r\n", "From: AskAwayProvider : <".$staffemail.">" );
echo "Swamped message sent to listserv from: ".$staffemail.".<br> Only authorised AskAway listserv email addresses will send a swamped message. Please check your email to confirm that the message was received.";

  mysqli_query($con,"INSERT INTO aadrupal_swamped_button 
(datetime, email_address, action_type) VALUES (now(), '$staffemail', '$action_type') ");


mysqli_close($con);
  }

?>