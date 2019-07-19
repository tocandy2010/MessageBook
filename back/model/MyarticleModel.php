<?php
session_start();
require_once("../model/Model.php");

class MyarticleModel extends Model
{
    protected $table = "content";
    protected $pk = "conid";
    protected $filter = ['conid'];
    protected $verification = array();
    protected $errormessage =[];


    public function tohtmlspecialchars($str) //將傳過來的字串轉義
    {   
        return htmlspecialchars($str,ENT_QUOTES);
    }
    
    
    

}


?>