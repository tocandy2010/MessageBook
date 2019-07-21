<!DOCTYPE html>
<html lang="en">

<head>
    <title>我的文章</title>
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
        #messagetable{
            padding: 30px;
            font-size: 20px;
        }
    </style>
</head>

<body>

    <?php include_once('../public/head.php') ?>

    <div class="container-fluid text-center">
        <div class="row content">
            <div class="col-sm-2 sidenav"></div><!-- 右邊灰色區 -->
            <div class="col-sm-8 text-left">
                <div class="container" id='messagetable'>
                    <table class="table table-striped" >
                        <thead>
                            <tr>
                                <th>主題</th>
                                <th>發佈時間</th>
                                <th>修改</th>
                            </tr>
                        </thead>
                        <tbody id='buildmyarticle'>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-2 sidenav"></div><!-- 左邊灰色區 -->
        </div>
    </div>
    <script>
        $().ready(function() {
            function getUrlParam(name) {
                var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
                var r = window.location.search.substr(1).match(reg);
                if (r != null) return decodeURI(r[2]);
                return null;
            }
            let page = getUrlParam('page')
            $.ajax({
                url: `../../back/controller/myarticle.php?page=${page}`,
                type: "GET",
                dataType: "html",
                success: function(result) {
                    if (typeof(result) == 'string') {
                        $('#buildmyarticle').append(result)
                    } else {

                    }
                }
            });
        })
    
    </script>
</body>

</html>