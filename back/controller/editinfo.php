<?php

require_once("../model/EditinfoModel.php");
require_once("../smarty/smarty/public/Mysmarty.php");

$smarty = new Mysmarty();
$editinfo  = new EditinfoModel();

if(!isset($_COOKIE['token']) || empty($_COOKIE['token'])){
    header('location:./index.php');
    exit;
} else {
    $con = $editinfo->getcon();
    $checklogin = $editinfo->checklogin($con,$_COOKIE['token']);
    if (empty($checklogin)) {
        $userinfo = [];
    } else {
        $userinfo = $checklogin[0];
        $userName = $userinfo['userName'];
        $email = $userinfo['email'];
        unset($userinfo['token']);
    }
}

$head = $editinfo->getheader($userinfo);

$smarty->assign('head',$head);
$smarty->assign('userName',$userName);
$smarty->assign('email',$email);

$smarty->display('./login/editinfo.html');


?>