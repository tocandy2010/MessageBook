<?php

session_start();
unset($_SESSION['vcode']);
unset($_SESSION['userinfo']);

header('Location: http://localhost/MessageBook/home/message/index.php');
?>