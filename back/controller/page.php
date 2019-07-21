<?php

require_once("../model/PageModel.php");

$page = new PageModel();

$pageinfo = $_GET;

$newpageinfo= $page->auto_filter($pageinfo);

$condition = 'status = 1';
$allcontentnum = $page->auto_selectAll($condition);

$pagelen = $page->contentpage(count($allcontentnum));
echo $page->bulidpage($pagelen,$newpageinfo['page']);
exit;
?>