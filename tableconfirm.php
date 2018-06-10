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

if ((isset($_POST['c_id'])) && ($_POST['c_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM confirm WHERE c_id=%s",
                       GetSQLValueString($_POST['c_id'], "int"));

  mysql_select_db($database_connectdb, $connectdb);
  $Result1 = mysql_query($deleteSQL, $connectdb) or die(mysql_error());

  $deleteGoTo = "tableconfirm.php";
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
$query_showproduct = "SELECT * FROM confirm";
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
$query_showproduct = "SELECT * FROM confirm ORDER BY c_id ASC";
$showproduct = mysql_query($query_showproduct, $connectdb) or die(mysql_error());
$row_showproduct = mysql_fetch_assoc($showproduct);
$totalRows_showproduct = mysql_num_rows($showproduct);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ตารางแจ้งชำระเงิน</title>
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
<h1 align="center">ตารางแจ้งชำระเงิน</h1>
<p align="center">&nbsp;</p>
<table width="100%" border="0" align="center" cellpadding="0" id="example" class="display">
  
  <!--ส่วนหัว-->
   <thead>
  <tr>
    <th align="center">รหัสสินค้า</th>
    <th align="center">ชื่อลูกค้า</th>
    <th align="center">อีเมลล์</th>
    <th align="right">เบอร์โทรศัพท์</th>
    <th align="center">ราคาสินค้า</th>
    <th align="center">รูปภาพ</th>
    <th align="center">วันเวลาที่แจ้ง</th>
    <th align="center">ลบข้อมูล</th>
    <th align="center">แก้ไขข้อมูล</th>
    
  </tr>
  </thead>
  <?php do { ?>
    <tr>
      <td align="center"><?php echo $row_showproduct['c_id']; ?></td>
      <td align="center"><?php echo $row_showproduct['c_name']; ?></td>
      <td align="center"><?php echo $row_showproduct['c_mail']; ?></td>
      <td align="center"><?php echo $row_showproduct['c_tel']; ?></td>
      <td align="center"><?php echo $row_showproduct['c_price']; ?></td>
      <td align="center"><img src="img/<?php echo $row_showproduct['c_img']; ?>" width="130" height="130" /></td>
      <td align="center"><?php echo $row_showproduct['c_date']; ?></td>
      <td align="center"><form id="form1" name="form1" method="post" action="">
        <input type="submit" name="button" id="button" value="ลบ" class="btn btn-danger" onclick="return confirm('ยืนยันการลบข้อมูล');" />
        <input name="c_id" type="hidden" id="c_id"  value="<?php echo $row_showproduct['c_id']; ?>"  />
      </form></td>
      <td align="center"><a href="editconfirm.php?c_id=<?php echo $row_showproduct['c_id']; ?>">แก้ไข</a></td>
      
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
