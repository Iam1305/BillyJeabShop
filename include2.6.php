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

$colname_showuser = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_showuser = $_SESSION['MM_Username'];
}
mysql_select_db($database_connectdb, $connectdb);
$query_showuser = sprintf("SELECT * FROM tb_user WHERE u_username = %s", GetSQLValueString($colname_showuser, "text"));
$showuser = mysql_query($query_showuser, $connectdb) or die(mysql_error());
$row_showuser = mysql_fetch_assoc($showuser);
$totalRows_showuser = mysql_num_rows($showuser);
?>
<meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="styles.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>

<div id='cssmenu' style="margin-top:1%">
<ul>
   <li class=''><a href='backend.php'><i class="glyphicon glyphicon-home"></i> หน้าหลัก</a></li>
   <li class=''><a href='frontproduct2.php'><i class="glyphicon glyphicon-briefcase"></i> สินค้า</a></li>
   <li class=''><a href='howtobuy2.php'><i class="glyphicon glyphicon-list-alt
"></i> วิธีซื้อสินค้า</a></li>
   <li class=''><a href='confirmpayment2.php'><i class="glyphicon glyphicon-credit-card"></i> ยืนยันชำระเงิน</a></li>
   <li class=''><a href='contract2.php'><i class="glyphicon glyphicon-phone-alt"></i> ติดต่อเรา</a></li>
   <li class='active'><a href='cart2.php'><i class="glyphicon glyphicon-shopping-cart"></i> ตะกร้า</a></li>
</ul>
<ul align="right" style="margin-top:-3%">
    <br>สวัสดี<?php echo $row_showuser['u_username']; ?>
    <a href="dataprivate.php"class="btn btn-link">ข้อมูลส่วนตัว</a>
    <a href="login_test.php"class="btn btn-link"><span class="glyphicon glyphicon-log-in"></span>LOGOUT</a>
</ul>
</div>

	<?php
mysql_free_result($showuser);
?>
