<?php
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'aerocontrol';
    $link=mysql_connect($hostname,$username,$password);
	if($link){
		mysql_select_db($database,$link);	
	}	 
    $mysqli = new mysqli($hostname, $username, $password, $database);
?>
