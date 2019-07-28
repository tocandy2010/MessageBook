<?php
/* Smarty version 3.1.33, created on 2019-07-28 18:46:13
  from 'D:\xampp\htdocs\MessageBook\back\smarty\smarty\temp\login\editpassword.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d3dd155a80f33_33629127',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '04ea3a11cc8cb81e8a7f4ac0a23999f91405d0a5' => 
    array (
      0 => 'D:\\xampp\\htdocs\\MessageBook\\back\\smarty\\smarty\\temp\\login\\editpassword.html',
      1 => 1564332198,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:D:\\xampp\\htdocs\\MessageBook\\back\\public\\header.html' => 1,
  ),
),false)) {
function content_5d3dd155a80f33_33629127 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- <!DOCTYPE html>
<html lang="en">

<head>
    <title>留言版註冊</title>
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
        /* Remove the navbar's default margin-bottom and rounded borders */
        .navbar {
            margin-bottom: 0;
            border-radius: 0;
        }

        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .row.content {
            height: 915px
        }

        /* Set gray background color and 100% height */
        .sidenav {
            padding-top: 20px;
            background-color: #f1f1f1;
            height: 100%;
        }

        /* Set black background color, white text and some padding */
        footer {
            background-color: #555;
            color: white;
            padding: 15px;
        }

        /* On small screens, set height to 'auto' for sidenav and grid */
        @media screen and (max-width: 767px) {
            .sidenav {
                height: auto;
                padding: 15px;
            }

            .row.content {
                height: auto;
            }
        } -->
<?php $_smarty_tpl->_subTemplateRender('file:D:\xampp\htdocs\MessageBook\back\public\header.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'會員密碼修改'), 0, false);
?>
<header>
    <style>

        .errorred {
            color: darkred;
        }

        #user {
            font-size: 20px;
            color: white;
            cursor: default;
            position: absolute;
            top: 20%
        }
    </style>
</head>


    <!-- <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../../back/controller/index.php">Home</a>
                <?php if ($_smarty_tpl->tpl_vars['loginflag']->value) {?>
                <span id='user'>歡迎登入&nbsp&nbsp&nbsp<?php echo $_smarty_tpl->tpl_vars['userinfo']->value['userName'];?>
</span>
                <?php }?>
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
    </nav> -->
    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-2 sidenav"></div>
            <div class="col-sm-8 text-left">
                <form class="form-horizontal">
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
                                <input id="password" name="password" type="password" placeholder=""
                                    class="form-control input-md">
                                <span class="help-block">請輸入6~20位數 英文或數字&nbsp&nbsp&nbsp禁止輸入任何符號</span>
                                <span class='errorred' id='passwordInfo'>&nbsp</span>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="">確認新密碼</label>
                            <div class="col-md-4">
                                <input id="repassword" name="repassword" type="password" placeholder=""
                                    class="form-control input-md">
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
            <div class="col-sm-2 sidenav"></div>
        </div>
    </div>

    <?php echo '<script'; ?>
>
        
        $("#regsend").click(function () {
            let oldpassword = $('#oldpassword').val();
            let password = $('#password').val();
            let repassword = $('#repassword').val();
            let res = ['oldpassword', 'password', 'repassword'];

            if (oldpassword === "" || password === "" || repassword === "") {
                $('#regerror').html("還有欄位位沒填");
                return false;
            }

            for (error of res) {
                $('#' + error + 'Info').html("&nbsp");
            }
            $.ajax({
                url: "./editpasswordback.php",
                type: "POST",
                dataType: "json",
                data: {
                    oldpassword : oldpassword,
                    password : password,
                    repassword : repassword,
                },
                success: function (result) {
                    if (result.success) {
                        alert(result.success);
                        $(window).attr('location', './editreg.php');
                    } else if (result.notlogin) {
                        alert(result.notlogin)
                        $(window).attr('location', './login.php');
                    } else if (result) {
                        for (error of res) {
                            $('#' + error + 'Info').html(result[error]);
                        }
                    } else {
                        alert('修改失敗');
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

        $('#repassword').blur(function(){
            let password = $('#password').val();
            let repassword = $('#repassword').val();
            if (password !== repassword) {
                $('#repasswordInfo').html("確認密碼錯誤");
            } else {
                $('#repasswordInfo').html("&nbsp");
            }
        })


    <?php echo '</script'; ?>
>
</body>

</html><?php }
}
