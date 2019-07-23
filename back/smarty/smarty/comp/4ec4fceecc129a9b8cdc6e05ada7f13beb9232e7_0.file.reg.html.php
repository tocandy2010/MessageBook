<?php
/* Smarty version 3.1.33, created on 2019-07-23 08:48:18
  from 'C:\xampp\htdocs\MessageBook\back\smarty\smarty\temp\login\reg.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d36adb2e077c6_13333269',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4ec4fceecc129a9b8cdc6e05ada7f13beb9232e7' => 
    array (
      0 => 'C:\\xampp\\htdocs\\MessageBook\\back\\smarty\\smarty\\temp\\login\\reg.html',
      1 => 1563864497,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d36adb2e077c6_13333269 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">

<head>
    <title>留言版註冊</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"><?php echo '</script'; ?>
>
    <style>
        #title {
            text-align: center
        }

        .errorred {
            color: darkred;
        }
    </style>
</head>

<body>
    
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="../../back/controller/index.php">首頁</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <?php if ($_smarty_tpl->tpl_vars['loginflag']->value) {?>
                    <li><a href=''><span></span>歡迎登入&nbsp<?php echo $_smarty_tpl->tpl_vars['userinfo']->value['userName'];?>
</a></li>;
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
    <form class="form-horizontal" action='../../back/controller/reg.php' method='post' id='regform'>
        <fieldset>
            <!-- Form Name -->
            <legend id='title'>
                <h2>留言版註冊</h2>
            </legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="">帳號</label>
                <div class="col-md-4">
                    <input id="" name="account" type="text" placeholder="" class="form-control input-md">
                    <span class="help-block">請輸入6~20位數 英文+數字&nbsp&nbsp&nbsp禁止輸入任何符號</span>
                    <span class='errorred' id='accountInfo'></span>
                </div>
            </div>

            <!-- Password input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="">密碼</label>
                <div class="col-md-4">
                    <input id="" name="password" type="password" placeholder="" class="form-control input-md">
                    <span class="help-block">請輸入6~20位數 英文+數字&nbsp&nbsp&nbsp禁止輸入任何符號</span>
                    <span class='errorred' id='passwordInfo'></span>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="">確認密碼</label>
                <div class="col-md-4">
                    <input id="" name="repassword" type="password" placeholder="" class="form-control input-md">
                    <span class="help-block">與密碼相同</span>
                    <span class='errorred' id='repasswordInfo'></span>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">姓名</label>
                <div class="col-md-4">
                    <input id="textinput" name="userName" type="text" placeholder="" class="form-control input-md">
                    <span class="help-block">請輸入姓名</span>
                    <span class='errorred' id='userNameInfo'></span>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="">email</label>
                <div class="col-md-4">
                    <input id="" name="email" type="text" placeholder="" class="form-control input-md">
                    <span class="help-block">ex:example@com</span>
                    <span class='errorred' id='emailInfo'></span>
                </div>
            </div>

            <!-- Button (Double) -->
            <div class="form-group">
                <label class="col-md-4 control-label" for=""></label>
                <div class="col-md-8">
                    <button id="regsend" type='button' class="btn btn-info">註冊</button>
                    <a href='./login.php'><button type='button' class="btn btn-danger">取消</button></a>
                    <span class='errorred' class id='regerror'></span>
                </div>
            </div>
        </fieldset>
    </form>

    <?php echo '<script'; ?>
>
        /*必須將contentType選項設置為false，強制jQuery不Content-Type為您添加標題，否則，邊界字符串將丟失。
        必須將processData標誌設置為false，否則，jQuery將嘗試將FormData轉換為字符串，將失敗。*/
        $("#regsend").click(function () {
            let regform = document.getElementById('regform')
            let fd = new FormData(regform);
            let res = ['account', 'password', 'repassword', 'email', 'userName'];
            for (error of res) {
                $('#' + error + 'Info').html("");
            }
            $.ajax({
                url: "../../back/controller/regback.php",
                type: "POST",
                dataType: "json",
                contentType: false,
                processData: false,
                data: fd,
                success: function (result) {
                    if (typeof (result) == 'object') {
                        for (error of res) {
                            $('#' + error + 'Info').html(result[error]);
                        }
                    } else if (result == '1') {
                        $(window).attr('location', '../../back/controller/login.php');
                    } else {
                        $(`#regerror`).html("註冊失敗");
                    }
                }
            });
        });
    <?php echo '</script'; ?>
>
</body>

</html><?php }
}
