<?php
session_start();
require_once("../model/Model.php");

class MessageModel extends Model
{
    protected $table = "message";
    protected $pk = "mesid";
    protected $filter = ['message','conid'];
    protected $verification = array(
        'message'=>array('notempty'=>'0'),
        'message'=>array('length'=>'1,255'),
    );
    protected $errormessage =[
        'notempty'=>'尚未輸入',
        'length'=>'資料長度錯誤'
    ];

    public function tohtmlspecialchars($str) //將傳過來的字串轉義
    {   
        return htmlspecialchars($str,ENT_QUOTES);
    }
    
    
    

}


?>