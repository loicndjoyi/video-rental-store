<?php
require_once (realpath(dirname(__FILE__) . "/../ressources/config.php"));
require_once (LIBRARY_PATH . "/utilitaire.php");

session_cache_limiter('nocache');

session_start();

// Variable des configurations
global $config;

// Passe des variables dans un array pour les utiliser dans le template.
$variables = array();

// Nouvelle instant de la classe database.
$connexion = new database($config['db']['db1']['dbname'],
        $config['db']['db1']['dbHost'], $config['db']['db1']['dbUsername'],
        $config['db']['db1']['dbPassword']);

//Connexion à la base de données.
$connexion->connect();

//Vérifie qu'un message d'erreur ou de confirmation doit être affiché.
if (isset($_SESSION['message'])) {
    
    $messages = $_SESSION['message'];
    
    //Ajout des messages dans l'array pour l'utiliser dans le template selectionné.
    array_push($variables, $messages);

    //Destruction de la session.
    unset($_SESSION['message']);
}

if (isset($_SESSION['s_Usager'])) {
    
    //La requête pour récupérer le contenu selon le numéro de la page.
    $resultatRequete = null;
    
    //Le fichier de contenu de la page demandée.
    $contenuPageDemandee = null;
    
    //Les images de la visionneuse.
    $ImagesVisionneuse = null;
    
    //Le tableau de fichier javascript
    $jsFiles = array();
    
    //L'utilisateur stocké dans la session.
    $user = new user();
    //$user->unserialize($_SESSION['s_Usager']); 
    $user = $_SESSION['s_Usager'];
    
    $TemplateSelectionne = "";
    // Variable pour les pages.
    $iPage = 1;
    if(isset($_GET['page'])){
        $iPage = $_GET['page'];
    }
    
    switch ($iPage) {
        case 2:
            $resultatRequete = $connexion->tousLesUtilisateurs();
            $TemplateSelectionne = "/table_ajout_modif_user.php";
            array_push($jsFiles, "util-dom.js");
            array_push($jsFiles, "ajax_recherche.js");
            break;
        
        case 3:
            $resultatRequete = $connexion->tousLesTypesAcces();
            $TemplateSelectionne = "/form_ajout_user.php";
            if (!empty($_SESSION['gestionUser'])) {
                array_push($jsFiles, "validation_form_modif.js");
            }
            else {
                array_push($jsFiles, "validation_form_ajout.js");
            }
            
            break;
        case 4:
            $TemplateSelectionne = "/form_ajout_film.php";
            break;
        
        default:
            
            $resultatRequete = $connexion->tousLesFilms();
            $ImagesVisionneuse = $connexion->ImagesVisionneuse(5);
            $TemplateSelectionne = "/content.php";
            //Ajout du résultat de la requête dans le tableau.
            array_push($variables, $ImagesVisionneuse);
            array_push($jsFiles, "jquery.slides.min.js");
            array_push($jsFiles, "visionneuse.js");
            break;
    }
    
    //Récupération de la page demandée.
    $contenuPageDemandee = $connexion->chercherUnePage($iPage);
    
    //Ajout du résultat de la requête dans le tableau.
    array_push($variables, $resultatRequete);
    
    //Ajout de la section de contenu dans le tableau.
    array_push($variables, $contenuPageDemandee);
    
    //Ajout de la variable contenant l'utilisateur connecté dans le tableau.
    array_push($variables, $user);
    
    //Ajout de la variable contenant les fichiers javascript.
    array_push($variables, $jsFiles);
    
    //Appel de la méthode d'affichage des templates.
    afficherPageAvecTemplates($TemplateSelectionne, $variables);
} else {
    
    $pageConnexion = $connexion->chercherUnePage(5);
    array_push($variables, $pageConnexion);
 
    afficherPageAvecTemplates("/form_connexion.php", $variables);

}

?>