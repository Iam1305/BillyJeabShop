<!DOCTYPE html>
<html>
<head>
<title></title>
</head>
<body>

<script type="text/javascript">
function popup(url,name,windowWidth,windowHeight){    
	myleft=(screen.width)?(screen.width-windowWidth)/2:100;	
	mytop=(screen.height)?(screen.height-windowHeight)/2:100;	
	properties = "width="+windowWidth+",height="+windowHeight;
	properties +=",scrollbars=yes, top="+mytop+",left="+myleft;   
	window.open(url,name,properties);
}
</script>

<form name="form1" method="post" action="imgslide/upload.php" enctype="multipart/form-data">
	<!-- <input type="hidden" name="id" value="<?php echo $_GET['r'];?>"><br> -->
	<input type="file" name="filUpload"><br>
	<input name="btnSubmit" type="submit" value="Submit">
</form>		

<?php
	ini_set('display_errors', 1);
	error_reporting(~0);

	include ("config.php");

	$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
	mysqli_set_charset($conn, "utf8");
	$sql = "SELECT * FROM gallery";

	$query = mysqli_query($connectdb,$sql);

?>
<table class = "table table-striped" width="650" border="1">
  <tr>
    <th width="91"> <div align="center">ชื่อรูป</div></th>
  	<th width="50"> <div align="center">แก้ไข</div></th>
  	<th width="50"> <div align="center">ลบ</div></th>
  </tr>
<?php
while($result=mysqli_fetch_array($query,MYSQLI_ASSOC))
{
?>
  <tr>
    <td><div align="center"><img src = "imgslide/myfile/<?php echo $result['GalleryShot'];?>" width="600" height="150"></div></td>
	<td align="center"><a href="javascript:popup('imgslide/upload1.php?r=<?php echo $result["GalleryID"];?>','',500,500)">แก้ไข</a></td>
	<td align="center"><a href="imgslide/del.php?r=<?php echo $result["GalleryID"];?>">ลบ</a></td>
  </tr>
<?php
}
?>
</table>
<?php
mysqli_close($conn);
?>








</body>
</html>