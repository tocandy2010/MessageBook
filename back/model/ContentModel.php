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

    public function findarticler($pdo,$uid)
    {
        $sql = "select * from users where uid = {$uid}";
        $res = $pdo->prepare($sql);
        $res->execute();
        return $res->fetch(PDO::FETCH_ASSOC);
    }

    public function useHtmlspecialchars($str)   //符號轉義
    {
        return htmlspecialchars($str,ENT_QUOTES);
    }

    public function getMessage($conid)  //找索此文章的所有留言
    {
        $sql = "select * from message as m 
        left join content as c on c.conid = m.conid 
        left join users as u on u.uid = m.uid
        where c.conid = {$conid} order by m.createTime desc";
        $res = $this->con->prepare($sql);
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

    public function getUserInfo($table,$token)
    {
        return $this->auto_selectOne($table,'token',$token);
    }

    public function getAllContent($table)
    {
        $condition = 'status = 1';
        return $this->auto_selectAll($table,$condition);
    }

    public function showContent($page,$showlen)
    {
        $offset = ceil(($page-1)*$showlen);
        $sql = "select u.uid,u.userName,c.conid,c.title,c.content,c.createTime
        from users as u 
        left join content as c on u.uid = c.uid where c.status = 1 order by c.conid desc limit {$offset},{$showlen}";
        $res = $this->con->prepare($sql);
        $res->execute();
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUser($token)
    {
        return $this->auto_selectOne('users','token',$token);
    }
    
    public function getContent($conid)
    {
        return $this->auto_selectOne('content','conid',$conid);
    }

    public function getMyContent($uid)
    {
        $condition = "uid = {$uid} and status = 1 order by createtime desc";
        return $this->auto_selectAll('content',$condition);
    }

    public function setMessage($arr)
    {
        return $this->auto_insert('message',$arr);
    }

    public function createArticle($arr)
    {
        return $this->auto_insert('content',$arr);
    }

    public function delArticl($conid)
    {
        return $this->auto_update('content',['status'=>0],'conid',$conid);
    }

    public function editContent($arr,$conid)
    {
        return $this->auto_update('content',$arr,'conid',$conid);
    }
}


?>