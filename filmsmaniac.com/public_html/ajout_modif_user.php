<?php
require_once (realpath(dirname(__FILE__) . "/../ressources/config.php"));
require_once (LIBRARY_PATH . "/utilitaire.php");

header("Cache-Control: no-cache, no-store");
header("Pragma: no-cache");
header("Expires: 0");

session_start();

// Variable des configurations
global $config;

// Nouvelle instant de la classe database.
$connexionDonnees = new database($config['db']['db1']['dbname'],
        $config['db']['db1']['dbHost'],
        $config['db']['db1']['dbUsername'],
        $config['db']['db1']['dbPassword']);

// Le vecteur de messages qui vont être retournés
$messagesErreurs = array();

if (isset($_POST['btnSuppression'])) {
    
    // Connexion à la base de données
        $connexionDonnees->connect();
        
        $userSupp = new user();
        $userSupp->Id = $_POST['Key'];
        
        //Supprime l'utilisateur de la base de données
        $retour = $connexionDonnees->supprimerUtilisateur($userSupp);
        
        array_push($messagesErreurs, $retour);
        
        $_SESSION['message'] = $messagesErreurs;
        
        // On redirige vers la même page pour afficher l'erreur.
        header('location: index.php?page=2');
        // On empêche l'exécution du reste de la page en cours.
        exit();
}
//Le bouton de modification des usagers.
if (isset($_POST['btnModifier'])) {
     // Connexion à la base de données
        $connexionDonnees->connect();
        
        $_SESSION['gestionUser']= $connexionDonnees->chercherUtilisateurAvecId($_POST['Key']);
        
        header('location: index.php?page=3');
        // On empêche l'exécution du reste de la page en cours.
        exit();
}

if (isset($_POST['btnSoumettre']) && ! empty(trim($_POST['Nom'])) &&
         ! empty(trim($_POST['passe'])) && ! empty(trim($_POST['confPasse']))) {
    
    // Validation du mot de passe.
    if ($_POST['passe'] != $_POST['confPasse']) {
        array_push($messagesErreurs, "Erreur. Vous devez entrer le même mot de passe.");
    } else {
        // Connexion à la base de données
        $connexionDonnees->connect();
        //Nouvelle instance de la classe utilisateur.
        $user = new user();
        $user->Nom = $_POST['Nom'];
        $user->dateNaissance = $_POST['bday'];
        $user->Adresse = $_POST['Adresse'];
        $user->NoTelephone = $_POST['NoTel'];
        $user->Courriel = $_POST['Mail'];
        $user->Mot_de_Passe = passwordEncryption($_POST['passe']);
        $user->Id = $_POST['Key'];
        
        // L'accès est membre de base.
        $acces = 2;
        if (isset($_POST['acces'])) {
            $acces = $_POST['acces'];
        }
        $user->id_acces = $acces;
        
        // Si c'est une modification.
        if (!empty($_SESSION['gestionUser'])) {
            
            $retour = $connexionDonnees->modifierUtilisateur($user);
            
        } else {
            
            $retour = $connexionDonnees->ajouterUtilisateur($user);
        }
        
        array_push($messagesErreurs, $retour);
        
        $_SESSION['message'] = $messagesErreurs;
    }
} else {
    array_push($messagesErreurs, "Erreur. Vous devez remplir tous les champs.");
}

// Garde les messages d'erreur dans une session.
if (count($messagesErreurs) != 0) {
    
    // Affichage de la division.
    $_SESSION['message'] = $messagesErreurs;
    
    
    // Si c'est une modification et que l'opération a réussi.
    if (!empty($_SESSION['gestionUser']) && strpos($messagesErreurs[0], "Erreur") === false) {
        
        // On redirige vers la page de gestion des usagers exxistants.
        header('location: index.php?page=2');
        
        // On détruit la session;
        unset($_SESSION['gestionUser']);
    }
    else{
        // On redirige vers la même page pour afficher l'erreur.
        header('location: index.php?page=3');
    }
    
    // On empêche l'exécution du reste de la page en cours.
    exit();
}

?>