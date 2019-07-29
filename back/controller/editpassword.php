<?php
require_once("../smarty/smarty/public/Mysmarty.php");
require_once("../model/Member.php");

$editpassword  = new Member();

## 判斷使用者是否登入
if (!isset($_COOKIE['token']) || empty($_COOKIE['token'])) {
    header("Location: login.php");
    exit;
} else {
    $checklogin = $editpassword->getUser($_COOKIE['token']);
    if (empty($checklogin)) {
        header("Location: login.php");
        exit;
    } else {
        $userinfo = $checklogin;
        unset($userinfo['token']);
    }
}

$smarty = new Mysmarty();

$loginflag = !empty($userinfo);

$smarty->assign('loginflag', $loginflag);
$smarty->assign('userinfo', $userinfo);
$smarty->display('./login/editpassword.html');
