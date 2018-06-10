<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conproduct = "localhost";
$database_conproduct = "product";
$username_conproduct = "root";
$password_conproduct = "";
$conproduct = mysql_pconnect($hostname_conproduct, $username_conproduct, $password_conproduct) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_query("SET NAMES UTF8");
?>