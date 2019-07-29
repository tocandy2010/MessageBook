<?php

require_once("../smarty/smarty/public/Mysmarty.php");

$smarty = new Mysmarty();

$userinfo = [];
$loginflag = !empty($userinfo);

## 判斷之前有沒有勾選記住帳號
if (isset($_COOKIE['remember']) && !empty($_COOKIE['remember'])) {
    $remember = "checked";
    $account = $_COOKIE['remember'];
} else {
    $remember = '';
    $account = '';
}

$smarty->assign('remember', $remember);
$smarty->assign('account', $account);
$smarty->assign('loginflag', $loginflag);
$smarty->display('./login/login.html');
