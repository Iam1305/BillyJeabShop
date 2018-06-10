<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<link href="jm.css"/>
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
	<link rel="stylesheet" href="button.css">
	<link rel="stylesheet" href="./css/bossstyle.css">
	<link rel="stylesheet" href="./css/parallax1.css">
	<link rel="stylesheet" href="./css/parallax2.css">
	<link rel="stylesheet" href="C:\xampp\htdocs\Talad\css\css.css"> <!--Boy-->
	<script type="text/javascript" src="./js/jquery.js"></script>
	<script type="text/javascript" src="./js/bootstrap.min.js"></script>
	<script src="jv.js"></script>
	<SCRIPT src="jquery-1.4.2.min.js" type="text/javascript"></SCRIPT>
	<script type="text/javascript" src="scrolltopcontrol.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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

$maxRows_showpdindex = 100;
$pageNum_showpdindex = 0;
if (isset($_GET['pageNum_showpdindex'])) {
  $pageNum_showpdindex = $_GET['pageNum_showpdindex'];
}
$startRow_showpdindex = $pageNum_showpdindex * $maxRows_showpdindex;

mysql_select_db($database_connectdb, $connectdb);
$query_showpdindex = "SELECT * FROM tbl_product WHERE p_name	 LIKE 'Mid%' ORDER BY p_id DESC";
$query_limit_showpdindex = sprintf("%s LIMIT %d, %d", $query_showpdindex, $startRow_showpdindex, $maxRows_showpdindex);
$showpdindex = mysql_query($query_limit_showpdindex, $connectdb) or die(mysql_error());
$row_showpdindex = mysql_fetch_assoc($showpdindex);

if (isset($_GET['totalRows_showpdindex'])) {
  $totalRows_showpdindex = $_GET['totalRows_showpdindex'];
} else {
  $all_showpdindex = mysql_query($query_showpdindex);
  $totalRows_showpdindex = mysql_num_rows($all_showpdindex);
}
$totalPages_showpdindex = ceil($totalRows_showpdindex/$maxRows_showpdindex)-1;

$colname_detail = "-1";
if (isset($_GET['p_id'])) {
  $colname_detail = $_GET['p_id'];
}
mysql_select_db($database_connectdb, $connectdb);
$query_detail = sprintf("SELECT * FROM tbl_product WHERE p_id = %s", GetSQLValueString($colname_detail, "int"));
$detail = mysql_query($query_detail, $connectdb) or die(mysql_error());
$row_detail = mysql_fetch_assoc($detail);
$totalRows_detail = mysql_num_rows($detail);
?>
<?php do { ?>
  <div class="col-md-4">
  <img src="img/<?php echo $row_showpdindex['p_img']; ?>" class="img-rounded img-responsive" width="380" style="padding-bottom:30px" > 
  <br>
  &nbsp;&nbsp;<?php echo $row_showpdindex['p_name']; ?>&nbsp;
  <font color="#0000FF"><br />
  ราคา <?php echo number_format($row_showpdindex['p_price'],2); ?>บาท
  </font>
  <p>
  <a href="product_detail2.php?p_id=<?php echo $row_showpdindex['p_id']; ?>" class="btn btn-info"> รายละเอียด</a>
 	 <?php echo "<a href='cart2.php?p_id=$row_showpdindex[p_id]&act=add'><span class='glyphicon glyphicon-shopping-cart'> </span> สั่งซื้อ </a>"; ?> 
  
  
  </p>
 
  <br/><br/><br/>
  </div>
  
  <?php } while ($row_showpdindex = mysql_fetch_assoc($showpdindex)); ?>
<?php
mysql_free_result($showpdindex);

mysql_free_result($detail);
?>
