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
    <form class="form-horizontal" action='../../back/controller/reg.php' method='post' id='editinfoform'>
        <fieldset>
            <!-- Form Name -->
            <legend id='title'>
                <h2>會員資料修改</h2>
            </legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">姓名</label>
                <div class="col-md-4">
                    <input id="textinput" name="userName" type="text" value="<?php echo $userName; ?>" placeholder="" class="form-control input-md">
                    <span class="help-block">請輸入姓名</span>
                    <span class='errorred' id='userNameInfo'></span>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="">email</label>
                <div class="col-md-4">
                    <input id="" name="email" type="text" value="<?php echo $email; ?>" placeholder="" class="form-control input-md">
                    <span class="help-block">ex:example@com</span>
                    <span class='errorred' id='emailInfo'></span>
                </div>
            </div>

            <!-- Button (Double) -->
            <div class="form-group">
                <label class="col-md-4 control-label" for=""></label>
                <div class="col-md-8">
                    <button id="regsend" type='button' class="btn btn-info">確認修改</button>
                    <a href='./editreg.php'><button type='button' class="btn btn-danger">取消</button></a>
                    <span class='errorred' id='errorInfo'></span>
                </div>
            </div>
        </fieldset>
    </form>
    </div>

    <script>
        /*必須將contentType選項設置為false，強制jQuery不Content-Type為您添加標題，否則，邊界字符串將丟失。
        必須將processData標誌設置為false，否則，jQuery將嘗試將FormData轉換為字符串，將失敗。*/
        $("#regsend").click(function() {
            let editinfoform = document.getElementById('editinfoform')
            let fd = new FormData(editinfoform);
            let res = ['email', 'userName','error'];
            for (error of res) {
                $(`#${error}Info`).html("");
            }
            $.ajax({
                url: "../../back/controller/editinfo.php",
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
                    }else if(result == 1){
                        alert('修改成功');
                        $(window).attr('location', 'http://localhost/MessageBook/home/message/index.php');
                    }else if(result == 2){
                        $(window).attr('location', 'http://localhost/MessageBook/home/login/login.php');
                    }
                }
            });
        });
    </script>
</body>

</html>