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

mysql_select_db($database_connectdb, $connectdb);
$query_typeproduct = "SELECT * FROM tbl_product ORDER BY p_type_id DESC";
$typeproduct = mysql_query($query_typeproduct, $connectdb) or die(mysql_error());
$row_typeproduct = mysql_fetch_assoc($typeproduct);
$totalRows_typeproduct = mysql_num_rows($typeproduct);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<?php include('navbackend.php');?>
<body background="img/num2.jpg">
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
          <div class="col-sm-8 info">
            <p> ภาพสินค้า1 </p>
            <input type="file" name="p_img" class="form-control" />
          </div>
        </div>
         <div class="form-group">
         
          <div class="col-sm-8 info">
            <p> ภาพสินค้า2 </p>
            <input type="file" name="p_img2" class="form-control" />
          </div>
        </div>
        <div class="form-group">
         
          <div class="col-sm-8 info">
            <p> ภาพสินค้า3 </p>
            <input type="file" name="p_img3" class="form-control" />
          </div>
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
        
         <!--div class="form-group">
       	<div class="col-sm-12"> ประเภทสินค้า : </div>
          <div class="col-sm-5" align="left">
            <label>
              <select name="p_type_id" id="p_type_id">
                <option value="">-เลือกประเภทสินค้า-</option>
                <?php
do {  
?>
                <option value="<?php echo $row_typeproduct['p_type_id']?>"><?php echo $row_typeproduct['p_type_name']?></option>
                <?php
} while ($row_typeproduct = mysql_fetch_assoc($typeproduct));
  $rows = mysql_num_rows($typeproduct);
  if($rows > 0) {
      mysql_data_seek($typeproduct, 0);
	  $row_typeproduct = mysql_fetch_assoc($typeproduct);
  }
?>
              </select>
            </label>
          </div>
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
