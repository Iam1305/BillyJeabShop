<?php require_once('Connections/conproduct.php'); ?>
<?php require_once('Connections/conproduct.php'); ?>
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

if ((isset($_POST['product_id'])) && ($_POST['product_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM product WHERE product_id=%s",
                       GetSQLValueString($_POST['product_id'], "int"));

  mysql_select_db($database_conproduct, $conproduct);
  $Result1 = mysql_query($deleteSQL, $conproduct) or die(mysql_error());

  $deleteGoTo = "newdataproduct.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

mysql_select_db($database_conproduct, $conproduct);
$query_newdataproduct = "SELECT * FROM product";
$newdataproduct = mysql_query($query_newdataproduct, $conproduct) or die(mysql_error());
$row_newdataproduct = mysql_fetch_assoc($newdataproduct);
$totalRows_newdataproduct = mysql_num_rows($newdataproduct);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ตารางแสดงข้อมูล</title>
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
		<div class="col-md-12">
<p>&nbsp;</p><p>&nbsp;</p>
<h1 align="center">ตารางแสดงข้อมูลสินค้า</h1>
<p>&nbsp;</p>
<table border="0" align="center" cellpadding="0"id="example" class="display" >
  <!--ส่วนหัว-->
   <thead>
  <tr>
    <th align="center">รหัสสินค้า</th>
    <th align="center">ชื่อสินค้า</th>
    <th align="center">ราคาสินค้า</th>
    <th align="center">จำนวนสินค้า</th>
    <th align="center">ลบ</th>
    <th align="center">แก้ไข</th>
  </tr>
  </thead>
  <?php do { ?>
    <tr>
      <td align="center"><?php echo $row_newdataproduct['product_id']; ?></td>
      <td align="center"><?php echo $row_newdataproduct['product_name']; ?></td>
      <td align="center"><?php echo $row_newdataproduct['product_price']; ?></td>
      <td align="center"><?php echo $row_newdataproduct['product_amount']; ?></td>
      <td align="center"><form id="form1" name="form1" method="post" action="">
        <input type="submit" name="ลบ" id="ลบ" value="ลบ" />
        <input name="product_id" type="hidden" id="product_id" value="<?php echo $row_newdataproduct['product_id']; ?>" />
      </form></td>
      <td align="center"><form id="edit" name="edit" method="post" action="neweditphp.php">
        <input type="submit" name="edit" id="edit" value="แก้ไข" />
      </form></td>
    </tr>
    <?php } while ($row_newdataproduct = mysql_fetch_assoc($newdataproduct)); ?>
</table>
        </div>
	</div>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($newdataproduct);
?>
