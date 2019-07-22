<?php

setcookie('token','',time()-10,'/');

header('Location: ./index.php');
?>