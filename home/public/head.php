<nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="http://localhost/MessageBook/home/message/index.php">首頁</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <?php if(!empty($_SESSION['useinfo']) && isset($_SESSION['useinfo'])){ ?>
                        <li><a href="../login/login.php"><span></span>已發佈留言</a></li>
                        <li><a href="../login/login.php"><span></span>修改會員</a></li>
                        <li><a href="../login/reg.php"><span></span>登出</a></li>
                    <?php }else{ ?>
                        <li><a href="../login/login.php"><span></span>登入</a></li>
                        <li><a href="../login/reg.php"><span></span>註冊</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>