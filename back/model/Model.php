<?php


spl_autoload_register(function($class){
    require_once("../databases/{$class}.php");
});

class Model extends Mysql
{
    protected $table = '';  //表名稱
    protected $pk = '';   //主鍵
    protected $filter = []; //過濾器
    protected $con = '';

    public function auto_filter($arr){  //自動過濾 返回允許的陣列
        $data = [];
        foreach($arr as $k=>$v){
            if(in_array($k,$this->filter)){
                $data[$k] = $v;
            }
        }
        return $data;
    } 
    
    //htmlentities

    public function checkLength($data,$max,$min){  //檢查字串長度   字串,最大值,最小值
        $len = mb_strlen($data);
        if($len>=$min && $len <=$max){
            return true;
        }else{
            return false;
        }
    }

}

?>