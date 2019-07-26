<?php

require_once("../model/Member.php");

$editinfo = new Member();

if (!isset($_COOKIE['token']) || empty($_COOKIE['token'])) {
    echo 2;
    exit;
} else {
    $checklogin = $editinfo->getUser($_COOKIE['token']);
    if (empty($checklogin)) {
        echo 2;
        exit;
    } else {
        $userinfo = $checklogin;
        unset($userinfo['token']);
    }
}

$editinfinfo = $_POST;

$allowinfo = ['userName','email'];

$neweditinfinfo = $editinfo->auto_filter($editinfinfo,$allowinfo);

$verification = [
    'userName'=>array('notempty'=>'0','length'=>'1,100'),
    'email'=>array('notempty'=>'0','email'=>'0'),
];

$editinfo->auto_verification($neweditinfinfo,$verification);

$errorMessage = [
    'length'=>'資料長度錯誤',
    'notempty'=>'未輸入',
    'email'=>'請輸入正確email格式'
];

if(!empty($editinfo->geterrorInfo())){  //檢查資料空白
    $error = $editinfo->changeErrormessage($editinfo->geterrorInfo(),$errorMessage);
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
}



if ($neweditinfinfo['userName'] === $userinfo['userName'] && $neweditinfinfo['email'] === $userinfo['email']) {
    $error['error'] = '未作任何修改';
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
}

$neweditinfinfo['userName'] = $editinfo->useHtmlspecialchars($neweditinfinfo['userName']);   //將使用者名稱轉義

if ($editinfo->editUserInfo($neweditinfinfo,$userinfo['uid']) == 1) {
    echo 1;
}else {
    echo 0;
}
