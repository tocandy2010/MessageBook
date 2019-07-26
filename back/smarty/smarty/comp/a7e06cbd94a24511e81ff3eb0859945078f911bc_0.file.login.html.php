<?php
/* Smarty version 3.1.33, created on 2019-07-26 10:58:29
  from 'C:\xampp\htdocs\MessageBook\back\smarty\smarty\temp\login\login.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d3ac0b5d42172_90232261',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a7e06cbd94a24511e81ff3eb0859945078f911bc' => 
    array (
      0 => 'C:\\xampp\\htdocs\\MessageBook\\back\\smarty\\smarty\\temp\\login\\login.html',
      1 => 1564131508,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d3ac0b5d42172_90232261 (Smarty_Internal_Template $_smarty_tpl) {
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
        }

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
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../../back/controller/index.php">Home</a>
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
    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-2 sidenav"></div>
            <div class="col-sm-8 text-left">
                <form class="form-horizontal" id='loginform'>
                    <fieldset>
                        <!-- Form Name -->
                        <legend id='title'>
                            <h2>留言板登入</h2>
                        </legend>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="">帳號</label>
                            <div class="col-md-4">
                                <input id="account" name="account" type="text" placeholder="" value="<?php echo $_smarty_tpl->tpl_vars['account']->value;?>
"
                                    class="form-control input-md">
                                <span class='errorred' id='accountInfo'>&nbsp</span>
                            </div>
                        </div>

                        <!-- Password input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="">密碼</label>
                            <div class="col-md-4">
                                <input id="password" name="password" type="password" placeholder=""
                                    class="form-control input-md">
                                <span class='errorred' id='passwordInfo'>&nbsp</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="appendedtext">驗證碼</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input id="vcode" name="vcode" class="form-control" type="text">
                                    <span class="input-group-addon"><img id='vcodeimg' src='../public/vcode.php'></span>
                                    <span class='errorred' id='vcodeInfo'>&nbsp</span>
                                </div>
                            </div>
                        </div>

                        <!-- Multiple Checkboxes (inline) -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="checkboxes"></label>
                            <div class="col-md-4">
                                <label class="checkbox-inline" for="remember">
                                    <input type="checkbox" name="remember" id="remember" <?php echo $_smarty_tpl->tpl_vars['remember']->value;?>
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
                                <a href='./reg.php'><button id="" type='button' name=""
                                        class="btn btn-info">註冊</button></a>
                                <span class='errorred' id='errorInfo'>&nbsp</span>
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

        $('#vcodeimg').click(function () {
            this.src = '../public/vcode.php?' + Math.random();
        })

        $('#remember').click(function(){
            if ($(this).val() === "1") {
                $(this).val('1')
            } else if($(this).val() === "0"){
                $(this).val('0')
            }
            alert($('#remember').val())
        })

        $("#loginsend").click(function () {
            let account = $('#account').val();
            let password = $('#password').val();
            let vcode = $('#vcode').val();

            if (account === "" || password === "" || vcode === "") {
                $('#errorInfo').html('請填完所有欄位');
                return false;
            }

            // let loginform = document.getElementById('loginform')
            // let fd = new FormData(loginform);
            let res = ['error', 'vcode', 'password', 'account'];
            for (error of res) {
                $('#' + error + 'Info').html("&nbsp");
            }
            $.ajax({
                url: "../../back/controller/loginback.php",
                type: "POST",
                dataType: "json",
                data: {
                    account : $('#account').val(),
                    password : $('#password').val(),
                    vcode : $('#vcode').val(),
                    remember : $('#remember').val(),
                },
                success: function (result) {
                    if (typeof (result) == 'object') {
                        for (error of res) {
                            $('#' + error + 'Info').html(result[error]);
                        }
                    } else if (result == 1) {
                        $(window).attr('location', '../../back/controller/index.php');
                    } else if (result == 2) {
                        $(`#errorInfo`).html("目前已登入狀態");
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
