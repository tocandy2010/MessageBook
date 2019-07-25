<?php

require_once("../model/Member.php");

$editpassword = new Member();

$editpasswordinfo = $_POST;

$allowpostinfo = ['oldpassword','password','repassword'];

$neweditpasswordinfo = $editpassword->auto_filter($editpasswordinfo,$allowpostinfo);

$verification = [
    'oldpassword'=>array('notempty'=>'0'),
    'password'=>array('notempty'=>'0','length'=>'6,20'),
    'repassword'=>array('notempty'=>'0'),
];

$editpassword->auto_verification($neweditpasswordinfo,$verification);

$errorMessage = [
    'length'=>'資料長度錯誤',
    'notempty'=>'未輸入'
];

if(!empty($editpassword->geterrorInfo())){  //檢查資料空白
    $error = $editpassword->changeErrormessage($editpassword->geterrorInfo(),$errorMessage);
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
}

if (!isset($_COOKIE['token']) || empty($_COOKIE['token'])) {
    $userinfo = [];
} else {
    $checklogin = $editpassword->getUser($_COOKIE['token']);
    if (empty($checklogin)) {
        $userinfo = [];
    } else {
        $userinfo = $checklogin;
        unset($userinfo['token']);
    }
}

$error = [];

if ($editpassword->checkpassword($editpasswordinfo['password'],$userinfo['password'])) {  //確認舊密碼
    $error['password'] = '請重新設定新密碼';
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
}

if (!$editpassword->checkpassword($editpasswordinfo['oldpassword'],$userinfo['password'])) {  //確認舊密碼
    $error['oldpassword'] = '舊密碼錯誤';
}

if ($neweditpasswordinfo['repassword'] !== $neweditpasswordinfo['password']) {  
    $error['repassword'] = '與新密碼不相同';
}

if (!$editpassword->onlyNumandEng($neweditpasswordinfo['password'])) {
    $error['password'] = '密碼中不能包含任何符號';
}

if (!empty($error)) {
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
}

unset($neweditpasswordinfo['oldpassword']);
unset($neweditpasswordinfo['repassword']);

$newpassword = $editpassword->encryptionPassword($neweditpasswordinfo['password']);

if ($editpassword->resetPassword(['password'=>$newpassword],$userinfo['uid']) == 1) {
    echo 1;
} else {
    echo 0;
}


?>