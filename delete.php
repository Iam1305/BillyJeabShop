<meta charset="utf-8" />
<?php

include('Connections/connectdb.php');
$p_id = $GET['p_id'];


		
	$sql = "DELETE FROM tbl_product WHERE p_id='$p_id'";

		$result = mysql_db_query($database_connectdb,$sql)or die("Error in query : $sql" .mysql_error());
	
	
	mysql_close();
	if($result){
		echo "<script>";
		echo "alert('Delete SuccessFully');";
		echo "window.location= 'sho_product.php';";
		echo "</script>";
		}else{
		echo "<script>";
		echo "alert('ERROR!!!!');";
		echo "window.location='sho_product.php';";
		echo "</script>";	

	}

?>