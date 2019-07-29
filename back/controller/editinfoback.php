<?php

require_once("../model/Member.php");
require_once("../public/Commontool.php");

$editinfo = new Member();

## 判斷使用者是否登入
if (!isset($_COOKIE['token']) || empty($_COOKIE['token'])) {
    echo json_encode(['notlogin' => "請先登入會員"], JSON_UNESCAPED_UNICODE);
    exit;
} else {
    $checklogin = $editinfo->getUser($_COOKIE['token']);
    if (empty($checklogin)) {
        echo json_encode(['notlogin' => "請先登入會員"], JSON_UNESCAPED_UNICODE);
        exit;
    } else {
        $userinfo = $checklogin;
        unset($userinfo['token']);
    }
}

$commontool = new Commontool();

$editinfinfo['userName'] = $_POST['userName'];
$editinfinfo['email'] = $_POST['email'];

## 檢查是否有修改
if ($editinfinfo['userName'] === $userinfo['userName'] && $editinfinfo['email'] === $userinfo['email']) {
    echo json_encode(['notanyedit' => '未作任何修改'], JSON_UNESCAPED_UNICODE);
    exit;
}

## 設定傳入資料格式
$verification = [
    'userName'=>array('notempty' => '0'),
    'userName'=>array('length' => '1,20'),
    'email'=>array('notempty' => '0'),
    'email'=>array('email' => '0'),
];
## 檢查傳入的資料格式
$commontool->auto_verification($editinfinfo, $verification);
$errirMessage = $commontool->getErrorInfo();
if (!empty($errirMessage)) {
    echo json_encode($errirMessage, JSON_UNESCAPED_UNICODE);
    exit;
}

## 過濾前後空白並轉義
$editinfinfo['userName'] = htmlspecialchars($editinfinfo['userName'], ENT_QUOTES);
$editinfinfo['userName'] = str_replace(" ", "", $editinfinfo['userName']);

## 修改資訊
if ($editinfo->editUserInfo($editinfinfo,$userinfo['uid']) === 1) {
    echo json_encode(['success' => "修改成功"], JSON_UNESCAPED_UNICODE);
}else {
    echo json_encode(['fail' => "修改失敗"], JSON_UNESCAPED_UNICODE);
}
