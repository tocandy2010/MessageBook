<!DOCTYPE html>
<html lang="en">

<head>
    <title>登入留言版</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
        #title {
            text-align: center
        }
        .errorred {
            color: darkred;
        }
    </style>
</head>

<body>
    <?php include_once('../public/head.php') ?>
    <form class="form-horizontal" action='' method='' id='loginform'>
        <fieldset>

            <!-- Form Name -->
            <legend id='title'>
                <h2>留言板登入</h2>
            </legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="">帳號</label>
                <div class="col-md-4">
                    <input id="" name="account" type="text" placeholder="" value="<?php if(isset($_COOKIE['remember'])){echo $_COOKIE['remember']; } ?>" class="form-control input-md">
                    <span class='errorred' id='accountInfo'></span>
                </div>
            </div>

            <!-- Password input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="">密碼</label>
                <div class="col-md-4">
                    <input id="" name="password" type="password" placeholder="" class="form-control input-md">
                    <span class='errorred' id='passwordInfo'></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="appendedtext">驗證碼</label>
                <div class="col-md-3">
                    <div class="input-group">
                        <input id="appendedtext" name="vcode" class="form-control" type="text">
                        <span class="input-group-addon"><img id='vcode' src='../public/vcode.php'></span>
                        <span class='errorred' id='vcodeInfo'></span>
                    </div>
                </div>
            </div>

            <!-- Multiple Checkboxes (inline) -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="checkboxes"></label>
                <div class="col-md-4">
                    <label class="checkbox-inline" for="checkboxes-0">
                        <input type="checkbox" name="remember"  id="checkboxes-0" <?php if(isset($_COOKIE['remember'])&&!empty($_COOKIE['remember'])){echo 'checked';}else{} ?> value="1">
                        記住帳號
                    </label>
                    
                </div>
            </div>
            <!-- Button (Double) -->
            <div class="form-group">
                <label class="col-md-4 control-label" for=""></label>
                <div class="col-md-8">
                    <button id="loginsend"  type='button' class="btn btn-success">登入</button>
                    <a href='./reg.php'><button id="" type='button' name="" class="btn btn-info">註冊</button></a>
                    <span class='errorred' id='errorInfo'></span>
                </div>
            </div>

        </fieldset>
    </form>

    <script>
    
    $('#vcode').click(function(ev){
        this.src = '../public/vcode.php?'+ Math.random();
    })

    $("#loginsend").click(function() {
            let loginform = document.getElementById('loginform')
            let fd = new FormData(loginform);
            let res = ['error', 'vcode'];
            for (error of res) {
                $(`#${error}Info`).html("");
            }
            $.ajax({
                url: "../../back/controller/login.php",
                type: "POST",
                dataType: "json",
                contentType: false,
                processData: false,
                data: fd,
                success: function(result) {
                    if(typeof(result) == 'object'){
                        for (error of res) {
                            $(`#${error}Info`).html(result[error]);
                        }
                    }else if(result == 1){
                        $(window).attr('location','http://localhost/MessageBook/home/message/index.php');
                    }else{
                        $(`#errorInfo`).html("登入失敗");
                    }
                }
            });
        });
    
    </script>

</body>

</html>