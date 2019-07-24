<?php


require_once("../smarty/smarty/public/Mysmarty.php");
require_once("../model/ContentModel.php");

$myarticle  = new ContentModel();
$smarty = new Mysmarty();

if(!isset($_COOKIE['token']) || empty($_COOKIE['token'])){
    $userinfo = [];
} else {
    $checklogin = $myarticle->getUser($_COOKIE['token']);
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

$mycontent = $myarticle->getMyContent($userinfo['uid']);

$mycontent = $myarticle->useTaiwanTime($mycontent,'createtime');

$loginflag = !empty($userinfo);

$smarty->assign('loginflag',$loginflag);

$smarty->assign('userinfo',$userinfo);

$smarty->assign('mycontent',$mycontent);

$smarty->display('./message/myarticle.html');
    










?>