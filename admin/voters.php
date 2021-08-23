<?php
	include 'header.php';
?>
	<section class="content-header">
	    <span class="content-title"> <i class="fa  fa-users"></i> الناخبين <i class="fa fa-chevron-left"></i> <h3>التحكم</h3> </span>
	    <ul class="header-btns">
	        <li>
	            <a href="voters_add.php?task=add" class="btn btn-info">
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
		$voters = mysql_query("
			 				SELECT * FROM `voters` 
			 			");
	?>

	<div class="table-responsive">
            <table class="table main-table rtl_table data-table table-striped table-hover">
                <thead>
                <tr>
                    <th >الرقم</th>
                    <th >الاسم الكامل</th>
                    <th >رقم إثبات الهوية</th>
                    <th >تاريخ الميلاد</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <?php
                	$num = 1;
                	while ($voter = mysqli_fetch_array($voters)) {
                		echo "			       		
				       		<tr>
				       			<td>".$num."</td>
				       			<td>".$voter['FullName']."</td>
				       			<td>".$voter['id_num']."</td>
				       			<td>".$voter['birthDate']."</td>
				       			<td>
				       				<a class='btn btn-success btn-sm my-link' href='voters_add.php?task=edit&id=".$voter['id']."'>تعديل <i class='fa fa-pencil-square-o'></i></a>
				       				<a class='btn btn-danger btn-sm my-link confirm'
				       				 href='voters_add.php?task=delete&id=".$voter['id']."'>حذف <i class='fa fa-trash-o'></i></a>
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