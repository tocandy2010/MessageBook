<?php
session_start();
require_once("../model/Model.php");

class LoginModel extends Model
{
    protected $table = "users";
    protected $pk = "uid";
    protected $filter = ['account','password','vcode','remember'];
    protected $verification = array(
        'account'=>array('notempty'=>'0'),
        'password'=>array('notempty'=>'0'),
        'vcode'=>array('notempty'=>'0'),
    );
    protected $errormessage =[
        'notempty'=>'尚未輸入'
    ];
    
    public function checkaccount($account,$show = PDO::FETCH_ASSOC)
    {
        $sql = "select * from {$this->table} where account = ?";
        $res = $this->con->prepare($sql);
        $res->bindParam(1, $account);
        $res->execute();
        if ($show == 'index') {
            $show = PDO::FETCH_NUM;
            return $res->fetch($show);
        }
        return $res->fetch($show);
    }

    public function checkpassword($inputpassword,$sqlpassword)
    {
        return password_verify($inputpassword,$sqlpassword);
    }

    public function create_token()  //產生token
    {
        $str = "abcdefghijklmnopqrstuvwxyz";
        $str .= strtoupper($str);
        $str .= "0123456789";
        $str .= "+-*/$.?:";
        $str = str_repeat($str,10);
        $str = str_shuffle($str);
        $token = substr($str,0,100);
        return $token;
    }

}


?>