<?php
$page='';
if(isset($_GET['page'])){
    $page=trim(strip_tags($_GET['page']));
}
else{
    $page='now';
}
require 'functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body style="background-image:url('../assets/img/PDF_bkg.png');">
<? echo drawTable($loan_amount, $total_monthly_payment, $loan_upfront_payment_monthly, $loan_with_percents, $loan_monthly_percent, $monthly_payment_with_percent ); ?>
</body>
</html>