<?php

require_once("../model/EditinfoModel.php");
require_once("../smarty/smarty/public/Mysmarty.php");

$smarty = new Mysmarty();
$editpassword  = new EditinfoModel();


if(!isset($_COOKIE['token']) || empty($_COOKIE['token'])){
    $userinfo = [];
} else {
    $con = $editpassword->getcon();
    $checklogin = $editpassword->checklogin($con,$_COOKIE['token']);

    if (empty($checklogin)) {
        $userinfo = [];
    } else {
        $userinfo = $checklogin[0];
        unset($userinfo['token']);
    }
}

$head = $editpassword->getheader($userinfo);

$smarty->assign('head',$head);

$smarty->display('./login/editreg.html');


?>