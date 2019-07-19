<?php
session_start();
require_once("../model/Model.php");

class EditinfoModel extends Model
{
    protected $table = "users";
    protected $pk = "uid";
    protected $filter = ['oldpassword','password','repassword','userName','email'];
    protected $verification = array(
        'oldpassword'=>array('notempty'=>'0'),
        'password'=>array('length'=>'6,12','notempty'=>'0'),
        'repassword'=>array('notempty'=>'0'),
        'userName'=>array('notempty'=>'0'),
        'email'=>array('email'=>'0','notempty'=>'0'),
    );
    protected $errormessage =[
        'notempty'=>'尚未輸入',
        'length'=>'資料長度錯誤',
        'email'=>'請輸入正eamil',
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

    public function onlynumandeng($str)   //驗證字串是只有英文和數字
    {
        return preg_match_all("/^[A-Za-z0-9]*$/",$str);
    }

    public function checkisedit($inpuatinfo,$userinfo)
    {
        unset($userinfo['uid']);
        unset($userinfo['account']);
        $row = array_diff($inpuatinfo,$userinfo);
        return empty($row);
    }

    public function checkuserName($str)   //轉義
    {
        return htmlspecialchars($str,ENT_QUOTES);
    }
    

}


?>