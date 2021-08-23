<?php
	include 'header.php';
?>
	<section class="content-header">
	    <span class="content-title"> <i class="fa  fa-ioxhost"></i> الدوائر الانتخابية<i class="fa fa-chevron-left"></i> <h3>التحكم</h3> </span>
	    <ul class="header-btns">
	        <li>
	            <a href="add_electoral_circuite.php?task=add" class="btn btn-info">
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
		$parties = mysql_query("
			 				SELECT * FROM `electoral_circuite` 
			 			");
	?>

	<div class="table-responsive">
            <table class="table main-table rtl_table data-table table-striped table-hover">
                <thead>
                <tr>
                    <th >الرقم</th>
                    <th >الاسم</th>
                    <th >الوصف</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <?php
                	$num = 1;
                	while ($party = mysqli_fetch_array($parties)) {
                		echo "			       		
				       		<tr>
				       			<td>".$num."</td>
				       			<td>".$party['e_name']."</td>
				       			<td>".$party['descript']."</td>
				       			<td>
				       				<a class='btn btn-success btn-sm my-link' href='add_electoral_circuite.php?task=edit&id=".$party['id']."'>تعديل <i class='fa fa-pencil-square-o'></i></a>
				       				<a class='btn btn-danger btn-sm my-link confirm'
				       				 href='add_electoral_circuite.php?task=delete&id=".$party['id']."'>حذف <i class='fa fa-trash-o'></i></a>
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