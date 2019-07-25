<?php

class Filterword {

    protected $path = null;
    protected $keyword = [];

    public function __construct($path)
    {
        $this->path = $path;
        if (!($keyword = file_get_contents($this->path))) {
            die('file read error!');    
        } else {
            $this->keyword = explode('|',$keyword);
        }
    }

    public function usefilter($str)
    {
        if (empty($this->keyword)) {
            return $str;
        }
        foreach($this->keyword as $v) {
            $str = str_replace($v,'***',$str);
        }
        return $str;
    }
}

?>