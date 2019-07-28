<?php

require_once("../model/Member.php");
require_once("../public/Commontool.php");

$commontool = new Commontool();
$editinfo = new Member();

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

$editinfinfo['userName'] = $_POST['userName'];
$editinfinfo['email'] = $_POST['email'];

$verification = [
    'userName'=>array('notempty' => '0'),
    'userName'=>array('length' => '1,20'),
    'email'=>array('notempty' => '0'),
    'email'=>array('email' => '0'),
];

$commontool->auto_verification($editinfinfo, $verification);
$errirMessage = $commontool->getErrorInfo();

if (!empty($errirMessage)) {
    echo json_encode($errirMessage, JSON_UNESCAPED_UNICODE);
    exit;
}

$editinfinfo['userName'] =  trim($editinfinfo['userName']);
$editinfinfo['userName'] = htmlspecialchars($editinfinfo['userName'], ENT_QUOTES);
$editinfinfo['userName'] = str_replace(" ", "", $editinfinfo['userName']);

if ($editinfinfo['userName'] === $userinfo['userName'] && $editinfinfo['email'] === $userinfo['email']) {
    $error['error'] = '未作任何修改';
    echo json_encode($error, JSON_UNESCAPED_UNICODE);
    exit;
}

if ($editinfo->editUserInfo($editinfinfo,$userinfo['uid']) === 1) {
    echo json_encode(['success' => "修改成功"], JSON_UNESCAPED_UNICODE);
}else {
    echo json_encode(['fail' => "修改失敗"], JSON_UNESCAPED_UNICODE);
}
