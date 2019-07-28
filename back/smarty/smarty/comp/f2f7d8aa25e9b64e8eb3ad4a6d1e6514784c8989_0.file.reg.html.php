<?php
/* Smarty version 3.1.33, created on 2019-07-28 18:43:42
  from 'D:\xampp\htdocs\MessageBook\back\smarty\smarty\temp\login\reg.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d3dd0be2c1fc6_15974931',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f2f7d8aa25e9b64e8eb3ad4a6d1e6514784c8989' => 
    array (
      0 => 'D:\\xampp\\htdocs\\MessageBook\\back\\smarty\\smarty\\temp\\login\\reg.html',
      1 => 1564332045,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:D:\\xampp\\htdocs\\MessageBook\\back\\public\\header.html' => 1,
  ),
),false)) {
function content_5d3dd0be2c1fc6_15974931 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:D:\xampp\htdocs\MessageBook\back\public\header.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'留言版註冊'), 0, false);
?>

    <!-- <nav class="navbar navbar-inverse">
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
    </nav> -->
    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-2 sidenav"></div>
            <div class="col-sm-8 text-left">
                <form class="form-horizontal" id='regform'>
                    <fieldset>
                        <!-- Form Name -->
                        <legend id='title'>
                            <h2>留言版註冊</h2>
                        </legend>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="">帳號</label>
                            <div class="col-md-4">
                                <input id="account" name="account" type="text" placeholder=""
                                    class="form-control input-md">
                                <span class="help-block">請輸入6~20位數 英文+數字&nbsp&nbsp&nbsp禁止輸入任何符號</span>
                                <span class='errorred' id='accountInfo'>&nbsp</span>
                            </div>
                        </div>

                        <!-- Password input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="">密碼</label>
                            <div class="col-md-4">
                                <input id="password" name="password" type="password" placeholder=""
                                    class="form-control input-md">
                                <span class="help-block">請輸入6~20位數 英文+數字&nbsp&nbsp&nbsp禁止輸入任何符號</span>
                                <span class='errorred' id='passwordInfo'>&nbsp</span>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="">確認密碼</label>
                            <div class="col-md-4">
                                <input id="repassword" name="repassword" type="password" placeholder=""
                                    class="form-control input-md">
                                <span class="help-block">與密碼相同</span>
                                <span class='errorred' id='repasswordInfo'>&nbsp</span>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">姓名</label>
                            <div class="col-md-4">
                                <input id="userName" name="userName" type="text" placeholder=""
                                    class="form-control input-md">
                                <span class="help-block">請輸入姓名 最大字數限制20個字</span>
                                <span class='errorred' id='userNameInfo'>&nbsp</span>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="">email</label>
                            <div class="col-md-4">
                                <input id="email" name="email" type="text" placeholder="" class="form-control input-md">
                                <span class="help-block">ex:example@com</span>
                                <span class='errorred' id='emailInfo'>&nbsp</span>
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
            </div>
            <div class="col-sm-2 sidenav">
            </div>
        </div>
    </div>

    <?php echo '<script'; ?>
>
        $("#regsend").click(function () {
            let account = $('#account').val();
            let password = $('#password').val();
            let repassword = $('#repassword').val();
            let userName = $('#userName').val();
            let email = $('#email').val();

            if (account.trim() === "" || password.trim() === "" || repassword.trim() === "" 
            || userName.trim() === "" || email.trim() === "") {
                $('#regerror').html("還有欄位未填妥");
                return false;
            } else {
                $('#regerror').html("&nbsp");
            }

            let emailpatt = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
            if (email.search(emailpatt) === -1) {
                $('#emailInfo').html("請輸入正確的eamil");
                return false;
            } else {
                $('#emailInfo').html("&nbsp");
            }

            let regform = document.getElementById('regform')
            let fd = new FormData(regform);
            let res = ['account', 'password', 'repassword', 'email', 'userName'];
            for (error of res) {
                $('#' + error + 'Info').html("&nbsp");
            }
            $.ajax({
                url: "./regback.php",
                type: "POST",
                dataType: "json",
                data: {
                    account: $('#account').val(),
                    password: $('#password').val(),
                    repassword: $('#repassword').val(),
                    email: $('#email').val(),
                    userName: $('#userName').val(),
                },
                success: function (result) {
                    if (result.success) {
                        alert(result.success)
                        $(window).attr('location', './login.php');
                    } else if (result.fail) {
                        alert(result.fail)
                    } else if(result) {
                        for (error of res) {
                            $('#' + error + 'Info').html(result[error]);
                        }
                    }
                }
            });
        });

        $('#userName').keyup(function () {
            if ($(this).val().length > 20) {
                $(this).next().attr('style', 'color:darkred')
            } else {
                $(this).next().attr('style', "color:gray")
            }
        })

        $('#repassword').blur(function () {
            let password = $('#password').val();
            let repassword = $('#repassword').val();
            if (password !== repassword) {
                $('#repasswordInfo').html('確認密碼與密碼不相同');
            } else {
                $('#repasswordInfo').html('&nbsp');
            }
        })

        let accountflag = true;
        let passwordflag = true;

        $('#account').keyup(function () {
            let patt = /[^a-zA-Z0-9]/;
            let strlen = $(this).val().length;
            if (patt.test(this.value) || !(strlen < 20) || !(strlen > 5)) {
                accountflag = false;
                $(this).next().attr('style', 'color:darkred')
            } else {
                accountflag = true;
                $(this).next().attr('style', "color:gray");
            }
            LuckButton(accountflag, passwordflag);
        });

        $('#password').keyup(function () {
            let patt = /[^a-zA-Z0-9]/;
            let strlen = $(this).val().length;
            if (patt.test(this.value) || !(strlen < 20) || !(strlen > 5)) {
                passwordflag = false;

                $(this).next().attr('style', 'color:darkred')
            } else {
                passwordflag = true;
                $(this).next().attr('style', "color:gray");
            }
            LuckButton(accountflag, passwordflag);
        });


        function LuckButton(accountflag, passwordflag) {
            if (accountflag && passwordflag) {
                $('#regsend').attr('disabled', false);
            } else {
                $('#regsend').attr('disabled', true);
            }
        }

    <?php echo '</script'; ?>
>
</body>

</html><?php }
}
