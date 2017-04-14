<?php 

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'config/mysql.php';//Connexion base de données 

$app = new \Slim\App(['settings' => ['displayErrorDetails' => true]]);
$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});

$app->get('/cyber/{id}', function (Request $request, Response $response) {

	
	
    $id = $request->getAttribute('id');
    $db = connect_db(); // connexion à la BDD GLPi 

    $query = "select name from glpi_users where id='".$id."'";
    $res = $db->query($query);

    while ($rne = $res->fetch()) {
    	$url = 'https://cyberlib.crdp-poitiers.org/Backoffice/Clients/?RNE='.$rne["name"];
    	
    }
    
    return $response->withStatus(302)->withHeader('Location',$url);

});

$app->post('/client/{codeRNE}', function (Request $request, Response $response) {

// Connexion à la BDD 
   $db = connect_db();

//Initialisation des variables 
   $password = password_hash($request->getParam('password'),PASSWORD_BCRYPT);
   $name = $request->getParam('nomEtab');
   $academie = $request->getParam('academie');
   $mail = $request->getParam('mail');

   $rne = $request->getAttribute('codeRNE');

 // Vérification de l'unicité du RNE dans la table users   
   $queryExiste = "SELECT count(*) as nb  FROM `glpi_users` WHERE `name`='".$rne."'";
   
   

   $count = $db->query($queryExiste)->fetchAll();
   if($count[0]['nb'] != 0)
   {
      $queryRecuperationId = "select id from glpi_users where name='".$rne."'";
      //echo $queryRecuperationId;
      //exit();
      $db->exec("SET CHARACTER SET utf8");
      $user = $db->query($queryRecuperationId);
      while($resIdUser = $user->fetch())
      {
        $id = $resIdUser["id"];
      }
      //echo $id;

      $queryUpdateUser = 'Update glpi_users set password="'.$password.'",realname="'.$name.'" where id="'.$id.'"';
      $db->exec($queryUpdateUser);

      $queryUpdateMail = 'Update glpi_useremails set email = "'.$mail.'"  where users_id="'.$id.'"';
      $db->exec($queryUpdateMail);

      return $response->getBody()->write("Le RNE ".$rne." a été modifié");
   }
   else
   {
      $queryRecupAcademie = "SELECT id from glpi_locations where name='".$academie."'";//Récupération de l'id de l'académie 
      $db->exec("SET CHARACTER SET utf8");

      $acad = $db->query($queryRecupAcademie);
      while($resId = $acad->fetch())
      {
        $idAcademie = $resId["id"];
      }


      $queryInsertUser = 'INSERT INTO `glpi_users`(`name`,`password`,`realname`,`locations_id`) VALUES ("'.$rne.'","'.$password.'","'.$name.'","'.$idAcademie.'")';
      $db->exec($queryInsertUser);
      $idUser = $db->lastInsertId();

      

      $queryInsertProfiles = "INSERT INTO `glpi_profiles_users`(`users_id`, `profiles_id`) VALUES ('".$idUser."','8')";
      $db->exec($queryInsertProfiles);

      $queryInsertMail = "INSERT INTO `glpi_useremails`(`users_id`, `is_default`,`email`) VALUES ('".$idUser."','1','".$mail."')";
      $db->exec($queryInsertMail);

      return $response->getBody()->write("Le RNE ".$rne." a bien été ajouté");

   }


});

$app->run();

 