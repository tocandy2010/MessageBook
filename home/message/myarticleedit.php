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
        #title {
            text-align: center
        }

        .errorred {
            color: darkred;
        }

        #contenttext {
            resize: none;
            overflow-Y: scroll;
        }

        .lenerror {
            display: none;
            color: darkred;
        }
    </style>
</head>

<body>
    <?php include_once('../public/head.php') ?>
    <form class="form-horizontal" action='' method='' id='articleeditform'>
        <fieldset>

            <!-- Form Name -->
            <legend id='title'>
                <h2>修改文章</h2>
            </legend>
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="title">標題</label>
                <div class="col-md-4">
                    <input id="titletext" name="title" spellcheck="false" type="text" placeholder="" class="form-control input-md">
                    <span class="help-block">文字上限&nbsp:&nbsp<span id='titlelength'>10</span><span class='lenerror' id="titlelenerror">已到達文字上限</span></span>
                    <span class='errorred' id="titleInfo"></span>
                </div>
            </div>

            <!-- Textarea -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="content">文章內容</label>
                <div class="col-md-4">
                    <textarea class="form-control" spellcheck="false" id="contenttext" rows="25" name="content"></textarea>
                    <span class="help-block">文字上限&nbsp:&nbsp<span id='contentlength'>10</span><span class='lenerror' id="contentlenerror">已到達文字上限</span></span>
                    <span class='errorred' id="contentInfo"></span>
                </div>
            </div>

            <!-- Button (Double) -->
            <div class="form-group">
                <label class="col-md-4 control-label" for=""></label>
                <div class="col-md-8">
                    <button id="articlesend" type='button' class="btn btn-success">修改</button>
                    <a href='./index.php'><button id="" type='button' class="btn btn-danger">取消</button></a>
                </div>
            </div>
        </fieldset>
    </form>
    </div>
    <script>
        let conid = null;
        let titlemaxlen = 10; //title 最大字數限制
        let contentmaxlen = 10; //content 最大字數限制  
        $().ready(function() {
            let res = ['title', 'content'];

            function getUrlParam(name) {
                var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
                var r = window.location.search.substr(1).match(reg);
                if (r != null) return decodeURI(r[2]);
                return null;
            }
            let getconid = getUrlParam('conid');
            if (getconid !== null) {
                $.ajax({
                    url: `../../back/controller/myarticleedit.php?conid=${getconid}`,
                    type: "GET",
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function(result) {
                        if (typeof(result) == 'object') {
                            for (error of res) {
                                $(`#${error}text`).val(result[error]);
                            }
                            let titlelength = $("#titletext").val().length;
                            let contentlength = $("#contenttext").val().length;
                            let contentnum = contentmaxlen - contentlength;
                            let titlenum = titlemaxlen - titlelength;
                            if (contentnum < 0) {
                                $("#contentlength").html(0)
                            } else {
                                $("#contentlength").html(contentnum)
                            }
                            if (titlenum < 0) {
                                $("#titlelength").html(0)
                            } else {
                                $("#titlelength").html(titlenum)
                            }
                            conid = getconid; //需要修改的id
                        } else {
                            $(window).attr('location', './index.php');
                        }
                    }
                });
            } else {
                $(window).attr('location', './index.php');
            }

        });

        $("#articlesend").click(function() {
            let articleeditform = document.getElementById('articleeditform')
            let fd = new FormData(articleeditform);
            fd.append('editconid', conid);
            let res = ['title', 'content', 'error'];
            for (error of res) {
                $(`#${error}Info`).html("");
            }
            $.ajax({
                url: "../../back/controller/article.php",
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
                    } else if (result == 1) {
                        alert('修改成功');
                        $(window).attr('location', 'http://localhost/MessageBook/home/message/myarticle.php');
                    } else {
                        alert('修改失敗');
                        $(window).attr('location', 'http://localhost/MessageBook/home/message/index.php');
                    }
                }
            });
        });
        let titleflag = true;
        let contentflag = true;
        $('#titletext').keyup(function() {
            let inplen = $('#titletext').val();
            //let titlelen = $('#titlelength').html();
            if (inplen.length <= 10) {
                $('#titlelength').html(10 - inplen.length);
                $('#titlelenerror').attr("style", 'display:none');
                titleflag = true;
            } else {
                $('#titlelength').html(0);
                $('#titlelenerror').attr("style", 'display:inline-block');
                titleflag = false;
            }
            checkwordlen(titleflag, contentflag);
        })

        $('#contenttext').keyup(function() {
            let inplen = $('#contenttext').val();
            if (inplen.length <= contentmaxlen) {
                $('#contentlength').html(contentmaxlen - inplen.length);
                $('#contentlenerror').attr("style", 'display:none');
                contentflag = true;
            } else {
                $('#contentlength').html(0);
                $('#contentlenerror').attr("style", 'display:inline-block');
                contentflag = false;
            }
            checkwordlen(titleflag, contentflag);
        })

        function checkwordlen(a, b) {
            if ((titleflag === true) && (contentflag === true)) {
                $('#articlesend').attr("disabled", false);
            } else {
                $('#articlesend').attr("disabled", true);
            }
        }
    </script>
</body>

</html>