




<?php require_once('Connections/conproduct.php'); ?>
<?php require_once('Connections/conproduct.php'); ?>
<?php require_once('Connections/conproduct.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
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

$currentPage = $_SERVER["PHP_SELF"];

$currentPage = $_SERVER["PHP_SELF"];

if ((isset($_POST['product_id'])) && ($_POST['product_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM product WHERE product_id=%s",
                       GetSQLValueString($_POST['product_id'], "int"));

  mysql_select_db($database_conproduct, $conproduct);
  $Result1 = mysql_query($deleteSQL, $conproduct) or die(mysql_error());

  $deleteGoTo = "dataproduct.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

if ((isset($_GET['product_id'])) && ($_GET['product_id'] != "")) {
  $deleteSQL = sprintf("DELETE FROM product WHERE product_id=%s",
                       GetSQLValueString($_GET['product_id'], "int"));

  mysql_select_db($database_conproduct, $conproduct);
  $Result1 = mysql_query($deleteSQL, $conproduct) or die(mysql_error());

  $deleteGoTo = "dataproduct.php";
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

mysql_select_db($database_conproduct, $conproduct);
$query_showproduct = "SELECT * FROM product ORDER BY product_id ASC";
$query_limit_showproduct = sprintf("%s LIMIT %d, %d", $query_showproduct, $startRow_showproduct, $maxRows_showproduct);
$showproduct = mysql_query($query_limit_showproduct, $conproduct) or die(mysql_error());
$row_showproduct = mysql_fetch_assoc($showproduct);

if (isset($_GET['totalRows_showproduct'])) {
  $totalRows_showproduct = $_GET['totalRows_showproduct'];
} else {
  $all_showproduct = mysql_query($query_showproduct);
  $totalRows_showproduct = mysql_num_rows($all_showproduct);
}
$totalPages_showproduct = ceil($totalRows_showproduct/$maxRows_showproduct)-1;

$queryString_showproduct = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_showproduct") == false && 
        stristr($param, "totalRows_showproduct") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_showproduct = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_showproduct = sprintf("&totalRows_showproduct=%d%s", $totalRows_showproduct, $queryString_showproduct);

$queryString_showproduct = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_showproduct") == false && 
        stristr($param, "totalRows_showproduct") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_showproduct = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_showproduct = sprintf("&totalRows_showproduct=%d%s", $totalRows_showproduct, $queryString_showproduct);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
 

</head>

<body>
<p>&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;</p>
<table border="5" align="center" cellpadding="20">
  <tr>
    <td colspan="7" align="center">หน้านี้แสดงข้อมูลสินค้าชิ้นที่ <?php echo ($startRow_showproduct + 1) ?> ถึง <?php echo min($startRow_showproduct + $maxRows_showproduct, $totalRows_showproduct) ?></td>
  </tr>
  <tr>
    <td colspan="7" align="center">มีข้อมูลสินค้า<?php echo $totalRows_showproduct ?>รายการ</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#CCFFCC">รหัสสินค้า</td>
    <td align="center" bgcolor="#CCFFCC">ชื่อสินค้า</td>
    <td align="center" bgcolor="#CCFFCC">ราคาสินค้า</td>
    <td align="center" bgcolor="#CCFFCC">จำนวนสินค้า</td>
    <td align="center" bgcolor="#CCFFCC">แก้ไข</td>
    <td align="center" bgcolor="#CCFFCC">ลบสินค้า</td>
    <td align="center" bgcolor="#CCFFCC">เพิ่มสินค้า</td>
  </tr>
  
  <?php do { ?>
    <tr>
      <td align="center"><?php echo $row_showproduct['product_id']; ?></td>
      <td align="center"><?php echo $row_showproduct['product_name']; ?></td>
      <td align="center"><?php echo $row_showproduct['product_price']; ?></td>
      <td align="center"><?php echo $row_showproduct['product_amount']; ?></td>
      <td align="center"><a href="form_edit.php?product_id=<?php echo $row_showproduct['product_id']; ?>">edit</a></td>
      <td align="center"><form id="product_id" name="product_id" method="post" action="">
        <input type="submit" name="button" id="button" value="ลบ" onclick="return confirm('ยืนยันการลบ');"/>
        <input name="product_id" type="hidden" id="product_id" value="<?php echo $row_showproduct['product_id']; ?>" />
      </form></td>
      <td align="center"><a href="http://localhost/hillspa/showproduct.php">เพิ่ม</a></td>
    </tr>
    <?php } while ($row_showproduct = mysql_fetch_assoc($showproduct)); ?>
</table>

<table border="0"align="center">
  <tr>
    <td><?php if ($pageNum_showproduct > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_showproduct=%d%s", $currentPage, 0, $queryString_showproduct); ?>"><img src="First.gif" /></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_showproduct > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_showproduct=%d%s", $currentPage, max(0, $pageNum_showproduct - 1), $queryString_showproduct); ?>"><img src="Previous.gif" /></a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_showproduct < $totalPages_showproduct) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_showproduct=%d%s", $currentPage, min($totalPages_showproduct, $pageNum_showproduct + 1), $queryString_showproduct); ?>"><img src="Next.gif" /></a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_showproduct < $totalPages_showproduct) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_showproduct=%d%s", $currentPage, $totalPages_showproduct, $queryString_showproduct); ?>"><img src="Last.gif" /></a>
        <?php } // Show if not last page ?></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($showproduct);
?>
