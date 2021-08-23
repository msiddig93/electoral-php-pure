<?php
	include 'header.php';
	

	if ($_GET['task'] == 'add') {
		$title = "إضافة دائرة إنتخابية جديدة";
	}elseif ($_GET['task'] == 'edit') {
		$title = "تعديل بيانات الدائرة إلانتخابية";
	}else{
		$title = "حذف بيانات الدائرة إلانتخابية";
	}

	switch ($_GET['task']) {
		case 'add':
			if (isset($_POST['save'])) {
				security();

				$q = "
					INSERT INTO 
					`electoral_circuite` (
							`e_name`, 
							`descript`
						) 
					VALUES (
							'".$_POST['e_name']."', 
							'".$_POST['descript']."'
						)
				";

				$query = mysql_query($q);
	 			
				if ($query) {
					$success_msg = "تم إضافة بيانات الدائرة بنجاح !";
					refresh("electoral_circuite.php");
				}else{
					$error_msg = " حدثت مشكلة أثناء عملية الاضافة !";
				}
			}

			break;
		case 'edit':
			
			$id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : 0;

			$stmt = mysql_query("
			 				SELECT * FROM `electoral_circuite` 
							WHERE `id` = {$id}
			 			");
			$party = mysqli_fetch_array($stmt);

			if ( $_SERVER['REQUEST_METHOD'] == 'GET') {
		 		if (isset($_GET['id'])) {
			 		$_POST = $party;
			 	}
			}
			
			if (isset($_POST['save'])) {
				security();

				$q ="
					UPDATE 
						`electoral_circuite` 
					SET 
						`e_name` = '".$_POST['e_name']."', 
						`descript` = '".$_POST['descript']."' 
						WHERE `electoral_circuite`.`id` = {$id}
				";
				$query = mysql_query($q);

				if ($query) {
					$success_msg = "تم تحديث بيانات الدائرة بنجاح !";
					refresh("electoral_circuite.php");
				}else{
					$error_msg = " حدثت مشكلة أثناء عملية الاضافة !";
				}
			}

			break;
		
		case 'delete':
			
			$id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : 0;

			if ( $_SERVER['REQUEST_METHOD'] == 'GET') {
		 		
		 		$stmt = mysql_query("
		 				DELETE  FROM `electoral_circuite` 
						WHERE `id` = {$id}
		 			");

		 		if ($stmt) {
					$success_msg = "تم حذف بيانات الدائرة بنجاح !";
					refresh("electoral_circuite.php");
				}else{
					$error_msg = " حدثت مشكلة أثناء عملية الاضافة !";
					refresh("electoral_circuite.php");
				}
			 	
			}

			break;
		default:
			# code...
			break;
	}
?>
	<section class="content-header">
	    <span class="content-title"> <i class="fa  fa-ioxhost"></i> الدوائر الانتخابية <i class="fa fa-chevron-left"></i> <h3><?= $title ?></h3> </span>  
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

		<form action="" method="POST" enctype="multipart/form-data">

		    <div class="form-group">
		    	<label for="e_name">الاسم</label>
		    	<input type="text" name="e_name"
		    	required 
		    	value="<?= isset($_POST['e_name']) ? $_POST['e_name'] : '' ?>" 
		    	id="e_name" 
		    	class="form-control"
		    	placeholder="الاسم" 
		    	>
		    </div>

		    <div class="form-group">
		    	<label for="descript">الوصف</label>
		    	<textarea name="descript"
				    	class="form-control"
				    	placeholder="الوصف" 
				    	required
		    	 ><?= isset($_POST['descript']) ? $_POST['descript'] : '' ?></textarea> 
		    	
		    </div>

			<div class="form-group text-center">
		    	<button type="submit" value="" name="save" class="btn btn-primary"> حفظ <i class="fa fa-sign-in fa-fw"></i> </button>
		    </div>
		</form>
	</div>

<?php
	include 'footer.php';
?>