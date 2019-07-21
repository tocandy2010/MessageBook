<?php

require_once("../model/RegModel.php");

$reg  = new RegModel();

$reginfo = $_POST;

$newreginfo = $reg->auto_filter($reginfo);

$reg->auto_verification($newreginfo);


if(!empty($reg->geterrorInfo())){  //檢查資資料長度及非空白
    $error = [];
    foreach($reg->geterrorInfo() as $k=>$v){
        $errormessage = $reg->toerrormessage($v);
        $error[$k] = implode('、',$errormessage);
    }
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
}

$error = [];

if(!$reg->isSame($newreginfo['password'],$newreginfo['repassword'])){
    $error['repassword'] = "確認密碼與密碼不相同";
    //echo json_encode($error,JSON_UNESCAPED_UNICODE);
}else{
    unset($newreginfo['repassword']);
}


if($reg->onlynumandeng($newreginfo['account'])==0){
    $error['account'] = "帳號不可輸入任何符號";
}

if($reg->onlynumandeng($newreginfo['password'])==0){
    $error['password'] = "密碼不可輸入任何符號";
}

if((!empty($reg->checkreged('account',$newreginfo['account'])))){
    $error['account'] = "帳號已被註冊";
}

if((!empty($reg->checkreged('email',$newreginfo['email'])))){
    $error['email'] = "email已被註冊";
}
if(!empty($error)){   
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
}

$newreginfo['userName'] = $reg->checkuserName($newreginfo['userName']);   //將使用者名稱轉義
$newreginfo['password']= password_hash($newreginfo['password'], PASSWORD_DEFAULT);  //密碼加密


if(empty($error)){
    $newreginfo['regTime'] = time();
    if($reg->auto_insert($newreginfo) ==1){
        echo 1;
    }else{
        echo 0;
    }
}

?>