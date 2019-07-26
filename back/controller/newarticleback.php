<?php

require_once("../model/ContentModel.php");
require_once("../public/Filterword.php");

$article  = new ContentModel();

if(!isset($_COOKIE['token']) || empty($_COOKIE['token'])){
    $error['notlogin'] = '請登入會員';
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
} else {
    $checklogin = $article->getUser($_COOKIE['token']);
    if (empty($checklogin)) {
        $userinfo = [];
    } else {
        $userinfo = $checklogin;
        unset($userinfo['token']);
    }
}

$articleinfo['title'] = $_POST['title'];
$articleinfo['content'] = $_POST['content'];


$verification = [
    'title'=>array('notempty'=>'0'),
    'title'=>array('length'=>'1,30'),
    'content'=>array('notempty'=>'0'),
    'content'=>array('length'=>'1,1000'),
];

$article->auto_verification($articleinfo,$verification);



$errorMessage = [
    'length'=>'資料長度錯誤',
    'notempty'=>'未輸入'
];

if (!empty($article->geterrorInfo())) {  //檢查資料空白
    $error = $article->changeErrormessage($article->geterrorInfo(), $errorMessage);
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
}


$articleinfo['title'] = $article->useHtmlspecialchars($articleinfo['title']);
$articleinfo['content'] = $article->useHtmlspecialchars($articleinfo['content']);

$filterword = new Filterword("../public/filterword.txt");

$articleinfo['title'] = $filterword->usefilter($articleinfo['title']);
$articleinfo['content'] = $filterword->usefilter($articleinfo['content']);


$articleinfo['createtime'] = time();
$articleinfo['uid'] = $userinfo['uid'];

if ($article->addArticle($articleinfo) === 1) {
    echo json_encode(['success'=>'發佈成功'],JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(['success'=>'inserfail'],JSON_UNESCAPED_UNICODE);
}
