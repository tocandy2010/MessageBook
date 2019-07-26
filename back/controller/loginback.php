<?php

require_once("../model/Member.php");

session_start();

if (isset($_COOKIE['token'])) {
    $error['error'] = '目前已登入中，返回首頁';
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
}

$login  = new Member();

$logininfo['account'] = $_POST['account'];
$logininfo['password'] = $_POST['password'];
$logininfo['vcode'] = $_POST['vcode'];
$logininfo['remember'] = $_POST['remember'];

$verification = [
    'account'=>array('notempty'=>'0'),
    'password'=>array('notempty'=>'0'),
    'vcode'=>array('notempty'=>'0'),
];

$login->auto_verification($logininfo,$verification);

$errorMessage = [
    'length'=>'資料長度錯誤',
    'notempty'=>'未輸入'
];

if (!empty($login->geterrorInfo())) {
    $error = $login->changeErrormessage($login->geterrorInfo(),$errorMessage);
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
}

$vcode = $login->getVcode();
if ($vcode !== $logininfo['vcode']) {
    $error['error'] = '驗證碼錯誤';
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
}

$logininfo['account'] = $login->useHtmlspecialchars($logininfo['account']);

$logininfo['password'] = $login->useHtmlspecialchars($logininfo['password']);

$userinfo = $login->getAccount($logininfo['account']);

if ($userinfo === false) {
    $error['error'] = '帳號密碼錯誤';
}
if ($login->checkPassword($logininfo['password'],$userinfo['password']) === false) {
    $error['error'] = '帳號密碼錯誤';
}

if (!empty($error)) {
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
}

$token = $login->createToken($userinfo['uid']);   //獲得token

if (isset($logininfo['remember']) && ($logininfo['remember'] === '1')) {   //記住帳號
    if (!isset($_COOKIE['remember']) || empty($_COOKIE['remember']) || $_COOKIE['remember']!==$logininfo['account']) { 
        setcookie("remember",$logininfo['account'], time()+3600*7,'/');
    }
} else {
    setcookie("remember" ,'', time()-100, '/');
}

if ($login->setToken('users',array('token'=>$token),'uid',$userinfo['uid']) === 1) {  //設定 cookie token
    setcookie("token",$token, time()+3600,'/');
    echo 1;
} else {
    echo 0;
}
