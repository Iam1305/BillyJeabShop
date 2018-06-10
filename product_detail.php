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

$colname_detail = "-1";
if (isset($_GET['p_id'])) {
  $colname_detail = $_GET['p_id'];
}
mysql_select_db($database_connectdb, $connectdb);
$query_detail = sprintf("SELECT * FROM tbl_product WHERE p_id = %s", GetSQLValueString($colname_detail, "int"));
$detail = mysql_query($query_detail, $connectdb) or die(mysql_error());
$row_detail = mysql_fetch_assoc($detail);
$totalRows_detail = mysql_num_rows($detail);

//update product view
$p_id = $row_detail['p_id'];
$p_view = $row_detail['p_view'];
$count = $p_view + 1;

$sql= "UPDATE tbl_product SET  p_view=$count WHERE p_id = $p_id";
	mysql_db_query($database_connectdb,$sql);
//





?>
<!DOCTYPE html>
<html>
<head>
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

	<title>รายละเอียดสินค้า</title>
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
	<script src="C:\xampp\htdocs\Talad\js\min.js"></script>
	<script src="C:\xampp\htdocs\Talad\js\jqary3.js"></script>

<?php include('include1.2.php');?>

	
	
 
 <div class="container">
 	<div class="row" align="center">
	  <h1 align="center">รายละเอียดสินค้า</h1>
 			<div class="col-md-4">
            <a href="img/<?php echo $row_detail['p_img']; ?>" rel="lightbox" title="กระเป๋า"><img src="img/<?php echo $row_detail['p_img']; ?>" width="400" class="img-thumbnail"> </a>
            </div>
            <div class="col-md-4">
            <a href="img/<?php echo $row_detail['p_img']; ?>" rel="lightbox" title="กระเป๋า"><img src="img/<?php echo $row_detail['p_img2']; ?>" width="400" class="img-thumbnail"> </a>
            </div>
            <div class="col-md-4">
            <a href="img/<?php echo $row_detail['p_img']; ?>" rel="lightbox" title="กระเป๋า"><img src="img/<?php echo $row_detail['p_img3']; ?>" width="400" class="img-thumbnail"> </a>
            </div>
	  <div class="col-md-12">
 			<h2>ชื่อสินค้า : <?php echo $row_detail['p_name']; ?></h2>
        	<h3>ราคา :<font color="#0000FF"><?php echo number_format( $row_detail['p_price'],2); ?></font>บาท
        <br><br>
        
        
       <?php echo "<a href='cart.php?p_id=$row_detail[p_id]&act=add'><span class='glyphicon glyphicon-shopping-cart'> </span> เพิ่มลงตะกร้าสินค้า </a>"; ?>
        
        
        <br>
        	</h3><br>
           <h2> รายละเอียด :<?php echo $row_detail['p_detail']; ?></p>
 			<p><span class="glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;
			<span class="badge"><?php echo $row_detail['p_view']; ?></span>&nbsp;ครั้ง<br>
	    </p></h2>
        
        <!-- Go to www.addthis.com/dashboard to customize your tools --> <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-59882ee1f1039a9f"></script> 
        <!-- Go to www.addthis.com/dashboard to customize your tools --> <div class="addthis_inline_share_toolbox"></div>
        
        
        
        
 			</div>
 	</div>
 </div>
  
  <div id="mySidenav">
			<a href="https://www.facebook.com/profile.php?id=100003672767712&pnref=lhc.friends" id="about"><img src="./img/jj.png" class="img-rounded img-responsive" ></a>  
			<a href="addressline.php" id="history"><img src="./img/line0.jpg" class="img-rounded img-responsive" ></a>
			<a href="addresstweet.php" id="blog"><img src="./img/0003.jpg" class="img-rounded img-responsive" ></a>
			
		</div>
  
  
  
  
  
  
  
  
  
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  <div class="footer">

  <div align="center"><font size="4">Credit By Jakrit Pongkorntrakul </font></div>

</div>
  

  
  
  
  </body>
<script>    
      function countDown(){
        seconds--
        $("#seconds").text(seconds);
        if (seconds === 0){
          openColorBox();
          clearInterval(i);
        }
      } 
      var seconds = 1,
          i = setInterval(countDown, 1000);
		  function openColorBox(){
        $.colorbox({iframe:true, width:"1400px", height:"800px", href: "WELLCOME2.jpg"});
      }
    </script>
  
  </html>
<?php
mysql_free_result($detail);
?>
