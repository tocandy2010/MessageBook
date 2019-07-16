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
    </style>
</head>

<body>
    <?php include_once('../public/head.php') ?>
    <form class="form-horizontal">
        <fieldset>

            <!-- Form Name -->
            <legend id='title'>
                <h2>留言板登入</h2>
            </legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="">帳號</label>
                <div class="col-md-4">
                    <input id="" name="" type="text" placeholder="" class="form-control input-md">

                </div>
            </div>

            <!-- Password input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="">密碼</label>
                <div class="col-md-4">
                    <input id="" name="" type="password" placeholder="" class="form-control input-md">

                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="appendedtext">驗證碼</label>
                <div class="col-md-2">
                    <div class="input-group">
                        <input id="appendedtext" name="" class="form-control" type="text">
                        <span class="input-group-addon"><img id='vcode' src='../public/vcode.php'></span>
                    </div>
                    <p class="help-block">help</p>
                </div>
            </div>

            <!-- Multiple Checkboxes (inline) -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="checkboxes"></label>
                <div class="col-md-4">
                    <label class="checkbox-inline" for="checkboxes-0">
                        <input type="checkbox" name="checkboxes" id="checkboxes-0" value="1">
                        記住帳號
                    </label>
                </div>
            </div>
            <!-- Button (Double) -->
            <div class="form-group">
                <label class="col-md-4 control-label" for=""></label>
                <div class="col-md-8">
                    <button id="" name="" class="btn btn-success">登入</button>
                    <a href='./reg.php'><button id="" type='button' name="" class="btn btn-info">註冊</button></a>
                </div>
            </div>

        </fieldset>
    </form>

    <script>
    
    $('#vcode').click(function(ev){
        this.src = '../public/vcode.php?'+ Math.random();
    })
    
    </script>

</body>

</html>