<?php

require_once("../model/RegModel.php");
require_once("../smarty/smarty/public/Mysmarty.php");

$smarty = new Mysmarty();
$reg  = new RegModel();


$userinfo = [];
$head = $reg->getheader($userinfo);

$smarty->assign('head',$head);

$smarty->display('./login/reg.html');




?>