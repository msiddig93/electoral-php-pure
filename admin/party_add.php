<?php
	include 'header.php';
	

	if ($_GET['task'] == 'add') {
		$title = "إضافة حزب جديد";
	}elseif ($_GET['task'] == 'edit') {
		$title = "تعديل بيانات الحزب";
	}else{
		$title = "حذف بيانات الحزب";
	}

	switch ($_GET['task']) {
		case 'add':
			if (isset($_POST['save'])) {
				security();

				if( $_FILES['logo']['name'] != "" ){
					$query = mysql_query("SELECT MAX(id)+1 as MAX FROM `parties`");
					$q = mysqli_fetch_array($query);
					$logo = $q == NULL ? 1 : $q['MAX'];
	                $logo = $logo .".". @strtolower(end(explode('.',$_FILES['logo']['name'] )));
	             }
	             else
	             {
	                 $logo = "0.jpg";
	             }

				$q = "
					INSERT INTO 
					`parties` (
							`name`, 
							`logo`, 
							`publish_at`, 
							`brand`) 
					VALUES (
							'".$_POST['name']."', 
							'".$logo."', 
							'".$_POST['publish_at']."', 
							'".$_POST['brand']."'
						)
				";

				$query = mysql_query($q);
	 			
				if ($query) {
					if ($_FILES['logo']['name'] != "") {
		 				move_uploaded_file($_FILES['logo']['tmp_name'], "..\images\logo\\" . $logo);
		 			}
					$success_msg = "تم إضافة بيانات الحزب بنجاح !";
					refresh("party.php");
				}else{
					$error_msg = " حدثت مشكلة أثناء عملية الاضافة !";
				}
			}

			break;
		case 'edit':
			
			$id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : 0;

			$stmt = mysql_query("
			 				SELECT * FROM `parties` 
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

				if( $_FILES['logo']['name'] != "" ){
					$logo = $id;
	                $logo = $logo .".". @strtolower(end(explode('.',$_FILES['logo']['name'] )));
	             }
	             else
	             {
	                 $logo = $party['logo'];
	             }

				$q ="
					UPDATE 
						`parties` 
					SET 
						`name` = '".$_POST['name']."', 
						`logo` = '".$logo."', 
						`publish_at` = '".$_POST['publish_at']."', 
						`brand` = '".$_POST['brand']."' 
						WHERE `parties`.`id` = {$id}
				";
				$query = mysql_query($q);

				if ($query) {
					if ($_FILES['logo']['name'] != "") {
		 				move_uploaded_file($_FILES['logo']['tmp_name'], "..\images\logo\\" . $logo);
		 			}
					$success_msg = "تم تحديث بيانات الحزب بنجاح !";
					refresh("party.php");
				}else{
					$error_msg = " حدثت مشكلة أثناء عملية الاضافة !";
				}
			}

			break;
		
		case 'delete':
			
			$id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : 0;

			if ( $_SERVER['REQUEST_METHOD'] == 'GET') {
		 		
		 		$stmt = mysql_query("
		 				DELETE  FROM `parties` 
						WHERE `id` = {$id}
		 			");

		 		if ($stmt) {
					$success_msg = "تم حذف بيانات الحزب بنجاح !";
					refresh("party.php");
				}else{
					$error_msg = " حدثت مشكلة أثناء عملية الاضافة !";
					refresh("party.php");
				}
			 	
			}

			break;
		default:
			# code...
			break;
	}
?>
	<section class="content-header">
	    <span class="content-title"> <i class="fa  fa-connectdevelop"></i> الاحزاب <i class="fa fa-chevron-left"></i> <h3><?= $title ?></h3> </span>  
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
		    	<label for="name">الاسم</label>
		    	<input type="text" name="name"
		    	required 
		    	value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>" 
		    	id="name" 
		    	class="form-control"
		    	placeholder="الاسم" 
		    	>
		    </div>

		    <div class="form-group">
		    	<label for="logo">رمز الحزب</label>
		    	<input type="file" name="logo"
		    	class="form-control"
		    	placeholder="الهاتف" 
		    	>
		    </div>

		    <div class="form-group">
		    	<label for="publish_at">تاريخ التاسيس</label>
		    	<input type="date" name="publish_at" value="<?= isset($_POST['publish_at']) ? $_POST['publish_at'] : '' ?>" id="publish_at" 
		    	class="form-control"
		    	placeholder="تارخ الميلاد" 
		    	required
		    	>
		    </div>

		    <div class="form-group">
		    	<label for="brand">شعار الحزب</label>
		    	<textarea name="brand"
				    	class="form-control"
				    	placeholder="شعار الحزب" 
				    	required
		    	 ><?= isset($_POST['brand']) ? $_POST['brand'] : '' ?></textarea> 
		    	
		    </div>

			<div class="form-group text-center">
		    	<button type="submit" value="" name="save" class="btn btn-primary"> حفظ <i class="fa fa-sign-in fa-fw"></i> </button>
		    </div>
		</form>
	</div>

<?php
	include 'footer.php';
?>