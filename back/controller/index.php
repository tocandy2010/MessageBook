<?php

require_once("../smarty/smarty/public/Mysmarty.php");
require_once("../model/ContentModel.php");
require_once("../public/Pagetool.php");
require_once("../model/Member.php");
require_once("../public/Commontool.php");

$commontool = new Commontool();
$content = new ContentModel();
$smarty = new Mysmarty();
$member  = new Member();

if (!isset($_COOKIE['token']) || empty($_COOKIE['token'])) {
    $userinfo = [];
} else {
    $userinfo = $member->getUser($_COOKIE['token']);
    $userinfo = empty($userinfo) ? [] : $userinfo;
}

if (!isset($_GET['page']) || is_null($_GET['page']) || !(is_numeric($_GET['page'])) || $_GET['page'] < 1) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$loginflag = !empty($userinfo);

$contentlength = 5;

if (isset($_GET['search']) && !empty($_GET['search'])) { 
    $search = $_GET['search'];
    $allcontent = $content->getSearch($search);
    $contentdata = $content->showSearch($search , $page, $contentlength);
    $contentdata = $commontool->useTaiwanTime($contentdata, 'createtime');

} else {
    $search = "";
    $allcontent = $content->getAllContent();
    $contentdata = $content->showContent($page, $contentlength);
    $contentdata = $commontool->useTaiwanTime($contentdata, 'createtime');
}

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
