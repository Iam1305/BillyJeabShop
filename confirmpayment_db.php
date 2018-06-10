<meta charset="UTF-8" />
<?php 
require_once('Connections/connectdb.php');

    //Set ว/ด/ป เวลา ให้เป็นของประเทศไทย
    date_default_timezone_set('Asia/Bangkok');
	//สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลด
	$date1 = date("Ymd_His");
	//สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
	$numrand = (mt_rand());
	
	//รับชื่อไฟล์จากฟอร์ม 
	$c_id = $_POST['c_id'];
	
	$c_name = $_POST['c_name'];
	$c_mail = $_POST['c_mail'];
	$c_tel = $_POST['c_tel'];
	$c_price = $_POST['c_price'];
	$c_img = (isset($_POST['c_img']) ? $_POST['c_img'] : '');
		
	$upload=$_FILES['c_img'];
	if($upload <> '') { 

	//โฟลเดอร์ที่เก็บไฟล์
	$path="img/";
	//ตัวขื่อกับนามสกุลภาพออกจากกัน
	$type = strrchr($_FILES['c_img']['name'],".");
	//ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
	$newname =$numrand.$date1.$type;

	$path_copy=$path.$newname;
	$path_link="img/".$newname;
	//คัดลอกไฟล์ไปยังโฟลเดอร์
	move_uploaded_file($_FILES['c_img']['tmp_name'],$path_copy);  
		
	
	}


			 $sql = "INSERT INTO confirm 
					(c_id,c_name, 
					c_mail,c_tel,
					c_price, 
					c_img) 
					VALUES
					('$c_id',
					'$c_name',
					'$c_mail',$c_tel,
					'$c_price',
					'$newname')";
		
		$result = mysql_db_query($database_connectdb, $sql) or die ("Error in query: $sql " . mysql_error());

	mysql_close();



	if($result){
   
			echo "<script type='text/javascript'>";
			echo  "alert('เพิ่มข้อมูลเรียบร้อย');";
			echo "window.location='confirmpayment.php';";
			echo "</script>";
	  }
	  else{
		    echo "<script type='text/javascript'>";
				echo "window.location='confirmpayment.php';";
			echo "</script>";
	  }
	
	
 ?>