<?php

require_once("../model/MyarticleModel.php");

$myarticle  = new MyarticleModel();

$myarticleinfo = $_GET;


$newmyarticle = $myarticle->auto_filter($myarticleinfo);

if($myarticle->checkuserlogin()!==false){  //判斷是否燈入
    $userinfo = $_SESSION['userinfo'];
}else{
    echo 2;
    exit;
}

$contentdata = $myarticle->auto_selectOne($newmyarticle['conid']);


if(!empty($contentdata)){
    unset($contentdata['uid']);
    unset($contentdata['createtime']);
    echo json_encode($contentdata,JSON_UNESCAPED_UNICODE);
}else{
    echo 0;
    exit;
}



?>