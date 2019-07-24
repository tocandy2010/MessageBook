<?php

require_once("../model/ContentModel.php");
require_once("../smarty/smarty/public/Mysmarty.php");

$smarty = new Mysmarty();
$content  = new ContentModel();

$contentinfo = $_GET;

$allowinfo = ['conid'];

$newcontentinfo = $content->auto_filter($contentinfo,$allowinfo);

if (!isset($_COOKIE['token']) || empty($_COOKIE['token'])) {
    $userinfo = [];
} else {
    $checklogin = $content->getUser($_COOKIE['token']);
    if (empty($checklogin)) {
        $userinfo = [];
    } else {
        $userinfo = $checklogin;
        unset($userinfo['token']);
    }
}

$loginflag = !empty($userinfo);

$getcontent = $content->getContent($newcontentinfo['conid']);

$getmessage = $content->getMessage( $newcontentinfo['conid'] );

$getmessage = $content->useTaiwanTime($getmessage,'createtime');

if (count($getmessage)>=1) {
    $allmessage = $getmessage;
} else {
    $allmessage = [];
}

$smarty->assign('content',$getcontent);

$smarty->assign('getmessage',$getmessage);

$smarty->assign('loginflag',$loginflag);

$smarty->assign('userinfo',$userinfo);

$smarty->display('./message/content.html');



?>