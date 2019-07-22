<?php

require_once("../model/LoginModel.php");
require_once("../smarty/smarty/public/Mysmarty.php");

$smarty = new Mysmarty();
$login  = new LoginModel();

$userinfo = [];
$head = $login->getheader($userinfo);

$smarty->assign('head',$head);

if (isset($_COOKIE['remember'])&&!empty($_COOKIE['remember'])) {
    $remember = "checked";
    $account = $_COOKIE['remember'];
} else {
    $remember = '';
    $account = '';
}

$smarty->assign('remember',$remember);
$smarty->assign('account',$account);

$smarty->display('./login/login.html');



?>