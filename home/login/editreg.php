<!DOCTYPE html>
<html lang="en">

<head>
    <title>留言版註冊</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
        #edit{
             position: relative;
             left:30%;
             bottom:30%;
             width:40%;
             height:40%;
             position:fixed;
        }
        #info{
            position:absolute;
            left: 0%;
            border:1px solid black;
            width:30%;
            height: 30%;
            text-align: center;
            line-height:  100px;
            font-size: 30px;
            border-radius: 15px;
            color:steelblue
        }
        .mouseover:hover{
            background-color: orange;
            box-shadow:3px 3px 5px 6px #cccccc;
            cursor: pointer;
        }

        #password{
            border:1px solid black;
            position:absolute;
            left: 50%;
            width:30%;
            height: 30%;
            text-align: center;
            line-height:  100px;
            font-size: 30px;
            border-radius: 15px;    
            color:steelblue
        }
    </style>
</head>

<body>
    <?php include_once('../public/head.php') ?>
    <div id='edit'>
        <a href='./editinfo.php'><div id='info' class='mouseover'>註冊資訊</div></a>
        <a href='./editpassword.php'><div id='password' class='mouseover'>修改密碼</div></a>

    </div>
</body>

</html>