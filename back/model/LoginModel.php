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

    /*public function isSame($a,$b){  //全等於比對 返回 true or false
        return $a === $b;
    }*/

}


?>