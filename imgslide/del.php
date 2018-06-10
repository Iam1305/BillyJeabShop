
<?php
	ini_set('display_errors', 1);
	error_reporting(~0);

	$serverName = "localhost";
	$userName = "root";
	$userPassword = "";
	$dbName = "hillspa";

	$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);

	$id = $_GET["r"];
	$sql = "DELETE FROM gallery
			WHERE GalleryID = '".$id."' ";

	$query = mysqli_query($connectdb,$sql);

	if(mysqli_affected_rows($connectdb)) {
		 echo "Record delete successfully";
	}

	mysqli_close($connectdb);
?>

	<script>/*alert('บันทึกเรียบร้อย');*/window.location='../index.php?r=สไลด์';</script>
