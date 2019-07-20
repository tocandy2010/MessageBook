<?php

require_once("../model/IndexModel.php");

$index  = new IndexModel();

$page = $_GET;

$newpage = $index->auto_filter($page);

if($index->checkuserlogin()!==false){  //判斷是否燈入
    $userinfo = $_SESSION['userinfo'];
}else{
    echo 2;
    exit;
}

$condition = '1 order by conid desc';

$data = $index->auto_selectAll($condition);

$newdata = $index->totaiwantime($data,'createtime');

$con = $index->getcon();
echo $index->buildindex($con,$newdata);
exit;




    










?>