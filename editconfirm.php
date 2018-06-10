<?php require_once('Connections/connectdb.php'); ?>
<?php include("dw-upload.inc.php")?>
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

$colname_edit = "-1";
if (isset($_GET['p_id'])) {
  $colname_edit = $_GET['p_id'];
}
mysql_select_db($database_connectdb, $connectdb);
$query_edit = sprintf("SELECT * FROM tbl_product WHERE p_id = %s", GetSQLValueString($colname_edit, "int"));
$edit = mysql_query($query_edit, $connectdb) or die(mysql_error());
$row_edit = mysql_fetch_assoc($edit);
$totalRows_edit = mysql_num_rows($edit);$colname_edit = "-1";
if (isset($_GET['c_id'])) {
  $colname_edit = $_GET['c_id'];
}
mysql_select_db($database_connectdb, $connectdb);
$query_edit = sprintf("SELECT * FROM confirm WHERE c_id = %s", GetSQLValueString($colname_edit, "int"));
$edit = mysql_query($query_edit, $connectdb) or die(mysql_error());
$row_edit = mysql_fetch_assoc($edit);
$totalRows_edit = mysql_num_rows($edit);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body background="img/num2.jpg">
<div class="container">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6"> <br />
      <h4 align="center"> ฟอร์มแก้ไขข้อมูล</h4>
      <hr />
      <form method="POST" enctype="multipart/form-data"  name="addprd" class="form-horizontal" id="addprd">
        
        <div class="form-group">
          <div class="col-sm-12">
            <p> รหัสสินค้า</p>
            <p><?php echo $row_edit['c_id']; ?></p>
          </div>
        </div>
        
        
        <div class="form-group">
          <div class="col-sm-12">
            <p> ชื่อ</p>
            <input  name="p_name" type="text" required class="form-control" placeholder="ชื่อ" value="<?php echo $row_edit['c_name']; ?>" />
          </div>
        </div>
        
        <div class="form-group">
          <div class="col-sm-12">
            <p> อีเมล์</p>
            <input  name="p_name" type="text" required class="form-control" placeholder="อีเมล์" value="<?php echo $row_edit['c_mail']; ?>" />
          </div>
        </div>
          <div class="form-group">
          <div class="col-sm-12">
            <p>โทรศัพท์</p>
            <input  name="p_name" type="text" required class="form-control" placeholder="โทรศัพท์" value="<?php echo $row_edit['c_tel']; ?>" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-3">
            <p> ราคา</p>
            <input  name="p_name" type="text" required class="form-control" placeholder="ราคา" value="<?php echo $row_edit['c_price']; ?>" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-8 info">
            <p> ภาพสินค้า1 </p>
            <input name="p_img" type="file" class="form-control" value="<?php echo $row_edit['c_img']; ?>" />
          <?php echo $row_edit['c_img']; ?> </div>
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
<p align="center"> Design by Jakrit </p>
</body>
</html>
<?php
mysql_free_result($edit);
?>
