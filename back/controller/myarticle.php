<?php

require_once("../model/MyarticleModel.php");

$myarticle  = new MyarticleModel();

$page = $_GET;

$newpage = $myarticle->auto_filter($page);

if($myarticle->checkuserlogin()!==false){  //判斷是否燈入
    $userinfo = $_SESSION['userinfo'];
}else{
    echo 2;
    exit;
}

$condition = 'uid  order by conid desc';
$data = $myarticle->auto_selectAll($condition);

$newdata = $myarticle->totaiwantime($data,'createtime');

$con = $myarticle->getcon();
echo $myarticle->buildindex($con,$newdata);
exit;



    










?>