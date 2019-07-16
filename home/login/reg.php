<!DOCTYPE html>
<html lang="en">

<head>
    <title>留言版註冊</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
        #title{
            text-align: center
        }
    </style>
</head>

<body>
<?php include_once('../public/head.php') ?>
    <form class="form-horizontal" action='../../back/controller/reg.php' method='post' >
        <fieldset>
            <!-- Form Name -->
            <legend id='title'><h2>留言版註冊</h2></legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="">帳號</label>
                <div class="col-md-4">
                    <input id="" name="account" type="text" placeholder="" class="form-control input-md">

                </div>
            </div>

            <!-- Password input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="">密碼</label>
                <div class="col-md-4">
                    <input id="" name="password" type="password" placeholder="" class="form-control input-md">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="">確認密碼</label>
                <div class="col-md-4">
                    <input id="" name="repassword" type="text" placeholder="" class="form-control input-md">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">姓名</label>
                <div class="col-md-4">
                    <input id="textinput" name="userName" type="text" placeholder="" class="form-control input-md">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="">e-mail</label>
                <div class="col-md-4">
                    <input id="" name="" type="text" placeholder="" class="form-control input-md">
                    <span class="help-block">123</span>
                </div>
            </div>

            <!-- Button (Double) -->
            <div class="form-group">
                <label class="col-md-4 control-label" for=""></label>
                <div class="col-md-8">
                    <button id="" name="" class="btn btn-info">註冊</button>
                    <a href='./login.php'><button id="" name="" type='button' class="btn btn-danger">取消</button></a>
                </div>
            </div>
        </fieldset>
    </form>
    </div>

</body>
</html>