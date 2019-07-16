<?php

require_once("../model/RegModel.php");

$reg  = new RegModel();

$reginfo = $_POST;

$newreginfo = $reg->auto_filter($reginfo);




?>