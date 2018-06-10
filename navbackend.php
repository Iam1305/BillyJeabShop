<?php require_once('Connections/connectdb.php'); ?>
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
	
  $logoutGoTo = "index2.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
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

$colname_admin = "-1";
if (isset($_GET['MM_Username'])) {
  $colname_admin = $_GET['MM_Username'];
}
mysql_select_db($database_connectdb, $connectdb);
$query_admin = sprintf("SELECT * FROM tb_user WHERE u_username = %s", GetSQLValueString($colname_admin, "text"));
$admin = mysql_query($query_admin, $connectdb) or die(mysql_error());
$row_admin = mysql_fetch_assoc($admin);
$totalRows_admin = mysql_num_rows($admin);$colname_admin = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_admin = $_SESSION['MM_Username'];
}
mysql_select_db($database_connectdb, $connectdb);
$query_admin = sprintf("SELECT * FROM tb_user WHERE u_username = %s", GetSQLValueString($colname_admin, "text"));
$admin = mysql_query($query_admin, $connectdb) or die(mysql_error());
$row_admin = mysql_fetch_assoc($admin);
$totalRows_admin = mysql_num_rows($admin);
?>
<style type="text/css">
.navbar.navbar-inverse .container-fluid .nav.navbar-nav.navbar-right li {
	color: #CCC;
}
.navbar.navbar-default .container-fluid .nav.navbar-nav.navbar-right li {
	color: #C06;
}
.navbar.navbar-default .container-fluid .nav.navbar-nav.navbar-right li {
	color: #666;
}
</style>
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


    </style>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="backend.php"><i class="glyphicon glyphicon-bold"></i>illy Jeab Shop</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="backend.php"><i class="glyphicon glyphicon-home"></i> Home</a></li>
      <li><a href="usertable.php"><i class="glyphicon glyphicon-user"></i> ตารางสมาชิก</a></li>
      <li><a href="sho_product.php"><i class="glyphicon glyphicon-sound-7-1"></i> ตารางสินค้ารวม</a></li>
      <li><a href="show_wacth.php"><i class="glyphicon glyphicon-sound-6-1
"></i> ตารางสินค้ากระเป๋าใหญ่</a></li>
      <li><a href="show_bag.php"><i class="glyphicon glyphicon-sound-5-1"></i> ตารางสินค้ากระเป๋ากลาง</a></li>
      <li><a href="tableconfirm.php"><i class="glyphicon glyphicon-usd"></i> ตารางสินแจ้งชำระเงิน</a></li>
      <li><a href="add_product.php"><i class="glyphicon glyphicon-plus"></i> เพิ่มสินค้า</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right" style="margin-top:1%">
    สวัสดี คุณ <?php echo $row_admin['u_username']; ?> <a href="<?php echo $logoutAction ?>">Log out</a>
      
    </ul>
  </div>
</nav>
<?php
mysql_free_result($admin);
?> 