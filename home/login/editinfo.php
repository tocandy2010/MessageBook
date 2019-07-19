<?php

session_start();

if(isset($_SESSION['userinfo'])&& !empty($_SESSION['userinfo'])){
    
    $userinfo = $_SESSION['userinfo'];
}else{
    header("Location:http://localhost/MessageBook/home/message/index.php");
}

$userName = $userinfo['userName'];
$email = $userinfo['email'];

include_once('./editinfoview.php');

?>