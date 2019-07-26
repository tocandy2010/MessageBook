<?php

require_once("../smarty/smarty/public/Mysmarty.php");
require_once("../model/ContentModel.php");
require_once("../public/Pagetool.php");

$index  = new ContentModel();
$smarty = new Mysmarty();


if(!isset($_COOKIE['token']) || empty($_COOKIE['token'])){
    $userinfo = [];
} else {
    $userinfo = $index->getUserInfo('users',$_COOKIE['token']);
    $userinfo = empty($userinfo) ? [] : $userinfo;
}

$loginflag = !empty($userinfo);

$page = $_GET;

$allowinfo = ['page'];

$newpage = $index->auto_filter($page, $allowinfo);

if (!isset($newpage['page']) || is_null($newpage['page']) || !(is_numeric($newpage['page'])) || $newpage['page'] < 1) {
    $newpage['page'] = 1;
}


$allcontent = $index->getAllContent('content');

$contentlength = 5;

if ($newpage['page'] > ceil(count($allcontent)/$contentlength)) {
    $newpage['page'] = 1;
}

$contentdata = $index->showContent($newpage['page'],$contentlength);

$contentdata = $index->useTaiwanTime($contentdata,'createTime');

$page = new Pagetool(count($allcontent), $newpage['page'], $contentlength);

$showpage = $page->show();

$smarty->assign('loginflag',$loginflag);
$smarty->assign('showpage',$showpage);
$smarty->assign('pagenum',$newpage['page']);
$smarty->assign('userinfo',$userinfo);
$smarty->assign('contentdata',$contentdata);

$smarty->display('./message/index.html');

