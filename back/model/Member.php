<?php

require_once("../databases/Mysql.php");

class Member extends Mysql
{
    /*
     * 查詢 table 內的標題和值是否已存在
     */
    public function checkReged($name, $value, $show = PDO::FETCH_ASSOC)
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
     * 傳入帳號取得使用者資訊
     */
    public function getAccount($account, $show = PDO::FETCH_ASSOC)  
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

    // /*
    //  * 產生token 100個字
    //  */
    // public function createToken($uid)  
    // {
    //     $str = "abcdefghijklmnopqrstuvwxyz";
    //     $str .= strtoupper($str);
    //     $str .= "0123456789";
    //     $str .= "+-*/$.?:";
    //     $str = str_repeat($str, 10);
    //     $str = str_shuffle($str);
    //     $token = substr($str, 0, 100).$uid;
    //     return $token;
    // }

    /*
     * 設定資料庫token
     */
    public function setToken($token, $id){  
        return $this->auto_update('users', ['token' => $token], 'uid', $id);
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


