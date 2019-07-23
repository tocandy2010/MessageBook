<?php

require_once("../smarty/smarty/public/Mysmarty.php");
require_once("../model/ContentModel.php");
require_once("../public/Pagetool.php");

$index  = new ContentModel();
$smarty = new Mysmarty();


if(!isset($_COOKIE['token']) || empty($_COOKIE['token'])){
    $userinfo = [];
} else {
    $userinfo = $index->getUserInfo('users',$_COOKIE['token']);
    $userinfo = empty($userinfo)?[]:$userinfo;
}

$loginflag = !empty($userinfo);

$page = $_GET;

$allowpostinfo = ['page'];

$newpage = $index->auto_filter($page,$allowpostinfo);

if (!isset($newpage['page']) || is_null($newpage['page']) || !(is_numeric($newpage['page']))){
    $newpage['page'] = 1;
}

$allcontent = $index->getAllContent('content');

$page = new Pagetool(count($allcontent),1,2);

var_dump($page->show());

$newdata = $index->useTaiwanTime($data,'createtime');

$contentdata = $index->buildindex($newdata); 

$smarty->assign('loginflag',$loginflag);
$smarty->assign('userinfo',$userinfo);
$smarty->assign('contentdata',$contentdata);

$smarty->display('./message/index.html');


?>