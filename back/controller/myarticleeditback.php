<?php

require_once("../model/ContentModel.php");
require_once("../model/Member.php");
require_once("../public/Commontool.php");

$commontool = new Commontool();
$member  = new Member();
$content  = new ContentModel();

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

$myarticleinfo['editconid'] = $_POST['editconid'];
$myarticleinfo['title'] = $_POST['title'];
$myarticleinfo['content'] = $_POST['content'];


$verification = [
    'title'=>array('notempty' => '0'),
    'title'=>array('length' => '1,30'),
    'content'=>array('notempty' => '0'),
    'content'=>array('length' => '1,1000'),
];

$errorMessage = [
    'length'=>'資料長度錯誤',
    'notempty'=>'未輸入'
];

$commontool->auto_verification($myarticleinfo, $verification);
$errirMessage = $commontool->getErrorInfo();

if (!empty($errirMessage)) {
    echo json_encode($errirMessage, JSON_UNESCAPED_UNICODE);
    exit;
}

$contentdata = $content->getContent($myarticleinfo['editconid']);

if ($contentdata['uid'] !== $userinfo['uid'] ) {
    header('location: ./login.php');
    exit;
}

$myarticleinfo['title'] = htmlspecialchars($myarticleinfo['title'], ENT_QUOTES);
$myarticleinfo['content'] = htmlspecialchars($myarticleinfo['content'], ENT_QUOTES);

if ($contentdata['title'] === $myarticleinfo['title'] && $contentdata['content'] === $myarticleinfo['content']) {
    $error['notanyedit'] = "未有任何修改";
    echo json_encode($error, JSON_UNESCAPED_UNICODE);
    exit;
}

$conid = $myarticleinfo['editconid'];

unset($myarticleinfo['editconid']);

if ($content->editContent($myarticleinfo,$conid) === 1) {
    echo json_encode(['success' => '修改成功'], JSON_UNESCAPED_UNICODE);
} else {
    echo 0;
}
