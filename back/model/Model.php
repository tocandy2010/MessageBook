<?php

require_once("../databases/Mysql.php");


class Model extends Mysql
{
    protected $table = '';  //表名稱
    protected $pk = '';   //主鍵
    protected $filter = []; //過濾器
    protected $con = '';
    protected $verification = [];     //自動驗證
    protected $errorInfo = [];   //驗證後的錯誤訊息放這
    protected $errormessage = [];  //錯誤訊息轉換

    public function auto_filter($arr)    //自動過濾 返回允許的陣列
    {
        $data = [];
        foreach ($arr as $k => $v) {
            if (in_array($k, $this->filter)) {
                $data[$k] = $v;
            }
        }
        return $data;
    }

    public function checkLength($data, $max, $min)  //檢查字串長度   字串,最大值,最小值 返回 true or false
    {
        $len = mb_strlen($data);
        if ($len >= $min && $len <= $max) {
            return true;
        } else {
            return false;
        }
    }

    public function auto_verification($arr)  //自動驗證
    {
        if (empty($arr)) {
            $this->errorInfo['empty'] = 'array is empty';
            return false;
        }
        foreach ($this->verification as $key => $value) {
            if (array_key_exists($key, $arr)) {
                foreach ($value as $k => $v) {
                    if (!$this->check_verification($k, $arr[$key], $v)) {
                        if (array_key_exists($key, $this->errorInfo)) {
                            $this->errorInfo[$key] .= ",{$k}";
                        } else {
                            $this->errorInfo[$key] = "{$k}";
                        }
                    }
                }
            }
        }
    }

    private function check_verification($key, $data, $v)  //自動驗證檢查
    {

        switch ($key) 
        {
            case 'length':  
                $len = mb_strlen($data);
                $res = explode(',', $v);
                return ($len >= $res[0] && $len <= $res[1]); //驗證字串長度
                break;
            case 'notempty':  
                return !empty($data); //驗證是否為空
                break;
            case 'email':  
                return !filter_var($data, FILTER_VALIDATE_EMAIL) === false; //驗證是否為email格式
        }
    }

    public function geterrorInfo()
    {    //自動驗證錯誤訊息  返回陣列
        return $this->errorInfo;
    }

    public function toerrormessage($data)  //錯誤訊息轉換
    {
        $error = explode(',', $data);
        foreach ($error as $k => $v) {
            if (array_key_exists($v, $this->errormessage)) {
                $error[$k] = $this->errormessage[$v];
            }
        }
        return $error;
    }
    public function isSame($a, $b)  //全等於比對 返回 true or false
    {
        return $a === $b;
    }

    public function checklogin($con,$token)
    {
        $sql = 'select * from users where token = ?';
        $res = $con->prepare($sql);
        $res->bindParam(1,$token);
        $res->execute();
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getheader($userinfo) //網站頭訊息   true false
    {
        $head = '';
            if (!empty($userinfo)) {
                $head .= "<li><a href=''><span></span>歡迎登入&nbsp{$userinfo['userName']}</a></li>";
                $head .= "<li><a href='../../back/controller/newarticle.php'><span></span>發佈文章</a></li>";
                $head .= "<li><a href='../../back/controller/myarticle.php'><span></span>已發佈文章</a></li>";
                $head .= "<li><a href='../../back/controller/editreg.php'><span></span>修改會員</a></li>";
                $head .= "<li><a href='../../back/controller/logout.php'><span></span>登出</a></li>";
            } else {
                $head .= "<li><a href='../../back/controller/login.php'><span></span>登入</a></li>";
                $head .= "<li><a href='../../back/controller/reg.php'><span></span>註冊</a></li>";
            }
        return $head;
    }

    
}
?>