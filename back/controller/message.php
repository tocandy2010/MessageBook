<?php

require_once("../model/ContentModel.php");
require_once("../public/Filterword.php");
require_once("../model/Member.php");
require_once("../public/Commontool.php");

$member = new Member();

## 判斷使用者是否登入
if (!isset($_COOKIE['token']) || empty($_COOKIE['token'])) {
    echo json_encode(['notlogin'=>'請登入會員'], JSON_UNESCAPED_UNICODE);
    exit;
} else {
    $checklogin = $member->getUser($_COOKIE['token']);
    if (empty($checklogin)) {
        echo json_encode(['notlogin'=>'請登入會員'], JSON_UNESCAPED_UNICODE);
        exit;
    } else {
        $userinfo = $checklogin;
        unset($userinfo['token']);
    }
}

## 限制用戶 5秒才能留言一次
if (isset($_COOKIE['tofast']) || !empty($_COOKIE['tofast'])) {
    echo json_encode(['tofast' => "留言速度過快，請收後再試"], JSON_UNESCAPED_UNICODE);
    exit;
} else {
    setcookie("tofast" ,time() , time()+5, '/');
}

$content  = new ContentModel();
$commontool = new Commontool();

$messageinfo['conid'] = $_POST['conid'];
$messageinfo['message'] = $_POST['message'];

## 設定傳入資料格式
$verification = [
    'message'=>array('notempty' => '0'),
    'message'=>array('length' => '1,100'),
];

## 檢查傳入的資料格式
$commontool->auto_verification($messageinfo, $verification);
$errirMessage = $commontool->getErrorInfo();
if (!empty($errirMessage)) {
    echo json_encode($errirMessage, JSON_UNESCAPED_UNICODE);
    exit;
}

## 過濾留言訊息前後空白及不雅文字及轉義
$filterword = new Filterword("../public/filterword.txt");
$messageinfo['message'] = trim($messageinfo['message']);
$messageinfo['message'] = $filterword->usefilter(htmlspecialchars($messageinfo['message'], ENT_QUOTES));
$messageinfo['uid'] = $userinfo['uid'];
$messageinfo['conid'] = $messageinfo['conid'];
$messageinfo['createtime'] = time();

## 寫入資料庫
if ($content->setMessage($messageinfo) === 1) {
    echo json_encode(['success' => "留言成功"], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(['fail' => "留言失敗"], JSON_UNESCAPED_UNICODE);
}
