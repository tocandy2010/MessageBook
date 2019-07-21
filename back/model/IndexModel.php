<?php
session_start();
require_once("../model/Model.php");

class IndexModel extends Model
{
    protected $table = "content";
    protected $pk = "conid";
    protected $filter = [];
    protected $verification = array();
    protected $errormessage =[];

    public function totaiwantime($arr,$name)  //傳入陣列  找到對應的欄位名稱修改其時間為台灣時間格式 Y-M-D H:i:s
    {
        date_default_timezone_set("Asia/Taipei");
        foreach($arr as $k=>$v){
            if(isset($v[$name])){
                $arr[$k][$name] = date("Y-m-d H:i:s",$v[$name]);
            }
        }
        return $arr;
    }

    public function buildindex($pdo,$arr)
    {
        $index = '';
        if(count($arr)<=0){
            $index = "<tr colspan = '3'>
                <td >目前沒有任何文章</td>
                <td ></td>
                <td ></td>
            </tr>";
        }else{
            foreach($arr as $v){
                $userinfo = $this->findarticler($pdo,$v['uid']);
                $index .= "<tr>";
                    $index .= "<td><a href=\"../../back/controller/content.php?article={$v['conid']}\">{$v['title']}</a></td>";
                    $index .= "<td>{$userinfo['userName']}({$userinfo['account']})</td>";
                    $index .= "<td>{$v['createtime']}</td>";
                $index .= "</tr>";
            }
        }
        return $index;
    }

    public function findarticler($pdo,$uid)
    {
        $sql = "select * from users where uid = {$uid}";
        $res = $pdo->prepare($sql);
        $res->execute();
        return $res->fetch(PDO::FETCH_ASSOC);
    }
}
