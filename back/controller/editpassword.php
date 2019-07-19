<?php

require_once("../model/EditinfoModel.php");

$editpassword  = new EditinfoModel();

$editpasswordinfo = $_POST;

$neweditpasswordinfo = $editpassword->auto_filter($editpasswordinfo);

$editpassword->auto_verification($neweditpasswordinfo);


if($editpassword->checkuserlogin()!==false){
    $userinfo = $_SESSION['userinfo'];
}else{
    echo 2;
    exit;
}

if(!empty($editpassword->geterrorInfo())){  //檢查資料空白
    $error = [];
    foreach($editpassword->geterrorInfo() as $k=>$v){
        $errormessage = $editpassword->toerrormessage($v);
        $error[$k] = implode('、',$errormessage);
    }
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
}

$error = [];

$userdata = $editpassword->auto_selectOne($userinfo['uid']);

if(!$editpassword->checkpassword($editpasswordinfo['oldpassword'],$userdata['password'])){  //確認舊密碼
    $error['oldpassword'] = '舊密碼錯誤';
}


if(!$editpassword->isSame($neweditpasswordinfo['repassword'],$neweditpasswordinfo['password'])){  
    $error['repassword'] = '與新密碼不相同';
}

if(!$editpassword->onlynumandeng($neweditpasswordinfo['password'])){
    $error['password'] = '密碼中不能包含任何符號';
}

if(!empty($error)){
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
}

unset($neweditpasswordinfo['oldpassword']);
unset($neweditpasswordinfo['repassword']);

$neweditpasswordinfo['password'] = password_hash($neweditpasswordinfo['password'], PASSWORD_DEFAULT);

if($editpassword->auto_update($neweditpasswordinfo,$userinfo['uid'])== 1){
    echo 1;
}else{
    echo 0;
}


?>