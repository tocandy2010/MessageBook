<?php

require_once("../model/ArticleModel.php");

$article  = new ArticleModel();

$articleinfo = $_POST;


$newarticleinfo = $article->auto_filter($articleinfo);

$article->auto_verification($newarticleinfo);


if ($article->checkuserlogin()!==false){  //判斷是否燈入
    $userinfo = $_SESSION['userinfo'];
} else {
    echo 2;
    exit;
}

if (!empty($article->geterrorInfo())){  //檢查資料空白
    $error = [];
    foreach($article->geterrorInfo() as $k=>$v){
        $errormessage = $article->toerrormessage($v);
        $error[$k] = implode('、',$errormessage);
    }
    echo json_encode($error,JSON_UNESCAPED_UNICODE);
    exit;
}

$newarticleinfo['title'] = $article->tohtmlspecialchars($newarticleinfo['title']);
$newarticleinfo['content'] = $article->tohtmlspecialchars($newarticleinfo['content']);


if (isset($newarticleinfo['editconid'])){
    $editconid = $newarticleinfo['editconid'];
    unset($newarticleinfo['editconid']);
    if ($article->auto_update($newarticleinfo,$editconid)==1){
        echo 1;
    } else {
        echo 0;
    }
    exit;
}


$newarticleinfo['createtime'] = time();
$newarticleinfo['uid'] = $userinfo['uid'];

if ($article->auto_insert($newarticleinfo)==1){
    echo 1;
} else {
    echo 0;
}

?>