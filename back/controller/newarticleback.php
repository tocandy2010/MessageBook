<?php

require_once("../model/ContentModel.php");
require_once("../public/Filterword.php");
require_once("../model/Member.php");
require_once("../public/Commontool.php");


$member  = new Member();

## 判斷使用者是否登入
if(!isset($_COOKIE['token']) || empty($_COOKIE['token'])){
    $error['notlogin'] = '請登入會員';
    echo json_encode($error, JSON_UNESCAPED_UNICODE);
    exit;
} else {
    $checklogin = $member->getUser($_COOKIE['token']);
    if (empty($checklogin)) {
        $error['notlogin'] = '請登入會員';
        echo json_encode($error, JSON_UNESCAPED_UNICODE);
        exit;
    } else {
        $userinfo = $checklogin;
        unset($userinfo['token']);
    }
}

$content = new ContentModel();
$commontool = new Commontool();

$articleinfo['title'] = trim($_POST['title']);
$articleinfo['content'] = trim($_POST['content']);

## 設定傳入資料格式
$verification = [
    'title'=>array('notempty' => '0'),
    'title'=>array('length' => '1,30'),
    'content'=>array('notempty' => '0'),
    'content'=>array('length' => '1,1000'),
];

## 傳入的資料檢查
$commontool->auto_verification($articleinfo, $verification);
$errirMessage = $commontool->getErrorInfo();
if (!empty($errirMessage)) {
    echo json_encode($errirMessage, JSON_UNESCAPED_UNICODE);
    exit;
}


## 過濾不雅文字及轉義
$filterword = new Filterword("../public/filterword.txt");
$articleinfo['title'] = $filterword->useFilter($articleinfo['title']);
$articleinfo['content'] = $filterword->useFilter($articleinfo['content']);
$articleinfo['title'] = htmlspecialchars($articleinfo['title'], ENT_QUOTES);
$articleinfo['content'] = htmlspecialchars($articleinfo['content'], ENT_QUOTES);


$articleinfo['createtime'] = time();
$articleinfo['uid'] = $userinfo['uid'];

## 寫入資料庫
if ($content->addArticle($articleinfo) === 1) {
    echo json_encode(['success' => '發佈成功'], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(['fail' => '發佈失敗'], JSON_UNESCAPED_UNICODE);
}
