<?php 

require 'config/mysql.php';


echo "<pre>";
echo "<h1>Test MySql é</h1>";
$db = connect_db(); 


$query = "select * from articles";
$res = $db->query($query);
$i=0;
while ($resultat = $res->fetch()) {
	
	print_r($resultat);
	
	
}
