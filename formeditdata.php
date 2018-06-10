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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "addprd")) {
  $updateSQL = sprintf("UPDATE tbl_product SET p_name=%s, p_detail=%s, p_price=%s, p_img=%s, p_img2=%s, p_img3=%s WHERE p_id=%s",
                       GetSQLValueString($_POST['p_name'], "text"),
                       GetSQLValueString($_POST['p_detail'], "text"),
                       GetSQLValueString($_POST['p_price'], "double"),
                       GetSQLValueString(dwUpload($_FILES['p_img']), "text"),
                       GetSQLValueString(dwUpload($_FILES['p_img2']), "text"),
                       GetSQLValueString(dwUpload($_FILES['p_img3']), "text"),
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
      <form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data"  name="addprd" class="form-horizontal" id="addprd">
        
        <div class="form-group">
          <div class="col-sm-12">
            <p> รหัสสินค้า</p>
            <p><?php echo $row_edit['p_id']; ?></p>
          </div>
        </div>
        
        
        <div class="form-group">
          <div class="col-sm-12">
            <p> ชื่อสินค้า</p>
            <input  name="p_name" type="text" required class="form-control" placeholder="ชื่อสินค้า" value="<?php echo $row_edit['p_name']; ?>" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <p> รายละเอียดสินค้า </p>
            <textarea name="p_detail" class="form-control"  rows="3"  required placeholder="รายละเอียดสินค้า"><?php echo $row_edit['p_detail']; ?></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-3">
            <p> ราคา (บาท) </p>
            <input  name="p_price" type="number" required class="form-control" placeholder="ราคา" value="<?php echo $row_edit['p_price']; ?>" />
            <input name="p_id" type="hidden" id="p_id" value="<?php echo $row_edit['p_id']; ?>" />
          </div>
          <div class="col-sm-8 info">
            <p> ภาพสินค้า1 </p>
            <input name="p_img" type="file" class="form-control" value="<?php echo $row_edit['p_img']; ?>" />
            <?php echo $row_edit['p_img']; ?>
          </div>
        </div>
         <div class="form-group">
         
          <div class="col-sm-8 info">
            <p> ภาพสินค้า2 </p>
            <input name="p_img2" type="file" class="form-control" value="<?php echo $row_edit['p_img2']; ?>" />
            <?php echo $row_edit['p_img2']; ?>
          </div>
        </div>
        <div class="form-group">
         
          <div class="col-sm-8 info">
            <p> ภาพสินค้า3 </p>
            <input name="p_img3" type="file" class="form-control" value="<?php echo $row_edit['p_img3']; ?>" />
            <?php echo $row_edit['p_img3']; ?>
          </div>
        </div>
        
         <div class="form-group">
          <div class="col-sm-12">
            <button type="submit" class="btn btn-primary" name="btnadd"> + เพิ่มสินค้า </button>
            <a href="backend.php" class="btn btn-primary">กลับหน้าหลัก</a>
          </div>
        </div>
         <input type="hidden" name="MM_update" value="addprd" />
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
