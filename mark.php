<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
</head>

<body>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

<ol class="carousel-indicators">
  <?php  
    include('config.php');  
    $sql = "select * from gallery where NewsID ='0' ORDER BY GalleryID ASC";  
    $result = mysqli_query($conn,$sql);  
    $num = mysqli_num_rows($result);
    $n=0;  
    while($n<$num){
      if($n=="0"){
        echo "<li data-target='#carousel-example-generic' data-slide-to='$n' class='active'></li>&nbsp;";
      }else{
        echo "<li data-target='#carousel-example-generic' data-slide-to='$n'></li>&nbsp;";
      }
    $n++;
    }?>
</ol>



<div class="carousel-inner">
  <?php  
  include('config.php'); 
  $sql = "select * from gallery where NewsID ='0' ORDER BY GalleryID ASC";  
  $result = mysqli_query($connectdb,$sql);  
  $num = mysqli_num_rows($result);
  $i=0;  
  while($i<$num){  
  $row = mysqli_fetch_array($result);  
  $image = $row["GalleryShot"];
  $link =  $row["GalleryName"];  
  if($image != ""){
  if($i == "0"){
  ?>
  <div class="item active"><?php
  echo "<img class='slide-image' src='imgslide/myfile/$image' style='width:100%; height:300px;' id='img-resize'/>";
  echo "</div>";
  }else{?>
  <div class="item"><?php
  echo "<img class='slide-image' src='imgslide/myfile/$image' style='width:100%; height:300px;' id='img-resize'/>";
  echo "</div>";
  }
  }
  $i++;  
  }  

  ?>
</div>




  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>

</body>
</html>