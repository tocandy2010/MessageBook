<!DOCTYPE html>
<html lang="en">

<head>
    <title>留言版</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
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

        #message {
            padding: 0px 50px 0px 50px;
        }
        #leavemessage{
            position: relative;
            right:20%;
        }
        #lmtextarea{
            width:200%;
            height:100px;
            resize:none;
            overflow-y:scroll;
        }
    </style>
</head>

<body>
<?php include_once('../public/head.php') ?>
    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-2 sidenav"></div><!-- 右邊灰色區 -->
            <div class="col-sm-8 text-left">
                <div id='message'>
                    <h1>標題</h1>
                    <hr>
                    <p>{Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore
                        et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                        ut
                        aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                        qui
                        officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor
                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                        ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    }</p>
                </div>
                <hr>

                <div class="container">
                    <div class="panel panel-default">
                        <div class="panel-heading">who</div>
                        <div class="panel-body"></div>
                    </div>
                </div>

                <div id='leavemessage'><!-- 留言表單區 -->
                    <form class="form-horizontal">
                        <fieldset>
                            <!-- Textarea -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textarea">留言</label>
                                <div class="col-md-4">
                                    <textarea class="form-control" id="lmtextarea" name="message"></textarea>
                                </div>
                            </div>

                            <!-- Button (Double) -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="button1id"></label>
                                <div class="col-md-8">
                                    <button id="button1id" name="button1id" class="btn btn-info">留言</button>
                                    <button id="button2id" name="button2id" class="btn btn-default">清除</button>
                                </div>
                            </div>

                        </fieldset>
                    </form>
                </div>

            </div>
            <div class="col-sm-2 sidenav"></div><!-- 左邊灰色區 -->
        </div>
    </div>
</body>

</html>