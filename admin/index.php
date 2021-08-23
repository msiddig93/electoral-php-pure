<?php
	include '../connect.php';

	if(isset($_SESSION['emp']))
		{
			header("location: emp.php");
			exit();
		}

		// Check If Coming From HTTP Request Method

		if (isset($_POST['login'])) {
			
			if (!empty($_POST['user'])  && !empty($_POST['pass'])) 
				{
					$user = filter_var($_POST['user'], FILTER_SANITIZE_STRING);
					$pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
					security();
					// Check If User Exist in The Database 

					$stmt = mysql_query("
										   SELECT * FROM `emp` 
										   WHERE `user` like '{$user}'
							");
					
					$emp = mysqli_fetch_array($stmt);

					if (mysqli_num_rows($stmt) > 0) {
						if( $emp['pass'] == $pass )
						{
							$_SESSION['emp'] = $emp ;
							header("location: emp.php");
				 			exit();
						}else
						{
							$error_msg = "عفواً بيانات المدخلة لم تطابق أي مستخدم .";
						}

					}else{
						$error_msg = "عفواً بيانات المدخلة لم تطابق أي مستخدم .";
					}

				}else
				{
					$error_msg = "الرجاء إدخال إسم المستخدم و كلمة المرور .";
				}
		}
?>

<!DOCTYPE html>
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
	<body >
		<div class="container" >

			<div class="panel panel-info panel-login">
			  <div class="panel-heading text-center">
			    <label class="">تسجيل الدخول</label>
			  </div>
			  <div class="panel-body">

			  	<?php 
			  		if (isset($error_msg)) {
			  			echo '<div class="alert alert-danger">'.$error_msg.'</div>';
			  		}
			  	?>
			    
			    <form action="" method="POST">
				    <div class="form-group">
				    	<label for="user">إسم المستخدم </label>
				    	<input type="text" required="" name="user" value="<?= isset($_POST['user']) ? $_POST['user'] : '' ?>" id="user" 
				    	class="form-control"
				    	placeholder="إسم المستخدم " autocomplete="off"
				    	>
				    </div>

				    <div class="form-group">
				    	<label for="pass">كلمة المرور</label>
				    	<input type="password" required="" name="pass" id="pass" 
				    		class="form-control"
				    		placeholder="كلمة المرور"
				    		>
				    </div>

					<div class="form-group text-center">
				    	<button type="submit" value="" name="login" class="btn btn-info"> تسجيل الدخول <i class="fa fa-sign-in"></i> </button>
				    </div>
				</form>

			  </div>
			</div>
		</div>
	</body>
</html>