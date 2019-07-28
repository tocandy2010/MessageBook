<?php

require_once("../model/Member.php");
require_once("../public/Commontool.php");

$commontool = new Commontool();
$member  = new Member();

$reginfo['account'] = $_POST['account'];
$reginfo['password'] = $_POST['password'];
$reginfo['repassword'] = $_POST['repassword'];
$reginfo['userName'] = $_POST['userName'];
$reginfo['email'] = $_POST['email'];

$verification = [
    'account'=>array('length' => '6,20'),
    'account'=>array('notempty' => '0'),
    'password'=>array('notempty' => '0'),
    'password'=>array('notempty' => '0'),
    'userName'=>array('length' =>' 1,20'),
    'userName'=>array('notempty' => '0'),
    'email'=>array('email' => '0'),
    'email'=>array('notempty' => '0'),
];

$commontool->auto_verification($reginfo, $verification);

$errirMessage = $commontool->getErrorInfo();

if (!empty($errirMessage)) {
    echo json_encode($errirMessage, JSON_UNESCAPED_UNICODE);
    exit;
}

$error = [];

if ($reginfo['password'] !== $reginfo['repassword']) {
    $error['repassword'] = "確認密碼與密碼不相同";
} else {
    unset($reginfo['repassword']);
}

if (!preg_match_all("/^[A-Za-z0-9]*$/", $reginfo['account'])) {
    $error['account'] = "帳號不可輸入任何符號";
}

if (!preg_match_all("/^[A-Za-z0-9]*$/", $reginfo['password'])) {
    $error['password'] = "密碼不可輸入任何符號";
}

if (!empty($error)) {   
    echo json_encode($error, JSON_UNESCAPED_UNICODE);
    exit;
}

if ((!empty($member->checkreged('account', $reginfo['account'])))) {
    $error['account'] = "帳號已被註冊";
}

if ((!empty($member->checkreged('email', $reginfo['email'])))) {
    $error['email'] = "email已被註冊";
}
if (!empty($error)) {   
    echo json_encode($error, JSON_UNESCAPED_UNICODE);
    exit;
}

$reginfo['userName'] = htmlspecialchars($reginfo['userName'], ENT_QUOTES);
$reginfo['userName'] =  trim($reginfo['userName']);
$reginfo['userName'] = str_replace(" ", "", $reginfo['userName']);

$newpassword = password_hash($reginfo['password'], PASSWORD_DEFAULT);

if ($newpassword !== false) {
    $reginfo['password'] = $newpassword;
} else {
    echo json_encode(['fail'=>'未知錯誤'], JSON_UNESCAPED_UNICODE);
    exit;
}

$reginfo['regTime'] = time();
if ($member->addUser('users',$reginfo) == 1) {
    echo json_encode(['success' => '註冊成功 請重新登入'], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(['fail'=>'註冊失敗'], JSON_UNESCAPED_UNICODE);
}
