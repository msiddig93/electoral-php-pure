<?php
	include 'header.php';
?>
	<section class="content-header">
	    <span class="content-title"> <i class="fa  fa-archive"></i> الدورات الانتخابية <i class="fa fa-chevron-left"></i> <h3>التحكم</h3> </span>
	    <ul class="header-btns">
	        <li>
	            <a href="cycle_add.php?task=add" class="btn btn-info">
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
		$cyclies = mysql_query("
			 				SELECT * FROM `electoral_cycle` 
			 			");
	?>

	<div class="table-responsive">
            <table class="table main-table rtl_table data-table table-striped table-hover">
                <thead>
                <tr>
                    <th >الرقم</th>
                    <th >العنوان</th>
                    <th >تارخ البداية</th>
                    <th >تارخ النهاية</th>
                    <th >الحالة</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <?php
                	$num = 1;
                	$status = "";
                	while ($cycle = mysqli_fetch_array($cyclies)) {

                		if ($cycle['status'] == 1 ) {
                			$status = "مفتوح";
                		}else{
                			$status = "مغلق";
                		}

                		echo "			       		
				       		<tr>
				       			<td>".$num."</td>
				       			<td>".$cycle['title']."</td>
				       			<td>".$cycle['start_at']."</td>
				       			<td>".$cycle['end_at']."</td>
				       			<td>".$status."</td>
				       			<td>
				       				<a class='btn btn-success btn-sm my-link' href='cycle_add.php?task=edit&id=".$cycle['id']."'>تعديل <i class='fa fa-pencil-square-o'></i></a>
				       				<a class='btn btn-danger btn-sm my-link confirm'
				       				 href='cycle_add.php?task=delete&id=".$cycle['id']."'>حذف <i class='fa fa-trash-o'></i></a>
				       				 <a class='btn btn-info btn-sm my-link confirm'
				       				 href='cycle_add.php?task=fetch&id=".$cycle['id']."'>فرز الاصوات </a>
				       				 <a class='btn btn-primary btn-sm my-link '
				       				 href='electoral_result.php?id=".$cycle['id']."'>عرض النتيجة </a>
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