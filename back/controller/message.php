<?php


require_once("../model/ContentModel.php");
require_once("../public/Filterword.php");

if(!isset($_COOKIE['token']) || empty($_COOKIE['token'])){
    echo 2;
    exit;
} else {
    $checklogin = $message->getUser($_COOKIE['token']);
    if (empty($checklogin)) {
        $userinfo = [];
    } else {
        $userinfo = $checklogin;
        unset($userinfo['token']);
    }
}

$message  = new ContentModel();

$messageinfo = $_POST;

$allowinfo = ['message','conid'];

$newmessageinfo = $message->auto_filter($messageinfo,$allowinfo);

$verification = [
    'message'=>array('notempty'=>'0','length'=>'1,100'),
];

$message->auto_verification($newmessageinfo,$verification);

$errorMessage = [
    'length'=>'資料長度錯誤',
    'notempty'=>'未輸入'
];

if(!empty($message->geterrorInfo())){  //檢查資料空白
    $error = $message->changeErrormessage($message->geterrorInfo(),$errorMessage);
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
}
$filterword = new Filterword("../public/filterword.txt");
$newmessageinfo['message'] = $filterword->usefilter($message->useHtmlspecialchars($newmessageinfo['message']));
$newmessageinfo['uid'] = $userinfo['uid'];
$newmessageinfo['conid'] = $newmessageinfo['conid'];
$newmessageinfo['createtime'] = time();

if($message->setMessage($newmessageinfo) == 1){
    echo 1;
} else {
    echo 0;
}



?>