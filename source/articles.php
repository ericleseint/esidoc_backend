<?php 

require 'config/mysql.php';


echo "<pre>";
echo "<h1>Articles</h1>";
$db = connect_db(); 


$query = "select * from articles";
$query .= " where id_article = 1";
$res = $db->query($query);
$i=0;
while ($resultat = $res->fetch()) {
	
	
	
	
	$tableauDetaille[$i]["id_article"]=$resultat[id_article];
	$tableauDetaille[$i]["titre"]=utf8_encode($resultat[titre]);
	$tableauDetaille[$i]["contenu"]=base64_encode($resultat[contenu]);
	$tableauDetaille[$i]["date_debut"]=$resultat[date_debut];
	$tableauDetaille[$i]["date_fin"]=$resultat[date_fin];
	$tableauDetaille[$i]["date_publication"]=$resultat[date_publication];
	$tableauDetaille[$i]["statut_publication"]=$resultat[statut_publication];
	$tableauDetaille[$i]["tag_admin"]=$resultat[tag_admin];
	$i++; 
	 
}

$tableau["articles"]["count"]=$i;
$tableau["articles"]["resultats"]=$tableauDetaille;


// POST //
unset($tableau);
$tableau["articles"]["id_article"]=3;

//DELETE //
unset($tableau);
$tableau["regroupements"]["groupe_article"][0]["id_groupe_article"]="14";
$tableau["associations"]["structures_contenus"][0]["type_structure"]="espaces";
$tableau["associations"]["structures_contenus"][0]["id_structure"]="24";

$json=json_encode($tableau);



echo "<textarea cols=100 rows=10>";


echo $json;

echo "</textarea>";
$test=json_decode($json,true);
print_r($test);