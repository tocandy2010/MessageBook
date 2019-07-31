<?php

class Commontool {

    protected $errorInfo = [];

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

    public function getErrorInfo()
    {
        $errordata = [];

        $message = [
            'length'=>'資料長度錯誤',
            'notempty'=>'未輸入',
            'email'=>'請輸入正確email'
        ];

        if (!empty($this->errorInfo)) {
            foreach ($this->errorInfo as $errorkey => $errorval) {
                if (array_key_exists($errorval, $message)) {
                    $errordata[$errorkey] = $message[$errorval];
                }
            }
        }
        return $errordata;
    }

    /*
     * 傳入2維陣列陣列  找到對應的欄位名稱修改其時間為台灣時間格式 Y-M-D H:i:s
     */
    public function useTaiwanTime($arr,$name)  //傳入陣列  找到對應的欄位名稱修改其時間為台灣時間格式 Y-M-D H:i:s
    {
        date_default_timezone_set("Asia/Taipei");
        foreach($arr as $k=>$v){
            if(isset($v[$name])){
                $arr[$k][$name] = date("Y-m-d H:i:s",$v[$name]);
                
            }
        }
        return $arr;
    }
}
