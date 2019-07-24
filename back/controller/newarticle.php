<?php

require_once("../smarty/smarty/public/Mysmarty.php");
require_once("../model/ContentModel.php");

$newarticle  = new ContentModel();
$smarty = new Mysmarty();

if(!isset($_COOKIE['token']) || empty($_COOKIE['token'])){
    $userinfo = [];
} else {
    $checklogin = $newarticle->getUser($_COOKIE['token']);
    if (empty($checklogin)) {
        $userinfo = [];
    } else {
        $userinfo = $checklogin;
        unset($userinfo['token']);
    }
}

if (empty($userinfo)) {
    header('location: ./login.php');
    exit;
}

$loginflag = !empty($userinfo);

$smarty->assign('loginflag',$loginflag);

$smarty->assign('userinfo',$userinfo);

$smarty->display('./message/newarticle.html');



?>