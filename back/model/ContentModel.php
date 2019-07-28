<?php

require_once("../model/Model.php");
class ContentModel extends Model 
{
    // public function findarticler($pdo,$uid)
    // {
    //     $sql = "select * from users where uid = {$uid}";
    //     $res = $pdo->prepare($sql);
    //     $res->execute();
    //     return $res->fetch(PDO::FETCH_ASSOC);
    // }

    /*
     * 傳入文章 id 回傳 content表和users表
     */
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

    // public function getUserInfo($table, $token)
    // {
    //     return $this->auto_selectOne($table, 'token', $token);
    // }

    /*
     * 回傳開放的文章
     */
    public function getAllContent()
    {
        $condition = 'status = 1';
        return $this->auto_selectAll('content', $condition);
    }

    /*
     * 根據 page 頁數 取資料
     */
    public function showContent($page, $showlen)
    {
        $offset = ceil(($page-1) * $showlen);
        $sql = "select u.uid,u.userName,c.conid,c.title,c.content,c.createtime
        from users as u 
        left join content as c on u.uid = c.uid where c.status = 1 order by c.conid desc limit {$offset},{$showlen}";
        $res = $this->con->prepare($sql);
        $res->execute();
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
   
    /*
     * 根據coid回傳文章
     */
    public function getContent($conid)
    {
        return $this->auto_selectOne('content', 'conid', $conid);
    }

    /*
     * 根據 uid 回傳文章
     */
    public function getMyContent($uid)
    {
        $condition = "uid = {$uid} and status = 1 order by createtime desc";
        return $this->auto_selectAll('content', $condition);
    }

    /*
     * 傳入陣列存入message表
     */
    public function setMessage($arr)
    {
        return $this->auto_insert('message', $arr);
    }

    /*
     * 傳入陣列存入content表
     */
    public function addArticle($arr)
    {
        return $this->auto_insert('content', $arr);
    }

    /*
     * 根據 conid 將文章狀態改為 0
     */
    public function delArticl($conid)
    {
        return $this->auto_update('content', ['status' => 0], 'conid', $conid);
    }

    /*
     * 傳入陣列和 conid 修改 content表
     */
    public function editContent($arr,$conid)
    {
        return $this->auto_update('content', $arr, 'conid', $conid);
    }

    public function getSearch($search)
    {
        $sql = "select * from users as u 
        left join 
        content as c on u.uid = c.uid 
        where u.userName like '%" . $search . "%' or c.title like '%" . $search . "%' having c.status = 1";
        $res = $this->con->prepare($sql);
        $res->execute();
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    public function showSearch( $search, $page, $showlen)
    {
        $offset = ceil(($page-1) * $showlen);
        $sql = "select * from users as u 
        left join 
        content as c on u.uid = c.uid 
        where u.userName like '%" . $search . "%' or c.title like '%" . $search  ."%' having c.status = 1 
        order by createtime desc
         limit {$offset} , {$showlen}";
        $res = $this->con->prepare($sql);
        $res->execute();
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
}
