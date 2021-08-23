<?php
	include 'header.php';
?>
	<section class="content-header">
	    <span class="content-title"> <i class="fa  fa-user-secret"></i> المرشحين <i class="fa fa-chevron-left"></i> <h3>التحكم</h3> </span>
	    <ul class="header-btns">
	        <li>
	            <a href="candidates_add.php?task=add" class="btn btn-info">
	                <i class="fa fa-plus-circle"></i>
	                <span class="hidden-xs hidden-sm">إضافة</span>
	            </a>
	        </li>
	        <li>
	            <a href="javascript:print(document.getElementById('PRINT'))" class="btn btn-default">
	                <i class="fa fa-print"></i>
	                <span class="hidden-xs hidden-sm">طباعة</span>
	            </a>
	        </li>
	    </ul>   
	</section>

	<?php
		$candidates = mysql_query("
			 				SELECT 
								`candidates`.*,
							    `electoral_circuite`.`e_name`,
							    `parties`.`name` 
							FROM  `candidates`,`parties`,`electoral_circuite` 
							WHERE `candidates`.`party_id` = `parties`.`id`
							AND `candidates`.`eleC_id` = `electoral_circuite`.`id`
			 			");
	?>

	<div class="table-responsive">
            <table class="table main-table rtl_table data-table table-striped table-hover">
                <thead>
                <tr>
                    <th >&nbsp;</th>
                    <th >الرقم</th>
                    <th >الاسم الكامل</th>
                    <th >تاريخ الميلاد</th>
                    <th >الحزب</th>
                    <th >الدائرة الانتخابية</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <?php
                	$num = 1;
                	while ($candidate = mysqli_fetch_array($candidates)) {
                		echo "			       		
				       		<tr>
				       			<td><img src='../images/avatar/".$candidate['image']."' class='logo-img' ></td>
				       			<td>".$num."</td>
				       			<td>".$candidate['FullName']."</td>
				       			<td>".$candidate['birthDate']."</td>
				       			<td>".$candidate['name']."</td>
				       			<td>".$candidate['e_name']."</td>
				       			<td>
				       				<a class='btn btn-success btn-sm my-link' href='candidates_add.php?task=edit&id=".$candidate['id']."'>تعديل <i class='fa fa-pencil-square-o'></i></a>
				       				<a class='btn btn-danger btn-sm my-link confirm'
				       				 href='candidates_add.php?task=delete&id=".$candidate['id']."'>حذف <i class='fa fa-trash-o'></i></a>
				       			</td>
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