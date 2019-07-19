<?php
session_start();
require_once("../model/Model.php");

class IndexModel extends Model
{
    protected $table = "content";
    protected $pk = "conid";
    protected $filter = [];
    protected $verification = array();
    protected $errormessage =[];

    
}


?>