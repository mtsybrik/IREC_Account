<?php
$mysqli = mysqli_init();
if (!$mysqli) {
    die('mysqli_init failed');
}
$env='';
//$env ='production'; Переключение между лайв и локальной базой
if($env=='production') {
    $user = 'corpwffl_account';
    $password = "J9yW0HbKMRz";
    $db = 'corpwffl_accounts';
    $host = 'localhost';
    $port = 3306;
}
else{
    $user = 'root';
    $password = "root";
    $db = 'accounts_db';
    $host = 'localhost';
    $port = 3307;
}
if (!$mysqli->real_connect($host, $user, $password, $db,$port)){
    die('Connect Error (' . mysqli_connect_errno() . ') '
        . mysqli_connect_error());
}
?>