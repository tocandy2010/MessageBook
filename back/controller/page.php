<?php

require_once("../model/PageModel.php");

$page = new PageModel();

$pageinfo = $_GET;

$allowpostinfo = ['page'];

$newpage = $page->auto_filter($page,$allowpostinfo);

$condition = 'status = 1';
$allcontentnum = $page->auto_selectAll('content',$condition);

$pagelen = $page->contentpage(count($allcontentnum));
echo $page->bulidpage($pagelen,$newpageinfo['page']);

