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
    </style>

	<title>หน้าสินค้า</title>
</head>
<body background="img/num2.jpg">
	<script src="C:\xampp\htdocs\Talad\js\min.js"></script>
	<script src="C:\xampp\htdocs\Talad\js\jqary3.js"></script>

<?php include('include1.2.php');?><br><br>

	<div class="row" align="center">
            
             <div class="col-md-2">
    					 <?php include('button group.php');?>
						</div>

<div class="container">
    <div class="row" align="center">
    	<div class="col-md-12">
    		<div class="panel panel-success">
     			<div class="panel-heading"><h3>กระเป๋าใหญ่</h3></div>
    				<div class="panel-body"><?php include('product_watch.php');?>
    				</div>
    			</div>
    		</div>
		</div>
    </div>
</div>
		
	
<!--<div class="container">
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
                </div>-->
 
 
 <div id="mySidenav">
			<a href="https://www.facebook.com/profile.php?id=100003672767712&pnref=lhc.friends" id="about"><img src="./img/jj.png" class="img-rounded img-responsive" ></a>  
			<a href="addressline.php" id="history"><img src="./img/line0.jpg" class="img-rounded img-responsive" ></a>
			<a href="addresstweet.php" id="blog"><img src="./img/0003.jpg" class="img-rounded img-responsive" ></a>
			
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
		
	
