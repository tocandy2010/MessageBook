<?php

require_once("../model/MyarticleModel.php");
require_once("../smarty/smarty/public/Mysmarty.php");

$smarty = new Mysmarty();

$myarticle  = new MyarticleModel();

$page = $_GET;

$newpage = $myarticle->auto_filter($page);

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

$condition = "uid  = {$userinfo['uid']} order by conid desc";
$data = $myarticle->auto_selectAll($condition);

$newdata = $myarticle->totaiwantime($data,'createtime');

$con = $myarticle->getcon();
echo $myarticle->buildindex($con,$newdata);



    










?>