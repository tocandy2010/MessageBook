<?php

require_once("../model/MyarticleModel.php");

$myarticle  = new MyarticleModel();

$myarticleinfo = $_GET;

$newmyarticle = $myarticle->auto_filter($myarticleinfo);

if(!isset($_COOKIE['token']) || empty($_COOKIE['token'])){
    header("Location:./login.php");
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

$myarticleinfo = $myarticle->auto_selectOne($myarticleinfo['conid']);

if ($myarticleinfo['uid'] == $userinfo['uid']) {
    if ($myarticle->auto_update(array('status'=>$newmyarticle['status']),$myarticleinfo['conid'])==1) {
        header('Location:./myarticle.php');
        exit;
    }
}

header('Location:./login.php');
exit;





?>