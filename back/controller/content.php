<?php

require_once("../model/ContentModel.php");
require_once("../smarty/smarty/public/Mysmarty.php");

$smarty = new Mysmarty();
$content  = new ContentModel();

$contentinfo = $_GET;

$newcontentinfo = $content->auto_filter($contentinfo);

if(!isset($_COOKIE['token']) || empty($_COOKIE['token'])){
    $userinfo = [];
} else {
    $con = $content->getcon();

    $checklogin = $content->checklogin($con,$_COOKIE['token']);

    if (empty($checklogin)) {
        $userinfo = [];
    } else {
        $userinfo = $checklogin[0];
        unset($userinfo['token']);
    }
}

 $head = $content->getheader($userinfo);

$data = $content->auto_selectOne($contentinfo['article']);

$con = $content->getcon();

$getmessage = $content->getmessage($con,$newcontentinfo['article']);

if (count($getmessage)>=1) {
    $allmessage = $content->findwhosend($con,$getmessage);
    $allmessage = $content->totaiwantime($allmessage,'createtime');
} else {
    $allmessage = [];
}

$smarty->assign('data',$data);

$smarty->assign('conid',$contentinfo['article']);

$smarty->assign('allmessage',$allmessage);

$smarty->assign('head',$head);

$smarty->display('./message/content.html');



?>