<?php
	include '../connect.php';

	if (!isset($_SESSION['emp']) || $_SESSION['emp']['id'] < 1 ) {
		header("location: index.php");
	}

?>
<!DOCTYPE HTML>
<!--
	Arcana by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Arcana by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="../assets/css/bootstrap.css" />
		<link rel="stylesheet" href="../assets/css/main.css" />
		<link rel="stylesheet" href="../assets/css/style.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body>
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header">

					<!-- Logo -->
						<h1><a style="cursor: pointer;" id="logo">الانتخابات <em>الالكترونية</em></a></h1>

					<!-- Nav -->
						<nav id="nav" >
								<ul class="container">
									<li class="current"><a >الرئيسية</a></li>
									
									<li><a href="emp.php">الموظفين</a></li>
									<li><a href="party.php">الاحزاب السياسية</a></li>
									<li><a href="electoral_circuite.php">الدوائر الانتخابية</a></li>
									<li><a href="candidates.php">المرشحين</a></li>
									<li><a href="voters.php">الناخبين</a></li>
									<li><a href="cycle.php">الدورات الانتخابية</a></li>
									<li class="pull-left">
										<a href="#">  <?= $_SESSION['emp']['FullName'] ?> <i class="fa fa-arrow-circle-o-down" class="pull-"></i></a>
										<ul>
											<li><a > --------- </a></li>
											<li><a href="logout.php">تسجيل الخروج</a></li>
											<li><a > --------- </a></li>
										</ul>
									</li>
								</ul>
						</nav>

				</div>

				<div class="container content">