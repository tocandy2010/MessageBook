<?php
/* Smarty version 3.1.33, created on 2019-07-25 17:01:18
  from 'C:\xampp\htdocs\MessageBook\back\smarty\smarty\temp\message\content.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d396fde9b1980_82964042',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a07b8fa5590add5b314fa7b16a11626667ca7e1a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\MessageBook\\back\\smarty\\smarty\\temp\\message\\content.html',
      1 => 1564045278,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d396fde9b1980_82964042 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">

<head>
    <title>留言版</title>
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
            height: 914px
        }

        /* Set gray background color and 100% height */
        .sidenav {
            padding-top: 20px;
            background-color: #f1f1f1;
            height: 100%;
        }

        #message {
            padding: 0px 50px 0px 50px;
        }

        #leavemessage {
            position: relative;
            right: 20%;
        }

        #lmtextarea {
            width: 200%;
            height: 100px;
            resize: none;
            overflow-y: scroll;
        }

        .errorred {
            color: darkred;
        }

        #messagelenerror {
            display: none;
        }

        #messagetext {
            resize: none;
            overflow-Y: scroll;
            width: 200%;
        }

        .messagetime {
            display: inline-block;
            width: 100%;
            text-align: right
        }

        #showcontent {
            word-wrap: break-word; 
            word-break: normal;
            width:100%;
            font-size: 25px;
        }
        #showtitle {
            text-align: center;
            width:100%;
            font-size: 30px;    
            padding: 20px 0px 0px 0px;         
        }

        #messagenum {
            text-align: center;
            font-family:fantasy;
            font-size: 18px;
            padding: 5px;        
        }

        #reback {
            width: 90px;
            position: absolute;
            top:-10px;
            left:10px
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
    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-2 sidenav"></div><!-- 右邊灰色區 -->
            <div class="col-sm-8 text-left">
                <div id='message'>
                    <p id='showtitle' style="font-family:sans-serif;"><?php echo $_smarty_tpl->tpl_vars['content']->value['title'];?>
</p>
                    <hr>
                    <p id='showcontent'><?php echo $_smarty_tpl->tpl_vars['content']->value['content'];?>
</p>
                </div>
                <hr>
                <div id='leavemessage'>
                    <!-- 留言表單區 -->
                    <form class="form-horizontal" id='messageform'>
                        <fieldset>
                            <!-- Textarea -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textarea">留言</label>
                                <div class="col-md-4">
                                    <textarea class="form-control" spellcheck="false" id="messagetext"name="message"></textarea>
                                    <input type="hidden" name="conid" value="<?php echo $_smarty_tpl->tpl_vars['content']->value['conid'];?>
">
                                    <span class="help-block">最大字數限制<span id='messagelength'>100</span></span>
                                    <span id='messageInfo' class='errorred' class="help-block">&nbsp</span>
                                </div>
                            </div>

                            <!-- Button (Double) -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="button1id"></label>
                                <div class="col-md-8">
                                    <button id="messagesend" type='button' class="btn btn-info">留言</button>
                                    <input type="reset" id='resetmessage' class="btn btn-default" value='清除'>
                                    <span id='messagelenerror' class='errorred'>超過最大字數限制</span>
                                </div>
                            </div>

                        </fieldset>
                    </form>
                </div>
                <p id='messagenum'><?php echo $_smarty_tpl->tpl_vars['messagenum']->value;?>
則留言</p>
                <hr/>
                <div class="container">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['getmessage']->value, 'v', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
?>
                    <div class="panel panel-default">
                        <div class="panel-heading"><?php echo $_smarty_tpl->tpl_vars['v']->value['userName'];?>
(<?php echo $_smarty_tpl->tpl_vars['v']->value['account'];?>
)<span
                                class='messagetime'><?php echo $_smarty_tpl->tpl_vars['v']->value['createtime'];?>
</span></div>
                        <div class="panel-body"><?php echo $_smarty_tpl->tpl_vars['v']->value['message'];?>
</div>
                    </div>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </div>

            </div>
            <div class="col-sm-2 sidenav"></div><!-- 左邊灰色區 -->
        </div>
    </div>
    <?php echo '<script'; ?>
>
        $("#messagesend").click(function() {
            let messageform = document.getElementById('messageform')
            let fd = new FormData(messageform);
            let res = ['message'];
            for (error of res) {
                $('#' + error + 'Info').html("&nbsp");
            }
            $.ajax({
                url: "../../back/controller/message.php",
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
                        location.reload();
                    } else if (result == 2) {
                        alert('請登入會員')
                        $(window).attr('location', '../../back/controller/login.php');
                    }else{
                        alert('留言失敗');
                    }
                }
            });
        });

        $('#messagetext').keyup(function(){
            let maxmessagelen = 100;
            let inplen = $('#messagetext').val();
            if (inplen.length <= maxmessagelen) {
                $('#messagelength').html(maxmessagelen - inplen.length);
                $('#messagelenerror').attr("style", 'display:none');
                $('#messagesend').attr('disabled', false)
            } else {
                $('#messagelength').html(maxmessagelen - inplen.length);
                $('#messagelenerror').attr("style", 'display:inline-block');
                $('#messagesend').attr('disabled', true)
            }
        });

        $('#resetmessage').click(function(){
            $('#messagelength').html(100);
            $('#messagesend').attr('disabled', false);
            $('#messagelenerror').attr("style", 'display:none');
        })

    <?php echo '</script'; ?>
>
</body>

</html><?php }
}
