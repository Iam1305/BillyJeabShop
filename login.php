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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['u_username'])) {
  $loginUsername=$_POST['u_username'];
  $password=$_POST['u_password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "indextrue.php";
  $MM_redirectLoginFailed = "login.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_connectdb, $connectdb);
  
  $LoginRS__query=sprintf("SELECT u_username, u_password FROM tb_user WHERE u_username=%s AND u_password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $connectdb) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="login" name="login" method="POST" action="<?php echo $loginFormAction; ?>">
  <table width="700" border="0" align="center">
    <tr>
      <td height="45" colspan="2" align="center" bgcolor="#CC99CC">Login</td>
    </tr>
    <tr>
      <td width="262" align="right" bgcolor="#99CCFF">&nbsp;</td>
      <td width="428" bgcolor="#99CCFF">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#99CCFF">Username:</td>
      <td bgcolor="#99CCFF"><label for="u_username"></label>
      <input type="text" name="u_username" id="u_username" /></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#99CCFF">&nbsp;</td>
      <td bgcolor="#99CCFF">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#99CCFF">Password:</td>
      <td bgcolor="#99CCFF"><label for="u_password"></label>
      <input type="password" name="u_password" id="u_password" /></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#99CCFF">&nbsp;</td>
      <td bgcolor="#99CCFF">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#99CCFF">&nbsp;</td>
      <td bgcolor="#99CCFF"><input type="submit" name="Login" id="Login" value="Login" /></td>
    </tr>
  </table>
</form>
</body>
</html>