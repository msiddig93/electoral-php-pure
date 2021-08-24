<?php
	include 'header.php';

	if (isset($_SESSION['voters'])) {
			header("location: index.php");
		}
	

	if ($_GET['task'] == 'login') {
		$title = "تسجيل الدخول";
	}else{
		$title = "التسجيل";
	}
?>
	<section class="content-header">
	    <span class="content-title"> <i class="fa  fa-users"></i> الناخبين <i class="fa fa-chevron-left"></i> <h3><?= $title ?></h3> </span>  
	</section>

	<?php if ($_GET['task'] == "login") {?>
	<div class="form-add">

		<?php

			if (isset($_POST['login'])) {
			
				if (!empty($_POST['user'])  && !empty($_POST['pass'])) 
					{
						security();
						$user = $_POST['user'];
						$pass = $_POST['pass'];
						
						// Check If User Exist in The Database 

						$stmt = mysql_query("
											   SELECT * FROM `voters` 
											   WHERE `id_num` like '{$user}'
								");
						
						$voter = mysqli_fetch_array($stmt);

						if (mysqli_num_rows($stmt) > 0) {
							if( $voter['pass'] == $pass )
							{
								$_SESSION['voters'] = $voter ;
								header("location: index.php");
					 			exit();
							}else
							{
								$error_msg = "عفواً بيانات المدخلة لم يتم التعرف عليها .";
							}

						}else{
							$error_msg = "عفواً بيانات المدخلة لم يتم التعرف عليها .";
						}

					}else
					{
						$error_msg = "الرجاء إدخال رقم إثبات الهوية و كلمة المرور .";
					}
			}

			if (isset($error_msg)) {
	  			echo '<div class="alert alert-danger">'.$error_msg.'</div>';
	  		}

	  		if (isset($success_msg)) {
	  			echo '<div class="alert alert-success">'.$success_msg.'</div>';
	  			die();
	  		}
		?> 

		<form action="" method="POST" enctype="multipart/form-data">

		    <div class="form-group">
		    	<label for="user">رقم إثبات الهوية </label>
		    	<input type="text" required="" name="user" value="<?= isset($_POST['user']) ? $_POST['user'] : '' ?>" id="user" 
		    	class="form-control"
		    	placeholder="رقم إثبات الهوية " autocomplete="off"
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
	<?php }else{ ?>
	
	<div class="form-add">

		<?php

			if (isset($_POST['save'])) {
				security();
				$stmt = mysql_query("
			 				SELECT * FROM `voters` 
							WHERE `id_num` = '".$_POST['id_num']."'
			 			");
			 	if (mysqli_num_rows($stmt) > 0) {
			 		$error_msg = " عزراً ... رقم إثبات الهوية مسجل من قبل الرجاء تغيره !";
			 	}else{
					$q = "
						INSERT INTO 
						`voters` (
								`FullName`, 
								`birthDate`, 
								`id_num`, 
								`pass`) 
						VALUES (
								'".$_POST['FullName']."', 
								'".$_POST['birthDate']."', 
								'".$_POST['id_num']."', 
								'".$_POST['pass']."')
					";
					$query = mysql_query($q);

					if ($query) {
						$success_msg = "تمت عملية تسجيلك بنجاح !";
						$stmt = mysql_query("
											   SELECT * FROM `voters` 
											   WHERE `id_num` like '{$_POST['id_num']}'
								");
						
						$voter = mysqli_fetch_array($stmt);
						refresh("index.php");
						$_SESSION['voters'] = $voter;
					}else{
						$error_msg = " حدثت مشكلة أثناء عملية الاضافة !";
					}
				}
			}

			if (isset($error_msg)) {
	  			echo '<div class="alert alert-danger">'.$error_msg.'</div>';
	  		}

	  		if (isset($success_msg)) {
	  			echo '<div class="alert alert-success">'.$success_msg.'</div>';
	  			die();
	  		}
		?> 

		<form action="" method="POST">

		    <div class="form-group">
		    	<label for="FullName">الاسم الكامل</label>
		    	<input type="text" name="FullName"
		    	required 
		    	value="<?= isset($_POST['FullName']) ? $_POST['FullName'] : '' ?>" 
		    	id="FullName" 
		    	class="form-control"
		    	placeholder="الاسم الكامل" 
		    	>
		    </div>

		    <div class="form-group">
		    	<label for="birthdate">تاريخ الميلاد</label>
		    	<input type="date" name="birthDate" value="<?= isset($_POST['birthDate']) ? $_POST['birthDate'] : '' ?>" id="birthdate" 
		    	class="form-control"
		    	placeholder="تارخ الميلاد" 
		    	required
		    	>
		    </div>

		    <div class="form-group">
		    	<label for="id_num">رقم إثبات الهوية</label>
		    	<input type="text" name="id_num" value="<?= isset($_POST['id_num']) ? $_POST['id_num'] : '' ?>" id="user" 
		    	class="form-control"
		    	placeholder="رقم إثبات الهوية" 
		    	required
		    	>
		    </div>

		    <div class="form-group">
		    	<label for="pass">كلمة المرور</label>
		    	<input type="password" name="pass" value="<?= isset($_POST['pass']) ? $_POST['pass'] : '' ?>" id="pass" 
		    	class="form-control"
		    	placeholder="كلمة المرور" 
		    	required
		    	>
		    </div>

			<div class="form-group text-center">
		    	<button type="submit" value="" name="save" class="btn btn-primary"> تسجيل </button>
		    </div>
		</form>
	</div>

<?php }

	include 'footer.php';
?>