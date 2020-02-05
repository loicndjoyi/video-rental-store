<?php
require_once (realpath(dirname(__FILE__) . "/../ressources/config.php"));
require_once (LIBRARY_PATH . "/utilitaire.php");

header("Cache-Control: no-cache, no-store"); 
header("Pragma: no-cache"); 
header("Expires: 0");

session_start ();

// Variable des configurations
global $config;

// Le vecteur de messages qui vont être retournés
$messagesErreurs = array ();

// On vérifie si le formulaire vient d'être soumis.
// On vérifie que les champs du formulaire ont été rempli et envoyé.
if (isset ( $_POST ['btnConnexion'])) {
    
    //Stockage des valeurs des POST.
    $p_NomUtilisateur = $_POST ['nomUsager'];
    $p_tMotDePasse = passwordEncryption($_POST ['motPasse']);
    
    
	// Validation du nom d'utilisateur.
	if (empty ( trim ($p_NomUtilisateur) )) {
		array_push ( $messagesErreurs, "Erreur. Vous devez entrer un nom d'utilisateur pour vous connecter." );
	} else {
		// Validation du mot de passe.
		if (empty ( trim ( $p_tMotDePasse ) )) {
			array_push ( $messagesErreurs, "Erreur. Vous devez entrer un mot de passe pour vous connecter." );
		} else {
			// On vérife que la case de conservation de login a été cochée.
			if (isset ( $_POST ['checked_garderLogin'] )) {
				// Le cookie expirera dans 1 an.
				$temps_expiration_cookie = time () + 31556926;
				// On écrit le cookie.
				setcookie ( 'c_NomUsager', $_POST ['nomUsager'], $temps_expiration_cookie );
			}
			
			// Nouvelle instant de la classe database.
			$connexionDonnees = new database($config['db']['db1']['dbname'],
			        $config['db']['db1']['dbHost'], $config['db']['db1']['dbUsername'],
			        $config['db']['db1']['dbPassword']);
			
			//Connexion à la base de données
			$connexionDonnees->connect();
			
			// Récupération des informations usagers dans la base de données.
			$usager = $connexionDonnees->chercherUtilisateur($p_NomUtilisateur);
			
			if ($usager == null) {
			    array_push ( $messagesErreurs, "Erreur. Le nom d'utilisateur entré est incorrect." );
			}
			elseif ($usager->Mot_de_Passe != $p_tMotDePasse){
			    array_push ( $messagesErreurs, "Erreur. Le mot de passe est invalide." );
			}
			else{
			    $_SESSION['s_Usager'] = $usager;
			    // On redirige vers la page index.
			    header ( 'location: index.php' );
			    // On empêche l'exécution du reste de la page en cours.
			    exit ();
			}
		}
	}
}
else {
    throw new Exception('Not implemented Yet');
}
//Garde les messages d'erreur dans une session.
if (count ( $messagesErreurs ) != 0) {

   $_SESSION['message'] = $messagesErreurs;
   // On redirige vers la page index.
   header ( 'location: index.php' );
   // On empêche l'exécution du reste de la page en cours.
   exit ();
}
?>