<?php

require_once("../model/Model.php");

class RegModel extends Model
{
    protected $table = "users";
    protected $pk = "uid";
    protected $filter = ['account','password','repassword','userName','email'];
    protected $verification = array(
        'account'=>array('length'=>'6,20','notempty'=>'0'),
        'password'=>array('length'=>'6,20','notempty'=>'0'),
        'userName'=>array('length'=>'1,100','notempty'=>'0'),
        'email'=>array('email'=>'0','notempty'=>'0'),
    );
    protected $errormessage =[
        'length'=>'資料長度錯誤',
        'email'=>'請輸入正eamil',
        'notempty'=>'尚未輸入'
    ];
    protected $errorInfo = [];   //驗證後的錯誤訊息放這

    public function checkVcode($data){   //驗證使用者輸入的驗證碼是否相符 返回 true or false
        return $data === $_SESSION['vcode'];
    }
    
    /*public function isSame($a,$b){  //全等於比對 返回 true or false
        return $a === $b;
    }*/

    public function onlynumandeng($str){   //驗證字串是只有英文和數字
        return preg_match_all("/^[A-Za-z0-9]*$/",$str);
    }

    public function checkuserName($str){
        return htmlspecialchars($str,ENT_QUOTES);
    }
    
    public function checkreged($name,$data, $show = PDO::FETCH_ASSOC)   //傳入key 和value 
    {
        $sql = "select * from {$this->table} where {$name} = ?";
        $res = $this->con->prepare($sql);
        $res->bindParam(1, $data);
        $res->execute();
        if ($show == 'index') {
            $show = PDO::FETCH_NUM;
            return $res->fetch($show);
        }
        return $res->fetch($show);
    }
}


?>