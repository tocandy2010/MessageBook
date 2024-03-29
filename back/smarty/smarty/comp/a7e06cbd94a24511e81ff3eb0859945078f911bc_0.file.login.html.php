<?php
/* Smarty version 3.1.33, created on 2019-07-30 09:51:09
  from 'C:\xampp\htdocs\MessageBook\back\smarty\smarty\temp\login\login.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d3ff6ed998ed5_84330216',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a7e06cbd94a24511e81ff3eb0859945078f911bc' => 
    array (
      0 => 'C:\\xampp\\htdocs\\MessageBook\\back\\smarty\\smarty\\temp\\login\\login.html',
      1 => 1564471883,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:\\xampp\\htdocs\\MessageBook\\back\\public\\header.html' => 1,
  ),
),false)) {
function content_5d3ff6ed998ed5_84330216 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:\xampp\htdocs\MessageBook\back\public\header.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'留言版登入'), 0, false);
?>
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

        $('#remember').click(function () {
            if ($(this).val() === "1") {
                $(this).val('1')
            } else if ($(this).val() === "0") {
                $(this).val('0')
            }
        })

        $("#loginsend").click(function () {
            let account = $('#account').val();
            let password = $('#password').val();
            let vcode = $('#vcode').val();

            if (account.trim() === "" || password.trim() === "" || vcode.trim() === "") {
                $('#errorInfo').html('請填完所有欄位');
                return false;
            }

            let res = ['error', 'vcode', 'password', 'account'];
            for (error of res) {
                $('#' + error + 'Info').html("&nbsp");
            }
            $.ajax({
                url: "../../back/controller/loginback.php",
                type: "POST",
                dataType: "json",
                data: {
                    account: $('#account').val(),
                    password: $('#password').val(),
                    vcode: $('#vcode').val(),
                    remember: $('#remember').val(),
                },
                success: function (result) {
                    if (result.logininfo === 'success') {
                        $(window).attr('location', '../../back/controller/index.php');
                    } else if (result.logininfo === 'islogined') {
                        $(`#errorInfo`).html("目前已登入狀態");
                    } else if (result.logininfo === 'fail') {
                        $(`#errorInfo`).html("帳號或密碼錯誤");
                    } else if (result.logininfo === 'errorvcode') {
                        $(`#errorInfo`).html("帳號或密碼錯誤");
                    } else if (result.errorinfo) {
                        for (error of res) {
                            $('#' + error + 'Info').html(result.loginfo[error]);
                        }
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
