<?php

require_once("../model/Model.php");

class ContentModel extends Model 
{

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

    public function findarticler($pdo,$uid)
    {
        $sql = "select * from users where uid = {$uid}";
        $res = $pdo->prepare($sql);
        $res->execute();
        return $res->fetch(PDO::FETCH_ASSOC);
    }

    public function tohtmlspecialchars($str) //將傳過來的字串轉義
    {   
        return htmlspecialchars($str,ENT_QUOTES);
    }

    public function useHtmlspecialchars($str)   //符號轉義
    {
        return htmlspecialchars($str,ENT_QUOTES);
    }

    public function getmessage($pdo,$conid)  //找索此文章的所有留言
    {
        $sql = "select * from message where conid = {$conid} order by createtime desc";
        $res = $pdo->prepare($sql);
        $res->execute();
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findwhosend($pdo,$arr)  
    {
        $sql = "select userName,account from users where uid = ?";
        $res = $pdo->prepare($sql);
        foreach ($arr as $k=>$v) {
            $res->bindValue(1,$v['uid']);
            $res->execute();
            $data = $res->fetch(PDO::FETCH_ASSOC);
            $arr[$k]['userName'] = $data['userName'];
            $arr[$k]['account'] = $data['account'];
        }
        return $arr;
    }

    public function onlynumandeng($str)   //驗證字串是只有英文和數字
    {
        return preg_match_all("/^[A-Za-z0-9]*$/",$str);
    }

    public function getUserInfo($table,$token)
    {
        return $this->auto_selectOne($table,'token',$token);
    }

    public function getAllContent($table){
        $condition = 'status = 1';
        return $this->auto_selectAll($table,$condition);
    }

}


?>