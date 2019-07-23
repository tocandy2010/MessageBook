<?php

require_once("../smarty/smarty/public/Mysmarty.php");
require_once("../model/IndexModel.php");

$index  = new IndexModel();
$smarty = new Mysmarty();

if(!isset($_COOKIE['token']) || empty($_COOKIE['token'])){
    $userinfo = [];
} else {
    $con = $index->getcon();

    $checklogin = $index->checklogin($con,$_COOKIE['token']);

    if (empty($checklogin)) {
        $userinfo = [];
    } else {
        $userinfo = $checklogin[0];
        unset($userinfo['token']);
    }
}


$loginflag = !empty($userinfo);

$page = $_GET;

$allowpostinfo = ['page'];

$newpage = $index->auto_filter($page,$allowpostinfo);

if (!isset($newpage['page']) || is_null($newpage['page']) || !(is_numeric($newpage['page']))){
    $newpage['page'] = 1;
}

$pagelen = ceil(count($index->auto_selectAll('content'))/3);

if ($newpage['page']>$pagelen){
    $newpage['page'] = 1;
}

$offset = ($newpage['page']-1)*3;

$condition = "status = 1 order by conid desc limit {$offset},3";
$data = $index->auto_selectAll('content',$condition);

$newdata = $index->totaiwantime($data,'createtime');

$con = $index->getcon();
$contentdata = $index->buildindex($con,$newdata); 




$smarty->assign('loginflag',$loginflag);
$smarty->assign('userinfo',$userinfo);
$smarty->assign('contentdata',$contentdata);

$smarty->display('./message/index.html');


?>