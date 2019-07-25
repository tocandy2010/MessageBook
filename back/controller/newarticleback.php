<?php

require_once("../model/ContentModel.php");
require_once("../public/Filterword.php");


$newarticle  = new ContentModel();

$articleinfo = $_POST;

$allowinfo = ['title','content'];

$newarticleinfo = $newarticle->auto_filter($articleinfo,$allowinfo);

$verification = [
    'title'=>array('notempty'=>'0'),
    'title'=>array('length'=>'1,30'),
    'content'=>array('notempty'=>'0'),
    'content'=>array('length'=>'1,1000'),
];

$newarticle->auto_verification($newarticleinfo,$verification);

if(!isset($_COOKIE['token']) || empty($_COOKIE['token'])){
    echo 2 ;
    exit;
} else {
    $checklogin = $newarticle->getUser($_COOKIE['token']);
    if (empty($checklogin)) {
        $userinfo = [];
    } else {
        $userinfo = $checklogin;
        unset($userinfo['token']);
    }
}

$errorMessage = [
    'length'=>'資料長度錯誤',
    'notempty'=>'未輸入'
];

if (!empty($newarticle->geterrorInfo())) {  //檢查資料空白
    $error = $newarticle->changeErrormessage($newarticle->geterrorInfo(),$errorMessage);
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
}


$newarticleinfo['title'] = $newarticle->useHtmlspecialchars($newarticleinfo['title']);
$newarticleinfo['content'] = $newarticle->useHtmlspecialchars($newarticleinfo['content']);

$filterword = new Filterword("../public/filterword.txt");

$newarticleinfo['title'] = $filterword->usefilter($newarticleinfo['title']);
$newarticleinfo['content'] = $filterword->usefilter($newarticleinfo['content']);


$newarticleinfo['createtime'] = time();
$newarticleinfo['uid'] = $userinfo['uid'];

if ($newarticle->createArticle($newarticleinfo)==1) {
    echo 1;
} else {
    echo 2;
}

?>