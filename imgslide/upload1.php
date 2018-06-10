<html>
<head>
<title>เพิ่มรูปที่ต้องการเปลี่ยน</title>
</head>
<body>
<form name="form1" method="post" action="upload2.php" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?php echo $_GET['r'];?>"><br>
	<input type="file" name="filUpload"><br>
	<input name="btnSubmit" type="submit" value="Submit">


</form>
</body>
</html>