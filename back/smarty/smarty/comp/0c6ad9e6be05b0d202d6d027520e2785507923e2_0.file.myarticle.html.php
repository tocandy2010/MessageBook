<?php
/* Smarty version 3.1.33, created on 2019-07-24 17:51:45
  from 'C:\xampp\htdocs\MessageBook\back\smarty\smarty\temp\message\myarticle.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d382a31e846e7_53367157',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0c6ad9e6be05b0d202d6d027520e2785507923e2' => 
    array (
      0 => 'C:\\xampp\\htdocs\\MessageBook\\back\\smarty\\smarty\\temp\\message\\myarticle.html',
      1 => 1563961876,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d382a31e846e7_53367157 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
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

        #messagetable {
            padding: 30px;
            font-size: 20px;
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
                <div class="container" id='messagetable'>
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
                                <td><a href = "./content.php?conid=<?php echo $_smarty_tpl->tpl_vars['v']->value['conid'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
</a></td>
                                <td><?php echo $_smarty_tpl->tpl_vars['v']->value['createtime'];?>
</td>
                                <td><a href="./myarticleedit.php?conid=<?php echo $_smarty_tpl->tpl_vars['v']->value['conid'];?>
"><button type="button" class="btn btn-success">編輯</button></a></td>
                                <td><button type="button" class="btn btn-danger" data-title= "<?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
" onclick="del(this,<?php echo $_smarty_tpl->tpl_vars['v']->value['conid'];?>
)">刪除</button></td>
                            </tr>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-2 sidenav"></div><!-- 左邊灰色區 -->
        </div>
    </div>
    <?php echo '<script'; ?>
>
        function del(obj,id,name){
            alert(obj.getAttribute('data-title'));
            if(confirm('確認刪除'+name+'"嗎?')){
                $.ajax({
                    url: '../../back/controller/myarticledel.php?conid='+id,
                    type: "GET",
                    dataType: "html",
                    success: function (result) {
                        if(result == 1){
                            $(window).attr('location', '../../back/controller/myarticle.php');
                        }else{
                            alert('刪除失敗')
                        }
                    }
                });
            }
        }

    <?php echo '</script'; ?>
>
</body>

</html><?php }
}
