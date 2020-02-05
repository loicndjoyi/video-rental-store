<?php
require_once (realpath(dirname(__FILE__) . "/../ressources/config.php"));
require_once (LIBRARY_PATH . "/utilitaire.php");

header("Cache-Control: no-cache, no-store"); 
header("Pragma: no-cache"); 
header("Expires: 0");

session_start();

// Variable des configurations
global $config;

// Le vecteur de messages qui vont être retournés
$messagesErreurs = array();

if (isset($_POST['btnSuppression'])) {
    
    // Nouvelle instant de la classe database.
    $connexionDonnees = new database($config['db']['db1']['dbname'],
            $config['db']['db1']['dbHost'],
            $config['db']['db1']['dbUsername'],
            $config['db']['db1']['dbPassword']);
    
    
    // Connexion à la base de données
        $connexionDonnees->connect();
        
        $filmSupp = new film();
        $filmSupp->Id = $_POST['Key'];
        
        //Supprime l'utilisateur de la base de données
        $retour = $connexionDonnees->supprimerFilm($filmSupp);
        
        array_push($messagesErreurs, $retour);
        
        $_SESSION['message'] = $messagesErreurs;
        
        // On redirige vers la même page pour afficher l'erreur.
        header('location: index.php?page=1');
        // On empêche l'exécution du reste de la page en cours.
        exit();
}