<?php


require_once("../smarty/smarty/public/Mysmarty.php");
require_once("../model/ContentModel.php");

$articleedit  = new ContentModel();
$smarty = new Mysmarty();

if(!isset($_COOKIE['token']) || empty($_COOKIE['token'])){
    header('location: ./login.php');
    exit;
} else {
    $checklogin = $articleedit->getUser($_COOKIE['token']);
    if (empty($checklogin)) {
        header('location: ./login.php');
        exit;
    } else {
        $userinfo = $checklogin;
        unset($userinfo['token']);
    }
}

$articleeditinfo = $_GET;

$allowinfo = ['conid'];

$newarticleeditinfo = $articleedit->auto_filter($articleeditinfo,$allowinfo);



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
