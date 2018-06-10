<?php require_once('Connections/connectdb.php'); ?>
<?php require_once('Connections/connectdb.php'); ?>
<?php
	error_reporting( error_reporting() & ~E_NOTICE );
    session_start();   
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>กรอกรายละเอียด</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
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

<style type="text/css">@media print{ #hid{display:none;}}
</style>
</head>
<body background="img/num2.jpg">
<?php include('include0.0.php');?>

<div class="container">
	<div class="row">
    	<div class="col-md-2"></div>
        <div class="col-md-8">

 <br><br><br>
  
  
  <button class="btn btn-info" onclick="window.print() ">พิมพ์ใบเสร็จ</button>
  <table width="700" border="1" align="center" class="table">
    <tr>
      <td width="1558" colspan="5" align="center">
      <strong>Billy Jeab Shop</strong><br>
       <strong>ใบเสร็จ</strong><br>
       <strong>ที่อยู่ร้าน : 89 ซอยวัดสวนพลู แขวง บางรัก เขต บางรัก กรุงเทพมหานคร 10500<br>
โทรศัพท์ : 084-452-5005 (คุณเจี๊ยบ)</strong><br>
      <strong>สั่งซื้อสินค้า</strong><br> <strong>เลขที่การสั่งซื้อ 38</strong>
      
      
      </td>
    </tr>
    <tr class="success">
    <td align="center">ลำดับ</td>
      <td align="center">สินค้า</td>
      <td align="center">ราคา</td>
      <td align="center">จำนวน</td>
      <td align="center">รวม/รายการ</td>
    </tr>
<?php
	require_once('Connections/connectdb.php');
	$total=0;
	foreach($_SESSION['shopping_cart'] as $p_id=>$p_qty)
	{
		$sql = "select * from tbl_product where p_id=$p_id";
		$query = mysql_db_query($database_connectdb, $sql);
		$row	= mysql_fetch_array($query);
		$sum	= $row['p_price']*$p_qty;
		$total	+= $sum;
    echo "<tr>";
	echo "<td align='center'>";
	echo  $i += 1;
	echo "</td>";
    echo "<td>" . $row["p_name"] . "</td>";
    echo "<td align='right'>" .number_format($row['p_price'],2) ."</td>";
    echo "<td align='right'>$p_qty</td>";
    echo "<td align='right'>".number_format($sum,2)."</td>";
    echo "</tr>";
	}
	echo "<tr>";
    echo "<td  align='right' colspan='4'><b>รวม</b></td>";
    echo "<td align='right'>"."<b>".number_format($total,2)."</b>"."</td>";
    echo "</tr>";
	
?>
</table>
		</div>
	</div>
</div>


<!--div class="container" id="hid">
  <div class="row">
  <div class="col-md-4"></div>
    <div class="col-md-5" style="background-color:#f4f4f4">
      <h3 align="center" style="color:green">
      <span class="glyphicon glyphicon-shopping-cart"> </span>
         confirm cart </h3>
      <form  name="formlogin" action="saveorder.php" method="POST" id="login" class="form-horizontal">
        <div class="form-group">
          <div class="col-sm-12">
            <input type="text"  name="name" class="form-control" required placeholder="ชื่อ-สกุล" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <textarea name="address" class="form-control"  rows="3"  required placeholder="ที่อยู่ในการส่งสินค้า"></textarea> 
          </div>
 
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <input type="text"  name="phone" class="form-control" required placeholder="เบอร์โทรศัพท์" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <input type="email"  name="email" class="form-control" required placeholder="อีเมล์" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12" align="center">
            <button type="submit" class="btn btn-primary" id="btn">
             ยืนยันสั่งซื้อ</button>
          </div>
        </div>
      </form>
      <p align="center"><a href="cart.php">กลับหน้าตะกร้าสินค้า</a> &nbsp;  </p>
    </div>
  </div>
</div-->
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

$colname_Recordset1 = "-1";
if (isset($_GET['d_id'])) {
  $colname_Recordset1 = $_GET['d_id'];
}
mysql_select_db($database_connectdb, $connectdb);
$query_Recordset1 = sprintf("SELECT * FROM tb_order_detail WHERE d_id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $connectdb) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>

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

<body>
 
 
<div class="container" id="hid">
	<div class="row">
		
        
      <div col-md-12></div>
      
    <div class="col-md-12" style="background-color:#f4f4f4">
      <h3 align="center" style="color:green">
      <span class="glyphicon glyphicon-shopping-cart"> </span>
         confirm cart </h3>
      <form  name="formlogin" action="saveorder2.php" method="POST" id="login" class="form-horizontal">
<h1 align="center"></h1>
<p align="center">&nbsp;</p>
<table width="100%" border="0" align="center" cellpadding="0" id="example" class="display">
  
  <!--ส่วนหัว-->
   <thead>
  <tr>
    <th align="center">รหัสลูกค้า</th>
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
      <td align="center"><?php echo $row_showmember['u_name']; ?></td>
      <td align="center"><?php echo $row_showmember['u_address']; ?></td>
      <td align="center"><?php echo $row_showmember['u_mail']; ?></td>
      <td align="center"><?php echo $row_showmember['u_tel']; ?></td>
      <td align="center"><a href="editmyself2.php?u_id=<?php echo $row_showmember['u_id']; ?>">แก้ไข</a></td>
      
    </tr>
    <?php } while ($row_showproduct = mysql_fetch_assoc($showproduct)); ?>
</table>
<div class="form-group">
          <div class="col-sm-12" align="center">
            <button type="submit" class="btn btn-primary" id="btn" >
             ยืนยันสั่งซื้อ</button>
    </div>
        </div>
        <p align="center"><a href="cart2.php">กลับหน้าตะกร้าสินค้า</a> &nbsp;  </p>
      </form>
    </div>
  </div>
</div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<p align="center"> Credit By Jakrit Pongkorntrakul</p>
</body>
</html>

<?php
mysql_free_result($showmember);

mysql_free_result($Recordset1);
?>
