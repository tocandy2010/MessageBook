<?php
/* Smarty version 3.1.33, created on 2019-07-29 00:43:40
  from 'D:\xampp\htdocs\MessageBook\back\smarty\smarty\temp\message\index.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d3dd0bca5f637_15752328',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bb91ebe74a8064eec883d54a3ad4d320b0483d77' => 
    array (
      0 => 'D:\\xampp\\htdocs\\MessageBook\\back\\smarty\\smarty\\temp\\message\\index.html',
      1 => 1564332055,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:D:\\xampp\\htdocs\\MessageBook\\back\\public\\header.html' => 1,
  ),
),false)) {
function content_5d3dd0bca5f637_15752328 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- <!DOCTYPE html>
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
        

    </style>
</head>

 -->
<?php $_smarty_tpl->_subTemplateRender('file:D:\xampp\htdocs\MessageBook\back\public\header.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'留言版首頁'), 0, false);
?>
<header>
    <style>
        #messagetable {
            padding: 30px;
            font-size: 20px;
        }

        #page {
            position: relative;
            top: -20%;
            left: 0%;
        }

        #showtitle {
            width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
        }

        td {
            width: 33%;
        }

        #user {
            font-size: 20px;
            color: white;
            cursor: default;
            position: absolute;
            top: 10px;
        }
    </style>
</header>
<!-- <body>
    <nav class="navbar navbar-inverse">
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
            <div class="col-sm-2 sidenav">
                <div class="form-group">
                    <div class="col-md-12">
                        <form action="./" method = 'get'>
                            <p><input name="search" type="text" spellcheck ="false" 
                                placeholder="依文章或姓名查詢" class="form-control input-md" ></p>
                            <p><button id="searchbun" type="submit" class="btn btn-info btn-block">search</button></p>
                        </form>               
                    </div>
                </div>
            </div>
            <div class="col-sm-8 text-left">
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
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['contentdata']->value, 'coninfo');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['coninfo']->value) {
?>
                        <tr>
                            <td><span id='showtitle'><a
                            href="../controller/content.php?conid=<?php echo $_smarty_tpl->tpl_vars['coninfo']->value['conid'];?>
"><?php echo $_smarty_tpl->tpl_vars['coninfo']->value['title'];?>
</span></a>
                            </td>
                            <td><?php echo $_smarty_tpl->tpl_vars['coninfo']->value['userName'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['coninfo']->value['createtime'];?>
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
            <div class="col-sm-2 sidenav">
                <div class="well">
                    <p>1.站內禁止任何交易行為</p>
                    <p>2.禁止人身攻擊的文字</p>
                    <p>3.相親相愛不吵架</p>
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
&search=<?php echo $_smarty_tpl->tpl_vars['search']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value;?>
</a></li>
                        <?php } else { ?>
                            <li class="active"><a href="../controller/index.php?page=<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
&search=<?php echo $_smarty_tpl->tpl_vars['search']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value;?>
</a></li>
                        <?php }?>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </ul>
            </div>
        </div>
    </div>
    <?php echo '<script'; ?>
>
    <?php echo '</script'; ?>
>

</body>

</html><?php }
}
