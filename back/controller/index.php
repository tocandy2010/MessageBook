<?php

require_once("../model/IndexModel.php");

$index  = new IndexModel();

$page = $_GET;

$newpage = $index->auto_filter($page);

$condition = "status = 1 order by conid desc limit 0,3";
$data = $index->auto_selectAll($condition);

$newdata = $index->totaiwantime($data,'createtime');

$con = $index->getcon();
echo $index->buildindex($con,$newdata);
exit;




    










?>