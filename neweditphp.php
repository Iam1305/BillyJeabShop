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

$colname_newedit = "-1";
if (isset($_GET['product_id'])) {
  $colname_newedit = $_GET['product_id'];
}
mysql_select_db($database_conproduct, $conproduct);
$query_newedit = sprintf("SELECT * FROM product WHERE product_id = %s", GetSQLValueString($colname_newedit, "int"));
$newedit = mysql_query($query_newedit, $conproduct) or die(mysql_error());
$row_newedit = mysql_fetch_assoc($newedit);
$totalRows_newedit = mysql_num_rows($newedit);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="edit.php">
  <table width="700" border="0" align="center">
    <tr>
      <td colspan="2" align="center">แก้ไขข้อมูลสินคัา</td>
    </tr>
    <tr>
      <td width="213">รหัสสินค้า</td>
      <td width="477"><label for="product_id"><?php echo $row_newedit['product_id']; ?></label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>ชื่อสินค้า</td>
      <td><label for="pproduct_name"></label>
      <input name="pproduct_name" type="text" id="pproduct_name" value="<?php echo $row_newedit['product_name']; ?>" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>ราคาสินค้า</td>
      <td><label for="product_price"></label>
      <input name="product_price" type="text" id="product_price" value="<?php echo $row_newedit['product_price']; ?>" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>จำนวนสินค้า</td>
      <td><label for="product_amount"></label>
      <input name="product_amount" type="text" id="product_amount" value="<?php echo $row_newedit['product_amount']; ?>" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="แก้ไข" id="แก้ไข" value="แก้ไข" /></td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
mysql_free_result($newedit);
?>
