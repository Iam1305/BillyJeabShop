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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "addprd")) {
  $updateSQL = sprintf("UPDATE tb_user SET u_username=%s, u_password=%s, u_name=%s, u_level=%s, u_tel=%s WHERE u_id=%s",
                       GetSQLValueString($_POST['u_username'], "text"),
                       GetSQLValueString($_POST['u_password'], "text"),
                       GetSQLValueString($_POST['u_name'], "text"),
                       GetSQLValueString($_POST['u_level'], "int"),
                       GetSQLValueString($_POST['u_tel'], "int"),
                       GetSQLValueString($_POST['u_id'], "int"));

  mysql_select_db($database_connectdb, $connectdb);
  $Result1 = mysql_query($updateSQL, $connectdb) or die(mysql_error());

  $updateGoTo = "usertable.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "addprd")) {
  $updateSQL = sprintf("UPDATE tb_order_detail SET order_id=%s, p_id=%s, p_qty=%s, total=%s WHERE d_id=%s",
                       GetSQLValueString($_POST['order_id'], "int"),
                       GetSQLValueString($_POST['p_id'], "int"),
                       GetSQLValueString($_POST['p_qty'], "int"),
                       GetSQLValueString($_POST['total'], "double"),
                       GetSQLValueString($_POST['d_id'], "int"));

  mysql_select_db($database_connectdb, $connectdb);
  $Result1 = mysql_query($updateSQL, $connectdb) or die(mysql_error());

  $updateGoTo = "backend.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_user = "-1";
if (isset($_GET['d_id'])) {
  $colname_user = $_GET['d_id'];
}
mysql_select_db($database_connectdb, $connectdb);
$query_user = sprintf("SELECT * FROM tb_order_detail WHERE d_id = %s", GetSQLValueString($colname_user, "int"));
$user = mysql_query($query_user, $connectdb) or die(mysql_error());
$row_user = mysql_fetch_assoc($user);
$totalRows_user = mysql_num_rows($user);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6"> <br />
      <h4 align="center"> ฟอร์มแก้ไขข้อมูลรายละเอียด</h4>
      <hr />
      <form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data"  name="addprd" class="form-horizontal" id="addprd">
        
        <div class="form-group">
          <div class="col-sm-12">
            <p> รหัสสั่งซื้อ</p>
            <p><?php echo $row_user['d_id']; ?></p>
          </div>
        </div>
        
        
        <div class="form-group">
          <div class="col-sm-12">
            <p> รหัสออร์เดอร์</p>
            <input  name="order_id" type="text" required class="form-control" id="order_id" placeholder="รหัสออร์เดอร์" value="<?php echo $row_user['order_id']; ?>" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <p>รหัสสินค้า</p>
            <input  name="p_id" type="text" required class="form-control" id="p_id" placeholder="รหัสสินค้า" value="<?php echo $row_user['p_id']; ?>" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <p> จำนวนที่สั่งซื้อ</p>
            <input  name="p_qty" type="text" required class="form-control" id="p_qty" placeholder="จำนวนที่สั่งซื้อ" value="<?php echo $row_user['p_qty']; ?>" />
          </div>
        </div>
         <div class="form-group">
        <div class="col-sm-12">
          <p>ราคา</p>
            <input  name="total" type="text" required class="form-control" id="total" placeholder="ราคา" value="<?php echo $row_user['total']; ?>" />
         </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <button type="submit" class="btn btn-primary" name="btnadd"> + เพิ่มสินค้า </button>
            <a href="backend.php" class="btn btn-primary">กลับหน้าหลัก</a>
          </div>
        </div>
         <input name="d_id" type="hidden" id="d_id" value="<?php echo $row_user['d_id']; ?>" />
         <input type="hidden" name="MM_update" value="addprd" />
      </form>
    </div>
  </div>
</div>
<p align="center"> Design by Jakrit </p>
</body>
</html>
<?php
mysql_free_result($user);
?>
