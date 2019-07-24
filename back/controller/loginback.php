<?php

require_once("../model/Member.php");

session_start();

$login  = new Member();

$logininfo = $_POST;

$allowpostinfo = ['account','password','vcode','remember'];

$newlogininfo = $login->auto_filter($logininfo,$allowpostinfo);

$verification = [
    'account'=>array('notempty'=>'0'),
    'password'=>array('notempty'=>'0'),
    'vcode'=>array('notempty'=>'0'),
];

$login->auto_verification($newlogininfo,$verification);

$errorMessage = [
    'length'=>'資料長度錯誤',
    'notempty'=>'未輸入'
];

if(!empty($login->geterrorInfo())){  //檢查資料空白
    $error = $login->changeErrormessage($login->geterrorInfo(),$errorMessage);
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
}

$vcode = $login->getVcode();
if (!$login->checkSame($vcode,$newlogininfo['vcode'])) {
    $error['error'] = '驗證碼錯誤 點選圖片更換驗證碼';
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
}

$newlogininfo['account'] = $login->useHtmlspecialchars($newlogininfo['account']);

$newlogininfo['password'] = $login->useHtmlspecialchars($newlogininfo['password']);

$userinfo = $login->getAccount($newlogininfo['account']);
if ($userinfo === false) {
    $error['error'] = '帳號密碼錯誤';
}
if ($login->checkPassword($newlogininfo['password'],$userinfo['password']) === false) {
    $error['error'] = '帳號密碼錯誤';
}

if (!empty($error)) {
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
}

$token = $login->createToken($userinfo['uid']);   //獲得token



if (isset($logininfo['remember'])&& ($logininfo['remember']==='1')) {   //記住帳號
    if (!isset($_COOKIE['remember']) || empty($_COOKIE['remember'])) { 
        setcookie("remember",$logininfo['account'], time()+3600*7,'/');
    }
} else {
    setcookie("remember",'', time()-100,'/');
}

if ($login->setToken('users',array('token'=>$token),'uid',$userinfo['uid']) === 1) {  //設定 cookie token
    setcookie("token",$token, time()+3600,'/');
    echo 1;
} else {
    echo 0;
}






?>