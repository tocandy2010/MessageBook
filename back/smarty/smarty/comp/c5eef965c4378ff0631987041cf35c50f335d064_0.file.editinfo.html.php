<?php
/* Smarty version 3.1.33, created on 2019-07-30 08:42:41
  from 'C:\xampp\htdocs\MessageBook\back\smarty\smarty\temp\login\editinfo.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d3fe6e1d58e67_31422259',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c5eef965c4378ff0631987041cf35c50f335d064' => 
    array (
      0 => 'C:\\xampp\\htdocs\\MessageBook\\back\\smarty\\smarty\\temp\\login\\editinfo.html',
      1 => 1564468961,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:\\xampp\\htdocs\\MessageBook\\back\\public\\header.html' => 1,
  ),
),false)) {
function content_5d3fe6e1d58e67_31422259 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:\xampp\htdocs\MessageBook\back\public\header.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'會員資訊修改'), 0, false);
?>
    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-2 sidenav"></div>
            <div class="col-sm-8 text-left">
                <form class="form-horizontal"  id='editinfoform'>
                    <fieldset>
                        <!-- Form Name -->
                        <legend id='title'>
                            <h2>會員資料修改</h2>
                        </legend>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">姓名</label>
                            <div class="col-md-4">
                                <input id="userName" name="userName" type="text" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['userinfo']->value['userName'])===null||$tmp==='' ? '' : $tmp);?>
"
                                autocomplete="off" class="form-control input-md">
                                <span class="help-block">請輸入姓&nbsp&nbsp名最大字數限制20個字&nbsp&nbsp不可輸入空白</span>
                                <span class='errorred' id='userNameInfo'>&nbsp</span>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="">email</label>
                            <div class="col-md-4">
                                <input id="email" name="email" type="text" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['userinfo']->value['email'])===null||$tmp==='' ? '' : $tmp);?>
" placeholder=""
                                autocomplete="off" class="form-control input-md">
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
            <div class="col-sm-2 sidenav">
            </div>
        </div>
    </div>
        <?php echo '<script'; ?>
>

            $("#regsend").click(function () {
                let userName = $('#userName').val();
                let email = $('#email').val();
                let res = [ 'userName', 'error','email'];

                // 循環檢查所有欄位
                res.every((item) => {
                if ($("#" + item).val() === '') {
                        alert(item)
                        $("#" + item).focus();
                        return false;
                    } else {
                        return true
                    }
                })

                if (userName.trim() === "" || email.trim() === "") {
                    $('#errorInfo').html("還有欄位未填");
                    return false;
                }

                //檢查email
                let emailpatt = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
                if (email.search(emailpatt) === -1) {
                    $('#emailInfo').html("請輸入正確的eamil");
                    return false;
                }

                $.ajax({
                    url: "./editinfoback.php",
                    type: "POST",
                    dataType: "json",
                    data: {
                        userName : userName,
                        email : email
                    },
                    success: function (result) {
                        if (result.success) {
                            alert(result.success);
                            $(window).attr('location', './editreg.php');
                        } else if (result.notlogin) {
                            alert(result.notlogin);
                            $(window).attr('location', './login.php');
                        } else if (result.notanyedit) {
                            alert(result.notanyedit)
                            $(window).attr('location', './editreg.php');
                        }else if(result) {
                            for (error of res) {
                                $('#' + error + 'Info').html(result[error]);
                            }
                        }else {
                            alert('修改失敗');
                        }
                    }
                });
            });

            $('#userName').keyup(function() {
                $('#errorInfo').html("&nbsp");
                let strlen = $(this).val().length;
                let str = $(this).val();
                for(let i = 0; i < strlen; i++) {
                    if (str.substring(i,i+1) === " " || strlen>20) {
                        $(this).next().attr('style', 'color:darkred')
                        $('#regsend').attr('disabled', true);
                        break;
                    }
                    $(this).next().attr('style', 'color:gray')
                    $('#regsend').attr('disabled', false);
                }
            })

            $('#email').keyup(function() {
                $('#errorInfo').html("&nbsp");
            })
        <?php echo '</script'; ?>
>
</body>

</html><?php }
}
