<!DOCTYPE html>
<html lang="en">

<head>
    <title>留言版註冊</title>
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
    <form class="form-horizontal" action='../../back/controller/reg.php' method='post' id='regform'>
        <fieldset>
            <!-- Form Name -->
            <legend id='title'>
                <h2>留言版註冊</h2>
            </legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="">帳號</label>
                <div class="col-md-4">
                    <input id="" name="account" type="text" placeholder="" class="form-control input-md">
                    <span class="help-block">請輸入6~20位數 英文+數字&nbsp&nbsp&nbsp禁止輸入任何符號</span>
                    <span class='errorred' id='accountInfo'></span>
                </div>
            </div>

            <!-- Password input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="">密碼</label>
                <div class="col-md-4">
                    <input id="" name="password" type="password" placeholder="" class="form-control input-md">
                    <span class="help-block">請輸入6~20位數 英文+數字&nbsp&nbsp&nbsp禁止輸入任何符號</span>
                    <span class='errorred' id='passwordInfo'></span>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="">確認密碼</label>
                <div class="col-md-4">
                    <input id="" name="repassword" type="password" placeholder="" class="form-control input-md">
                    <span class="help-block">與密碼相同</span>
                    <span class='errorred' id='repasswordInfo'></span>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">姓名</label>
                <div class="col-md-4">
                    <input id="textinput" name="userName" type="text" placeholder="" class="form-control input-md">
                    <span class="help-block">請輸入姓名</span>
                    <span class='errorred' id='userNameInfo'></span>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="">email</label>
                <div class="col-md-4">
                    <input id="" name="email" type="text" placeholder="" class="form-control input-md">
                    <span class="help-block">ex:example@com</span>
                    <span class='errorred' id='emailInfo'></span>
                </div>
            </div>

            <!-- Button (Double) -->
            <div class="form-group">
                <label class="col-md-4 control-label" for=""></label>
                <div class="col-md-8">
                    <button id="regsend" type='button' class="btn btn-info">註冊</button>
                    <a href='./login.php'><button type='button' class="btn btn-danger">取消</button></a>
                    <span class='errorred' class id='regerror'></span>
                </div>
            </div>
        </fieldset>
    </form>
    </div>

    <script>
        /*必須將contentType選項設置為false，強制jQuery不Content-Type為您添加標題，否則，邊界字符串將丟失。
        必須將processData標誌設置為false，否則，jQuery將嘗試將FormData轉換為字符串，將失敗。*/
        $("#regsend").click(function() {
            let regform = document.getElementById('regform')
            let fd = new FormData(regform);
            let res = ['account', 'password', 'repassword', 'email', 'userName'];
            for (error of res) {
                $('#'+${error}+'Info').html("");
            }
            $.ajax({
                url: "../../back/controller/regback.php",
                type: "POST",
                dataType: "json",
                contentType: false,
                processData: false,
                data: fd,
                success: function(result) {
                    if (typeof(result) == 'object') {
                        for (error of res) {
                            $('#'+error}+'Info').html(result[error]);
                        }
                    }else if(result == '1'){
                        $(window).attr('location','http://localhost/MessageBook/home/login/login.php');
                    }else{
                        $(`#regerror`).html("註冊失敗");
                    }
                }
            });
        });
    </script>
</body>

</html>