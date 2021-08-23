<?php
	include 'header.php';
?>
	<section class="content-header" style="margin-bottom:5px">
	    <span class="content-title"> <i class="fa  fa-archive"></i> الاقتراع <i class="fa fa-chevron-left"></i> <h3>التصويت</h3> </span>
	</section>

	<?php

		if (!isset($_SESSION['voters']) || $_SESSION['voters']['id'] < 0 ) {
			echo '<div class="alert alert-danger">الرجاء تسجيل دخولك للقيام بعملية التصويت .</div>';
			refresh("login.php?task=login");
	  		die();
		}

		$test = mysql_query("SELECT * FROM `votes` WHERE `voter_id` = {$_SESSION['voters']['id']} ");
		if (mysqli_num_rows($test) > 0) {
			echo '<div class="alert alert-danger">عفواً ... لقد قم بعملية التصويت .</div>';
			refresh("index.php");
	  		die();
		}

		$cycle = mysql_query("
			 				SELECT * FROM `electoral_cycle` 
							WHERE `start_at` <= CURRENT_DATE()
							AND `end_at` >= CURRENT_DATE()
							AND `status` = 1
			 			");
			 			
		if (mysqli_num_rows($cycle) == 0) {
			echo '<div class="alert alert-danger">عفواً المحتوي غير متوفر حالياَ .</div>';
			refresh("index.php");
	  		die();
		}

		$eles = mysql_query("
			 				SELECT * FROM `electoral_circuite`
			 			");

		$cycleId = mysqli_fetch_array($cycle);

		if (isset($_POST['voting'])) {

			foreach ($eles as $ele) {
				if (isset($_POST[$ele['id']]) && !empty($_POST[$ele['id']]) ) {

					$q = "
						INSERT INTO `votes`
										(`voter_id`, 
										`cand_id`, 
										`cycle_id`, 
										`eleC_id`) 
									VALUES (
										".$_SESSION['voters']['id'].",
										".$_POST[$ele['id']].",
										".$cycleId['id'].",
										".$ele['id']."
									)
					";

					$vote = mysql_query($q);
				}
			}

			if ($vote) {
				echo '<div class="alert alert-success">تمت عملية تصويتك بنجاح ... شكراً لثقتك بنا .</div>';
				refresh("index.php");
		  		die();
			}
		}



		echo '<form action="" method="post" >';
		foreach ($eles as $ele) { ?>
			<div class="panel panel-info">
	                <div class="panel-body">
	                    <section class="content-header" >
	                        <a ><span class="content-title"> </span> الدائرة الانتخابية - <?= $ele['e_name'] ?>  </span></a>
	                    </section>

	                    <?php
	                    	$candidates = mysql_query("
				 				SELECT 
									`candidates`.*,
								    `electoral_circuite`.`e_name`,
								    `parties`.`name` 
								FROM  `candidates`,`parties`,`electoral_circuite` 
								WHERE `candidates`.`party_id` = `parties`.`id`
								AND `electoral_circuite`.`id` = `candidates`.`eleC_id`
								AND `candidates`.`eleC_id` = ".$ele['id']."
				 			");

				 			if ($candidates) {

				 			foreach ($candidates as $cand ):

	                    ?>

	                       	<div class="row" style="margin:10px">
	                       		<div class="col-sm-7">
	                       			<label class="form-control label-vote">إسم المرشح : <?= $cand['FullName'] ?> </label>
	                       			<label class="form-control label-vote">الحزب السياسي : <?= $cand['name'] ?> </label>
	                       			<label class="form-control label-vote">تاريخ الميلاد : <?= $cand['birthDate'] ?> </label>
	                       			<label style="padding:5px;cursor: pointer;" class="form-control alert alert-danger label-vote">تصويت : <input type="radio" name="<?= $ele['id'] ?>" value="<?= $cand['id'] ?>" /> </label>
	                       		</div>
	                       		<div class="col-sm-5 text-center"><img class="img-vote" src="images/avatar/<?= $cand['image'] ?>" /></div>
	                       	</div>
	                   	<?php 
	                    	endforeach; 
	                	} ?>
	                </div>
            </div>
<?php		}?>

			<div class="panel-body text-center" >
	        	<button type="submit" name="voting" class="btn btn-info confirm">تسليم ورقة الاقتراع</button>
	        </div>
        </form>

<?php
	include 'footer.php';
?>