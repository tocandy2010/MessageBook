<?php

require_once("../model/MyarticleModel.php");

$myarticle  = new MyarticleModel();

$myarticleinfo = $_GET;

$newmyarticle = $myarticle->auto_filter($myarticleinfo);

if($myarticle->checkuserlogin()!==false){  //判斷是否燈入
    $userinfo = $_SESSION['userinfo'];
}else{
    header('Location:../../home/login/login.php');
    exit;
}

$myarticleinfo = $myarticle->auto_selectOne($myarticleinfo['conid']);

if($myarticleinfo['uid'] == $userinfo['uid']){
    if($myarticle->auto_update(array('status'=>$newmyarticle['status']),$myarticleinfo['conid'])==1){
        header('Location:../../home/message/myarticle.php');
        exit;
    }
}

header('Location:../../home/login/login.php');
exit;





?>