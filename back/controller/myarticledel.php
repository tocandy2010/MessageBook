<?php

require_once("../model/ContentModel.php");
require_once("../model/Member.php");

$member  = new Member();

## 判斷使用者是否登入
if(!isset($_COOKIE['token']) || empty($_COOKIE['token'])){
    echo json_encode(['notlogin'=>'請登入會員'] , JSON_UNESCAPED_UNICODE);
    exit;
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

$content  = new ContentModel();

$articledelinfo['conid'] = $_GET['conid'];

## 獲得文章資訊並檢查傳過來的文章是否屬於使用者的
$contentdata = $content->getContent($articledelinfo['conid']);
if ($contentdata['uid'] !== $userinfo['uid']) {
    echo json_encode(['erroruser'=>'無法刪除本文章'] , JSON_UNESCAPED_UNICODE);
    exit;
}


## 將文章狀態修改為0
if ($content->delArticl($articledelinfo['conid']) === 1) {
    echo json_encode(['delsuccess'=>'刪除成功'] , JSON_UNESCAPED_UNICODE);
    exit;
} else {
    echo json_encode(['delfail'=>'刪除失敗'] , JSON_UNESCAPED_UNICODE);
}
