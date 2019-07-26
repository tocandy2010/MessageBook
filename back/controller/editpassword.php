<?php


require_once("../smarty/smarty/public/Mysmarty.php");
require_once("../model/Member.php");

$editpassword  = new Member();
$smarty = new Mysmarty();


if (!isset($_COOKIE['token']) || empty($_COOKIE['token'])) {
    $userinfo = [];
} else {
    $checklogin = $editpassword->getUser($_COOKIE['token']);
    if (empty($checklogin)) {
        $userinfo = [];
    } else {
        $userinfo = $checklogin;
        unset($userinfo['token']);
    }
}

$loginflag = !empty($userinfo);

$smarty->assign('loginflag',$loginflag);

$smarty->assign('userinfo',$userinfo);

$smarty->display('./login/editpassword.html');
