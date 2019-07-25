<?php
/* Smarty version 3.1.33, created on 2019-07-25 16:30:43
  from 'D:\xampp\htdocs\MessageBook\back\smarty\smarty\temp\login\editinfo.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d39bd13c33566_18477449',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7a5574b840476c039592e4aecbbe19917cbef353' => 
    array (
      0 => 'D:\\xampp\\htdocs\\MessageBook\\back\\smarty\\smarty\\temp\\login\\editinfo.html',
      1 => 1564065042,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d39bd13c33566_18477449 (Smarty_Internal_Template $_smarty_tpl) {
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
    <form class="form-horizontal" action='../../back/controller/reg.php' method='post' id='editinfoform'>
        <fieldset>
            <!-- Form Name -->
            <legend id='title'>
                <h2>會員資料修改</h2>
            </legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">姓名</label>
                <div class="col-md-4">
                    <input id="userName" name="userName" type="text" value="<?php echo $_smarty_tpl->tpl_vars['userinfo']->value['userName'];?>
" placeholder=""
                        class="form-control input-md">
                    <span class="help-block">請輸入姓&nbsp&nbsp名最大字數限制20個字</span>
                    <span class='errorred' id='userNameInfo'>&nbsp</span>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="">email</label>
                <div class="col-md-4">
                    <input id="email" name="email" type="text" value="<?php echo $_smarty_tpl->tpl_vars['userinfo']->value['email'];?>
" placeholder=""
                        class="form-control input-md">
                    <span class="help-block">ex:example@com</span>
                    <span class='errorred' id='emailInfo'>&nbsp</span>
                </div>
            </div>

            <!-- Button (Double) -->
            <div class="form-group">
                <label class="col-md-4 control-label" for=""></label>
                <div class="col-md-8">
                    <button id="regsend" type='button' class="btn btn-info">確認修改</button>
                    <a href='./editreg.php'><button type='button' class="btn btn-danger">取消</button></a>
                    <span class='errorred' id='errorInfo'>&nbsp</span>
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
            let userName = $('#userName').val();
            let email = $('#email').val();
            if(userName === "" || email === ""){
                $('#errorInfo').html("還有欄位未填");
                return false;
            }

            if(userName.length>20){
                $('#userNameInfo').html("超過字數上限");
                return false;
            }

            let emailpatt = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
            if(email.search(emailpatt) === -1){
                $('#emailInfo').html("請輸入正確的eamil");
                return false;
            }

            let editinfoform = document.getElementById('editinfoform')
            let fd = new FormData(editinfoform);
            let res = ['email', 'userName', 'error'];
            for (error of res) {
                $('#' + error + 'Info').html("&nbsp");
            }
            $.ajax({
                url: "../../back/controller/editinfoback.php",
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
                    } else if (result == 1) {
                        alert('修改成功');
                        $(window).attr('location', './editreg.php');
                    } else if (result == 2) {
                        alert('修改失敗');
                        $(window).attr('location', './login.php');
                    }
                }
            });
        });
    <?php echo '</script'; ?>
>
</body>

</html><?php }
}
