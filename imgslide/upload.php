<html>
<head>
<title>อัพโหลดรูป</title>
</head>
<body>
<?php
	if(copy($_FILES["filUpload"]["tmp_name"],"myfile/".$_FILES["filUpload"]["name"]))
	{

		//*** Insert Record ***//
		include ("config.php");
		

		
		$strSQL = "INSERT INTO gallery ";
		$strSQL .="(NewsID, GalleryShot) VALUES ('0','".$_FILES["filUpload"]["name"]."')";
		$query = mysqli_query($conn,$strSQL);		
	}
?>
				<script>/*alert('บันทึกเรียบร้อย');*/window.location='../index.php?r=สไลด์';</script>

</body>
</html>
        
