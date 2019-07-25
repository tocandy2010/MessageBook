<?php

require_once("../model/ContentModel.php");

$articledel  = new ContentModel();

$articledelinfo = $_GET;

$allowinfo = ['conid'];

$newarticledelinfo = $articledel->auto_filter($articledelinfo,$allowinfo);

if(!isset($_COOKIE['token']) || empty($_COOKIE['token'])){
    $userinfo = [];
} else {
    $checklogin = $articledel->getUser($_COOKIE['token']);
    if (empty($checklogin)) {
        $userinfo = [];
    } else {
        $userinfo = $checklogin;
        unset($userinfo['token']);
    }
}

if (empty($userinfo)) {
    echo 2;
    exit;
}

$content = $articledel->getContent($newarticledelinfo['conid']);
if ($content['uid'] !== $userinfo['uid']) {
    echo 0;
    exit;
}

if ($articledel->delArticl($newarticledelinfo['conid']) == 1) {
    echo 1;
} else {
    echo 0;
}







?>