<?php


class Mysql
{
    private $dbtype = 'mysql';  //連線方式
    private $host = 'localhost';  //主機
    private $dbname = 'messagebook';  //資料庫名
    private $account = 'root';  //sql帳號
    private $password = '123456789';  //sql密碼
    private $info = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', PDO::ATTR_EMULATE_PREPARES, false);
    protected $con = null;
    public function __construct()
    {
        try {
            $this->con = new PDO("$this->dbtype:host=$this->host;dbname=$this->dbname", "$this->account", "$this->password", $this->info);
        } catch (PDOException $e) {
            echo "錯誤提示:" . $e->getMessage();
            echo "錯誤行:" . $e->getLine();
            exit;
        }
    }
    public function getcon()
    {
        return $this->con;
    }
    
    public function auto_insert($array)  ## 自動insert 指定表 和 一個陣列
    {
        if (!is_array($array)) {
            return false;
        }
        
        $count = count($array);
        $sql = "insert into {$this->table} (";
        foreach ($array as $k => $v) {
            $sql .= "$k,";
        }
        $sql = rtrim($sql, ',');
        $sql .= ") values(";
        $sql .= str_repeat('?,', $count);
        $sql = rtrim($sql, ',') . ")";    
        $res = $this->con->prepare($sql);
         foreach (array_values($array) as $k => $v) {
            $res->bindValue(($k+1), $v);
        }
        $res->execute();
        return $this->affected_rows($res);
    }

    public function auto_update($array,$id)  //自動update 指定表 一個關聯陣列 一個陣列主鍵 返回影響行數 
    {  
        if (!is_array($array)) {
            return false;
        }
        $count = count($array);
        $sql = "update {$this->table} set ";
        foreach ($array as $k => $v) {
            $sql .= "{$k} = ?,";
        }
        $sql = rtrim($sql, ',');
        $sql .= " where {$this->pk} = {$id}";
        $res = $this->con->prepare($sql);
        foreach (array_values($array) as $k => $v) {
            $res->bindValue($k + 1, $v);
        }
        $res->execute();
        return $this->affected_rows($res);
    }

    public function auto_delete($id)  //傳入id 並且刪除回傳影響行數
    {
        $sql = "delete from users where uid = ?";
        $res = $this->con->prepare($sql);
        $res->bindParam(1, $id);
        $res->execute();
        return $this->affected_rows($res);
    }

    public function auto_selectAll($where=1,$show = PDO::FETCH_ASSOC)   //select全部  show參數等於index 回傳索引陣列
    {
        $sql = "select * from {$this->table} where {$where}";
        $res = $this->con->prepare($sql);
        $res->execute();
        if ($show == 'index') {
            $show = PDO::FETCH_NUM;
            return $res->fetchAll($show);
        }
        return $res->fetchAll($show);
    }

    public function auto_selectOne($id, $show = PDO::FETCH_ASSOC)   //傳入主鍵select該主鍵  show參數等於index 回傳索引陣列
    {
        $sql = "select * from {$this->table} where {$this->pk} = ?";
        $res = $this->con->prepare($sql);
        $res->bindParam(1, $id);
        $res->execute();
        if ($show == 'index') {
            $show = PDO::FETCH_NUM;
            return $res->fetch($show);
        }
        return $res->fetch($show);
    }

    public function affected_rows($res)  //返回受 insert update delete 所影響行數
    {
        return $res->rowCount();
    }

    public function getinsertid(){   //取得隊後一次insert的id
        return $this->con->lastInsertId();
    }
}