<?php

require_once("../model/ContentModel.php");
require_once("../smarty/smarty/public/Mysmarty.php");

$content  = new ContentModel();

$contentinfo = $_GET;

$newcontentinfo = $content->auto_filter($contentinfo);

// if($content->checkuserlogin()!==false){  //判斷是否燈入
//     $userinfo = $_SESSION['userinfo'];
// }else{
//     echo 2;
//     exit;
// }

$data = $content->auto_selectOne($contentinfo['article']);

$con = $content->getcon();

$getmessage = $content->getmessage($con,$newcontentinfo['article']);

if(count($getmessage)>=1){
    $allmessage = $content->findwhosend($con,$getmessage);
    $allmessage = $content->totaiwantime($allmessage,'createtime');
}else{
    $allmessage = [];
}

$smarty = new Mysmarty();

$smarty->assign('data',$data);
$smarty->assign('conid',$contentinfo['article']);
$smarty->assign('allmessage',$allmessage);

$smarty->display('content.html');



?>