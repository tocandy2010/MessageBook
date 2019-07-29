<?php

session_start();

if (isset($_COOKIE['token'])) {
    
    echo json_encode(['logined'=>'目前已登入中，返回首頁'], JSON_UNESCAPED_UNICODE);
    exit;
}
require_once("../model/Member.php");
require_once("../public/Commontool.php");

$commontool = new Commontool();
$member  = new Member();

$logininfo['account'] = $_POST['account'];
$logininfo['password'] = $_POST['password'];
$logininfo['vcode'] = $_POST['vcode'];
$logininfo['remember'] = $_POST['remember'];

## 設定傳入資料格式
$verification = [
    'account'=>array('notempty' => '0'),
    'password'=>array('notempty' => '0'),
    'vcode'=>array('notempty' => '0'),
];
## 檢查傳入的資料格式
$commontool->auto_verification($logininfo,$verification);
$errirMessage = $commontool->getErrorInfo();
if (!empty($errirMessage)) {
    echo json_encode($errirMessage, JSON_UNESCAPED_UNICODE);
    exit;
}

## 檢查驗證碼
if (!(isset($_SESSION['vcode'])) && ($vcode !== $logininfo['vcode'])) {
    $error['error'] = '驗證碼錯誤';
    echo json_encode($error, JSON_UNESCAPED_UNICODE);
    exit;
}

$logininfo['account'] = htmlspecialchars($logininfo['account'], ENT_QUOTES);
$logininfo['password'] = htmlspecialchars($logininfo['password'], ENT_QUOTES);


## 判斷帳號是否存在
$userinfo = $member->getAccount($logininfo['account']);
if (password_verify($logininfo['password'], $userinfo['password']) && $userinfo === false) {
    echo json_encode(['error'=>'帳號密碼錯誤'], JSON_UNESCAPED_UNICODE);
    exit;
}

## 記住帳號
if (isset($logininfo['remember']) && ($logininfo['remember'] === '1')) {
    if (!isset($_COOKIE['remember']) || empty($_COOKIE['remember']) || $_COOKIE['remember'] !== $logininfo['account']) { 
        setcookie("remember", $logininfo['account'], time()+3600*7, '/');
    }
} else {
    setcookie("remember", '', time()-100, '/');
}

## 產生token並存入登入的使用者
$token = $member->createToken($userinfo['uid']);
if ($member->setToken('users', ['token' => $token], 'uid', $userinfo['uid']) === 1) {  //設定 cookie token
    setcookie("token", $token, time() + 3600, '/');
    echo json_encode(['login'=>'success'], JSON_UNESCAPED_UNICODE);
} else {
    echo 0;
}
