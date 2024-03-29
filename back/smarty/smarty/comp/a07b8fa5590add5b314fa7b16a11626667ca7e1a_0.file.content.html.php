<?php
/* Smarty version 3.1.33, created on 2019-07-30 15:36:59
  from 'C:\xampp\htdocs\MessageBook\back\smarty\smarty\temp\message\content.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d3ff39b760a88_22587279',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a07b8fa5590add5b314fa7b16a11626667ca7e1a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\MessageBook\\back\\smarty\\smarty\\temp\\message\\content.html',
      1 => 1564472219,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:\\xampp\\htdocs\\MessageBook\\back\\public\\header.html' => 1,
  ),
),false)) {
function content_5d3ff39b760a88_22587279 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:\xampp\htdocs\MessageBook\back\public\header.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'發佈文章'), 0, false);
?>
<header>
    <style>
        #message {
            padding: 0px 50px 0px 50px;
        }

        #messagelenerror {
            display: none;
        }

        #messagetext {
            resize: none;
            overflow-Y: scroll;
        }

        .messagetime {
            display: inline-block;
            width: 100%;
            text-align: right;
            position: relative;
            
        }

        #showcontent {
            width:  100%;
            height: 500px;
            padding: 10px 30px 10px 30px;
            font-size: 25px;
            overflow-y: scroll;
            overflow-x: hidden;
            white-space: pre-wrap;
        }

        #showtitle {
            text-align: center;
            width: 100%;
            font-size: 30px;
            padding: 20px 0px 0px 0px;
        }

        #messagenum {
            text-align: center;
            font-family: fantasy;
            font-size: 18px;
            padding: 5px;
        }

        #reback {
            width: 90px;
            position: absolute;
            top: -10px;
            left: 10px
        }

        .messagebody {
            word-break: break-all;
            text-align: left;
            font-size: 16px;
        }

        .messagename {
            font-size: 16px;
            font-weight:bold;
            text-align: left;

            width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp:2 ;
            -webkit-box-orient: vertical;
        }

    </style>
    </head>
    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-2 sidenav"></div>
            <div class="col-sm-8 text-left">
                <div id='message'>
                    <p id='showtitle' style="font-family:sans-serif;"><?php echo $_smarty_tpl->tpl_vars['content']->value['title'];?>
</p>
                    <hr>
                    <pre id='showcontent'><?php echo $_smarty_tpl->tpl_vars['content']->value['content'];?>
</pre>
                </div>
                <hr>
                <!-- 留言表單區 -->
                <form class="form-horizontal" id='messageform'>
                    <fieldset>
                        <!-- Textarea -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textarea">留言</label>
                            <div class="col-md-4">
                                <textarea class="form-control" spellcheck="false" id="messagetext"
                                    name="message"></textarea>
                                <input type="hidden" id="conid" value="<?php echo $_smarty_tpl->tpl_vars['content']->value['conid'];?>
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
                <p id='messagenum'><span id='msgnum' ><?php echo $_smarty_tpl->tpl_vars['messagenum']->value;?>
</span>則留言</p>
                <hr/>
                <div class="container-fluid text-center" id='messageregion'>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['getmessage']->value, 'messageinfo');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['messageinfo']->value) {
?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <p class='messagename'><?php echo $_smarty_tpl->tpl_vars['messageinfo']->value['userName'];?>
(<?php echo $_smarty_tpl->tpl_vars['messageinfo']->value['account'];?>
)</p>
                            <span class='messagetime'><?php echo $_smarty_tpl->tpl_vars['messageinfo']->value['createtime'];?>
</span>
                        </div>
                        <div class="panel-body" ><p class='messagebody'><?php echo $_smarty_tpl->tpl_vars['messageinfo']->value['message'];?>
</p></div>
                    </div>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </div>
            </div>
            <div class="col-sm-2  sidenav"></div>
            </div>
        </div>

        <?php echo '<script'; ?>
>

            $().ready(function() {
                let height = document.body.offsetHeight;
                $('.row.content').attr('style','height:' + height + 'px');
            })

            $("#messagesend").click(function () {
                let messagetext = $('#messagetext').val();
                let conid = $('#conid').val();
                if ((messagetext.trim()) === "") {
                    $('#messageInfo').html('請輸入留言');
                    return false;
                }

                let res = ['message'];
                for (error of res) {
                    $('#' + error + 'Info').html("&nbsp");
                }
                $.ajax({
                    url: "./message.php",
                    type: "POST",
                    dataType: "json",
                    data: {
                        message: messagetext,
                        conid: conid,
                    },
                    success: function (result) {
                        if (result.notlogin) {
                            alert(result.notlogin)
                            $(window).attr('location', './login.php');
                        } else if (result.success) {
                            let mesinfo = result.success;
                            let str = '';
                                str += "<div class='panel panel-default'>";
                                str += "<div class='panel-heading'>" + mesinfo['userName'] + "(" + mesinfo['account'] + ")";
                                str += "<span class='messagetime'>" + mesinfo['createtime'] + "</span></div>";
                                str += "<div class='panel-body'><p class='messagebody'>" + mesinfo['message'] + "</p></div>";
                                str += "</div>";
                            $("#messageregion").prepend(str);
                            $("#resetmessage").click();
                            let msgnum = parseInt($("#msgnum").html())+1;
                            $("#msgnum").html(msgnum);
                            let height = document.body.offsetHeight;
                            $('.row.content').attr('style','height:' + height + 'px');
                        } else if (result.tofast) {
                            alert(result.tofast);
                        } else if (result) {
                            for (error of res) {
                                $('#' + error + 'Info').html(result[error]);
                            }
                        } else {
                            alert('留言失敗');
                        }
                    }
                });
            });

            $('#messagetext').keyup(function () {
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

            $('#resetmessage').click(function () {
                $('#messagelength').html(100);
                $('#messagesend').attr('disabled', false);
                $('#messagelenerror').attr("style", 'display:none');
            })

        <?php echo '</script'; ?>
>
    </body>
</html><?php }
}
