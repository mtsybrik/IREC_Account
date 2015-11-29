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

    //   Дата выдачи займа:
    $loan_issue_date = $loaner_info["loan_issue_date"];
        if($loan_issue_date==0){
            $loan_issue_date='Открыта';
        }
        else{
            $loan_issue_date= date('d.m.Y', $loan_issue_date );
        }

    //Номер договора займа
    $contract_number = $loaner_info["contract_number"];

    //Договор WellMax
    $loan_BM = $loaner_info["loan_BM"];

    //Срока погашения займа
    $year_payment=date('Y', $loaner_info["date_of_payment"])+10; //Прибавляет 10 лет к дате выдачи займа так как срок погашения 10 лет
    $date_of_payment= date('d.m.', $loaner_info["date_of_payment"]) . $year_payment ; // За основу взят date of payment для демо - надо изменить на loan_issue_date

    //ОСТАВШАЯСЯ СУММА
    $loan_left = $loaner_info["loan_left"];

    //ЕЖЕМЕСЯЧНЫЙ ПЛАТЕЖ
    $monthly_payment = $loaner_info["monthly_payment"];

    //ДОСТУПНЫЙ БАЛАНС WELLMAX
    $BM_balance = $loaner_info["BM_balance"];

    //ДАТА СЛЕДУЮЩЕГО ПЛАТЕЖА
    $next_payment_date=date('07.m.Y',$loaner_info["next_payment_date"]);

    //СУММА ЗАДОЛЖЕННОСТИ
    $total_debt_montly = $loaner_info["total_debt_montly"];

    //Дата пересмотра процентной ставки
    $percent_year_payment=date('Y', $loaner_info["date_of_payment"])+2; //Прибавляет 10 лет к дате выдачи займа так как срок погашения 10 лет
    $percent_rate_change_date= date('d.m.', $loaner_info["date_of_payment"]) . $percent_year_payment ; // За основу взят date of payment для демо - надо изменить на loan_issue_date




// Closing Connection
$mysqli->close();
?>