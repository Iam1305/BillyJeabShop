<?php require_once('Connections/connectdb.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

if ((isset($_POST['u_id'])) && ($_POST['u_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM tb_user WHERE u_id=%s",
                       GetSQLValueString($_POST['u_id'], "int"));

  mysql_select_db($database_connectdb, $connectdb);
  $Result1 = mysql_query($deleteSQL, $connectdb) or die(mysql_error());

  $deleteGoTo = "usertable.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$maxRows_showproduct = 10;
$pageNum_showproduct = 0;
if (isset($_GET['pageNum_showproduct'])) {
  $pageNum_showproduct = $_GET['pageNum_showproduct'];
}
$startRow_showproduct = $pageNum_showproduct * $maxRows_showproduct;

mysql_select_db($database_connectdb, $connectdb);
$query_showproduct = "SELECT * FROM tb_user";
$query_limit_showproduct = sprintf("%s LIMIT %d, %d", $query_showproduct, $startRow_showproduct, $maxRows_showproduct);
$showproduct = mysql_query($query_limit_showproduct, $connectdb) or die(mysql_error());
$row_showproduct = mysql_fetch_assoc($showproduct);

if (isset($_GET['totalRows_showproduct'])) {
  $totalRows_showproduct = $_GET['totalRows_showproduct'];
} else {
  $all_showproduct = mysql_query($query_showproduct);
  $totalRows_showproduct = mysql_num_rows($all_showproduct);
}

$pageNum_showproduct = 0;
if (isset($_GET['pageNum_showproduct'])) {
  $pageNum_showproduct = $_GET['pageNum_showproduct'];
}
$startRow_showproduct = $pageNum_showproduct * $maxRows_showproduct;

mysql_select_db($database_connectdb, $connectdb);
$query_showproduct = "SELECT * FROM tb_user ORDER BY u_id ASC";
$showproduct = mysql_query($query_showproduct, $connectdb) or die(mysql_error());
$row_showproduct = mysql_fetch_assoc($showproduct);
$totalRows_showproduct = mysql_num_rows($showproduct);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ตารางสมาชิก</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script>
		
$(document).ready(function() {
    $('#example').DataTable();
} );

	</script>

</head>

<body background="img/num2.jpg">
 <?php include('navbackend.php');?>
<div class="container">
	<div class="row">
		
        
        <div col-md-12>
<h1 align="center">ตารางสมาชิก</h1>
<p align="center">&nbsp;</p>
<table width="100%" border="0" align="center" cellpadding="0" id="example" class="display">
  
  <!--ส่วนหัว-->
   <thead>
  <tr>
    <th align="center">รหัสลูกค้า</th>
    <th align="center">ชื่อยูเซอร์เนม</th>
    <th align="center">รหัสผ่าน</th>
    <th align="right">ชื่อลูกค้า</th>
    <th align="right">ที่อยู่</th>
    <th align="right">อีเมลล์</th>
    <th align="right">เลเวล</th>
    <th align="center">เบอร์โทรศัพท์</th>
    <th align="center">วันเวลาที่สมัคร</th>
    <th align="center">ลบข้อมูล</th>
    <th align="center">แก้ไขข้อมูล</th>
    
  </tr>
  </thead>
  <?php do { ?>
    <tr>
      <td align="center"><?php echo $row_showproduct['u_id']; ?></td>
      <td align="center"><?php echo $row_showproduct['u_username']; ?></td>
      <td align="center"><?php echo $row_showproduct['u_password']; ?></td>
      <td align="center"><?php echo $row_showproduct['u_name']; ?></td>
      <td align="center"><?php echo $row_showproduct['u_address']; ?></td>
      <td align="center"><?php echo $row_showproduct['u_mail']; ?></td>
      <td align="center"><?php echo $row_showproduct['u_level']; ?></td>
      <td align="center"><?php echo $row_showproduct['u_tel']; ?></td>
      <td align="center"><?php echo $row_showproduct['u_datesave']; ?></td>
      <td align="center"><form id="form1" name="form1" method="post" action="">
        <input name="ลบ" type="submit" id="ลบ" value="ลบ" class="btn btn-danger" onclick="return confirm('ยืนยันการลบหรือไม่');" />
        <input name="u_id" type="hidden" id="u_id" value="<?php echo $row_showproduct['u_id']; ?>" />
      </form></td>
      <td align="center"><a href="formedituser.php?u_id=<?php echo $row_showproduct['u_id']; ?>">แก้ไข</a></td>
      
    </tr>
    <?php } while ($row_showproduct = mysql_fetch_assoc($showproduct)); ?>
</table>
      </div>
	</div>
</div>

</body>
</html>
<?php
mysql_free_result($showproduct);
?>
