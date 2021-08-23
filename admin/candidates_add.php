<?php
	include 'header.php';
	

	if ($_GET['task'] == 'add') {
		$title = "إضافة مرشح جديد";
	}elseif ($_GET['task'] == 'edit') {
		$title = "تعديل بيانات المرشح";
	}else{
		$title = "حذف بيانات المرشح";
	}

	switch ($_GET['task']) {
		case 'add':
			if (isset($_POST['save'])) {
				security();

				$q = mysql_query("SELECT * FROM `candidates` 
								  WHERE `party_id` = ".$_POST['party_id']."
								  AND `eleC_id` = ".$_POST['eleC_id']." ");
				if (mysqli_num_rows($q) > 0) {
					$error_msg = " ععفواً ... لقد تم إضافة مرشح لهذه الدائرة تبع هذا الحزب   !";
				}else{

					if( $_FILES['logo']['name'] != "" ){
						$query = mysql_query("SELECT MAX(id)+1 as MAX FROM `candidates`");
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
						`candidates` (
								`FullName`, 
								`birthDate`, 
								`gennder`, 
								`image`, 
								`party_id`, 
								`eleC_id`) 
						VALUES (
								'".$_POST['FullName']."', 
								'".$_POST['birthDate']."', 
								".$_POST['gennder'].", 
								'".$logo."', 
								'".$_POST['party_id']."', 
								'".$_POST['eleC_id']."'
							)
					";

					$query = mysql_query($q);
		 			
					if ($query) {
						if ($_FILES['logo']['name'] != "") {
			 				move_uploaded_file($_FILES['logo']['tmp_name'], "..\images\avatar\\" . $logo);
			 			}
						$success_msg = "تم إضافة بيانات المرشح بنجاح !";
						refresh("candidates.php");
					}else{
						$error_msg = " حدثت مشكلة أثناء عملية الاضافة !";
					}
				}
			}

			break;
		case 'edit':
			
			$id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : 0;

			$stmt = mysql_query("
			 				SELECT * FROM `candidates` 
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

				$q = mysql_query("SELECT * FROM `candidates` 
								  WHERE `party_id` = ".$_POST['party_id']."
								  AND `eleC_id` = ".$_POST['eleC_id']." ");
				if (mysqli_num_rows($q) > 0) {
					$error_msg = " ععفواً ... لقد تم إضافة مرشح لهذه الدائرة تبع هذا الحزب   !";
				}else{

					if( $_FILES['logo']['name'] != "" ){
						$logo = $id;
		                $logo = $logo .".". @strtolower(end(explode('.',$_FILES['logo']['name'] )));
		             }
		             else
		             {
		                 $logo = $party['image'];
		             } 

					$q ="
						UPDATE 
							`candidates` 
						SET 
							`FullName` = '".$_POST['FullName']."', 
							`birthDate` = '".$_POST['birthDate']."', 
							`gennder` = ".$_POST['gennder'].", 
							`image` = '".$logo."', 
							`party_id` = ".$_POST['party_id'].", 
							`eleC_id` = ".$_POST['eleC_id']." 
							WHERE `candidates`.`id` = {$id}
					";
					$query = mysql_query($q);

					if ($query) {
						if ($_FILES['logo']['name'] != "") {
			 				move_uploaded_file($_FILES['logo']['tmp_name'], "..\images\logo\\" . $logo);
			 			}
						$success_msg = "تم تحديث بيانات المرشح بنجاح !";
						refresh("candidates.php");
					}else{
						$error_msg = " حدثت مشكلة أثناء عملية الاضافة !";
					}
				}
			}

			break;
		
		case 'delete':
			
			$id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : 0;

			if ( $_SERVER['REQUEST_METHOD'] == 'GET') {
		 		
		 		$stmt = mysql_query("
		 				DELETE  FROM `candidates` 
						WHERE `id` = {$id}
		 			");

		 		if ($stmt) {
					$success_msg = "تم حذف بيانات المرشح بنجاح !";
					refresh("candidates.php");
				}else{
					$error_msg = " حدثت مشكلة أثناء عملية الاضافة !";
					refresh("candidates.php");
				}
			 	
			}

			break;
		default:
			# code...
			break;
	}
?>
	<section class="content-header">
	    <span class="content-title"> <i class="fa  fa-user-secret"></i> المرشحين <i class="fa fa-chevron-left"></i> <h3><?= $title ?></h3> </span>  
	</section>

	<div class="form-add">

		<?php
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
		    	<label for="birthDate">تاريخ الميلاد</label>
		    	<input type="date" name="birthDate" value="<?= isset($_POST['birthDate']) ? $_POST['birthDate'] : '' ?>" id="birthDate" 
		    	class="form-control"
		    	required
		    	>
		    </div>

		    <div class="form-group">
		    	<label for="logo">النوع</label>
		    	<select name="gennder" class="form-control" >
		    		<option <?= isset($_POST['gennder']) && $_POST['gennder'] == 1 ? 'selected' : '' ?> value="1">ذكر</option>
		    		<option <?= isset($_POST['gennder']) && $_POST['gennder'] == 2 ? 'selected' : '' ?>  value="1">أنثي</option>
		    	</select>
		    </div>

		    <div class="form-group">
		    	<label for="logo">الصورة</label>
		    	<input type="file" name="logo"
		    	class="form-control"
		    	placeholder="الهاتف" 
		    	required
		    	>
		    </div>

		    <div class="form-group">
		    	<label for="logo">الحزب السياسي</label>
		    	<select name="party_id" class="form-control" >
	    		<?php
	    			$parties = mysql_query("SELECT * FROM `parties`");
	    			$selected = "";
	    			while ($party = mysqli_fetch_array($parties)) {
	    				if ($_POST['party_id'] == $party['id']) {
	    					$selected = "selected";
	    				}else{
	    					$selected = "";
	    				}

	    				echo "<option ".$selected." value='".$party['id']."' >".$party['name']."</option>";
	    			}
	    		?>
		    	</select>
		    </div>

		    <div class="form-group">
		    	<label for="logo">الدائرة الانتخابية</label>
		    	<select name="eleC_id" class="form-control" >
		    	<?php
	    			$parties = mysql_query("SELECT * FROM `electoral_circuite`");
	    			$selected = "";
	    			while ($party = mysqli_fetch_array($parties)) {
	    				if ($_POST['eleC_id'] == $party['id']) {
	    					$selected = "selected";
	    				}else{
	    					$selected = "";
	    				}

	    				echo "<option ".$selected." value='".$party['id']."' >".$party['e_name']."</option>";
	    			}
	    		?>
		    	</select>
		    </div>


			<div class="form-group text-center">
		    	<button type="submit" value="" name="save" class="btn btn-primary"> حفظ <i class="fa fa-sign-in fa-fw"></i> </button>
		    </div>
		</form>
	</div>

<?php
	include 'footer.php';
?>