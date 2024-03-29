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
                <h2>會員密碼修改</h2>
            </legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">舊密碼</label>
                <div class="col-md-4">
                    <input id="textinput" name="oldpassword" type="password" placeholder="" class="form-control input-md">
                    <span class="help-block">請輸入舊密碼</span>
                    <span class='errorred' id='oldpasswordInfo'></span>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="">新密碼</label>
                <div class="col-md-4">
                    <input id="" name="password" type="password" placeholder="" class="form-control input-md">
                    <span class="help-block">請輸入6~20位數 英文或數字&nbsp&nbsp&nbsp禁止輸入任何符號</span>
                    <span class='errorred' id='passwordInfo'></span>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="">確認新密碼</label>
                <div class="col-md-4">
                    <input id="" name="repassword" type="password" placeholder="" class="form-control input-md">
                    <span class="help-block">與新密碼相同</span>
                    <span class='errorred' id='repasswordInfo'></span>
                </div>
            </div>

            <!-- Button (Double) -->
            <div class="form-group">
                <label class="col-md-4 control-label" for=""></label>
                <div class="col-md-8">
                    <button id="regsend" type='button' class="btn btn-info">確認修改</button>
                    <a href='./editreg.php'><button type='button' class="btn btn-danger">取消</button></a>
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
            let res = ['oldpassword', 'password', 'repassword'];
            for (error of res) {
                $(`#${error}Info`).html("");
            }
            $.ajax({
                url: "../../back/controller/editpassword.php",
                type: "POST",
                dataType: "json",
                contentType: false,
                processData: false,
                data: fd,
                success: function(result) {
                    if (typeof(result) == 'object') {
                        for (error of res) {
                            $(`#${error}Info`).html(result[error]);
                        }
                    }else if (result == '1') {
                        alert('修改成功');
                        $(window).attr('location', 'http://localhost/MessageBook/home/login/editreg.php');
                    }else if (result == '2') {
                        $(window).attr('location', 'http://localhost/MessageBook/home/login/login.php');
                    }
                }
            });
        });
    </script>
</body>

</html>