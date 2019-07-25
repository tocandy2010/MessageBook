<?php

require_once("../model/Member.php");

$reg  = new Member();

$reginfo = $_POST;

$allowpostinfo = ['account','password','repassword','userName','email'];

$newreginfo = $reg->auto_filter($reginfo,$allowpostinfo);

$verification = [
    'account'=>array('length'=>'6,20','notempty'=>'0'),
    'password'=>array('length'=>'6,20','notempty'=>'0'),
    'userName'=>array('length'=>'1,20','notempty'=>'0'),
    'email'=>array('email'=>'0','notempty'=>'0'),
];

$reg->auto_verification($newreginfo,$verification);

$errorMessage = [
    'length'=>'資料長度錯誤',
    'email'=>'請輸入正eamil',
    'notempty'=>'尚未輸入'
];

if (!empty($reg->geterrorInfo())) {  //檢查資料空白
    $error = $reg->changeErrormessage($reg->geterrorInfo(),$errorMessage);
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
}

$error = [];

if (!$reg->checkSame($newreginfo['password'],$newreginfo['repassword'])) {
    $error['repassword'] = "確認密碼與密碼不相同";
    //echo json_encode($error,JSON_UNESCAPED_UNICODE);
} else {
    unset($newreginfo['repassword']);
}

if ($reg->onlynumandeng($newreginfo['account'])==0) {
    $error['account'] = "帳號不可輸入任何符號";
}

if ($reg->onlynumandeng($newreginfo['password'])==0) {
    $error['password'] = "密碼不可輸入任何符號";
}

if (!empty($error)) {   
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
}

if ((!empty($reg->checkreged('account',$newreginfo['account'])))) {
    $error['account'] = "帳號已被註冊";
}

if ((!empty($reg->checkreged('email',$newreginfo['email'])))) {
    $error['email'] = "email已被註冊";
}
if (!empty($error)) {   
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
}

$newreginfo['userName'] = $reg->useHtmlspecialchars($newreginfo['userName']);

$newpassword = $reg->encryptionPassword($newreginfo['password']);  //密碼加密
if ($newpassword !== false) {     //將使用者名稱轉義
    $newreginfo['password'] = $newpassword;
} else {
    echo 0;
    exit;
}

$newreginfo['regTime'] = time();
if ($reg->addUser('users',$newreginfo) == 1) {
    echo 1;
} else {
    echo 0;
}

?>