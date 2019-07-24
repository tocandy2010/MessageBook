<?php


require_once("../smarty/smarty/public/Mysmarty.php");
require_once("../model/ContentModel.php");

$articleedit  = new ContentModel();
$smarty = new Mysmarty();

$articleeditinfo = $_GET;

$allowinfo = ['conid'];

$newarticleeditinfo = $articleedit->auto_filter($articleeditinfo,$allowinfo);

if(!isset($_COOKIE['token']) || empty($_COOKIE['token'])){
    $userinfo = [];
} else {
    $checklogin = $articleedit->getUser($_COOKIE['token']);
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

$contentinfo = $articleedit->getContent($newarticleeditinfo['conid']);

if($contentinfo['uid'] !== $userinfo['uid'] || $contentinfo === false || $contentinfo['status'] === 0){
    header('location: ./index.php');
    exit;
}


$loginflag = !empty($userinfo);

$smarty->assign('loginflag',$loginflag);

$smarty->assign('userinfo',$userinfo);

$smarty->assign('contentinfo',$contentinfo);

$smarty->display('./message/meyarticleedit.html');


?>