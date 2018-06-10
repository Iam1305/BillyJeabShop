<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_connectdb = "localhost";
$database_connectdb = "cooldesi_hillspa";
$username_connectdb = "cooldesi_hillspa";
$password_connectdb = "jakrit000333";
$connectdb = mysql_connect($hostname_connectdb, $username_connectdb, $password_connectdb) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_query("SET NAMES UTF8");
?>