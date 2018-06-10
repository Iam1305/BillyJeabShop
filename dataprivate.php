<link href="https://fonts.googleapis.com/css?family=Sriracha&amp;subset=thai" rel="stylesheet">
<link rel="icon" href="favicon.ico" type="image/x-icon"> 
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"> 
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
		strong {
        font-family: 'Sriracha', cursive;
        
      }


    </style>
<?php require_once('Connections/connectdb.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "dataprivate.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

$maxRows_showproduct = 1;
$pageNum_showproduct = 0;
if (isset($_GET['pageNum_showproduct'])) {
  $pageNum_showproduct = $_GET['pageNum_showproduct'];
}
$startRow_showproduct = $pageNum_showproduct * $maxRows_showproduct;

mysql_select_db($database_connectdb, $connectdb);
$query_showproduct = "SELECT * FROM tb_user";
$query_limit_showproduct = sprintf("%s LIMIT %d, %d", $query_showproduct, $startRow_showproduct, $maxRows_showproduct);
$showproduct = mysql_query($query_limit_showproduct, $connectdb) or die(mysql_error());
$row_showproduct = mysql_fetch_assoc($showproduct);

if (isset($_GET['totalRows_showproduct'])) {
  $totalRows_showproduct = $_GET['totalRows_showproduct'];
} else {
  $all_showproduct = mysql_query($query_showproduct);
  $totalRows_showproduct = mysql_num_rows($all_showproduct);
}

$pageNum_showproduct = 0;
if (isset($_GET['pageNum_showproduct'])) {
  $pageNum_showproduct = $_GET['pageNum_showproduct'];
}
$startRow_showproduct = $pageNum_showproduct * $maxRows_showproduct;

$colname_showmember = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_showmember = $_SESSION['MM_Username'];
}
mysql_select_db($database_connectdb, $connectdb);
$query_showmember = sprintf("SELECT * FROM tb_user WHERE u_username = %s", GetSQLValueString($colname_showmember, "text"));
$showmember = mysql_query($query_showmember, $connectdb) or die(mysql_error());
$row_showmember = mysql_fetch_assoc($showmember);
$totalRows_showmember = mysql_num_rows($showmember);
?>
<?php include('include0.0.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ข้อมูลส่วนตัว</title>
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

<body background="img/num2.jpg">
 
 
<div class="container">
	<div class="row">
		
        
      <div col-md-12>
<h1 align="center">ข้อมูลส่วนตัว</h1>
<p align="center">&nbsp;</p>
<table width="100%" border="0" align="center" cellpadding="0" id="example" class="display">
  
  <!--ส่วนหัว-->
   <thead>
  <tr>
    <th align="center">รหัสลูกค้า</th>
    <th align="center">ชื่อลูกค้า</th>
    <th align="center">รหัสผ่าน</th>
    <th align="center">ชื่อ</th>
    <th align="center">ที่อยู่</th>
    <th align="center">อีเมลล์</th>
    <th align="center">เบอร์โทรศัพท์</th>
    <th align="center">แก้ไขข้อมูล</th>
    
  </tr>
  </thead>
  <?php do { ?>
    <tr>
      <td align="center"><?php echo $row_showmember['u_id']; ?></td>
      <td align="center"><?php echo $row_showmember['u_username']; ?></td>
      <td align="center"><?php echo $row_showmember['u_password']; ?></td>
      <td align="center"><?php echo $row_showmember['u_name']; ?></td>
      <td align="center"><?php echo $row_showmember['u_address']; ?></td>
      <td align="center"><?php echo $row_showmember['u_mail']; ?></td>
      <td align="center"><?php echo $row_showmember['u_tel']; ?></td>
      <td align="center"><a href="editmyself.php?u_id=<?php echo $row_showmember['u_id']; ?>">แก้ไข</a></td>
      
    </tr>
    <?php } while ($row_showproduct = mysql_fetch_assoc($showproduct)); ?>
</table>
      </div>
	</div>
</div>
<?php include('history.php');?>



<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<p align="center"> Credit By Jakrit Pongkorntrakul</p>
</body>
</html>
<?php
mysql_free_result($showmember);
?>
