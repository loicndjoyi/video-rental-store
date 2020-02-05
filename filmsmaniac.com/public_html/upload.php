<?php

require_once(realpath(dirname(__FILE__) . "/../ressources/config.php"));
require_once (LIBRARY_PATH . "/utilitaire.php");

header("Cache-Control: no-cache, no-store");
header("Pragma: no-cache");
header("Expires: 0");

session_start();

// Variable des configurations
global $config;

// Le vecteur de messages qui vont être retournés
$messagesErreurs = array ();

//Cette façon ne fonctionne pas en local si on ajoute des répertoires parents supplémentaires 
//$dossier_grandes = $config['paths']['images']['grandes'];
//$dossier_petites = $config['paths']['images']['petites'];

$dossier_grandes = realpath ( dirname ( __FILE__ ) . '/img/grandes/' );
$dossier_petites = realpath ( dirname ( __FILE__ ) . '/img/petites/' );

//Nom du fichier.
$fileName = $_FILES["fileToUpload"]["name"];
$fic_original = $dossier_grandes . basename($fileName);
$fic_redimensionne = $dossier_petites . basename($fileName);
$uploadOk = 1;
$imageFileType = pathinfo($fic_original,PATHINFO_EXTENSION);
$titreFilm= null;
$description = null;


// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	if($check !== false) {
		$uploadOk = 1;
	} else {
	    array_push($messagesErreurs, "Erreur. Le téléchargement n'a pas été effectué. Le fichier n'est pas une image.");
		$uploadOk = 0;
	}
}
// Check if file already exists
if (file_exists($fic_original)) {
	array_push($messagesErreurs, "Erreur. Le téléchargement n'a pas été effectué. Le fichier existe déjà.");
	$uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
	array_push($messagesErreurs, "Erreur. Le téléchargement n'a pas été effectué. Le fichier est trop gros.");
	$uploadOk = 0;
}

if (!empty(trim($_POST['Nom'])) && !empty(trim($_POST['Description']))) {
    $titreFilm = $_POST['Nom'];
    $description = $_POST['Description'];
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			array_push($messagesErreurs, "Erreur. Le téléchargement n'a pas été effectué. Seul JPG, JPEG, PNG et GIF sont 
			        les types de fichiers permis.");
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk != 0 && move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $fic_original)) {
		    
		    //Redimensionne l'image ici.
		    if (smart_resize_image($fic_original,150,150, false, $fic_redimensionne ,false,false) && $titreFilm !== null
		             && $description !== null) {
		        // Nouvelle instant de la classe database.
                $connexionDonnees = new database($config['db']['db1']['dbname'],
                        $config['db']['db1']['dbHost'],
                        $config['db']['db1']['dbUsername'],
                        $config['db']['db1']['dbPassword']);
                
                // Connexion à la base de données
                $connexionDonnees->connect();
                
                //Nouvel objet film.
                $newFilm = new film();
                $newFilm->Nom = $titreFilm;
                $newFilm->Description = $description;
                $newFilm->Image = $fileName;
    
                $retour = $connexionDonnees->ajouterFilm($newFilm);
                array_push($messagesErreurs, $retour);
		    }
		}
		
		// Garde les messages d'erreur dans une session.
		if (count($messagesErreurs) != 0) {
		    // Affichage de la division.
		
		    $_SESSION['message'] = $messagesErreurs;
		    // On redirige vers la même page pour afficher l'erreur.
		    header('location: index.php?page=4');
		    // On empêche l'exécution du reste de la page en cours.
		    exit();
		}
		
		?>