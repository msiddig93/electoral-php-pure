<?php
	include 'header.php';
?>
	<section class="content-header">
	    <span class="content-title"> <i class="fa  fa-archive"></i> الدورة الانتخابية <i class="fa fa-chevron-left"></i> <h3>النتيجة </h3> </span>
	    <ul class="header-btns">
	        <li>
	            <a href="javascript:print(document.getElementById('PRINT'))" class="btn btn-default">
	                <i class="fa fa-print"></i>
	                <span class="hidden-xs hidden-sm">طباعة</span>
	            </a>
	        </li>
	    </ul>   
	</section>

	<?php
		$id = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : 0;
		$cyclies = mysql_query("
			 				SELECT `electoral_result`.* ,
								   `candidates`.`FullName` ,
							       `candidates`.`image`,
							       `parties`.`name`,
							       `electoral_circuite`.`e_name`
							FROM `electoral_result` , `candidates` , `parties` ,`electoral_circuite` 
							WHERE `electoral_result`.`cand_id` = `candidates`.`id`
							AND `electoral_result`.`eleC_id` = `electoral_circuite`.`id`
							AND `candidates`.`party_id` = `parties`.`id`
							AND `electoral_result`.`cycle_id` = {$id}
							ORDER BY `electoral_circuite`.id asc
			 			");
	?>

	<div class="table-responsive">
            <table class="table main-table rtl_table data-table table-striped table-hover">
                <thead>
                <tr>
                    <th >التريب</th>
                    <th >أسم المرشح</th>
                    <th >الحزب</th>
                    <th >الدائرة الانتجابية</th>
                    <th >عدد الاصوات</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <?php
                	$num = 1;
                	$status = "";
                	while ($cycle = mysqli_fetch_array($cyclies)) {

                		echo "			       		
				       		<tr>
				       			<td>".$num."</td>
				       			<td>".$cycle['FullName']."</td>
				       			<td>".$cycle['name']."</td>
				       			<td>".$cycle['e_name']."</td>
				       			<td>".$cycle['num_vote']."</td>
				       			<td><img src='../images/avatar/".$cycle['image']."' class='logo-img' ></td>
				       		</tr>
				       		";

                		$num +=1;
                	}

                ?>
                </tbody>
            </table>
        </div>

<?php
	include 'footer.php';
?>