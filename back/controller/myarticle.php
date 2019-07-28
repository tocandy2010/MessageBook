<?php

require_once("../smarty/smarty/public/Mysmarty.php");
require_once("../model/ContentModel.php");
require_once("../model/Member.php");
require_once("../public/Commontool.php");

$commontool = new Commontool();
$content  = new ContentModel();
$member  = new Member();
$smarty = new Mysmarty();

if(!isset($_COOKIE['token']) || empty($_COOKIE['token'])){
    $userinfo = [];
} else {
    $checklogin = $member->getUser($_COOKIE['token']);
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

$mycontent = $content->getMyContent($userinfo['uid']);

$mycontent = $commontool->useTaiwanTime($mycontent, 'createtime');

$loginflag = !empty($userinfo);

$smarty->assign('loginflag', $loginflag);
$smarty->assign('userinfo', $userinfo);
$smarty->assign('mycontent', $mycontent);
$smarty->display('./message/myarticle.html');
