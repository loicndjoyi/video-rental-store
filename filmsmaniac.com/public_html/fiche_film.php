<?php
//Configuration file
require_once (realpath(dirname(__FILE__) . "/../ressources/config.php"));
require_once (LIBRARY_PATH . "/utilitaire.php");

session_start();

if (isset($_SESSION['s_Usager'], $_GET['fiche'])) {

$user = new user();

//$user->unserialize($_SESSION['s_Usager']);
$user = $_SESSION['s_Usager'];
    
global $config;

$messagesErreurs = array();

// Nouvelle instant de la classe database.
$connexion = new database($config['db']['db1']['dbname'],
        $config['db']['db1']['dbHost'],
        $config['db']['db1']['dbUsername'],
        $config['db']['db1']['dbPassword']);

// Connexion à la base de données
$connexion->connect();

require_once (TEMPLATES_PATH . "/header.php");


$filmCherche = $connexion->chercherFilm($_GET['fiche']);

if (!empty($filmCherche)) {

echo "\t<div id=\"content\">\n";
?>
<div class="container">
	<h1>Fiche du film: <?php echo $filmCherche->Nom;?></h1>
	<div class="row">
		<div class="col-md-4">
			<div class="imgAbt">
				<img src="img/grandes/<?php echo $filmCherche->Image; ?>" class="img-responsive"/>
			</div>
		</div>
		<div class="col-md-8">
			<h2>Description du film: </h2>
			<p><?php echo $filmCherche->Description; ?></p>
			<a href="/TP-LoicNdjoyi/filmsmaniac.com/public_html/index.php" class="btn btn-large btn-info"><i
						class="icon-home icon-white"></i> Retour à la page des films</a>
		</div>
	</div>
</div>
<?php
}
else 
{
    array_push($messagesErreurs, "Erreur. Le film n'existe pas.");
}
// close content div
	echo "\t</div>\n";
	
	////Inclut le pied de page.
	require_once(TEMPLATES_PATH . "/footer.php");
}
else {
    
        array_push($messagesErreurs, "Erreur. Vous devez être connecté pour accéder à la zone membre."); 
}

// Garde les messages d'erreur dans une session.
if (count($messagesErreurs) != 0) {
    // Affichage de la division.
    
    $_SESSION['message'] = $messagesErreurs;
    // On redirige vers la même page pour afficher l'erreur.
    header('location: /TP-LoicNdjoyi/filmsmaniac.com/public_html/index.php');
    // On empêche l'exécution du reste de la page en cours.
    exit();
}
?>