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

if ((isset($_POST['d_id'])) && ($_POST['d_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM tb_order_detail WHERE d_id=%s",
                       GetSQLValueString($_POST['d_id'], "int"));

  mysql_select_db($database_connectdb, $connectdb);
  $Result1 = mysql_query($deleteSQL, $connectdb) or die(mysql_error());

  $deleteGoTo = "backend.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  
}

mysql_select_db($database_connectdb, $connectdb);
$query_showproduct = "SELECT * FROM tb_order_detail ORDER BY d_id DESC";
$showproduct = mysql_query($query_showproduct, $connectdb) or die(mysql_error());
$row_showproduct = mysql_fetch_assoc($showproduct);
$totalRows_showproduct = mysql_num_rows($showproduct);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ตารางออร์เดอร์</title>
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
<p align="center"><font size="+3">ตารางรายละเอียดการสั่งซื้อ</font></p>
<p align="center">&nbsp;</p>
<table width="100%" border="1" align="center" cellpadding="0" id="example" class="display">
  
  <!--ส่วนหัว-->
   <thead>
  <tr>
    <th align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ลำดับ</th>
    <th align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รหัสออเดอร์</th>
    <th align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รหัสสินค้า</th>
    <th align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จำนวนที่ซื้อ</th>
    <th align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ราคา</th>
   <th align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ลบข้อมูล</th>
    <th align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;แก้ไขข้อมูล</th>
    
  </tr>
  </thead>
  <?php do { ?>
    <tr>
      <td align="center"><?php echo $row_showproduct['d_id']; ?></td>
      <td align="center"><?php echo $row_showproduct['order_id']; ?></td>
      <td align="center"><?php echo $row_showproduct['p_id']; ?></td><!--<td align="center">&nbsp;</td>-->
      <td align="center"><?php echo $row_showproduct['p_qty']; ?></td>
      <td align="center"><?php echo $row_showproduct['total']; ?></td>
      
      
      <td align="center"><form id="form1" name="form1" method="post" action="">
        <input type="submit" name="button" id="button" value="ลบ" class="btn btn-danger" onclick="return confirm('ยืนยันการลบ?')"/>
        <input name="d_id" type="hidden" id="d_id" value="<?php echo $row_showproduct['d_id']; ?>" />
      </form></td>
      <td align="center"><a href="formedit_orderdetail.php?d_id=<?php echo $row_showproduct['d_id']; ?>">แก้ไข</a></td>
      
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
