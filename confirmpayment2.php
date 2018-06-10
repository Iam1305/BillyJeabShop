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
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="styles.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ฟอร์มแจ้งชำระเงิน</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
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
</head>

<body background="img/num2.jpg"> 
<?php include('include2.4.php');?>
<?php include('slidenav2.php');?>
<div class="container">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6"> <br />
    <div class="panel panel-info">
      		<div class="panel-heading" align="center"><h3>แจ้งชำระเงิน</h3></div>
      						<div class="panel-body">
      
      <hr />
      <form action="confirmpayment_db.php" method="POST" enctype="multipart/form-data"  name="addprd" class="form-horizontal" id="addprd">
        
        <div class="form-group">
          <div class="col-sm-12">
            <p>เลขที่ใบสั่งซื้อ</p>
            <input type="text"  name="c_id" class="form-control" required placeholder="เลขที่ใบสั่งซื้อ" />
          </div>
        </div>
        
        
        <div class="form-group">
          <div class="col-sm-12">
            <p> ชื่อ-นามสกุล</p>
            <input type="text"  name="c_name" class="form-control" required placeholder="ชื่อ-นามสกุล" />
          </div>
        </div>
       
       <div class="form-group">
          <div class="col-sm-12">
            <p> อีเมลล์</p>
            <input type="text"  name="c_mail" class="form-control" required placeholder="อีเมลล์" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <p> เบอร์โทรศัพท์</p>
            <input type="number"  name="c_tel" class="form-control" required placeholder="เบอร์โทรศัพท์" />
          </div>
        </div>
       
       
        <div class="form-group">
          <div class="col-sm-4">
            <p> จำนวนเงินที่โอน (บาท) </p>
            <input type="number"  name="c_price" class="form-control" required placeholder="จำนวนเงินที่โอน" />
          </div>
          <div class="col-sm-8 info">
            <p> ภาพใบเสร็จ</p>
            <input type="file" name="c_img" class="form-control" />
          </div>
        </div>
    </select>
            </label>
          </div>
      </div>
        
       
        <div class="form-group" align="center">
          <div class="col-sm-12">
            <button type="submit" class="btn btn-primary" name="btnadd"> ยืนยัน</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<br><br>
<p align="center"><font color="#FF0000">*หมายเหตุ ลูกค้ากรุณาโอนเงินหรือยืนยันการสั่งซื้อก่อน 14.00น เพราะทางร้านจะส่งสินค้าก่อนเวลา 15.00น ของวันที่ลูกค้าสั่งซื้อสินค้า ทางร้านจะส่งเมลยืนยันตามที่ลูกค้าได้ให้ข้อมูลไว้ ขอบคุณครับ</font></p>
<br>
<p align="center"><font color="#FF0000">*หากลูกค้ามีข้อสงสัยหรือติดปัญหากรุณาติดต่อ<a href="contract2.php">ที่นี่</a></font></p>
<br><br><br><br><br><br>
<p align="center"> Credit By Jakrit Pongkorntrakul</p>
</body>
</html>
