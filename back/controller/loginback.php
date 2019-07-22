<?php

require_once("../model/LoginModel.php");

$login  = new LoginModel();

$logininfo = $_POST;

$newlogininfo = $login->auto_filter($logininfo);

$login->auto_verification($newlogininfo);

if(!empty($login->geterrorInfo())){  //檢查資料空白
    $error = [];
    foreach($login->geterrorInfo() as $k=>$v){
        $errormessage = $login->toerrormessage($v);
        $error[$k] = implode('、',$errormessage);
    }
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
}

$error = [];

if($login->isSame($newlogininfo['vcode'],$_SESSION['vcode']) === false){
    $error['error'] = "驗證碼錯誤";
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
}

htmlspecialchars($newlogininfo['account'],ENT_QUOTES); //帳號密碼含有符號就轉義
htmlspecialchars($newlogininfo['password'],ENT_QUOTES);

$userinfo = $login->checkaccount($newlogininfo['account']);
if ($userinfo === false) {
    $error['error'] = '帳號密碼錯誤';
}

if ($login->checkpassword($newlogininfo['password'],$userinfo['password']) === false) {
    $error['error'] = '帳號密碼錯誤';
}

if (!empty($error)) {
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
} else {
    if (isset($logininfo['remember'])&& ($logininfo['remember']==='1')) {
        if (!isset($_COOKIE['remember']) || empty($_COOKIE['remember'])) {
            setcookie("remember",$logininfo['account'], time()+3600*7,'/');
        }
    } else {
        setcookie("remember",'', time()-100,'/');
    }

    $tokene = $login->create_token().$userinfo['uid'];
    
    if ($login->auto_update(array('token'=>$tokene),$userinfo['uid'])==1) {
        setcookie('token',$tokene,time()+3600,'/');
        echo 1;
    } else {
        echo 0;
    }
}




?>