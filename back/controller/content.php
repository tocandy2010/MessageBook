<?php

require_once("../model/ContentModel.php");
require_once("../model/Member.php");
require_once("../smarty/smarty/public/Mysmarty.php");
require_once("../public/Filterword.php");
require_once("../public/Commontool.php");
require_once("../public/Commontool.php");

$member  = new Member();
$commontool = new Commontool();
$smarty = new Mysmarty();
$content  = new ContentModel();

## 判斷使用者是否登入
if (!isset($_COOKIE['token']) || empty($_COOKIE['token'])) {
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

$contentinfo['conid'] = $_GET['conid'];

## 非數字或是null則轉回首頁
if (is_null($contentinfo['conid']) || !is_numeric($contentinfo['conid'])) {
    require('./index.php');
    exit;
}

$loginflag = !empty($userinfo);

## 找不到文章或是狀態為0的文章則跳回首頁
$getcontent = $content->getContent($contentinfo['conid']);
if ($getcontent === false) {
    require('./index.php');
    exit;
}

## 過濾文章不雅文字
$filterword = new Filterword("../public/filterword.txt");
$getcontent['title'] = $filterword->usefilter($getcontent['title']);
$getcontent['content'] = $filterword->usefilter($getcontent['content']);

## 根據conid獲取文章下的狀態為1的留言
$getmessage = $content->getMessage( $contentinfo['conid']);
$getmessage = $commontool->useTaiwanTime($getmessage, 'createtime');
$allmessage = count($getmessage) >= 1?$getmessage : [];

$smarty->assign('messagenum', count($allmessage));
$smarty->assign('content', $getcontent);
$smarty->assign('getmessage', $getmessage);
$smarty->assign('loginflag', $loginflag);
$smarty->assign('userinfo', $userinfo);
$smarty->display('./message/content.html');
