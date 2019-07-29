<?php

require_once("../smarty/smarty/public/Mysmarty.php");
require_once("../model/ContentModel.php");
require_once("../model/Member.php");
require_once("../public/Commontool.php");

$commontool = new Commontool();
$content  = new ContentModel();
$member  = new Member();
$smarty = new Mysmarty();

## 判斷使用者是否登入
if(!isset($_COOKIE['token']) || empty($_COOKIE['token'])){
    header("Location: login.php");
    exit;
} else {
    $checklogin = $member->getUser($_COOKIE['token']);
    if (empty($checklogin)) {
        header("Location: login.php");
        exit;
    } else {
        $userinfo = $checklogin;
        unset($userinfo['token']);
    }
}

## 根據用戶取得狀態為 1 的所有文章
$mycontent = $content->getMyContent($userinfo['uid']);
$mycontent = $commontool->useTaiwanTime($mycontent, 'createtime');

$loginflag = !empty($userinfo);

$smarty->assign('loginflag', $loginflag);
$smarty->assign('userinfo', $userinfo);
$smarty->assign('mycontent', $mycontent);
$smarty->display('./message/myarticle.html');
