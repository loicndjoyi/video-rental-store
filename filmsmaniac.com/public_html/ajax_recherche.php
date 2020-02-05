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

// Le vecteur de messages qui vont être retournés
$messagesErreurs = "";

// Est-ce que le paramètre "recherche" a été fourni ?
if (! isset ( $_GET ["search"] ))
	$messagesErreurs = "Erreur. Le paramètre \"recherche\" n'a pas été fourni avec la requête.";
else
{
    $connexionDonnees->connect();
	// Champ à rechercher.
	$rech = $_GET ["search"];
	
	$resultat = $connexionDonnees->LesUtilisateursViaAjax($rech);
	
	if(empty($resultat))
	{
	    throw new Exception("Not yet implemented!!!");
	}
	else 
	{
	    $lstUtilisateurs = "[\n";
	    while ( $info = $resultat->fetch () ) {
	        // Récupération des informations sur le membre.
	        $id = $info->Id;
	        $Nom = $info -> Nom;
	        $ddn = $info -> dateNaissance;
	        $Adresse = $info -> Adresse;
	        $NoTel= $info -> NoTelephone;
	        $Courriel= $info -> Courriel;
	        $acces = $info -> nom;
	        	
	        // Production de l'expression JSON à retourner.
	        $lstUtilisateurs .= "\t{\n";
	        $lstUtilisateurs .= "\t\t\"id\": \"$id\",\n";
	        $lstUtilisateurs .= "\t\t\"Nom\": \"$Nom\",\n";
	        $lstUtilisateurs .= "\t\t\"DateNaissance\": \"$ddn\",\n";
	        $lstUtilisateurs .= "\t\t\"Adresse\": \"$Adresse\",\n";
	        $lstUtilisateurs .= "\t\t\"NoTelephone\": \"$NoTel\",\n";
	        $lstUtilisateurs .= "\t\t\"Courriel\": \"$Courriel\",\n";
	        $lstUtilisateurs .= "\t\t\"categorie\": \"$acces\"\n";
	        $lstUtilisateurs .= "\t},\n";
	    }
	    $lstUtilisateurs .= "]";
	    
	    $posDerniereVirgule = strrpos ( $lstUtilisateurs, "," );
	    // on enlève la dernière virgule
	    $lstUtilisateurs = substr_replace ( $lstUtilisateurs, "", $posDerniereVirgule, 1 );
	    
	    echo $lstUtilisateurs;
	}

}

// S'il y erreur, on retourne un message d'erreur en format JSON.
if (!empty($messagesErreurs)) {
	echo "{\n";
	echo "\t\"erreur\":\n";
	echo "\t{\n";
	echo "\t\t\"message\": \"" . str_replace ( "\"", "\\\"", $messagesErreurs ) . "\"\n";
	echo "\t}\n";
	echo "}\n";
}
?>