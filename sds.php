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

if ((isset($_POST['p_id'])) && ($_POST['p_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM tbl_product WHERE p_id=%s",
                       GetSQLValueString($_POST['p_id'], "int"));

  mysql_select_db($database_connectdb, $connectdb);
  $Result1 = mysql_query($deleteSQL, $connectdb) or die(mysql_error());

  $deleteGoTo = "sho_product.php";
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
$query_showproduct = "SELECT * FROM tbl_product";
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
$query_showproduct = "SELECT * FROM tbl_product ORDER BY p_id ASC";
$showproduct = mysql_query($query_showproduct, $connectdb) or die(mysql_error());
$row_showproduct = mysql_fetch_assoc($showproduct);
$totalRows_showproduct = mysql_num_rows($showproduct);mysql_select_db($database_connectdb, $connectdb);
$query_showproduct = "SELECT * FROM tbl_product, product_type WHERE tbl_product.p_type_id=product_type.p_type_id ORDER BY p_id ASC";
$showproduct = mysql_query($query_showproduct, $connectdb) or die(mysql_error());
$row_showproduct = mysql_fetch_assoc($showproduct);
$totalRows_showproduct = mysql_num_rows($showproduct);
$query_showproduct = "SELECT * FROM tbl_product, product_type WHERE tbl_product.p_type_id=product_type.p_type_id ORDER BY p_id ASC";
$showproduct = mysql_query($query_showproduct, $connectdb) or die(mysql_error());
$row_showproduct = mysql_fetch_assoc($showproduct);
$totalRows_showproduct = mysql_num_rows($showproduct);
$query_showproduct = "SELECT * FROM tbl_product, product_type WHERE tbl_product.p_type_id=product_type.p_type_id ORDER BY p_id ASC";
$showproduct = mysql_query($query_showproduct, $connectdb) or die(mysql_error());
$row_showproduct = mysql_fetch_assoc($showproduct);
$totalRows_showproduct = mysql_num_rows($showproduct);
$query_showproduct = "SELECT * FROM tbl_product ORDER BY p_id DESC";
$showproduct = mysql_query($query_showproduct, $connectdb) or die(mysql_error());
$row_showproduct = mysql_fetch_assoc($showproduct);
$totalRows_showproduct = mysql_num_rows($showproduct);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ตารางสินค้า</title>
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

<body>
<div class="container">
	<div class="row">
		<div col-md-12>
<h1 align="center">ตารางสินค้า</h1>
<p align="center">&nbsp;</p>
<table width="100%" border="0" align="center" cellpadding="0" id="example" class="display">
  
  <!--ส่วนหัว-->
   <thead>
  <tr>
    <th align="center">รหัสสินค้า</th>
    <th align="center">ชื่อสินค้า</th>
    <th align="center">ประเภทสินค้า</th>
    <th align="center">รายละเอียดสินค้า</th>
    <th align="right">ราคาสินค้า</th>
    <th align="center">รูปสินค้า</th>
    <th align="center">เวลา</th>
    <th align="center">ลบข้อมูล</th>
    <th align="center">แก้ไขข้อมูล</th>
    <th align="center">จำนวนครั้งที่เข้าชม</th>
  </tr>
  </thead>
  <?php do { ?>
    <tr>
      <td align="center"><?php echo $row_showproduct['p_id']; ?></td>
      <td align="center"><?php echo $row_showproduct['p_name']; ?></td>
      <td align="center">&nbsp;</td>
      <td align="center"><?php echo $row_showproduct['p_detail']; ?></td>
      <td align="center"><?php echo $row_showproduct['p_price']; ?></td>
      <td> &nbsp;&nbsp;  &nbsp; &nbsp; <img src="img/<?php echo $row_showproduct['p_img']; ?>" width="176" height="130" /></td>
      <td align="center"><?php echo $row_showproduct['date_save']; ?></td>
      <td align="center"><form id="form1" name="form1" method="post" action="">
        <input type="submit" name="button" id="button" value="ลบ" class="btn btn-danger" onclick="return confirm('ยืนยันการลบ?')"/>
        <input name="p_id" type="hidden" id="p_id" value="<?php echo $row_showproduct['p_id']; ?>" />
      </form></td>
      <td align="center"><a href="form_edit.php?p_id=<?php echo $row_showproduct['p_id']; ?>">แก้ไข</a></td>
      <td align="center"><?php echo $row_showproduct['p_view']; ?></td>
    </tr>
    <?php } while ($row_showproduct = mysql_fetch_assoc($showproduct)); ?>
</table>
      </div>
	</div>
</div>
<div align="center"> <a href="add_product.php"class="btn btn-danger" >เพิ่มสินค้า</a></div>&nbsp;&nbsp;
</body>
</html>
<?php
mysql_free_result($showproduct);
?>
