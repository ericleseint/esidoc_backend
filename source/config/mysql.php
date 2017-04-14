<?php
function connect_db(){
	require "config_db.php";
	$connection = new PDO("mysql:dbname=$dbname;host=$dbhost",$user,$password);

	return $connection;

}