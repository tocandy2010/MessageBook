<?php
/* Smarty version 3.1.33, created on 2019-07-25 11:38:41
  from 'C:\xampp\htdocs\MessageBook\back\smarty\smarty\temp\login\editpassword.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d3978a1648368_82504344',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'def49e97d1705ffbbf7d91dd17c804956ec94379' => 
    array (
      0 => 'C:\\xampp\\htdocs\\MessageBook\\back\\smarty\\smarty\\temp\\login\\editpassword.html',
      1 => 1564047520,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d3978a1648368_82504344 (Smarty_Internal_Template $_smarty_tpl) {
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
                <h2>會員密碼修改</h2>
            </legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">舊密碼</label>
                <div class="col-md-4">
                    <input id="oldpassword" name="oldpassword" type="password" placeholder=""
                        class="form-control input-md">
                    <span class="help-block">請輸入舊密碼</span>
                    <span class='errorred' id='oldpasswordInfo'>&nbsp</span>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="">新密碼</label>
                <div class="col-md-4">
                    <input id="password" name="password" type="password" placeholder="" class="form-control input-md">
                    <span class="help-block">請輸入6~20位數 英文或數字&nbsp&nbsp&nbsp禁止輸入任何符號</span>
                    <span class='errorred' id='passwordInfo'>&nbsp</span>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="">確認新密碼</label>
                <div class="col-md-4">
                    <input id="" name="repassword" type="password" placeholder="" class="form-control input-md">
                    <span class="help-block">與新密碼相同</span>
                    <span class='errorred' id='repasswordInfo'>&nbsp</span>
                </div>
            </div>

            <!-- Button (Double) -->
            <div class="form-group">
                <label class="col-md-4 control-label" for=""></label>
                <div class="col-md-8">
                    <button id="regsend" type='button' class="btn btn-info">確認修改</button>
                    <a href='./editreg.php'><button type='button' class="btn btn-danger">取消</button></a>
                    <span class='errorred' class id='regerror'>&nbsp</span>
                </div>
            </div>
        </fieldset>
    </form>
    </div>

    <?php echo '<script'; ?>
>
        /*必須將contentType選項設置為false，強制jQuery不Content-Type為您添加標題，否則，邊界字符串將丟失。
        必須將processData標誌設置為false，否則，jQuery將嘗試將FormData轉換為字符串，將失敗。*/
        $("#regsend").click(function () {
            let oldpassword = $('#oldpassword').val();
            let password = $('#password').val();
            let repassword = $('#repassword').val();
            let regform = document.getElementById('regform')
            let fd = new FormData(regform);
            let res = ['oldpassword', 'password', 'repassword'];

            if(oldpassword ==="" || password ==="" || repassword ===""){
                $('#regerror').html("還有欄位未沒填");
                return false;
            }

            for (error of res) {
                $('#' + error + 'Info').html("&nbsp");
            }
            $.ajax({
                url: "../../back/controller/editpasswordback.php",
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
                        alert('修改成功');
                        $(window).attr('location', './editreg.php');
                    } else if (result == '2') {
                        alert('修改失敗');
                        $(window).attr('location', './login.php');
                    }
                }
            });
        });

        $('#password').keyup(function () {
            checksymbol(this);
        })

        function checksymbol(obj) {
            let patt = /[^a-zA-Z0-9]/;
            let strlen = $(obj).val();
            let flag = patt.test(obj.value);
            $('#regsend').attr('disabled', flag);
            if (flag === true) {
                $(obj).next().attr('style', 'color:darkred')
            } else {
                $(obj).next().attr('style', "color:gray")
            }
        }



    <?php echo '</script'; ?>
>
</body>

</html><?php }
}
