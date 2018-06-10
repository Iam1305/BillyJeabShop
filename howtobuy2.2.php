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
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="styles.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>
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
   
	<title>วิธีซื้อสินค้า</title>
</head>
<body background="img/num2.jpg">
	

<?php include('include2.3.php');?>
<br><br>
<div class="row" align="center">
            <div class="col-md-2">
    					 <?php include('howtogroup2.php');?>
			</div>
<div class ="container">
			<div class="row" align="center">
				<div class="col-md-12">
                	<div class="panel panel-info">
      					<div class="panel-heading"><font size="+2">วิธีการสั่งซื้อแบบล๊อคอิน</font></div>
      						<div class="panel-body">

                <a href="img/0000.jpg" rel="lightbox" title="กระเป๋า"><p><img src="./img/0000.jpg" class="img-rounded img-responsive" width ="700" height="600" style="width:100%;border-style: solid;border-color: black;border-width: 2px;"></p></a>
                <br><br><br>
              <p><font size="5">1.ให้คุณล๊อคอินเข้าสู่ระบบด้วยการกรอก usernameและpassword หากยังไม่มีกรุณาสมัครสมาชิกโดยการกดปุุ่มREGISTERด้านข้างปุ่มLOGIN เมื่อท่านล๊อคอินสำเร็จแล้วก็คลิกเลิกหน้าสินค้าและรับชมสินค้า</font></p>
                
                <br><br><br>
                
                <a href="img/0100.jpg" rel="lightbox" title="กระเป๋า"><p><img src="./img/0100.jpg" class="img-rounded img-responsive" width ="700" height="600" style="width:100%;border-style: solid;border-color: black;border-width: 2px;"></p></a>
                <br><br><br>
              <p><font size="5">2.ให้คุณรับชมสินค้าที่สนใจและคลิกที่ปุ่ม (รายละเอียด)หรือ(สั่งซื้อ) ใต้รูปสินค้าที่คุณตัองการซื้อ</font></p>
                <br><br><br>
                <a href="img/2222.jpg" rel="lightbox" title="กระเป๋า"><p><img src="./img/2222.jpg" class="img-rounded img-responsive" width ="700" height="600" style="width:100%;border-style: solid;border-color: black;border-width: 2px;"></p></a>
              <br><br><br>
              <p><font size="5">3.เมื่อคุณคลิกที่ปุ่ม (รายละเอียด)หรือ(สั่งซื้อ) ใต้รูปสินค้าที่คุณตัองการซื้อแล้วก็จะเข้าสู่หน้ารายละเอียดสินค้า ในหน้านี้จะมีรูปสินค้า,ชื่อสินค้า,ราคาสินค้า,รายละเอียดสินค้า และมีปุ่มแชร์โซเชียลต่างๆเมื่อคุณชอบสินค้าชิ้นนี้ก็ทำการกดที่ปุ่ม<br>(เพิ่มลงตะกร้าสินค้า) ได้เลย</font></p>
                <br><br><br>
                <a href="img/2222222.jpg" rel="lightbox" title="กระเป๋า"><p><img src="./img/2222222.jpg" class="img-rounded img-responsive" width ="700" height="600" style="width:100%;border-style: solid;border-color: black;border-width: 2px;"></p></a>
                
                <br><br><br>
                <p><font size="5">4.เมื่อคุณทำการเพิ่มสินค้าลงตะกร้าแล้ว ก็จะเข้าสู่หน้าตะกร้าสินค้าในหน้านี้จะทำการบอกรายละเอียดสินค้าที่คุณสั่งประกอบด้วย ชื่อสินค้า,รูปสินค้า,ราคา,จำนวนสินค้า(สามารถเพิ่มลดได้)และมีปุ่มลบในแต่ละรายการ ด้านล่างมีปุ่มยกเลิกสินค้าทั้งหมด,ปุ่มคำนวนราคาใหม่(ในกรณีเพิ่มลดจำนวนสินค้า) เมื่อคุณตรวจทานเรียบร้อยเเล้วก็กดปุ่มสั่งซื้อได้เลย</font></p>
		
        		<br><br><br>
                <a href="img/3.jpg" rel="lightbox" title="กระเป๋า"><p><img src="./img/3.jpg" class="img-rounded img-responsive" width ="700" height="600" style="width:100%;border-style: solid;border-color: black;border-width: 2px;"></p></a>
                <br><br><br>
                <p><font size="5">5.เมื่อกดสั่งซื้อแล้วจะเข้าสู่หน้ากรอกรายละเอียดจัดส่ง จะมีปุ่มปริ้นใบเสร็จสามารถกดเพื่อปริ้นใบเสร็จได้ ด้านล่างคุณต้องกรอกรายละเอียดต่างๆ เมื่อกรอกเสร็จแล้วก็ยืนยันได้เลย</font></p><br><br>
                <br><br><br>
                <a href="img/44444.jpg" rel="lightbox" title="กระเป๋า"><p><img src="./img/44444.jpg" class="img-rounded img-responsive" width ="700" height="600" style="width:100%;border-style: solid;border-color: black;border-width: 2px;"></p></a><br><br>
                <br><br><br>
                <p><font size="5">6.เสร็จสิ้นขั้นตอนการสั่งซื้อแบบล๊อคอินเรียบร้อย</font></p>
        
        </div>
        
        </div></div></div>
  
			
 <br><br><br><br>
 
 <div id="mySidenav">
			<a href="https://www.facebook.com/profile.php?id=100003672767712&pnref=lhc.friends" id="about"><img src="./img/jj.png" class="img-rounded img-responsive" ></a>  
			<a href="addressline2.php" id="history"><img src="./img/line0.jpg" class="img-rounded img-responsive" ></a>
			<a href="addresstweet2.php" id="blog"><img src="./img/0003.jpg" class="img-rounded img-responsive" ></a>
			
		</div>
  
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
		
	
