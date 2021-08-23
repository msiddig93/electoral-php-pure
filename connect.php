<?php
	session_start();
	$con = mysqli_connect("127.0.0.1","root","","electoral") or die("Not Connect To DataBase Cuase ".mysqli_error());
	mysqli_query($con, "set names 'utf8'");

	function mysql_query($query = "" )
	{
		global $con;
		$stm = mysqli_query($con, $query) or die(mysqli_error());
		return $stm;
	}

	function refresh($page=null ,$time=3){
		if ($page === null) {
			$page = 'admin/index.php';
		}
		echo" <meta http-equiv=\"refresh\" content=\"$time; url=$page\">";
	}

	function security(){
		foreach ($_POST as $key => $value ):
	            $_POST[$key] = strip_tags($value);
	    endforeach;
	}

?>