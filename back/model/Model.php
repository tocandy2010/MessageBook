<?php

require_once("../databases/Mysql.php");


class Model extends Mysql
{
    protected $errorInfo = [];

    public function auto_filter($postinfo,$allowinfo)    //自動過濾 返回允許的陣列
    {
        $data = [];
        foreach ($postinfo as $k => $v) {
            if (in_array($k, $allowinfo)) {
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

    public function auto_verification($arr,$verification)  //自動驗證
    {
        if (empty($arr)) {
            $this->errorInfo['empty'] = 'array is empty';
            return false;
        }
        foreach ($verification as $key => $value) {
            if (array_key_exists($key, $arr)) {
                foreach ($value as $k => $v) {
                    if (!$this->check_verification($k, $arr[$key], $v)) {
                        if (!array_key_exists($key, $this->errorInfo)) {
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
    
}
?>