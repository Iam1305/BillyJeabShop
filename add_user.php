<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>สมัครสมาชิก</title>
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

    </style>
</head>

<body background="img/num2.jpg">
<?php include('include0.php');?>
<div class="container">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6"> <br />
      <h4 align="center"> Register</h4>
      <hr />
      <form action="add_user_db.php" method="POST" enctype="multipart/form-data"  name="addprd" class="form-horizontal" id="addprd">
    	<div class="form-group">
          <div class="col-sm-12">
            <p> Username</p>
            <input type="text"  name="u_username" class="form-control" required placeholder="Username" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <p> Password</p>
            <input type="num" name="u_password" class="form-control"    required placeholder="Password"/>
          </div>
        </div>
        
           <div class="form-group">
          <div class="col-sm-12">
            <p> Name</p>
            <input type="text" name="u_name" class="form-control"    required placeholder="Name"/>
          </div>
        </div>
        
        <div class="form-group">
          <div class="col-sm-12">
            <p>Address</p>
            <input type="text" name="u_address" class="form-control"    required placeholder="Address"/>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <p>Mail</p>
            <input type="text" name="u_mail" class="form-control"    required placeholder="mail"/>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <p> Tel.</p>
            <input type="num" name="u_tel" class="form-control"    required placeholder="Tel."/>
          </div>
        </div>
        
        
        
        
        <div class="form-group">
          <div class="col-md-12">
            <button type="submit" class="btn btn-primary" name="btnadd"> Register</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<p align="center"> Credit By Jakrit Pongkorntrakul</p>
</body>
</html>