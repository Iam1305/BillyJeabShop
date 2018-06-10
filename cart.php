



<?php
    error_reporting( error_reporting() & ~E_NOTICE );
    session_start(); 
    $p_id = $_REQUEST['p_id']; 
	$act = $_REQUEST['act'];

	if($act=='add' && !empty($p_id))
	{
		if(!isset($_SESSION['shopping_cart']))
		{
			 
			$_SESSION['shopping_cart']=array();
		}else{
		 
		}
		if(isset($_SESSION['shopping_cart'][$p_id]))
		{
			$_SESSION['shopping_cart'][$p_id]++;
		}
		else
		{
			$_SESSION['shopping_cart'][$p_id]=1;
		}
	}

	if($act=='remove' && !empty($p_id))  //ยกเลิกการสั่งซื้อ
	{
		unset($_SESSION['shopping_cart'][$p_id]);
	}

	if($act=='update')
	{
		$amount_array = $_POST['amount'];
		foreach($amount_array as $p_id=>$amount)
		{
			$_SESSION['shopping_cart'][$p_id]=$amount;
		}
	}
	//ยกเลิกตะกร้าสินค้า
	if($act=='Cancel-Cart'){
		unset($_SESSION['shopping_cart']);	
	}
	
	
	
	
	?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ตะกร้าสินค้า</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<link href="jm.css"/>
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
	<link rel="stylesheet" href="button.css">
	<link rel="stylesheet" href="./css/bossstyle.css">
	<link rel="stylesheet" href="./css/parallax1.css">
	<link rel="stylesheet" href="./css/parallax2.css">
	<link rel="stylesheet" href="C:\xampp\htdocs\Talad\css\css.css"> <!--Boy-->
	<link rel="icon" href="favicon.ico" type="image/x-icon"> 
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"> 
	<script type="text/javascript" src="./js/jquery.js"></script>
	<script type="text/javascript" src="./js/bootstrap.min.js"></script>
	<script src="jv.js"></script>
	<SCRIPT src="jquery-1.4.2.min.js" type="text/javascript"></SCRIPT>
	<script type="text/javascript" src="scrolltopcontrol.js"></script>
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

    </style>
</head>

<body background="img/num2.jpg">
<?php include('include1.6.php');?>
<?php include('slidenav.php');?>
<br>
<br>
<div class="container">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-7">
      <form id="frmcart" name="frmcart" method="post" action="?act=update">
        <table width="100%" border="0" align="center" >
        <tr>
          <td height="60" colspan="7" align="center" bgcolor="#CCCCCC"><strong><b>ตะกร้าสินค้า</span></strong></td>
        </tr>
        <tr>
          <td align="center" bgcolor="#EAEAEA"><strong>No.</strong></td>
          <td align="center" bgcolor="#EAEAEA"><strong>image</strong></td>
          <td align="center" bgcolor="#EAEAEA"><strong>สินค้า</strong></td>
          <td align="center" bgcolor="#EAEAEA"><strong>ราคา</strong></td>
          <td align="center" bgcolor="#EAEAEA"><strong>จำนวน</strong></td>
          <td align="center" bgcolor="#EAEAEA"><strong>รวม/รายการ</strong></td>
          <td align="center" bgcolor="#EAEAEA"><strong>ลบ</strong></td>
        </tr>
        <?php

if(!empty($_SESSION['shopping_cart']))
{
require_once('Connections/connectdb.php');
	foreach($_SESSION['shopping_cart'] as $p_id=>$p_qty)
	{
		$sql = "select * from tbl_product where p_id=$p_id";
		$query = mysql_db_query($database_connectdb, $sql);
		while($row = mysql_fetch_array($query))
		{
		 
		$sum = $row['p_price'] * $p_qty;
		$total += $sum;
		echo "<tr>";
		echo "<td>";
        echo $i += 1;
        echo ".";
		echo "</td>";
		echo "<td width='100'>"."<img src='img/$row[p_img]'  width='50'/>"."</td>";
		echo "<td width='334'>"." " . $row["p_name"] . "</td>";
		echo "<td width='100' align='right'>" . number_format($row["p_price"],2) . "</td>";
		
		echo "<td width='57' align='right'>";  
		echo "<input type='text' name='amount[$p_id]' value='$p_qty' size='2'/></td>";
		
		echo "<td width='100' align='right'>" .number_format($sum,2)."</td>";
		echo "<td width='100' align='center'><a href='cart.php?p_id=$p_id&act=remove' class='btn btn-danger btn-xs'>ลบ</a></td>";
		
		echo "</tr>";
		}
 
	}
	echo "<tr>";
  	echo "<td colspan='5' bgcolor='#CEE7FF' align='right'>Total</td>";
  	echo "<td align='right' bgcolor='#CEE7FF'>";
  	echo "<b>";
  	echo  number_format($total,2);
  	echo "</b>";
  	echo "</td>";
  	echo "<td align='left' bgcolor='#CEE7FF'></td>";
	echo "</tr>";


}
?>
        <tr>
          <td></td>
          <td colspan="5" align="right">
          <a href="cart.php?act=Cancel-Cart" class="btn btn-danger">ยกเลิกตะกร้าสินค้า</a>
          <button type="submit" name="button" id="button" class="btn btn-warning"> คำนวณราคาใหม่ </button>
            <button type="button" name="Submit2"  onclick="window.location='confirm.php';" class="btn btn-primary"> 
            <span class="glyphicon glyphicon-shopping-cart"> </span> สั่งซื้อ </button>
            </td>
        </tr>
      </form>
      <p align="center"> <a href="frontproduct.php" class="btn btn-primary">กลับไปเลือกสินค้า</a> </p>
    </div>
  </div>
</div>

</body>
</html>
