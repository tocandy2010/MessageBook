<?php

require_once("../model/ContentModel.php");

$articleedit  = new ContentModel();

$myarticleinfo = $_POST;

$allowinfo = ['editconid','title','content'];

$newmyarticleinfo = $articleedit->auto_filter($myarticleinfo,$allowinfo);

$verification = [
    'title'=>array('notempty'=>'0'),
    'content'=>array('notempty'=>'0'),
    'content'=>array('length'=>'1,1000'),
    'title'=>array('length'=>'1,30 '),
];

$articleedit->auto_verification($newmyarticleinfo,$verification);

$errorMessage = [
    'length'=>'資料長度錯誤',
    'notempty'=>'未輸入'
];

if(!empty($articleedit->geterrorInfo())){  //檢查資料空白
    $error = $articleedit->changeErrormessage($articleedit->geterrorInfo(),$errorMessage);
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
}

if(!isset($_COOKIE['token']) || empty($_COOKIE['token'])){
    $userinfo = [];
} else {
    $checklogin = $articleedit->getUser($_COOKIE['token']);
    if (empty($checklogin)) {
        $userinfo = [];
    } else {
        $userinfo = $checklogin;
        unset($userinfo['token']);
    }
}


if (empty($userinfo) ) {
    echo 2;
    exit;
}

$content = $articleedit->getContent($newmyarticleinfo['editconid']);

if ($content['uid'] !== $userinfo['uid'] ) {
    header('location: ./login.php');
    exit;
}

$newmyarticleinfo['title'] = $articleedit->useHtmlspecialchars($newmyarticleinfo['title']);
$newmyarticleinfo['content'] = $articleedit->useHtmlspecialchars($newmyarticleinfo['content']);

if ($content['title'] === $newmyarticleinfo['title'] && $content['content'] === $newmyarticleinfo['content']) {
    $error['error'] = "未做任何修改";
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
}

$conid = $newmyarticleinfo['editconid'];

unset($newmyarticleinfo['editconid']);

if ($articleedit->editContent($newmyarticleinfo,$conid) === 1) {
    echo 1;
} else {
    echo 0;
}



?>