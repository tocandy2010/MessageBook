<?php

require_once("../model/ContentModel.php");
require_once("../public/Filterword.php");
require_once("../model/Member.php");
require_once("../public/Commontool.php");

$commontool = new Commontool();
$member  = new Member();
$content = new ContentModel();

if(!isset($_COOKIE['token']) || empty($_COOKIE['token'])){
    $error['notlogin'] = '請登入會員';
    echo json_encode($error, JSON_UNESCAPED_UNICODE);
    exit;
} else {
    $checklogin = $member->getUser($_COOKIE['token']);
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
    'title'=>array('notempty' => '0'),
    'title'=>array('length' => '1,30'),
    'content'=>array('notempty' => '0'),
    'content'=>array('length' => '1,1000'),
];

$commontool->auto_verification($articleinfo, $verification);
$errirMessage = $commontool->getErrorInfo();

if (!empty($errirMessage)) {
    echo json_encode($errirMessage, JSON_UNESCAPED_UNICODE);
    exit;
}

$articleinfo['title'] = htmlspecialchars($articleinfo['title'], ENT_QUOTES);
$articleinfo['content'] = htmlspecialchars($articleinfo['content'], ENT_QUOTES);

$filterword = new Filterword("../public/filterword.txt");

$articleinfo['title'] = $filterword->usefilter($articleinfo['title']);
$articleinfo['content'] = $filterword->usefilter($articleinfo['content']);

$articleinfo['createtime'] = time();
$articleinfo['uid'] = $userinfo['uid'];

if ($content->addArticle($articleinfo) === 1) {
    echo json_encode(['success' => '發佈成功'], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(['fail' => '發佈失敗'], JSON_UNESCAPED_UNICODE);
}
