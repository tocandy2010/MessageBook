<?php
session_start();
require_once("../model/Model.php");

class PageModel extends Model
{
    protected $table = "content";
    protected $pk = "conid";
    protected $filter = ['page'];
    public $length = 3;
    protected $verification = array();
    protected $errormessage =[];

    public function contentpage($sum){
        if($sum<=0){
            return 1;
        }
        return ceil($sum/$this->length);
    }    
    
    public function bulidpage ($num,$nowpage)
    {
        $page = '';
        if ($nowpage>$num){
            $nowpage = 1;
        }
        for ($i=1;$i<=$num;$i++){
            if ($i==$nowpage){
                $page.="<li ><a style='color:black' href=./index.php?page={$i}>{$i}</a></li>";
                continue;
            }
            $page.="<li><a href=./index.php?page={$i}>{$i}</a></li>";
        }
        return $page;
    }

}


?>