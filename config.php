<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_connectdb = "localhost";
$database_connectdb = "hillspa";
$username_connectdb = "root";
$password_connectdb = "";
$connectdb = mysql_pconnect($hostname_connectdb, $username_connectdb, $password_connectdb) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_query("SET NAMES UTF8");
?>