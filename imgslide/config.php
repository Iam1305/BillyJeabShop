<?php
	$serverName = "localhost";
	$userName = "root";
	$userPassword = "";
	$dbName = "hillspa";

	$connectdb = mysqli_connect($serverName,$userName,$userPassword,$dbName)or die("เลือกฐานข้อมูลไม่ได้");
	mysqli_query($conn, "SET NAMES UTF8");

?>