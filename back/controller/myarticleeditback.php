<?php

require_once("../model/ContentModel.php");

$articleedit  = new ContentModel();

if(!isset($_COOKIE['token']) || empty($_COOKIE['token'])){
    $error['notlogin'] = "123";
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
} else {
    $checklogin = $articleedit->getUser($_COOKIE['token']);
    if (empty($checklogin)) {
        $error['notlogin'] = "未做任何修改";
        echo json_encode($error,JSON_UNESCAPED_UNICODE);
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
    'title'=>array('notempty'=>'0','length'=>'1,30'),
    'content'=>array('notempty'=>'0','length'=>'1,1000'),
];

$articleedit->auto_verification($myarticleinfo,$verification);

$errorMessage = [
    'length'=>'資料長度錯誤',
    'notempty'=>'未輸入'
];

if(!empty($articleedit->geterrorInfo())){  //檢查資料空白
    $error = $articleedit->changeErrormessage($articleedit->geterrorInfo(),$errorMessage);
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
}

$content = $articleedit->getContent($myarticleinfo['editconid']);

if ($content['uid'] !== $userinfo['uid'] ) {
    header('location: ./login.php');
    exit;
}

$myarticleinfo['title'] = $articleedit->useHtmlspecialchars($myarticleinfo['title']);
$myarticleinfo['content'] = $articleedit->useHtmlspecialchars($myarticleinfo['content']);

if ($content['title'] === $myarticleinfo['title'] && $content['content'] === $myarticleinfo['content']) {
    $error['notanyedit'] = "未做任何修改";
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
}

$conid = $myarticleinfo['editconid'];

unset($myarticleinfo['editconid']);

if ($articleedit->editContent($myarticleinfo,$conid) === 1) {
    echo 1;
} else {
    echo 0;
}
