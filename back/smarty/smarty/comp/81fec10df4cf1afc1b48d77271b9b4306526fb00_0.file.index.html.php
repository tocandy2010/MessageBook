<?php
/* Smarty version 3.1.33, created on 2019-07-25 16:57:19
  from 'C:\xampp\htdocs\MessageBook\back\smarty\smarty\temp\message\index.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d396eefb82039_77326159',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '81fec10df4cf1afc1b48d77271b9b4306526fb00' => 
    array (
      0 => 'C:\\xampp\\htdocs\\MessageBook\\back\\smarty\\smarty\\temp\\message\\index.html',
      1 => 1564045039,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d396eefb82039_77326159 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">

<head>
    <title>留言板首頁</title>
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
            height: 880px
        }

        /* Set gray background color and 100% height */
        .sidenav {
            padding-top: 20px;
            background-color: #f1f1f1;
            height: 104%;
        }

        #messagetable {
            padding: 30px;
            font-size: 20px;
        }

        #page {
            width: 40%;
            position: absolute;
            top: 90%;
            left: 40%
        }

        .nowpage {
            color: red;
        }

        #page {
            position: absolute;
            top:85%;
        }

        #showtitle {
            width:90%;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
        }

        td {
            width:33%
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
                    <li><span>歡迎登入&nbsp<?php echo $_smarty_tpl->tpl_vars['userinfo']->value['userName'];?>
</span></li>;
                    <li><a href='../../back/controller/newarticle.php'><span>發佈文章</span></a></li>;
                    <li><a href='../../back/controller/myarticle.php'><span>已發佈文章</span></a></li>;
                    <li><a href='../../back/controller/editreg.php'><span>修改會員</span></a></li>;
                    <li><a href='../../back/controller/logout.php'><span>登出</span></a></li>;
                    <?php } else { ?>
                    <li><a href='../../back/controller/login.php'><span>登入</span></a></li>;
                    <li><a href='../../back/controller/reg.php'><span>註冊</span></a></li>;
                    <?php }?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-2 sidenav"></div><!-- 右邊灰色區 -->
            <div class="col-sm-8 text-left">
                <div class="container" id='messagetable'>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>標題</th>
                                <th>發佈者</th>
                                <th>發佈時間</th>
                            </tr>
                        </thead>
                        <tbody id='buildindex'>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['contentdata']->value, 'v', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
?> 
                            <tr>
                                <td><span id='showtitle'><a href = "../controller/content.php?conid=<?php echo $_smarty_tpl->tpl_vars['v']->value['conid'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
</span></a></td>
                                <td><?php echo $_smarty_tpl->tpl_vars['v']->value['userName'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['v']->value['createTime'];?>
</td>
                            </tr>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="col-sm-2 sidenav"></div><!-- 左邊灰色區 -->
        </div>
    </div>
    <div class="container" id='page'>
        <ul class="pagination">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['showpage']->value, 'v', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
?>
                <?php if ($_smarty_tpl->tpl_vars['pagenum']->value !== $_smarty_tpl->tpl_vars['v']->value) {?>
                    <li><a href="../controller/index.php?page=<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value;?>
</a></li>
                <?php } else { ?>
                    <li class="active"><a href="../controller/index.php?page=<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value;?>
</a></li>
                <?php }?>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
    </div>

    <?php echo '<script'; ?>
>
    <?php echo '</script'; ?>
>

</body>

</html><?php }
}
