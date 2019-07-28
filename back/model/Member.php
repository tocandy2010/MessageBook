<?php
require_once("../model/Model.php");
class Member extends Model
{
    /*
     * 傳入table 字段名稱
     */
    public function checkReged($name, $value, $show = PDO::FETCH_ASSOC)   //檢查是否已被註冊 key和vlue
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

    /*
     * 帳號獲得使用者資訊
     */
    public function getAccount($account, $show = PDO::FETCH_ASSOC)  
    {    ##取得帳號是否存在
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

    /*
     * 產生token 100個字
     */
    public function createToken($uid)  
    {
        $str = "abcdefghijklmnopqrstuvwxyz";
        $str .= strtoupper($str);
        $str .= "0123456789";
        $str .= "+-*/$.?:";
        $str = str_repeat($str, 10);
        $str = str_shuffle($str);
        $token = substr($str, 0, 100).$uid;
        return $token;
    }

    /*
     * 設定資料庫token
     */
    public function setToken($table, $arr, $pk, $id){  
        return $this->auto_update($table, $arr, $pk, $id);
    }

    /*
     *  註冊用戶
     */
    public function addUser($table, $userinfo) 
    {
        return $this->auto_insert($table, $userinfo);
    }

    /*
     * 根據token找使用者
     */
    public function getUser($token)
    {
        return $this->auto_selectOne('users','token',$token);
    }

    /*
     *  update使用者密碼
     */
    public function resetPassword($password, $uid)
    {
        return $this->auto_update('users', $password, 'uid', $uid);
    }

    /*
     *  update使用者密碼
     */
    public function editUserInfo($arr,$uid)
    {
        return $this->auto_update('users', $arr, 'uid', $uid);
    }
}


