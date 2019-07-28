<?php
/* Smarty version 3.1.33, created on 2019-07-29 00:48:11
  from 'D:\xampp\htdocs\MessageBook\back\smarty\smarty\temp\message\myarticle.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d3dd1cb5fe1e1_94924670',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '46c79df95ee072508f84d9a4bfae297d622ab6ae' => 
    array (
      0 => 'D:\\xampp\\htdocs\\MessageBook\\back\\smarty\\smarty\\temp\\message\\myarticle.html',
      1 => 1564332205,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:D:\\xampp\\htdocs\\MessageBook\\back\\public\\header.html' => 1,
  ),
),false)) {
function content_5d3dd1cb5fe1e1_94924670 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- <!DOCTYPE html>
<html lang="en">

<head>
    <title>我的文章</title>
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

        #messagetable {
            padding: 30px;
            font-size: 20px;
        }

        #showtitle {
            width: 90%;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
        }

        #user {
            font-size: 20px;
            color: white;
            cursor: default;
            position: absolute;
            top:20%
        }
    </style>
</head> -->
<?php $_smarty_tpl->_subTemplateRender('file:D:\xampp\htdocs\MessageBook\back\public\header.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'我的文章'), 0, false);
?>
<header>
    <style>
        #messagetable {
            padding: 30px;
            font-size: 20px;
        }

        #showtitle {
            width: 90%;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
        }

        #user {
            font-size: 20px;
            color: white;
            cursor: default;
            position: absolute;
            top: 10px;
        }
    </style>
<header>

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
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>主題</th>
                                <th>發佈時間</th>
                                <th>修改</th>
                                <th>刪除</th>
                            </tr>
                        </thead>
                        <tbody id='buildmyarticle'>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['mycontent']->value, 'v', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
?>
                            <tr>
                                <td style="width:50%"><a href="./content.php?conid=<?php echo $_smarty_tpl->tpl_vars['v']->value['conid'];?>
"><span
                                            id='showtitle'><?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
</span></a></td>
                                <td><?php echo $_smarty_tpl->tpl_vars['v']->value['createtime'];?>
</td>
                                <td><a href="./myarticleedit.php?conid=<?php echo $_smarty_tpl->tpl_vars['v']->value['conid'];?>
"><button type="button"
                                            class="btn btn-success">編輯</button></a></td>
                                <td><span class='delcontnet' data-title="<?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
"
                                        data-conid="<?php echo $_smarty_tpl->tpl_vars['v']->value['conid'];?>
"><button type="button"
                                            class="btn btn-danger">刪除</button><span></span></td>
                            </tr>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-2 sidenav"></div>
            </div>
        </div>
    <?php echo '<script'; ?>
>

        $(".delcontnet").click(function () {
            let title = this.getAttribute('data-title');
            let conid = this.getAttribute('data-conid');
            let _this = this;
            if (confirm('確認刪除文章[' + title + ']嗎?')) {
                $.ajax({
                    url: '../../back/controller/myarticledel.php?conid=' + conid,
                    type: "GET",
                    dataType: "json",
                    success: function (result) {
                        if (result.delsuccess) {
                            $(_this).parent().parent().remove();
                        } else if (result.nologin) {
                            alert(result.nologin)
                            $(window).attr('location', './login.php');
                        } else if (result.erroruser) {
                            alert(result.erroruser)
                        } else {
                            alert('刪除失敗')
                        }
                    }
                });
            }
        })




    <?php echo '</script'; ?>
>
</body>

</html><?php }
}
