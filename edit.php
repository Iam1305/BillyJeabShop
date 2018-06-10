<<meta charset="utf-8" />
<?php
include('Connections/conproduct.php');
$product_id=$_POST['product_id'];
$product_name=$POST['product_name'];
$product_price=$POST['product_price'];
$product_amount=$POST['product_amount'];

		
	$sql = "UPDATE FROM product SET product_name='$product_name'
			,product_price='$product_price',product_amount='$product_amount'
	
	
	 WHERE product_id='$product_id'";

		$result = mysql_db_query($database_conproduct,$sql)or die("Error in query : $sql" .mysql_error());
	
	
	mysql_close();
	if($result){
		echo "<script>";
		echo "alert('Delete SuccessFully');";
		echo "window.location= 'newdataproduct.php';";
		echo "</script>";
		}else{
		echo "<script>";
		echo "alert('ERROR!!!!');";
		echo "window.location='newregister.php';";
		echo "</script>";	

	}

?>