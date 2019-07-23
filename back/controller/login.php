<?php

require_once("../model/Member.php");
require_once("../smarty/smarty/public/Mysmarty.php");

$smarty = new Mysmarty();
$Member  = new Member();

$userinfo = [];
$loginflag = !empty($userinfo);


if (isset($_COOKIE['remember'])&&!empty($_COOKIE['remember'])) {
    $remember = "checked";
    $account = $_COOKIE['remember'];
} else {
    $remember = '';
    $account = '';
}

$smarty->assign('remember',$remember);

$smarty->assign('account',$account);

$smarty->assign('loginflag',$loginflag);

$smarty->display('./login/login.html');



?>