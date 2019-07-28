<?php

require_once("../model/Member.php");
require_once("../smarty/smarty/public/Mysmarty.php");

$smarty = new Mysmarty();
$editreg  = new Member();


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

$loginflag = !empty($userinfo);

$smarty->assign('loginflag', $loginflag);

$smarty->assign('userinfo', $userinfo);

$smarty->display('./login/editreg.html');
