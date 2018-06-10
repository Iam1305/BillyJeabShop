<meta charset="utf-8" />
<?php
include('Connections/connectdb.php');

$u_username=$_POST['u_username'];
$u_password=md5($_POST['u_password']);
$u_name=$_POST['u_name'];
$u_tel=$_POST['u_tel'];

$check = "SELECT * FROM tb_user WHERE u_username='$u_username' ";
$result1=mysql_db_query($database_connectdb ,$check);
$num=mysql_num_rows($result1);
	if($num>0)
	{
		echo "<script>";
		echo "alert('Username นี้มีผู้ใช้เเล้ว');";
		echo "window.location= 'newregister.php';";
		echo "</script>";
		
	}else{
		
	$sql = "INSERT INTO tb_user

		(u_username ,u_password,u_name,u_tel )
		VALUES 
		
		('$u_username', '$u_password', '$u_name', '$u_tel' )";
	$result = mysql_db_query($database_connectdb,$sql)or die("Error in query : $sql" .mysql_error());
	}
	
	mysql_close();
	if($result){
		echo "<script>";
		echo "alert('Register SuccessFully');";
		echo "window.location= 'newregister.php';";
		echo "</script>";
		}else{
		echo "<script>";
		echo "alert('ERROR!!!!');";
		echo "window.location='newregister.php';";
		echo "</script>";	

	}

?>