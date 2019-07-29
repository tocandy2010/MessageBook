<?php

require_once("../model/Member.php");
require_once("../smarty/smarty/public/Mysmarty.php");


$editreg  = new Member();

## 判斷使用者是否登入
if (!isset($_COOKIE['token']) || empty($_COOKIE['token'])) {
    $userinfo = [];
} else {
    $checklogin = $editreg->getUser($_COOKIE['token']);
    if (empty($checklogin)) {
        $userinfo = [];
    } else {
        $userinfo = $checklogin;
        unset($userinfo['token']);
    }
}

$smarty = new Mysmarty();

$loginflag = !empty($userinfo);

$smarty->assign('loginflag', $loginflag);
$smarty->assign('userinfo', $userinfo);
$smarty->display('./login/editreg.html');
