<?php

require_once("../model/EditinfoModel.php");

$editinfo  = new EditinfoModel();

$editinfinfo = $_POST;

$neweditinfinfo = $editinfo->auto_filter($editinfinfo);

$editinfo->auto_verification($neweditinfinfo);


if($editinfo->checkuserlogin()!==false){  //判斷是否燈入
    $userinfo = $_SESSION['userinfo'];
}else{
    echo 2;
    exit;
}

if(!empty($editinfo->geterrorInfo())){  //檢查資料空白
    $error = [];
    foreach($editinfo->geterrorInfo() as $k=>$v){
        $errormessage = $editinfo->toerrormessage($v);
        $error[$k] = implode('、',$errormessage);
    }
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
}


if($editinfo->checkisedit($editinfinfo,$userinfo)){  //判斷是有否修改
    $error = [];
    $error['error'] = '未修改任何資料';
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
}

$neweditinfinfo['userName'] = $editinfo->checkuserName($neweditinfinfo['userName']);   //將使用者名稱轉義

if($editinfo->auto_update($neweditinfinfo,$userinfo['uid']) === 1){
    $newuserinfo = $editinfo->auto_selectOne($userinfo['uid']);
    if(!empty($newuserinfo)){
        unset($newuserinfo['password']);
        unset($newuserinfo['regTime']);
        $_SESSION['userinfo'] = $newuserinfo;
        echo 1;
    }else{
        echo 0;
    }
}else{
    echo 0;
}

?>