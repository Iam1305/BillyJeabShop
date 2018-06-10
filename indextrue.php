	<link href="css/bootstrap.min.css" rel="stylesheet">
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
	
  $logoutGoTo = "login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
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

$MM_restrictGoTo = "login.php";
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_showmember = 1;
$pageNum_showmember = 0;
if (isset($_GET['pageNum_showmember'])) {
  $pageNum_showmember = $_GET['pageNum_showmember'];
}
$startRow_showmember = $pageNum_showmember * $maxRows_showmember;

$colname_showmember = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_showmember = $_SESSION['MM_Username'];
}
mysql_select_db($database_connectdb, $connectdb);
$query_showmember = sprintf("SELECT * FROM tb_user WHERE u_username = %s", GetSQLValueString($colname_showmember, "text"));
$query_limit_showmember = sprintf("%s LIMIT %d, %d", $query_showmember, $startRow_showmember, $maxRows_showmember);
$showmember = mysql_query($query_limit_showmember, $connectdb) or die(mysql_error());
$row_showmember = mysql_fetch_assoc($showmember);

if (isset($_GET['totalRows_showmember'])) {
  $totalRows_showmember = $_GET['totalRows_showmember'];
} else {
  $all_showmember = mysql_query($query_showmember);
  $totalRows_showmember = mysql_num_rows($all_showmember);
}
$totalPages_showmember = ceil($totalRows_showmember/$maxRows_showmember)-1;

$queryString_showmember = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_showmember") == false && 
        stristr($param, "totalRows_showmember") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_showmember = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_showmember = sprintf("&totalRows_showmember=%d%s", $totalRows_showmember, $queryString_showmember);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
	<nav class="navbar navbar-inverse navbar-static-top"> <!--default,inverse--> <!--navbar-fixed-top-->
		<div class="container">
			<div class="navbar-header">
				<button class="navbar-toggle collapsed"
					data-toggle="collapse"
					data-target="#id_nav1"
				>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"></a>
			</div>
		
			<div class="collapse navbar-collapse" id="id_nav1">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="index.html"> <font size="5"><i class="glyphicon glyphicon-home"></i> หน้าแรก </font></a>
					</li>
								
					<li><a href="History2.html"> <font size="5"><i class="glyphicon glyphicon-list-alt"></i>ประวัติ </font></a>
					</li>
				
					<li><a href="product.html"> <font size="5"><i class="glyphicon glyphicon-apple"></i> สินค้า </font></a>
					</li>
				
					<li><a href="picture.html"> <font size="5"><i class="glyphicon glyphicon-picture"></i>  รวมภาพ</font></a>
					</li>
					<li><a href="travel.html"> <font size="5"><i class="glyphicon glyphicon-map-marker"></i> การเดินทาง </font></a>
					</li>
					<li><a href="sraff.html"> <font size="5"><i class="glyphicon glyphicon-user"></i> ผู้จัดทำ </font></a>
					</li>
				</ul>		
			</div>
		</div>
	</nav>
<form id="form1" name="form1" method="post" action="">
<label for="ยินดีต้อนรับสู้ร้าน Hill Spa"></label>
<table width="700" border="0" align="center">
  <tr>
    <td height="157" align="center"><h1>ยินดีต้อนรับสู่ร้าน Hill Spa </h1></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;&nbsp;	&nbsp;</p>
<table width="700" border="0" align="center">
  <tr>
    <td align="center"><h1>ยินดีต้อนรับคุณ <?php echo $row_showmember['u_name']; ?></h1>
      <p><a href="<?php echo $logoutAction ?>">Logout</a></p></td>
  </tr>
</table>
<div class="container">
<div class="row">
            <div class="col-md-3">
                <div>
                    <li class="list-group-item">แบรนด์กระเป๋า</li>
                    
                    
                    <ul class="list-group">

                        <li class="list-group-item">Lui
      
                        </li>
                        <li class="list-group-item">Hermas
                      
                        </li>
                        <li class="list-group-item">guchi
                         
                        </li>
                        <li class="list-group-item">prada
                            
                        </li>
                        <li class="list-group-item">Herchel
                            
                        </li>
                    </ul>
                </div>
                </div>
<p>&nbsp;
</p>
<p>&nbsp;</p>
<blockquote>
  <blockquote>
    <blockquote>
      <p>
        &nbsp;
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;	
        &nbsp;</p>
    </blockquote>
  </blockquote>
</blockquote>
</form>
</body>
</html>
<?php
mysql_free_result($showmember);
?>
