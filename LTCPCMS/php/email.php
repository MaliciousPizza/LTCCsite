<?php
//if(!isset($_POST['submit'])){
    //This page should not be access direcly. need to submit the form.
   // echo "error; you need to submit the form!";
//}

//the message
$name = $_POST['name'];
$msg = $_POST['msg'];
$email = $_POST['email'];

//if(empty($msg)||empty($email)){
  //  echo "message and email are mandatory!";
//exit;
//}

if(IsInjected($email)){
    echo "Bad email Value!";
    exit;
}
$email_from = "franklindcharity@gmail.com";
$to = "Fdcharity@gmail.com";
$email_subject = "New form Submission";
$email_body = "You have received a new message from the user $name.\n".
    "Here is the message:\n $msg".;
$email_from = $email;
$visitor_email = $email;
$headers = "From: $email_from \r\n";
$headers .= "Reply-to: $visitor_email \r\n";
mail($to,$email_subject,$email_body,$headers);
//echo "Thanks for contacting me I hope to speak to you soon!";
header('Location: index.html');

//function to validate against any email injection attempts
function IsInjected($str){
    $injections = array(  '(\n+)',    
                          '(\r+)',
                          '(\t+)',
                          '(%0A+)',
                          '(%0D+)',
                          '(%08+)',
                          '(%09+)');
    $inject = join('|', $injections);
    $inject = "/$inject/i";
    if(preg_match($inject,$str)){
        return true;
    }
    else{
        return false;
    }
}

?>