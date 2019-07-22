<?php

require_once("../model/IndexModel.php");

$index  = new IndexModel();

$page = $_GET;

$newpage = $index->auto_filter($page);

if (is_null($newpage['page']) || !(is_numeric($newpage['page']))) {
    $newpage['page'] = 1;
}

$pagelen = ceil(count($index->auto_selectAll())/3);


if ($newpage['page']>$pagelen) {
    $newpage['page'] = 1;
}

$offset = ($newpage['page']-1)*3;

$condition = "status = 1 order by conid desc limit {$offset},3";
$data = $index->auto_selectAll($condition);

$newdata = $index->totaiwantime($data,'createtime');

$con = $index->getcon();

echo $index->buildindex($con,$newdata);
exit;




    










?>