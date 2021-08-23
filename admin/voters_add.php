<?php
	include 'header.php';
	

	if ($_GET['task'] == 'add') {
		$title = "إضافة ناخب جديد";
	}elseif ($_GET['task'] == 'edit') {
		$title = "تعديل بيانات الناخب";
	}else{
		$title = "حذف بيانات الناخب";
	}

	switch ($_GET['task']) {
		case 'add':
			if (isset($_POST['save'])) {
				security();
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
					$success_msg = "تم إضافة بيانات الناخب بنجاح !";
					refresh("voters.php");
				}else{
					$error_msg = " حدثت مشكلة أثناء عملية الاضافة !";
				}
			}

			break;
		case 'edit':
			
			$id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : 0;

			if ( $_SERVER['REQUEST_METHOD'] == 'GET') {
		 		if (isset($_GET['id'])) {
			 		$stmt = mysql_query("
			 				SELECT * FROM `voters` 
							WHERE `id` = {$id}
			 			");
			 		$_POST = mysqli_fetch_array($stmt);
			 	}
			}
			
			if (isset($_POST['save'])) {
				security();
				$q ="
					UPDATE 
						`voters` 
					SET 
						`FullName` = '".$_POST['FullName']."', 
						`birthDate` = '".$_POST['birthDate']."', 
						`id_num` = '".$_POST['id_num']."', 
						`pass` = '".$_POST['pass']."' 
						WHERE `voters`.`id` = {$id}
				";
				$query = mysql_query($q);

				if ($query) {
					$success_msg = "تم تحديث بيانات الناخب بنجاح !";
					refresh("voters.php");
				}else{
					$error_msg = " حدثت مشكلة أثناء عملية الاضافة !";
				}
			}

			break;
		
		case 'delete':
			
			$id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : 0;

			if ( $_SERVER['REQUEST_METHOD'] == 'GET') {
		 		
		 		$stmt = mysql_query("
		 				DELETE  FROM `voters` 
						WHERE `id` = {$id}
		 			");

		 		if ($stmt) {
					$success_msg = "تم حذف بيانات الناخب بنجاح !";
					refresh("voters.php");
				}else{
					$error_msg = " حدثت مشكلة أثناء عملية الاضافة !";
					refresh("voters.php");
				}
			 	
			}

			break;
		default:
			# code...
			break;
	}
?>
	<section class="content-header">
	    <span class="content-title"> <i class="fa  fa-users"></i> الناخبين <i class="fa fa-chevron-left"></i> <h3><?= $title ?></h3> </span>  
	</section>

	<div class="form-add">

		<?php
			if (isset($error_msg)) {
	  			echo '<div class="alert alert-danger">'.$error_msg.'</div>';
	  			die();
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
		    	<button type="submit" value="" name="save" class="btn btn-primary"> حفظ <i class="fa fa-sign-in fa-fw"></i> </button>
		    </div>
		</form>
	</div>

<?php
	include 'footer.php';
?>