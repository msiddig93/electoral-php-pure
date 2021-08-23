<?php
	include 'connect.php';

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
		<link rel="stylesheet" href="assets/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/style.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body>
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header">

					<!-- Logo -->
						<h1><a href="admin" style="cursor: pointer;" id="logo">الانتخابات <em>الالكترونية</em></a></h1>

					<!-- Nav -->
						<nav id="nav" >
								<ul class="container">
										<li class="current"><a href="index.php">الرئيسية</a></li>
										<li><a href="voting.php">التصويت</a></li>
										<li><a href="electoral_result.php">نتائج التصويت</a></li>
									<?php 
										if (isset($_SESSION['voters'])) {
											echo '
												<li class="pull-left">
													<a href="#">  '.$_SESSION['voters']['FullName'].' <i class="fa fa-arrow-circle-o-down" class="pull-"></i></a>
													<ul>
														<li><a > --------- </a></li>
														<li><a href="logout.php">تسجيل الخروج</a></li>
														<li><a > --------- </a></li>
													</ul>
												</li>
											';
										}else{
											echo '
												<li class="pull-left link-left">
													<a href="login.php?task=register">التسجيل</a>
													<a href="login.php?task=login">تسجيل الدخول</a>
												</li>
											';
										}
									?>
									
								</ul>
						</nav>

				</div>

				<div class="container content">