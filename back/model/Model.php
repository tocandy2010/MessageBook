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

    public function auto_filter($arr){  //自動過濾 返回允許的陣列
        $data = [];
        foreach($arr as $k=>$v){
            if(in_array($k,$this->filter)){
                $data[$k] = $v;
            }
        }
        return $data;
    } 
    
    public function checkLength($data,$max,$min){  //檢查字串長度   字串,最大值,最小值 返回 true or false
        $len = mb_strlen($data);
        if($len>=$min && $len <=$max){
            return true;
        }else{
            return false;
        }
    }

    public function auto_verification($arr){    //自動驗證
        if(empty($arr)){
            $this->errorInfo['empty'] = 'array is empty';
            return false;
        }
        foreach($this->verification as $key=>$value){
            if(array_key_exists($key,$arr)){
                foreach($value as $k=>$v){
                    if(!$this->check_verification($k,$arr[$key],$v)){
                        if(array_key_exists($key,$this->errorInfo)){
                            $this->errorInfo[$key].=",{$k}";
                        }else{
                            $this->errorInfo[$key]="{$k}";
                        }
                    }
                }
            }
        }

    }

    private function check_verification($key,$data,$v){   //自動驗證檢查
        switch($key){
            case 'length':  //驗證字串長度
                $len = mb_strlen($data);
                $res = explode(',',$v);
                return ($len>=$res[0] && $len <=$res[1]);
                break;
            case 'notempty':  //驗證是否為空
                return !empty($data);
                break;
            case 'email' :  //驗證是否為email格式
                return !filter_var($data, FILTER_VALIDATE_EMAIL) === false;
        }
    }

    public function geterrorInfo(){    //自動驗證錯誤訊息  返回陣列
        return $this->errorInfo;
    }

    public function toerrormessage($data){  //錯誤訊息轉換
        $error = explode(',',$data);
        foreach($error as $k=>$v){
            if(array_key_exists($v,$this->errormessage)){
                $error[$k] = $this->errormessage[$v];
            }
        }
        return $error;
    }
    public function isSame($a,$b){  //全等於比對 返回 true or false
        return $a === $b;
    }

    public function checkuserlogin(){  //確認用戶使否登入
        return isset($_SESSION['userinfo'])&&!empty($_SESSION['userinfo']);
    }


}

?>