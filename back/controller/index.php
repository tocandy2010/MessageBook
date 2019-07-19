<?php

require_once("../model/IndexModel.php");

$index  = new IndexModel();


if($index->checkuserlogin()!==false){  //判斷是否燈入
    $userinfo = $_SESSION['userinfo'];
}else{
    echo 2;
    exit;
}

$data = $index->auto_selectAll();



?>