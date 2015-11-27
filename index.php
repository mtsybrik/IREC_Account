<?php
session_start();
//require 'Libs/cookies.php';
$page='';
if(isset($_GET['page'])){
    $page=trim(strip_tags($_GET['page']));
}
else{
    $page='now';
}
//require 'Libs/connect.php';

if(empty($_SESSION['login_user'])){
        header("Location: login.php");
        exit;}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<title>Webarch - Responsive Admin Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta content="" name="description" />
<meta content="" name="author" />
    
<link href="assets/plugins/jquery-metrojs/MetroJs.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="assets/plugins/shape-hover/css/demo.css" />
<link rel="stylesheet" type="text/css" href="assets/plugins/shape-hover/css/component.css" />
<link rel="stylesheet" type="text/css" href="assets/plugins/owl-carousel/owl.carousel.css" />
<link rel="stylesheet" type="text/css" href="assets/plugins/owl-carousel/owl.theme.css" />
<link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="assets/plugins/jquery-slider/css/jquery.sidr.light.css" rel="stylesheet" type="text/css" media="screen"/>
<link rel="stylesheet" href="assets/plugins/jquery-ricksaw-chart/css/rickshaw.css" type="text/css" media="screen" >
<link rel="stylesheet" href="assets/plugins/Mapplic/mapplic/mapplic.css" type="text/css" media="screen" >
<!-- BEGIN CORE CSS FRAMEWORK -->
<link href="assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css"/>
<!-- END CORE CSS FRAMEWORK -->

<!-- BEGIN CSS TEMPLATE -->
<link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/responsive.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/magic_space.css" rel="stylesheet" type="text/css"/>
<!-- END CSS TEMPLATE -->

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="">
<!-- BEGIN HEADER -->
<!-- END HEADER -->
<!-- BEGIN CONTAINER -->
<div class="page-container row-fluid">
  <!-- BEGIN SIDEBAR -->
  <div class="page-sidebar" id="main-menu">
    <!-- BEGIN MINI-PROFILE -->
    <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
      <div class="user-info-wrapper">
        <div class="profile-wrapper"> <img src="assets/img/profiles/avatar.jpg"  alt="" data-src="assets/img/profiles/avatar.jpg" data-src-retina="assets/img/profiles/avatar2x.jpg" width="69" height="69" /> </div>
        <div class="user-info">
          <div class="username">Natalia <span class="semi-bold">Pisanina</span></div>
          <div class="status">Status
            <div class="status-icon green"></div>
            Заемщик</div>
        </div>
      </div>
      <!-- END MINI-PROFILE -->
      <!-- BEGIN SIDEBAR MENU -->
      <!--<p class="menu-title">BROWSE <span class="pull-right"><a href="javascript:;"><i class="fa fa-refresh"></i></a></span></p>-->
      <ul>
        <li class=""> <a href="#"> <i class="fa fa-users"></i> <span class="title">Участник</span></a> </li>
        <li class="start "> <a href="index.php" > <i class="icon-custom-home"></i> <span class="title">Заемщик</span> <span class="selected"></span></a></li>
          <li class=""> <a href="1"> <i class="fa fa-folder-open"></i> <span class="title">Документы</span> <span class="arrow "></span> </a>
              <ul class="sub-menu">
                  <li > <a href="javascript:;"> Бланки </a> </li>
                  <li > <a href="javascript:;"> Мои документы</a></li>
              </ul>
          </li>
      </ul>
      <div class="side-bar-widgets">
        <p class="menu-title"></p>
        <ul class="folders">
          <li><a href="#">
            <div class="status-icon green"></div>
            История Взносов </a> </li>
        </ul>
      </div>
      <!-- END SIDEBAR MENU -->
    </div>
  </div>
  <div class="footer-widget">
    <i class="fa fa-power-off"></i><span class="title"><a href="login.php">&nbsp;&nbsp;&nbsp;&nbsp;Выйти</a></span>
  </div>
  <!-- END SIDEBAR -->
  <!-- BEGIN PAGE CONTAINER-->
  <div class="page-content">
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div id="portlet-config" class="modal hide">
      <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button"></button>
        <h3>Widget Settings</h3>
      </div>
      <div class="modal-body"> Widget settings form goes here </div>
    </div>
    <div class="clearfix"></div>
    <div class="content sm-gutter">
      <div class="page-title">
      </div>
	   <!-- BEGIN DASHBOARD TILES -->
      <div class="row">
        <div class="col-md-2 col-vlg-3 col-sm-2">
          <img src="assets/img/INTERNATIONAL-REAL-ESTATE-COMMUNITY_logo_7.png" >
        </div>
        <div class="col-md-5 col-vlg-3 col-sm-5">
          <div class="user-mini-description">
            <h5>Номер договора займа</h5>
            <h3 class="text-success semi-bold">
              CRC-90000001
            </h3>
            <br><br style="line-height: 2.2em">
            <h5>Договор WellMax</h5>
            <h3 class="text-success semi-bold">
              WMGLP-20140326-008296-131
            </h3>
          </div>
        </div>
        <div class="col-md-4 col-vlg-4 col-sm-4" style="float: right" >
          <h6 class="no-margin"><i class="fa fa-shield"></i>&nbsp;&nbsp;Вид займа</h6>
          <h4 class="semi-bold no-margin">Под залог прав на активы WellMax</h4>
          <br>
          <h6 class="no-margin"><i class="fa fa-briefcase"></i>&nbsp;&nbsp;  Дата выдачи займа:</h6>
          <h4 class="semi-bold no-margin">Открыта</h4>
          <br>
          <h6 class="no-margin"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;  Срок погашения займа:</h6>
          <h4 class="semi-bold no-margin">27.11.2025</h4>
        </div>
      </div>
      <div class="row 2col">
        <div class="col-md-3 col-sm-3 m-b-10">
          <div class="tiles blue ">
            <div class="tiles-body">
              <div class="tiles-title"> ОБЩАЯ СУММА ЗАЙМА </div>
              <div class="heading"> $<span class="animate-number" data-value="110000" data-animation-duration="1200">110000</span> </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-3 m-b-10">
          <div class="tiles green ">
            <div class="tiles-body">
              <div class="tiles-title"> ОСТАВШАЯСЯ СУММА </div>
              <div class="heading"> $<span class="animate-number" data-value="110000" data-animation-duration="1000">110000</span> </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-3 m-b-10">
          <div class="tiles red ">
            <div class="tiles-body">
              <div class="tiles-title"> ЕЖЕМЕСЯЧНЫЙ ПЛАТЕЖ </div>
              <div class="heading"> $ <span class="animate-number" data-value="980.31" data-animation-duration="1200">980.31</span> </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 m-b-10">
          <div class="tiles purple  ">
            <div class="tiles-body">
              <div class="tiles-title"> ПРОЦЕНТНАЯ СТАВКА </div>
              <div class="row-fluid">
                <div class="heading"> <span class="animate-number" data-value="1.99" data-animation-duration="12">1.99</span>% </div>
            </div>
          </div>
        </div>
      </div>
      </div>
		<!-- BEGIN REALTIME SALES GRAPH -->
		<div class="row">
        <div class="col-md-12 col-vlg-12 m-b-10 ">
			<div class="tiles white">
			  <div class="row">
				<div class="sales-graph-heading">
				<div class="col-md-5 col-sm-5">
                  <p class="semi-bold">ДОСТУПНЫЙ БАЛАНС WELLMAX</p>
				  <h4><span class="item-count animate-number semi-bold" data-value="395.64" data-animation-duration="700">395.64</span> USD</h4>
				</div>
				<div class="col-md-3 col-sm-3">
				  <p class="semi-bold">ДАТА СЛЕДУЮЩЕГО ПЛАТЕЖА</p>
				  <h4><span class="semi-bold">07.12.2015</span></h4>
				</div>
				<div class="col-md-4 col-sm-4">
				  <p class="semi-bold">СУММА ЗАДОЛЖЕННОСТИ</p>
				  <h4><span class="item-count animate-number semi-bold" data-value="0" data-animation-duration="700">0</span> USD</h4>
				</div>
				<div class="clearfix"></div>
			  </div>
			  </div>
			  <!--<h5 class="semi-bold m-t-30 m-l-30">LAST SALE</h5>-->
			  <table class="table no-more-tables m-t-20 m-l-20 m-b-30">
				<tbody>
				  <tr>
					<td style="width: 475px;"><span class="muted">Дата пересмотра процентной ставки</span> </td>
					<td><span class="muted bold text-success">25.11.2017</span> </td>
					<td ></td>
				  </tr>
				  <tr>
					<td style="width: 475px;"><span class="muted">Период действия страхования недвижимостиe</span> </td>
					<td><span class="muted bold text-success"></span> </td>
					<td class="v-align-middle"></td>
				  </tr>
                  <tr>
					<td style="width: 475px;"><span class="muted">Период действия личного страхования</span> </td>
					<td><span class="muted bold text-success"></span> </td>
					<td class="v-align-middle"></td>
				  </tr>
				</tbody>
			  </table>
			</div>
        </div>
        </div>
      <div>
        <div class="col-md-4 col-vlg-4 m-b-12">
          <i class="fa fa-phone"></i> Free Line For You
          <span>+421220400693</span>
        </div>
        <div class="col-md-4 col-vlg-4 m-b-12 text-center">
          <i class="fa fa-envelope"></i> Email Us
          <span>office@i-r-e-c.com</span>
        </div>
        <div class="col-md-4 col-vlg-4 m-b-12 text-right">
          <i class="fa fa-clock-o"></i> Working Hours
          <span>8:00 to 16:30 CET</span>
        </div>
      </div>
		<!-- END REALTIME SALES GRAPH -->
	   </div>
		  </div>
<!-- BEGIN CHAT -->
<!-- END CHAT -->		  
</div>

<!-- END CONTAINER -->
<!-- BEGIN CORE JS FRAMEWORK-->
    
<!--[if lt IE 9]>
<script src="assets/plugins/respond.js"></script>
<![endif]-->

<script src="assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/plugins/breakpoints.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-lazyload/jquery.lazyload.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
<!-- END CORE JS FRAMEWORK -->
<!-- BEGIN PAGE LEVEL JS -->
<script src="assets/plugins/jquery-slider/jquery.sidr.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-ricksaw-chart/js/raphael-min.js"></script>
<script src="assets/plugins/jquery-ricksaw-chart/js/d3.v2.js"></script>
<script src="assets/plugins/jquery-ricksaw-chart/js/rickshaw.min.js"></script>
<script src="assets/plugins/jquery-sparkline/jquery-sparkline.js"></script>
<script src="assets/plugins/skycons/skycons.js"></script>
<script src="assets/plugins/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
<script src="assets/plugins/Mapplic/js/jquery.easing.js" type="text/javascript"></script>
<script src="assets/plugins/Mapplic/js/jquery.mousewheel.js" type="text/javascript"></script>
<script src="assets/plugins/Mapplic/js/hammer.js" type="text/javascript"></script>
<script src="assets/plugins/Mapplic/mapplic/mapplic.js" type="text/javascript"></script>
    
<script src="assets/plugins/jquery-flot/jquery.flot.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-metrojs/MetroJs.min.js" type="text/javascript" ></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN CORE TEMPLATE JS -->
<script src="assets/js/core.js" type="text/javascript"></script>
<script src="assets/js/chat.js" type="text/javascript"></script>
<script src="assets/js/demo.js" type="text/javascript"></script>
<script src="assets/js/dashboard_v2.js" type="text/javascript"></script>
<script type="text/javascript">
        $(document).ready(function () {
            $(".live-tile,.flip-list").liveTile();
        });
</script>

<!-- END CORE TEMPLATE JS -->
</body>
</html>
