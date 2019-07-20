<?php

require_once("../model/MessageModel.php");

$message  = new MessageModel();

$messageinfo = $_POST;

$newmessageinfo = $message->auto_filter($messageinfo);

$message->auto_verification($newmessageinfo);


if($message->checkuserlogin()!==false){  //判斷是否燈入
    $userinfo = $_SESSION['userinfo'];
}else{
    echo 2;
    exit;
}

if(!empty($message->geterrorInfo())){  //檢查資料空白
    $error = [];
    foreach($message->geterrorInfo() as $k=>$v){
        $errormessage = $message->toerrormessage($v);
        $error[$k] = implode('、',$errormessage);
    }
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
}

$newmessageinfo['message'] = $message->tohtmlspecialchars($newmessageinfo['message']);
$newmessageinfo['uid'] = $userinfo['uid'];
$newmessageinfo['createtime'] = time();

if($message->auto_insert($newmessageinfo)==1){
    echo 1;
}else{
    echo 0;
}





?>