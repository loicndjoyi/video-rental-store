<?php
require_once (realpath(dirname(__FILE__) . "/../ressources/config.php"));
require_once (LIBRARY_PATH . "/utilitaire.php");

// Retourne du contenu en format JSON.
header ( "Content-type: application/json; charset=utf-8" );

// Force l'expiration immédiate de la page au niveau du navigateur Web; elle n'est pas conservée en cache.
header ( "Expires: Thu, 19 Nov 1981 08:52:00 GMT" );
header ( "Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0" );
header ( "Pragma: no-cache" );


session_start();

// Variable des configurations
global $config;

// Nouvelle instant de la classe database.
$connexionDonnees = new database($config['db']['db1']['dbname'],
        $config['db']['db1']['dbHost'],
        $config['db']['db1']['dbUsername'],
        $config['db']['db1']['dbPassword']);

/* check if email is already registered */

//connect to db using mysqli

if (!empty($_POST['Nom']))
{
     $connexionDonnees->connect();
	// Champ à rechercher.
	$login = $_POST['Nom'];
	
	$resultat = $connexionDonnees->chercherUtilisateur($login);
	
	if(empty($resultat))
	{
	    echo "true";
	}
	else 
	{
	    echo "false";
	}
}
else{
    echo "false";
}

?>