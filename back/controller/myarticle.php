<?php

require_once("../model/MyarticleModel.php");
require_once("../smarty/smarty/public/Mysmarty.php");

$smarty = new Mysmarty();
$myarticle  = new MyarticleModel();

$page = $_GET;

if(!isset($_COOKIE['token']) || empty($_COOKIE['token'])){
    $userinfo = [];
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


$loginflag = !empty($userinfo);

$smarty->assign('loginflag',$loginflag);

$smarty->assign('userinfo',$userinfo);

$smarty->display('./message/myarticle.html');
    










?>