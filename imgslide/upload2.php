<html>
<head>
<title></title>
</head>
<body>
<?php
	if(copy($_FILES["filUpload"]["tmp_name"],"myfile/".$_FILES["filUpload"]["name"]))
	{

		//*** Insert Record ***//
		include ("config.php");
		$strSQL = "UPDATE gallery SET ";
		$strSQL .="GalleryShot = '".$_FILES["filUpload"]["name"]."' ";
		

		$strSQL .="WHERE GalleryID = '".$_POST["id"]."' ";
		$objQuery = mysqli_query($conn,$strSQL);
		

		// $objDB = mysql_select_db("bit");
		// $strSQL = "INSERT INTO file ";
		// $strSQL .="(NewsID, FileTitle, FileName) VALUES ('".$_POST["id"]."','".$_POST["FileTitle"]."','".$_FILES["filUpload"]["name"]."')";
		// $query = mysqli_query($conn,$strSQL);		
	}
?>
		<script>
		alert('อัพโหลดเรียบร้อยแล้ว');
		window.opener.location.reload();
		</script>
				<script> window.close();</script>

</body>
</html>
        
