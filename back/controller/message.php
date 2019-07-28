<?php

require_once("../model/ContentModel.php");
require_once("../public/Filterword.php");
require_once("../model/Member.php");
require_once("../public/Commontool.php");

$commontool = new Commontool();
$member = new Member();
$content  = new ContentModel();

if (!isset($_COOKIE['token']) || empty($_COOKIE['token'])) {
    echo json_encode(['notlogin'=>'請登入會員'] , JSON_UNESCAPED_UNICODE);
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

if (isset($_COOKIE['tofast']) || !empty($_COOKIE['tofast'])) {
    echo json_encode(['tofast' => "留言速度過快，請收後再試"], JSON_UNESCAPED_UNICODE);
    exit;
} else {
    setcookie("tofast" ,time() , time()+5, '/');
}

$messageinfo['conid'] = $_POST['conid'];
$messageinfo['message'] = $_POST['message'];

$verification = [
    'message'=>array('notempty' => '0'),
    'message'=>array('length' => '1,100'),
];

$commontool->auto_verification($messageinfo, $verification);
$errirMessage = $commontool->getErrorInfo();

if (!empty($errirMessage)) {
    echo json_encode($errirMessage, JSON_UNESCAPED_UNICODE);
    exit;
}

$filterword = new Filterword("../public/filterword.txt");
$messageinfo['message'] = $filterword->usefilter(htmlspecialchars($messageinfo['message'], ENT_QUOTES));
$messageinfo['uid'] = $userinfo['uid'];
$messageinfo['conid'] = $messageinfo['conid'];
$messageinfo['createtime'] = time();


if ($content->setMessage($messageinfo) == 1) {
    unset($messageinfo['uid']);
    $messageinfo['userName'] = $userinfo['userName'];
    date_default_timezone_set("Asia/Taipei");
    $messageinfo['createtime'] = date("Y-m-d H:i:s", $messageinfo['createtime']);
    echo json_encode(['success' => "留言成功"], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(['fail' => "留言失敗"], JSON_UNESCAPED_UNICODE);
}
