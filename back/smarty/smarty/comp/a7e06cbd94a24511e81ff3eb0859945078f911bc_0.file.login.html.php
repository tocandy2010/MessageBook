<?php
/* Smarty version 3.1.33, created on 2019-07-25 05:02:25
  from 'C:\xampp\htdocs\MessageBook\back\smarty\smarty\temp\login\login.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d391bc12b8031_09347316',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a7e06cbd94a24511e81ff3eb0859945078f911bc' => 
    array (
      0 => 'C:\\xampp\\htdocs\\MessageBook\\back\\smarty\\smarty\\temp\\login\\login.html',
      1 => 1564023740,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d391bc12b8031_09347316 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">

<head>
    <title>登入留言版</title>
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
    <form class="form-horizontal" action='' method='' id='loginform'>
        <fieldset>

            <!-- Form Name -->
            <legend id='title'>
                <h2>留言板登入</h2>
            </legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="">帳號</label>
                <div class="col-md-4">
                    <input id="" name="account" type="text" placeholder=""
                        value="<?php echo $_smarty_tpl->tpl_vars['account']->value;?>
" class="form-control input-md">
                    <span class='errorred' id='accountInfo'></span>
                </div>
            </div>

            <!-- Password input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="">密碼</label>
                <div class="col-md-4">
                    <input id="" name="password" type="password" placeholder="" class="form-control input-md">
                    <span class='errorred' id='passwordInfo'></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="appendedtext">驗證碼</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input id="appendedtext" name="vcode" class="form-control" type="text">
                        <span class="input-group-addon"><img id='vcode' src='../public/vcode.php'></span>
                        <span class='errorred' id='vcodeInfo'></span>
                    </div>
                </div>
            </div>

            <!-- Multiple Checkboxes (inline) -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="checkboxes"></label>
                <div class="col-md-4">
                    <label class="checkbox-inline" for="checkboxes-0">
                        <input type="checkbox" name="remember" id="checkboxes-0" <?php echo $_smarty_tpl->tpl_vars['remember']->value;?>
 value="1">
                        記住帳號
                    </label>

                </div>
            </div>
            <!-- Button (Double) -->
            <div class="form-group">
                <label class="col-md-4 control-label" for=""></label>
                <div class="col-md-8">
                    <button id="loginsend" type='button' class="btn btn-success">登入</button>
                    <a href='./reg.php'><button id="" type='button' name="" class="btn btn-info">註冊</button></a>
                    <span class='errorred' id='errorInfo'></span>
                </div>
            </div>

        </fieldset>
    </form>

    <?php echo '<script'; ?>
>

        $('#vcode').click(function (ev) {
            this.src = '../public/vcode.php?' + Math.random();
        })

        $("#loginsend").click(function () {
            let loginform = document.getElementById('loginform')
            let fd = new FormData(loginform);
            let res = ['error', 'vcode','password','account'];
            for (error of res) {
                $('#'+error+'Info').html("");
            }
            $.ajax({
                url: "../../back/controller/loginback.php",
                type: "POST",
                dataType: "json",
                contentType: false,
                processData: false,
                data: fd,
                success: function (result) {
                    if (typeof (result) == 'object') {
                        for (error of res) {
                            $('#'+error+'Info').html(result[error]);
                        }
                    } else if (result == 1) {
                        $(window).attr('location', '../../back/controller/index.php');
                    } else  if (result == 2) {
                        $(`#errorInfo`).html("目前已登入")
                    } else {
                        $(`#errorInfo`).html("登入失敗");
                    }
                }
            });
        });

    <?php echo '</script'; ?>
>

</body>

</html><?php }
}
