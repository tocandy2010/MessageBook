<?php

require_once("../model/MyarticleModel.php");

$myarticle  = new MyarticleModel();

$myarticleinfo = $_GET;


$newmyarticle = $myarticle->auto_filter($myarticleinfo);

if(!isset($_COOKIE['token']) || empty($_COOKIE['token'])){
    echo 2;
    exit;
} else {
    $con = $myarticle->getcon();

    $checklogin = $myarticle->checklogin($con,$_COOKIE['token']);

    if (empty($checklogin)) {
        $userinfo = [];
    } else {
        $userinfo = $checklogin[0];
        unset($userinfo['token']);
    }
}

$contentdata = $myarticle->auto_selectOne($newmyarticle['conid']);

if (!empty($contentdata)) {
    unset($contentdata['uid']);
    unset($contentdata['createtime']);
    echo json_encode($contentdata,JSON_UNESCAPED_UNICODE);
} else {
    echo 0;
    exit;
}



?>