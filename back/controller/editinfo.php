<?php

require_once("../smarty/smarty/public/Mysmarty.php");
require_once("../model/Member.php");

$editinfo = new Member();

## 判斷使用者是否登入
if (!isset($_COOKIE['token']) || empty($_COOKIE['token'])) {
    header("Location: login.php");
    $userinfo = [];
} else {
    $checklogin = $editinfo->getUser($_COOKIE['token']);
    if (empty($checklogin)) {
        header("Location: login.php");
        $userinfo = [];
    } else {
        $userinfo = $checklogin;
        unset($userinfo['token']);
    }
}

$loginflag = !empty($userinfo);

$smarty = new Mysmarty();
$smarty->assign('loginflag', $loginflag);
$smarty->assign('userinfo', $userinfo);
$smarty->display('./login/editinfo.html');
