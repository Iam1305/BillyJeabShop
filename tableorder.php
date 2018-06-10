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

if ((isset($_POST['order_id'])) && ($_POST['order_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM tb_order WHERE order_id=%s",
                       GetSQLValueString($_POST['order_id'], "int"));

  mysql_select_db($database_connectdb, $connectdb);
  $Result1 = mysql_query($deleteSQL, $connectdb) or die(mysql_error());

  $deleteGoTo = "backend.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

mysql_select_db($database_connectdb, $connectdb);
$query_showproduct = "SELECT * FROM tb_order ORDER BY order_id DESC";
$showproduct = mysql_query($query_showproduct, $connectdb) or die(mysql_error());
$row_showproduct = mysql_fetch_assoc($showproduct);
$totalRows_showproduct = mysql_num_rows($showproduct);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ตารางสั่งซื้อ</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script>
		
$(document).ready(function() {
    $('#example').DataTable();
} );

	</script>
<link href="https://fonts.googleapis.com/css?family=Sriracha&amp;subset=thai" rel="stylesheet">
    <style>
      body {
        font-family: 'Sriracha', cursive;
        
      }
	  li {
        font-family: 'Sriracha', cursive;
        
      }
	  a {
        font-family: 'Sriracha', cursive;
        
      }
	  
      
	   p {
        font-family: 'Sriracha', cursive;
        
      }
	   h3 {
        font-family: 'Sriracha', cursive;
        
      }
	  font {
        font-family: 'Sriracha', cursive;
        
      }
		th {
        font-family: 'Sriracha', cursive;
        
      }
	  td {
        font-family: 'Sriracha', cursive;
        
      }
	  h1 {
        font-family: 'Sriracha', cursive;
        
      }

    </style>
</head>

<body>
 
<div class="container">
	<div class="row">
		<div col-md-12>
<p align="center"><font size="+3">ตารางการสั่งซื้อ</font></p>
<p align="center">&nbsp;</p>
<table width="100%" border="0" align="center" cellpadding="0" id="example" class="display">
  
  <!--ส่วนหัว-->
   <thead>
  <tr>
    <th align="center">รหัสออเดอร์</th>
    <th align="center">ชื่อลูกค้า</th>
    <th align="center">ที่อยู่จัดส่ง</th>
    <th align="center">อีเมลล์</th>
    <th align="right">โทรศัพท์</th>
    <th align="center">วันเวลาที่สั่งซื้อ</th>
    <th align="center">ลบข้อมูล</th>
    <th align="center">แก้ไขข้อมูล</th>
    
  </tr>
  </thead>
  <?php do { ?>
    <tr>
      <td align="center"><?php echo $row_showproduct['order_id']; ?></td>
      <td align="center"><?php echo $row_showproduct['name']; ?></td>
      <td align="center"><?php echo $row_showproduct['address']; ?></td><!--<td align="center">&nbsp;</td>-->
      <td align="center"><?php echo $row_showproduct['email']; ?></td>
      <td align="center"><?php echo $row_showproduct['phone']; ?></td>
      
      <td align="center"><?php echo $row_showproduct['order_date']; ?></td>
      <td align="center"><form id="form1" name="form1" method="post" action="">
        <input type="submit" name="button" id="button" value="ลบ" class="btn btn-danger" onclick="return confirm('ยืนยันการลบ?')"/>
        <input name="order_id" type="hidden" id="order_id" value="<?php echo $row_showproduct['order_id']; ?>" />
      </form></td>
      <td align="center"><a href="formedit_order.php?order_id=<?php echo $row_showproduct['order_id']; ?>">แก้ไข</a></td>
      
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
