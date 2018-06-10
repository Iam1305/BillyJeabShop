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
	$u_id = $_POST['u_id'];
	$u_username = $_POST['u_username'];
	$u_password = $_POST['u_password'];
	$u_name = $_POST['u_name'];
	$u_address = $_POST['u_address'];
	$u_mail = $_POST['u_mail'];
	$u_tel = $_POST['u_tel'];
	
		
	
	


			 $sql = "INSERT INTO tb_user
					(u_id,u_username, 
					u_password,u_name,u_address,u_mail,u_tel) 
					VALUES
					('$u_id',
					'$u_username',
					'$u_password','$u_name','$u_address','$u_mail',
					'$u_tel')";
		
		$result = mysql_db_query($database_connectdb, $sql) or die ("Error in query: $sql " . mysql_error());

	mysql_close();



	if($result){
   
			echo "<script type='text/javascript'>";
			echo  "alert('เพิ่มข้อมูลเรียบร้อย');";
			echo "window.location='add_user.php';";
			echo "</script>";
	  }
	  else{
		    echo "<script type='text/javascript'>";
				echo "window.location='add_user.php';";
			echo "</script>";
	  }
	
	
 ?>