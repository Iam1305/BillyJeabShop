<?php require_once('Connections/conproduct.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form_product")) {
  $insertSQL = sprintf("INSERT INTO product (product_id, product_name, product_price, product_amount) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['product_id'], "int"),
                       GetSQLValueString($_POST['product_name'], "text"),
                       GetSQLValueString($_POST['product_price'], "int"),
                       GetSQLValueString($_POST['product_amount'], "int"));

  mysql_select_db($database_conproduct, $conproduct);
  $Result1 = mysql_query($insertSQL, $conproduct) or die(mysql_error());

  $insertGoTo = "showproduct.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form_product" name="form_product" method="POST" action="<?php echo $editFormAction; ?>">
  <table width="700" border="0" align="center">
    <tr>
      <td colspan="2" align="center" bgcolor="#FFCC66">Add Product</td>
    </tr>
    <tr>
      <td width="197" align="right" bgcolor="#FFCC66">product_id:</td>
      <td width="493" bgcolor="#FFCC66"><label for="product_id2"></label>
      <input type="text" name="product_id" id="product_id2" required="required" /></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFCC66">product_name:</td>
      <td bgcolor="#FFCC66"><label for="product_name"></label>
      <input type="text" name="product_name" id="product_name" required="required" /></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFCC66">product_price:</td>
      <td bgcolor="#FFCC66"><label for="product_price"></label>
      <input type="text" name="product_price" id="product_price" required="required" /></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFCC66">product_amount:</td>
      <td bgcolor="#FFCC66"><label for="product_amount"></label>
      <input type="text" name="product_amount" id="product_amount" required="required" /></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFCC66">&nbsp;</td>
      <td bgcolor="#FFCC66"><input type="submit" name="Add" id="Add" value="Add" /></td>
    </tr>
  </table>
  
  <p>&nbsp;</p>
  <input type="hidden" name="MM_insert" value="form_product" />
</form>
</body>
</html>