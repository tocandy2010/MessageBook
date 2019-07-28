<?php

require_once("../model/ContentModel.php");
require_once("../model/Member.php");

$member  = new Member();
$content  = new ContentModel();


$articledelinfo['conid'] = $_GET['conid'];

if(!isset($_COOKIE['token']) || empty($_COOKIE['token'])){
    $userinfo = [];
} else {
    $checklogin = $member->getUser($_COOKIE['token']);
    if (empty($checklogin)) {
        echo json_encode(['notlogin'=>'請登入會員'] , JSON_UNESCAPED_UNICODE);
        exit;
    } else {
        $userinfo = $checklogin;
        unset($userinfo['token']);
    }
}

$contentdata = $content->getContent($articledelinfo['conid']);

if ($contentdata['uid'] !== $userinfo['uid']) {
    echo json_encode(['erroruser'=>'無法刪除'] , JSON_UNESCAPED_UNICODE);
    exit;
}

if ($content->delArticl($articledelinfo['conid']) == 1) {
    echo json_encode(['delsuccess'=>'刪除成功'] , JSON_UNESCAPED_UNICODE);
    exit;
} else {
    echo json_encode(['delfail'=>'刪除失敗'] , JSON_UNESCAPED_UNICODE);
}
