<?php

require_once("../model/RegModel.php");
require_once("../smarty/smarty/public/Mysmarty.php");

$smarty = new Mysmarty();
$reg  = new RegModel();


$userinfo = [];
$loginflag = !empty($userinfo);

$smarty->assign('loginflag',$loginflag);

$smarty->assign('userinfo',$userinfo);

$smarty->display('./login/reg.html');




?>