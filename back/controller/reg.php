<?php

require_once("../smarty/smarty/public/Mysmarty.php");
require_once("../model/Member.php");

$reg  = new Member();
$smarty = new Mysmarty();


$userinfo = [];
$loginflag = !empty($userinfo);

$smarty->assign('loginflag', $loginflag);

$smarty->assign('userinfo', $userinfo);

$smarty->display('./login/reg.html');
