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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "edit")) {
  $updateSQL = sprintf("UPDATE tbl_product SET p_name=%s, p_detail=%s, p_price=%s, p_img=%s, date_save=%s WHERE p_id=%s",
                       GetSQLValueString($_POST['p_name'], "text"),
                       GetSQLValueString($_POST['p_detail'], "text"),
                       GetSQLValueString($_POST['p_price'], "double"),
                       GetSQLValueString($_POST['p_img'], "text"),
                       GetSQLValueString($_POST['date_save'], "date"),
                       GetSQLValueString($_POST['p_id'], "int"));

  mysql_select_db($database_connectdb, $connectdb);
  $Result1 = mysql_query($updateSQL, $connectdb) or die(mysql_error());

  $updateGoTo = "sho_product.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_edit = "-1";
if (isset($_GET['p_id'])) {
  $colname_edit = $_GET['p_id'];
}
mysql_select_db($database_connectdb, $connectdb);
$query_edit = sprintf("SELECT * FROM tbl_product WHERE p_id = %s", GetSQLValueString($colname_edit, "int"));
$edit = mysql_query($query_edit, $connectdb) or die(mysql_error());
$row_edit = mysql_fetch_assoc($edit);
$totalRows_edit = mysql_num_rows($edit);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6"> <br />
      <h4 align="center"> ฟอร์มเพิ่มสินค้า </h4>
      <hr />
      <form action="add_product_db.php" method="POST" enctype="multipart/form-data"  name="addprd" class="form-horizontal" id="addprd">
        
        <div class="form-group">
          <div class="col-sm-12">
            <p> รหัสสินค้า</p>
            <input type="text"  name="p_id" class="form-control" required placeholder="รหัสสินค้า" />
          </div>
        </div>
        
        
        <div class="form-group">
          <div class="col-sm-12">
            <p> ชื่อสินค้า</p>
            <input type="text"  name="p_name" class="form-control" required placeholder="ชื่อสินค้า" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <p> รายละเอียดสินค้า </p>
            <textarea name="p_detail" class="form-control"  rows="3"  required placeholder="รายละเอียดสินค้า"></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-3">
            <p> ราคา (บาท) </p>
            <input type="number"  name="p_price" class="form-control" required placeholder="ราคา" />
          </div>
          
        
         <div class="form-group">
          <div class="col-sm-12">
            <button type="submit" class="btn btn-primary" name="btnadd"> + เพิ่มสินค้า </button>
            <a href="backend.php" class="btn btn-primary">กลับหน้าหลัก</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<p align="center"> design by Jakrit </p>
</body>
</html>
  
         

<?php
mysql_free_result($typeproduct);
?>
