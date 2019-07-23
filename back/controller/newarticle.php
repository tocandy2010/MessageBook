<?php

require_once("../model/ArticleModel.php");
require_once("../smarty/smarty/public/Mysmarty.php");

$smarty = new Mysmarty();
$article  = new ArticleModel();

if(!isset($_COOKIE['token']) || empty($_COOKIE['token'])){
    $userinfo = [];
} else {
    $con = $article->getcon();

    $checklogin = $article->checklogin($con,$_COOKIE['token']);

    if (empty($checklogin)) {
        $userinfo = [];
    } else {
        $userinfo = $checklogin[0];
        unset($userinfo['token']);
    }
}


$loginflag = !empty($userinfo);

$smarty->assign('loginflag',$loginflag);

$smarty->assign('userinfo',$userinfo);

$smarty->display('./message/newarticle.html');



?>