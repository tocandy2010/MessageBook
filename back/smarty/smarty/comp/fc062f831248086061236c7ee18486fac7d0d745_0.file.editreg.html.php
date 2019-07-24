<?php
/* Smarty version 3.1.33, created on 2019-07-24 17:05:02
  from 'D:\xampp\htdocs\MessageBook\back\smarty\smarty\temp\login\editreg.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d38739ea09e30_72372110',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fc062f831248086061236c7ee18486fac7d0d745' => 
    array (
      0 => 'D:\\xampp\\htdocs\\MessageBook\\back\\smarty\\smarty\\temp\\login\\editreg.html',
      1 => 1563900860,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d38739ea09e30_72372110 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">

<head>
    <title>留言版註冊</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"><?php echo '</script'; ?>
>
    <style>
        #edit {
            position: relative;
            left: 30%;
            bottom: 30%;
            width: 40%;
            height: 40%;
            position: fixed;
        }

        #info {
            position: absolute;
            left: 0%;
            border: 1px solid black;
            width: 30%;
            height: 30%;
            text-align: center;
            line-height: 100px;
            font-size: 30px;
            border-radius: 15px;
            color: steelblue
        }

        .mouseover:hover {
            background-color: orange;
            box-shadow: 3px 3px 5px 6px #cccccc;
            cursor: pointer;
        }

        #password {
            border: 1px solid black;
            position: absolute;
            left: 50%;
            width: 30%;
            height: 30%;
            text-align: center;
            line-height: 100px;
            font-size: 30px;
            border-radius: 15px;
            color: steelblue
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
    <div id='edit'>
        <a href='./editinfo.php'>
            <div id='info' class='mouseover'>註冊資訊</div>
        </a>
        <a href='./editpassword.php'>
            <div id='password' class='mouseover'>修改密碼</div>
        </a>

    </div>
</body>

</html><?php }
}
