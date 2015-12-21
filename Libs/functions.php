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
            $user_status='Borrower';
        }
        else{
            $user_status='Participant';
        };
    $loan_type = $userinfo["status"]; //Вид займа - в базе 0 или 1, а значения прописаны тут так как из базы приходило ????
        if($loan_type==1){
            $loan_type='Under the pledge of WellMax assets';
        }
        else{
            $loan_type='Accumulative';
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
            $loan_issue_date='Open';
        }
        else{
            $loan_issue_date= date('d.m.Y', $loan_issue_date );
        }

    //Номер договора займа
    $contract_number = $loaner_info["contract_number"];

    //Договор WellMax
    $loan_BM = $loaner_info["loan_BM"];

    //Срока погашения займа
    $year_payment=date('Y', $loaner_info["loan_issue_date"])+10; //Прибавляет 10 лет к дате выдачи займа так как срок погашения 10 лет
    $date_of_payment= date('d.m.', $loaner_info["loan_issue_date"]) . $year_payment ;

    //ОСТАВШАЯСЯ СУММА
    $loan_left = $loaner_info["loan_left"];

    //ЕЖЕМЕСЯЧНЫЙ ПЛАТЕЖ
    $monthly_payment = $loaner_info["monthly_payment"];

    //ДОСТУПНЫЙ БАЛАНС WELLMAX
    $BM_balance = $loaner_info["BM_balance"];

    //ПРОЦЕНТНАЯ СТАВКА
    $percentage_rate = $loaner_info["percentage_rate"];

    //ДАТА СЛЕДУЮЩЕГО ПЛАТЕЖА
    $next_payment_date=date('07.m.Y',$loaner_info["next_payment_date"]);

    //СУММА ЗАДОЛЖЕННОСТИ
    $total_debt_montly = $loaner_info["total_debt_montly"];

    //Дата пересмотра процентной ставки
    $percent_year_payment=date('Y', $loaner_info["loan_issue_date"])+2; //Прибавляет 2 года к дате выдачи займа так как пересмотр через 2 года
    $percent_rate_change_date= date('d.m.', $loaner_info["loan_issue_date"]) . $percent_year_payment ; // За основу взят date of payment для демо - надо изменить на loan_issue_date

    $loan_years = 10;
    $loan_months = $loan_years*12;//месяцев в году
    $loan_upfront_payment = $loan_amount*0.33; // Первоначальный взнос (33% на данный момент)
    if($userinfo["idUser"]==1 || $userinfo["idUser"]==2){
        $loan_upfront_payment = $loan_amount/3;
        $loan_upfront_payment = round($loan_upfront_payment,0);
    }
    $loan_with_percents = $loan_amount-$loan_upfront_payment; // Тело для начисления процентов
    $loan_monthly_percent = $percentage_rate/1200; //Процентов в месяц
    $monthly_payment_with_percent = $loan_with_percents*($loan_monthly_percent+($loan_monthly_percent/((pow((1+$loan_monthly_percent),$loan_months))-1))); // Месячный платеж с процентами
    $loan_monthly_percentage_payment = '';// Начисление месячных процентов
    $loan_upfront_payment_monthly = $loan_upfront_payment/$loan_months; // Месячный платеж из первого взноса
    $total_monthly_payment = $monthly_payment_with_percent+$loan_upfront_payment_monthly; //Общий месячный аннуитентный платеж

    function drawTable($loan_amount, $total_monthly_payment, $loan_upfront_payment_monthly, $loan_with_percents, $loan_monthly_percent, $monthly_payment_with_percent )
    {
        echo '<style>
        tr:nth-child(even) {background-color: white}
        th, td {
            padding: 5px;
            text-align: center;
            }
        th {
            border: 1px solid #00869D;
            color:#00869D;
            background-color:white;
        }
        td {
            border: 1px dotted #00869D;
        }

        </style>
        <div style="overflow-x:auto; margin-right: 20px;"><table align="center" style="border-collapse: collapse; border: 1px solid #00869D;">
                <tr>
                    <th>Payment No / </br> № платежа</th>
                    <th>Year, month / Год, месяц </th>
                    <th>Amount of </br> monthly payment / </br> Сумма</br> ежемесячного</br> платежа</th>
                    <th>Principal debt /</br> Основной долг</th>
                    <th>Charged interest /</br> Начисленные </br> проценты</th>
                    <th>Outstanding debt /</br> Остаток </br> задолженности</th>
                </tr>'; // Заголовок
        $payment_year = 1;
        $payment_month = 1;
        $loan_monthly_percentage_payment = '';// Начисление месячных процентов
        $loan_pure_payment = ''; //Чистое погашение тела
        $loan_pure_debt = ''; // Чистое тело кредита
        $loan_total_amount_left = ''; // Общий остаток по кредиту
        for ($i=1; $i<121; $i++) {
            echo '<tr>';
            echo '<td>'. $i . '</td><td>'.$payment_year.' год '. $payment_month . ' месяц </td>';
            $loan_monthly_percentage_payment = $loan_with_percents*$loan_monthly_percent; // Вычисление месячных процентов для графы Начисленные проценты
            $loan_pure_payment = $monthly_payment_with_percent - $loan_monthly_percentage_payment; // Вычисление месячного погашения теля для высчитывания Остаток задолженности
            $loan_with_percents = $loan_with_percents - $loan_pure_payment; // Вычисление графы Основной долг
            $loan_amount = $loan_amount - ($loan_pure_payment + $loan_upfront_payment_monthly);
            echo '<td>'. number_format($total_monthly_payment,2) . '</td><td>'.number_format($loan_with_percents,2).'</td><td>'. number_format($loan_monthly_percentage_payment,2).'</td><td>'.number_format($loan_amount,2).'</td>';
            echo "</tr>";
            if($payment_month == 12){
                $payment_year++;
                $payment_month = 0;
            }
            $payment_month++;

        }
        echo '</table></div>';
    }



// Closing Connection
$mysqli->close();
?>