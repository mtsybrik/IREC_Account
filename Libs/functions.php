<?php

session_start(); // Starting Session
if(empty($_SESSION['login_user'])){
    header("Location: login.php");
    exit;}
require('connect.php');

// SQL query to fetch information of registerd users and finds user match.
    $username = $_SESSION['login_user'];
    $useravatar = $user_firstname = $userinfo = $user_lastname= $user_status = $loan_type= $loan_amount = $userid= '';
    $userinfo = $mysqli->query("SELECT * FROM User WHERE login = '$username'"); //Выборка данных пользователя для дальнейшего использования
    $userinfo = $userinfo->fetch_assoc();
    $useravatar = $userinfo["picture_url"]; // Путь к аватару, фактически аватарку складываем на сервак
    $user_firstname = $userinfo["firstname"]; // Имя пользователя
    $user_lastname = $userinfo["last_name"]; // Фамилия пользователя
    $user_status = $userinfo["status"]; // Статус пользователя - в базе 0 или 1, значения в коде менять
        if($user_status==1){
            $user_status='Заемщик';
        }
        else{
            $user_status='Участник';
        };
    $loan_type = $userinfo["status"]; //Вид займа - в базе 0 или 1, а значения прописаны тут так как из базы приходило ????
        if($loan_type==1){
            $loan_type='Под залог прав на активы WellMax';
        }
        else{
            $loan_type='Накопительный';
        };
    $loan_amount = $userinfo["loan_amount"]; //ОБЩАЯ СУММА ЗАЙМА
    $userid = $userinfo["idUser"]; // Выбираем id пользователя потому что база не связана Foreign Key ключами


    $loan_issue_date = $date_of_payment = $loan_BM = $total_loan= $loan_left = $monthly_payment = $next_payment_date = $loaner_info = $contract_number = '';
    $BM_balance = $percentage_rate = $total_debt_montly = $percent_rate_change_date = $real_estate_insurance_period = $personal_insurance_period = '';
    $loaner_info = $mysqli->query("SELECT * FROM loaner_profile WHERE iduser_profile = '$userid'"); //Выбираем пользователя по id
    $loaner_info = $loaner_info->fetch_assoc();
    $loan_issue_date = $loaner_info["loan_issue_date"]; //   Дата выдачи займа:
        if($loan_issue_date==0){
            $loan_issue_date='Открыта';
        }
        else{
            $loan_issue_date= date('d.m.Y', $loan_issue_date );
        }
    $contract_number = $loaner_info["contract_number"]; //Номер договора займа
    $loan_BM = $loaner_info["loan_BM"]; //Договор WellMax
    $year_payment=date('Y', $loaner_info["date_of_payment"])+10; //Прибавляет 10 лет к дате выдачи займа так как срок погашения 10 лет
    $date_of_payment= date('d.m.', $loaner_info["date_of_payment"]) . $year_payment ; // За основу взят date of payment для демо - надо изменить на loan_issue_date




    $mysqli->close();// Closing Connection

?>