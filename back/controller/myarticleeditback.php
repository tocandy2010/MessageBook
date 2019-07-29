<?php

require_once("../model/ContentModel.php");
require_once("../model/Member.php");
require_once("../public/Commontool.php");
require_once("../public/Filterword.php");

$member  = new Member();

## 判斷使用者是否登入
if (!isset($_COOKIE['token']) || empty($_COOKIE['token'])) {
    $error['notlogin'] = "請先登入會員";
    echo json_encode($error, JSON_UNESCAPED_UNICODE);
    exit;
} else {
    $checklogin = $member->getUser($_COOKIE['token']);
    if (empty($checklogin)) {
        $error['notlogin'] = "請先登入會員";
        echo json_encode($error, JSON_UNESCAPED_UNICODE);
        exit;
    } else {
        $userinfo = $checklogin;
        unset($userinfo['token']);
    }
}

$content  = new ContentModel();
$commontool = new Commontool();

$myarticleinfo['editconid'] = $_POST['editconid'];
$myarticleinfo['title'] = trim($_POST['title']);
$myarticleinfo['content'] = trim($_POST['content']);

## 設定傳入資料格式
$verification = [
    'title'=>array('notempty' => '0'),
    'title'=>array('length' => '1,30'),
    'content'=>array('notempty' => '0'),
    'content'=>array('length' => '1,1000'),
];
## 檢查傳入的資料格式
$commontool->auto_verification($myarticleinfo, $verification);
$errirMessage = $commontool->getErrorInfo();
if (!empty($errirMessage)) {
    echo json_encode($errirMessage, JSON_UNESCAPED_UNICODE);
    exit;
}

## 根據文章 id 檢查使否為該用戶的文章 
$oldcontentdata = $content->getContent($myarticleinfo['editconid']);
if ($oldcontentdata['uid'] !== $userinfo['uid'] ) {
    echo json_encode(['notmyarticle' => '非本會員文章'], JSON_UNESCAPED_UNICODE);
    exit;
}

## 傳入的資料檢查
$filterword = new Filterword("../public/filterword.txt");
$myarticleinfo['title'] = $filterword->useFilter($myarticleinfo['title']);
$myarticleinfo['content'] = $filterword->useFilter($myarticleinfo['content']);
$myarticleinfo['title'] = htmlspecialchars($myarticleinfo['title'], ENT_QUOTES);
$myarticleinfo['content'] = htmlspecialchars($myarticleinfo['content'], ENT_QUOTES);

## 檢查本次內容是否有修改
if ($oldcontentdata['title'] === $myarticleinfo['title'] && $oldcontentdata['content'] === $myarticleinfo['content']) {
    $error['notanyedit'] = "未有任何修改";
    echo json_encode($error, JSON_UNESCAPED_UNICODE);
    exit;
}

$conid = $myarticleinfo['editconid'];
unset($myarticleinfo['editconid']);

## 修改文章
if ($content->editContent($myarticleinfo, $conid) == 1) {
    echo json_encode(['success' => '修改成功'], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(['fail' => '修改失敗'], JSON_UNESCAPED_UNICODE);
}
