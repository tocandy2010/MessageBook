<?php

spl_autoload_register(function($class){
    require_once("../model/Model.php");
});

class RegModel extends Model
{
    protected $table = "users";
    protected $pk = "uid";
    protected $filter = array('account','password','repassword','userName','vcode','email');
    
}


?>