<?php
require 'connect.php';

$mysqli->query("UPDATE loaner_profile SET next_payment_date=UNIX_TIMESTAMP();");
$mysqli->query("UPDATE loaner_profile SET loan_left=(loan_left-monthly_payment)");


// Closing Connection
$mysqli->close();
?>