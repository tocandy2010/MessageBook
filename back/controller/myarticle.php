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


$head = $myarticle->getheader($userinfo);

$smarty->assign('head',$head);

$smarty->display('./message/myarticle.html');
    










?>