<?php

require_once("../model/MessageModel.php");

$message  = new MessageModel();

$messageinfo = $_POST;

$newmessageinfo = $message->auto_filter($messageinfo);

$message->auto_verification($newmessageinfo);


if(!isset($_COOKIE['token']) || empty($_COOKIE['token'])){
    echo 2;
    exit;
} else {
    $con = $message->getcon();
    $checklogin = $message->checklogin($con,$_COOKIE['token']);

    if (empty($checklogin)) {
        $userinfo = [];
    } else {
        $userinfo = $checklogin[0];
        unset($userinfo['token']);
    }
}

if (!empty($message->geterrorInfo())) {  //檢查資料空白
    $error = [];
    foreach ($message->geterrorInfo() as $k=>$v) {
        $errormessage = $message->toerrormessage($v);
        $error[$k] = implode('、',$errormessage);
    }
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
}

$newmessageinfo['message'] = $message->tohtmlspecialchars($newmessageinfo['message']);
$newmessageinfo['uid'] = $userinfo['uid'];
$newmessageinfo['createtime'] = time();

if ($message->auto_insert($newmessageinfo)==1) {
    echo 1;
} else {
    echo 0;
}





?>