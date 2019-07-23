<?php
require_once("../model/Model.php");

class Member extends Model
{
    public function getVcode(){   //驗證使用者輸入的驗證碼是否相符 返回 true or false
        return $_SESSION['vcode'];
    }

    public function onlyNumandEng($str){   //驗證字串是只有英文和數字
        return preg_match_all("/^[A-Za-z0-9]*$/",$str);
    }
    
    public function changeErrormessage($errorInfo,$changeInfo)
    {
        $error = [];
        foreach ($errorInfo as $k=>$v) {
            $errormessage = $this->setErrormessage($v,$changeInfo);
            $error[$k] = implode('、',$errormessage);
        }
        return $error;
    }

    protected function setErrormessage($data,$changeInfo)  //錯誤訊息轉換中文
    {
        $error = explode(',', $data);
        foreach ($error as $k => $v) {
            if (array_key_exists($v, $changeInfo)) {
                $error[$k] = $changeInfo[$v];
            }
        }
        return $error;
    }

    public function checkReged($name,$value, $show = PDO::FETCH_ASSOC)   //檢查是否已被註冊 key和value 
    {
        $sql = "select * from users where {$name} = ?";
        $res = $this->con->prepare($sql);
        $res->bindParam(1, $value);
        $res->execute();
        if ($show == 'index') {
            $show = PDO::FETCH_NUM;
            return $res->fetch($show);
        }
        return $res->fetch($show);
    }

    public function getAccount($account,$show = PDO::FETCH_ASSOC)  //取得帳號是否存在
    {
        $sql = "select * from users where account = ?";
        $res = $this->con->prepare($sql);
        $res->bindParam(1, $account);
        $res->execute();
        if ($show == 'index') {
            $show = PDO::FETCH_NUM;
            return $res->fetch($show);
        }
        return $res->fetch($show);
    }

    public function checkPassword($inputpassword,$sqlpassword)  //檢查密碼是否存在
    {
        return password_verify($inputpassword,$sqlpassword);
    }

    public function createToken($uid)  //產生token 100個字
    {
        $str = "abcdefghijklmnopqrstuvwxyz";
        $str .= strtoupper($str);
        $str .= "0123456789";
        $str .= "+-*/$.?:";
        $str = str_repeat($str,10);
        $str = str_shuffle($str);
        $token = substr($str,0,100).$uid;
        return $token;
    }

    public function setToken($table,$arr,$pk,$id){  //設定資料庫token
        return $this->auto_update($table,$arr,$pk,$id);
    }

    public function addUser($table,$userinfo) //註冊用戶
    {
        return $userinfo;
        return $this->auto_insert($table,$userinfo);
    }

    public function encryptionPassword($password)   //加密
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function useHtmlspecialchars($str)   //符號轉義
    {
        return htmlspecialchars($str,ENT_QUOTES);
    }

        
    protected function addErrorinfo($arr){  //增加錯誤訊息
        foreach ($arr as $k=>$v) {
            if (!array_key_exists($k,$this->errorInfo)) {
                $this->errorInfo[$k] = $v;  
            }
        }
    }

    public function checkSame($a, $b)  //全等於比對 返回 true or false
    {
        return $a === $b;
    }

    public function checkLogin($token)   //cookie判斷是否登入
    {
        $sql = 'select * from users where token = ?';
        $res = $this->con->prepare($sql);
        $res->bindParam(1,$token);
        $res->execute();
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
}


?>