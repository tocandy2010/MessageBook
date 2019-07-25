<?php
/* Smarty version 3.1.33, created on 2019-07-25 16:06:42
  from 'D:\xampp\htdocs\MessageBook\back\smarty\smarty\temp\message\newarticle.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d39b772d0da04_68374783',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '893f14bd92127409e8173845521f6fec8b4b69ac' => 
    array (
      0 => 'D:\\xampp\\htdocs\\MessageBook\\back\\smarty\\smarty\\temp\\message\\newarticle.html',
      1 => 1564063602,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d39b772d0da04_68374783 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">

<head>
    <title>留言版</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"><?php echo '</script'; ?>
>
    <style>
        #title {
            text-align: center
        }

        .errorred {
            color: darkred;
        }

        #contenttext {
            resize: none;
            overflow-Y:scroll;
        }
        .lenerror{
            display:none;
            color:darkred;
        }

        #user {
            font-size: 15px;
            color:white;
            position: relative;
            top:15px;
            left:800%;
            cursor: default;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="../../back/controller/index.php">首頁</a>
                <span id= 'user'>歡迎登入&nbsp<?php echo $_smarty_tpl->tpl_vars['userinfo']->value['userName'];?>
</span>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <?php if ($_smarty_tpl->tpl_vars['loginflag']->value) {?>
                    <li><a href='../../back/controller/newarticle.php'><span></span>發佈文章</a></li>;
                    <li><a href='../../back/controller/myarticle.php'><span></span>已發佈文章</a></li>;
                    <li><a href='../../back/controller/editreg.php'><span></span>修改會員</a></li>;
                    <li><a href='../../back/controller/logout.php'><span></span>登出</a></li>;
                    <?php } else { ?>
                    <li><a href='../../back/controller/login.php'><span></span>登入</a></li>;
                    <li><a href='../../back/controller/reg.php'><span></span>註冊</a></li>;
                    <?php }?>
                </ul>
            </div>
        </div>
    </nav>   
    <form class="form-horizontal" action='' method='' id='articleform'>
        <fieldset>
            <!-- Form Name -->
            <legend id='title'>
                <h2>發佈新文章</h2>
            </legend>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="title">標題</label>
                <div class="col-md-4">
                    <input id="titletext"  name="title" spellcheck="false" type="text" placeholder="" class="form-control input-md">
                    <span class="help-block">文字上限&nbsp:&nbsp<span id='titlelength'>30</span><span class='lenerror' id="titlelenerror">已到達文字上限</span></span>
                    <span class='errorred' id="titleInfo">&nbsp</span>
                </div>
            </div>

            <!-- Textarea -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="content">文章內容</label>
                <div class="col-md-4">
                    <textarea class="form-control" spellcheck="false" id="contenttext" rows="25" name="content"></textarea>
                    <span class="help-block">文字上限&nbsp:&nbsp<span id='contentlength'>1000</span><span class='lenerror' id="contentlenerror">已到達文字上限</span></span>
                    <span class='errorred' id="contentInfo">&nbsp</span>
                </div>
            </div>

            <!-- Button (Double) -->
            <div class="form-group">
                <label class="col-md-4 control-label" for=""></label>
                <div class="col-md-8">
                    <button id="articlesend" type='button' class="btn btn-success">發佈</button>
                    <a href='./index.php'><button id=""  type='button' class="btn btn-danger">取消</button></a>
                </div>
            </div>
        </fieldset>
    </form>
    </div>
    <?php echo '<script'; ?>
>
        
        
        $("#articlesend").click(function() {

            let title = $('#titletext').val();
            let content = $('#contenttext').val();
            if(title =="" ){
                $('#titleInfo').html("未填");
                return  false;
            }else{
                $('#titleInfo').html("&nbsp");
            }

            if(content =="" ){
                $('#contentInfo').html("未填");
                return  false;
            }else{
                $('#contentInfo').html("&nbsp");
            }

            let articleform = document.getElementById('articleform')
            let fd = new FormData(articleform);
            let res = ['title', 'content','error'];
            for (error of res) {
                $('#'+error+'Info').html("&nbsp");
            }
            $.ajax({
                url: "../../back/controller/newarticleback.php",
                type: "POST",
                dataType: "json",
                contentType: false,
                processData: false,
                data: fd,
                success: function(result) {
                    if(typeof(result) == 'object'){
                        for (error of res) {
                            $('#'+error+'Info').html(result[error]);
                        }
                    }else if(result == 1){
                        alert('成功發佈');
                        $(window).attr('location','./index.php');
                    }else if(result == 2){
                        alert('請先登入會員');
                        $(window).attr('location','./index.php');
                    }else {
                        alert('失敗發佈');
                        $(window).attr('location','./login.php');
                    }
                }
            });
        });
            let titleflag = true;
            let contentflag = true;
        $('#titletext').keyup(function(){
            let maxtitlelen = 30;
            let inplen = $('#titletext').val();
            if(inplen.length<=maxtitlelen){
                $('#titlelength').html(maxtitlelen-inplen.length);
                $('#titlelenerror').attr("style", 'display:none');     
                titleflag = true;       
            }else{
                $('#titlelength').html(maxtitlelen-inplen.length);
                $('#titlelenerror').attr("style", 'display:inline-block');
                titleflag = false;
            }
            checkwordlen(titleflag,contentflag);
        })
        
        $('#contenttext').keyup(function(){
            let maxcontentlen = 1000;
            let inplen = $('#contenttext').val();
            if(inplen.length<=maxcontentlen){
                $('#contentlength').html(maxcontentlen-inplen.length);
                $('#contentlenerror').attr("style", 'display:none');
                contentflag = true; 
            }else{
                $('#contentlength').html(maxcontentlen-inplen.length);
                $('#contentlenerror').attr("style", 'display:inline-block');
                contentflag = false;
            }
            checkwordlen(titleflag,contentflag);
        })

        function checkwordlen(a,b){
            if((titleflag===true) && (contentflag===true)){
                $('#articlesend').attr("disabled", false);
            }else{               
                $('#articlesend').attr("disabled",true);
            }
        }

    
    <?php echo '</script'; ?>
>
</body>

</html><?php }
}
