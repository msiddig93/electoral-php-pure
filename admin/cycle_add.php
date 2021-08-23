<?php
	include 'header.php';
	

	if ($_GET['task'] == 'add') {
		$title = "إضافة دورة إنتخابية جديد";
	}elseif ($_GET['task'] == 'edit') {
		$title = "تعديل بيانات الدورة الانتخابية";
	}else{
		$title = "حذف بيانات الدورة الانتخابية";
	}

	switch ($_GET['task']) {
		case 'add':
			if (isset($_POST['save'])) {
				security();
				$q = "
					INSERT INTO 
					`electoral_cycle` (
							`title`, 
							`start_at`, 
							`end_at`, 
							`status` 
						) 
					VALUES (
							'".$_POST['title']."', 
							'".$_POST['start_at']."', 
							'".$_POST['end_at']."', 
							".$_POST['status']." 
						)
				";
				$query = mysql_query($q);

				if ($query) {
					$success_msg = "تم إضافة بيانات الدورة الانتخابية بنجاح !";
					refresh("cycle.php");
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
			 				SELECT * FROM `electoral_cycle` 
							WHERE `id` = {$id}
			 			");
			 		$_POST = mysqli_fetch_array($stmt);
			 	}
			}
			
			if (isset($_POST['save'])) {
				security();
				$q ="
					UPDATE 
						`electoral_cycle` 
					SET 
						`title` = '".$_POST['title']."', 
						`start_at` = '".$_POST['start_at']."', 
						`end_at` = '".$_POST['end_at']."', 
						`status` = ".$_POST['status']." 
						WHERE `electoral_cycle`.`id` = {$id}
				";
				$query = mysql_query($q);

				if ($query) {
					$success_msg = "تم تحديث بيانات الموظف بنجاح !";
					refresh("cycle.php");
				}else{
					$error_msg = " حدثت مشكلة أثناء عملية الاضافة !";
				}
			}

			break;
		
		case 'delete':
			
			$id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : 0;

			if ( $_SERVER['REQUEST_METHOD'] == 'GET') {
		 		
		 		$stmt = mysql_query("
		 				DELETE  FROM `electoral_cycle` 
						WHERE `id` = {$id}
		 			");

		 		if ($stmt) {
					$success_msg = "تم حذف بيانات الدورة الانتخابية بنجاح !";
					refresh("cycle.php");
				}else{
					$error_msg = " حدثت مشكلة أثناء عملية الاضافة !";
					refresh("cycle.php");
				}
			 	
			}

			break;

		case 'fetch':
			
			$id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : 0;

			if ( $_SERVER['REQUEST_METHOD'] == 'GET') {

				
		 		
		 		$cycle = mysql_query("SELECT * FROM `electoral_result` WHERE `cycle_id` = {$id}");

		 		if (mysqli_num_rows($cycle) > 0 ) {
		 			$error_msg = "عزراً ... لقد تمت عملية فرز الاصوات مسبقاً .";
		 			refresh("cycle.php");
		 		}else{
			 		$eles = mysql_query("
				 				SELECT * FROM `electoral_circuite`
				 			");

			 		foreach ($eles as $ele) {
			 			$votes = mysql_query("
			 				SELECT COUNT(*) AS 'vote',`cand_id` FROM `votes` 
							WHERE `cycle_id` = {$id}
							AND `eleC_id` = {$ele['id']}
							GROUP BY `cand_id`
							ORDER BY vote DESC
			 			");

				 		foreach ($votes as $vote) :
				 			$q = "
				 				INSERT INTO 
				 					`electoral_result`(
				 						`cycle_id`, 
				 						`cand_id`, 
				 						`eleC_id`, 
				 						`num_vote`
				 					) 
				 					VALUES (
				 						{$id},
				 						{$vote['cand_id']},
				 						{$ele['id']},
				 						{$vote['vote']}
				 					)
				 			";
				 			$re = mysql_query($q);

				 		endforeach;
			 		}

			 		$re = mysql_query("UPDATE `electoral_cycle` SET status = 2 WHERE id = {$id} ");

			 		if ($re) {
						$success_msg = "تمت عملية فرز الاصوات ... الارجاء الانتظار لرض النتيجة !";
						refresh("cycle.php");
					}else{
						$error_msg = " حدثت مشكلة أثناء عملية الاضافة !";
						refresh("cycle.php");
					}


			 	}
			 	
			}

			break;
		default:
			# code...
			break;
	}
?>
	<section class="content-header">
	    <span class="content-title"> <i class="fa  fa-archive"></i> الدورات الانتخابية <i class="fa fa-chevron-left"></i> <h3><?= $title ?></h3> </span>  
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
		    	<label for="title">العنوان</label>
		    	<input type="text" name="title"
		    	required 
		    	value="<?= isset($_POST['title']) ? $_POST['title'] : '' ?>" 
		    	id="title" 
		    	class="form-control"
		    	placeholder="عنوان الدورة الانتخابية" 
		    	>
		    </div>

		    <div class="form-group">
		    	<label for="start_at">تاريخ البداية</label>
		    	<input type="date" name="start_at" value="<?= isset($_POST['start_at']) ? $_POST['start_at'] : '' ?>" id="start_at" 
		    	class="form-control"
		    	placeholder="تارخ البداية" 
		    	required
		    	>
		    </div>

		    <div class="form-group">
		    	<label for="end_at">تاريخ النهاية</label>
		    	<input type="date" name="end_at" value="<?= isset($_POST['end_at']) ? $_POST['end_at'] : '' ?>" id="end_at" 
		    	class="form-control"
		    	placeholder="تارخ النهاية" 
		    	required
		    	>
		    </div>

		    <div class="form-group">
		    	<label for="id_num">الحالة</label>
		    	<select name="status" class="form-control" required >
			    	<option <?= isset($_POST['status']) && $_POST['status'] == 1  ? 'selected' : ''  ?> value="1">مفتوح</option>
			    	<option <?= isset($_POST['status']) && $_POST['status'] == 2  ? 'selected' : ''  ?> value="2">مغلق</option>
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