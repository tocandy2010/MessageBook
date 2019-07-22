<?php
session_start();
class vcode{
    private $font = 'abcdefghijkmnpqrstuvwxy23456789abcdefghijkmnpqrstuvwxy23456789';
    private $width = 80;  //圖寬
    private $height = 40;  //圖高
    private $imgtype = 'bmp';  //圖片類型
    private $font_length = 4;  //驗證碼長度
    private $vcode = null;  //驗證碼
    private $img = null;
    private $font_color = null;
    private $img_color = null;
    private $linenumber = 5;  //干擾線數量

    public function __construct(){
        $this->img = imagecreatetruecolor($this->width,$this->height);
        $this->vcode = substr(str_shuffle($this->font),$this->font_length);
        $this->font_color = imagecolorallocate($this->img,0,mt_rand(0,100),mt_rand(0,100));
        $this->img_color = imagecolorallocate($this->img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
        $this->vcode = substr(str_shuffle($this->font),0,$this->font_length);
    }
    
    public function show(){
        imagefill($this->img,0,0,$this->img_color);
        $this->font();
        $this->line();
        ob_clean();
        header('Content-type:image/'.$this->imgtype);
        $this->createimg($this->imgtype);
        $this->setsession();
        imagedestroy($this->img);
    }

    private function font(){
        ImageTTFText($this->img, 22, 0, mt_rand(0,5), mt_rand(30,35), $this->font_color, "C:\Windows\Fonts\Arial.ttf", $this->vcode);
    }

   private function line(){
       for ($i = 0 ; $i<$this->linenumber ; $i++){
        imageline($this->img,mt_rand(0,80),mt_rand(0,40),mt_rand(0,80),mt_rand(0,40),$this->font_color);
       }     
    }

    public function getvcode(){
        return $this->vcode;
    }

    private function setsession(){
        $_SESSION['vcode'] = $this->vcode;
    }

    private function createimg($type){
        switch($type){
            case 'jpeg' : imagejpeg($this->img);
            break;
            case 'png' : imagepng($this->img);
            break;
            case 'gif' : imagegif($this->img);
            break;
            case 'bmp' : imagebmp($this->img);
            break;            
        }
    }


}


$vcode = new vcode();

$vcode->show();


?>