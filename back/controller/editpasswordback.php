<?php

require_once("../model/Member.php");
require_once("../public/Commontool.php");

$commontool = new Commontool();
$editpassword = new Member();

if (!isset($_COOKIE['token']) || empty($_COOKIE['token'])) {
    echo json_encode(['notlogin'=>'請登入會員'], JSON_UNESCAPED_UNICODE);
    exit;
} else {
    $checklogin = $editpassword->getUser($_COOKIE['token']);
    if (empty($checklogin)) {
        echo json_encode(['notlogin'=>'請登入會員'], JSON_UNESCAPED_UNICODE);
        exit;
    } else {
        $userinfo = $checklogin;
        unset($userinfo['token']);
    }
}

$editpasswordinfo['oldpassword'] = $_POST['oldpassword'];
$editpasswordinfo['password'] = $_POST['password'];
$editpasswordinfo['repassword'] = $_POST['repassword'];

$verification = [
    'oldpassword'=>array('notempty' => '0'),
    'password'=>array('notempty' => '0'),
    'password'=>array('length' => '6,20'),
    'repassword'=>array('notempty' => '0'),
];

$commontool->auto_verification($editpasswordinfo, $verification);

$errirMessage = $commontool->getErrorInfo();

if (!empty($errirMessage)) {
    echo json_encode($errirMessage, JSON_UNESCAPED_UNICODE);
    exit;
}

if (!password_verify($editpasswordinfo['oldpassword'], $userinfo['password'])) {
    $error['oldpassword'] = '舊密碼錯誤';
    echo json_encode($error, JSON_UNESCAPED_UNICODE);
    exit;
}



$error = [];

if (password_verify($editpasswordinfo['password'], $userinfo['password'])) {
    $error['password'] = '請勿與舊密碼相同';
}

if ($editpasswordinfo['repassword'] !== $editpasswordinfo['password']) {  
    $error['repassword'] = '與新密碼不相同';
}


if (!preg_match_all("/^[A-Za-z0-9]*$/", $editpasswordinfo['password'])) {
    $error['password'] = '密碼中不能包含任何符號';
}

if (!empty($error)) {
    echo json_encode($error, JSON_UNESCAPED_UNICODE);
    exit;
}

unset($editpasswordinfo['oldpassword']);
unset($editpasswordinfo['repassword']);

$password = password_hash($editpasswordinfo['password'], PASSWORD_DEFAULT);

if ($editpassword->resetPassword(['password'=>$password],$userinfo['uid']) === 1) {
    echo json_encode(['success' => '修改成功'], JSON_UNESCAPED_UNICODE);
} else {
    echo  json_encode(['fail' => '修改失敗'], JSON_UNESCAPED_UNICODE);
}
