<?php


require_once("../smarty/smarty/public/Mysmarty.php");
require_once("../model/ContentModel.php");
require_once("../model/Member.php");

$member  = new Member();
$content = new ContentModel();
$smarty = new Mysmarty();

if(!isset($_COOKIE['token']) || empty($_COOKIE['token'])){
    header('location: ./login.php');
    exit;
} else {
    $checklogin = $member->getUser($_COOKIE['token']);
    if (empty($checklogin)) {
        header('location: ./login.php');
        exit;
    } else {
        $userinfo = $checklogin;
        unset($userinfo['token']);
    }
}

$articleeditinfo['conid'] = $_GET['conid'];

$contentinfo = $content->getContent($articleeditinfo['conid']);

if ($contentinfo['uid'] !== $userinfo['uid'] || $contentinfo === false || $contentinfo['status'] === 0) {
    header('location: ./index.php');
    exit;
}

$loginflag = !empty($userinfo);

$smarty->assign('loginflag', $loginflag);

$smarty->assign('userinfo', $userinfo);

$smarty->assign('contentinfo', $contentinfo);

$smarty->display('./message/meyarticleedit.html');
