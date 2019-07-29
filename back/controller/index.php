<?php

require_once("../smarty/smarty/public/Mysmarty.php");
require_once("../model/ContentModel.php");
require_once("../public/Pagetool.php");
require_once("../model/Member.php");
require_once("../public/Commontool.php");


$member  = new Member();
$commontool = new Commontool();
$content = new ContentModel();
$smarty = new Mysmarty();

## 判斷使用者是否登入
if (!isset($_COOKIE['token']) || empty($_COOKIE['token'])) {
    $userinfo = [];
} else {
    $userinfo = $member->getUser($_COOKIE['token']);
    $userinfo = empty($userinfo) ? [] : $userinfo;
}

## 過濾傳入的page頁碼
if (!isset($_GET['page']) || is_null($_GET['page']) || !(is_numeric($_GET['page'])) || $_GET['page'] < 1) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$loginflag = !empty($userinfo);

## 一頁顯示的文章數量
$contentlength = 5;


if (isset($_GET['search']) && !empty($_GET['search'])) {
    ## 獲得 search 狀態為1的文章
    $search = $_GET['search'];
    $search = htmlspecialchars($search, ENT_QUOTES);
    $allcontent = $content->getSearch($search);
    $contentdata = $content->showSearch($search , $page, $contentlength);
    $contentdata = $commontool->useTaiwanTime($contentdata, 'createtime');

} else {
    ## 顯示全部 狀態為1的文章
    $search = "";
    $allcontent = $content->getAllContent();
    $contentdata = $content->showContent($page, $contentlength);
    $contentdata = $commontool->useTaiwanTime($contentdata, 'createtime');
}

## 計算總頁數
if ($page > ceil(count($allcontent) / $contentlength)) {
    $page = 1;
}

$pagetool = new Pagetool(count($allcontent), $page, $contentlength);
$showpage = $pagetool->show();

$smarty->assign('search', $search);
$smarty->assign('loginflag', $loginflag);
$smarty->assign('showpage', $showpage);
$smarty->assign('pagenum', $page);
$smarty->assign('userinfo', $userinfo);
$smarty->assign('contentdata', $contentdata);
$smarty->display('./message/index.html');
