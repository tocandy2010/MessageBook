<?php


require_once("../smarty/smarty/public/Mysmarty.php");
require_once("../model/ContentModel.php");
require_once("../model/Member.php");

$member  = new Member();

## 判斷使用者是否登入
if(!isset($_COOKIE['token']) || empty($_COOKIE['token'])){
    require('./login.php');
    exit;
} else {
    $checklogin = $member->getUser($_COOKIE['token']);
    if (empty($checklogin)) {
        require('./login.php');
        exit;
    } else {
        $userinfo = $checklogin;
        unset($userinfo['token']);
    }
}

$content = new ContentModel();
$smarty = new Mysmarty();

$articleeditinfo['conid'] = $_GET['conid'];

## 根據 conid 驗證文章
$contentinfo = $content->getContent($articleeditinfo['conid']);
if ($contentinfo['uid'] !== $userinfo['uid'] || $contentinfo === false || $contentinfo['status'] === 0) {
    header("Location: login.php");
    exit;
}

$loginflag = !empty($userinfo);

$smarty->assign('loginflag', $loginflag);
$smarty->assign('userinfo', $userinfo);
$smarty->assign('contentinfo', $contentinfo);
$smarty->display('./message/meyarticleedit.html');
