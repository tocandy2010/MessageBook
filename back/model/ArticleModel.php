<?php
session_start();
require_once("../model/Model.php");

class ArticleModel extends Model
{
    protected $table = "content";
    protected $pk = "conid";
    protected $filter = ['title','content','editconid'];
    protected $verification = array(
        'title'=>array('length'=>'1,255','notempty'=>'0'),
        'content'=>array('length'=>'1,1000','notempty'=>'0'),
    );
    protected $errormessage =[
        'notempty'=>'尚未輸入',
        'length'=>'資料長度錯誤',
    ];


    public function tohtmlspecialchars($str) //將傳過來的字串轉義
    {   
        return htmlspecialchars($str,ENT_QUOTES);
    }
    
    
    

}


?>