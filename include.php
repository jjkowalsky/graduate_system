<?php
//this is the php include file 
$dbhost ='localhost';
$dbuser='root';
$dbpass='password';
$dbname='mtsu_grad';
$dbhandle = mysql_connect($dbhost,$dbuser,$dbpass) or die ("Couldn't connect to SQL Server on $dbname");
mysql_select_db($dbname);
?>					

