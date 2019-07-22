<?php
/* Smarty version 3.1.33, created on 2019-07-22 10:41:03
  from 'C:\xampp\htdocs\MessageBook\back\smarty\smarty\temp\login\editinfo.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d35769f8971d5_52552263',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c5eef965c4378ff0631987041cf35c50f335d064' => 
    array (
      0 => 'C:\\xampp\\htdocs\\MessageBook\\back\\smarty\\smarty\\temp\\login\\editinfo.html',
      1 => 1563784707,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d35769f8971d5_52552263 (Smarty_Internal_Template $_smarty_tpl) {
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
                    <?php echo $_smarty_tpl->tpl_vars['head']->value;?>

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
                    <input id="textinput" name="userName" type="text" value="<?php echo $_smarty_tpl->tpl_vars['userName']->value;?>
" placeholder=""
                        class="form-control input-md">
                    <span class="help-block">請輸入姓名</span>
                    <span class='errorred' id='userNameInfo'></span>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="">email</label>
                <div class="col-md-4">
                    <input id="" name="email" type="text" value="<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
" placeholder=""
                        class="form-control input-md">
                    <span class="help-block">ex:example@com</span>
                    <span class='errorred' id='emailInfo'></span>
                </div>
            </div>

            <!-- Button (Double) -->
            <div class="form-group">
                <label class="col-md-4 control-label" for=""></label>
                <div class="col-md-8">
                    <button id="regsend" type='button' class="btn btn-info">確認修改</button>
                    <a href='./editreg.php'><button type='button' class="btn btn-danger">取消</button></a>
                    <span class='errorred' id='errorInfo'></span>
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
            let editinfoform = document.getElementById('editinfoform')
            let fd = new FormData(editinfoform);
            let res = ['email', 'userName', 'error'];
            for (error of res) {
                $('#' + error + 'Info').html("");
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
