<?php

// Utilisateur connecté.
global $user;
// La variable qui contient la requête de tous les films.
global $resultatRequete;
// La variable qui contient la requête de la page.
global $contenuPageDemandee;
// Récupération des films.
$lesFilms = $resultatRequete->fetchAll();

global $messages;

// Affichage du titre de la page.
echo $contenuPageDemandee->Contenu;

//Affichage d'une ou plusieurs erreurs.
if (!empty($messages)) {
    afficherUnOuPlusieursMessages($messages);
}
?>

<div class="row">
<?php

foreach ($lesFilms as $colonne) {
    ?>
    <div class="col-xs-18 col-sm-6 col-md-3">
	<a href="fiche_film.php?fiche=<?php echo $colonne['Id'];?>" class="thumbnail">
				<img src="img/petites/<?php echo $colonne['Image']; ?>" alt="Vignette du film <?php echo $colonne['Nom']; ?>" />
				<div class="caption">
				<p><?php echo $colonne['Nom']; ?></p>
	<?php
    if ($user->id_acces == 1) {
        ?>
        <form method="post" action="suppression_film.php">
        <input type="hidden" name="Key" value='<?php echo $colonne['Id']; ?>' />
        <!-- Trop de choses à gérer <input type='submit' name='btnModifier' value='Modifier' class='btn' /> -->
			<input type='submit' name='btnSuppression' id='btnSuppression' value='Supprimer' class='btn' 
			onclick="return confirm('&Ecirc;tes-vous sûr de vouloir supprimer ?')"/>
		</form>
        <?php
    } ?>
    </div></a></div> <?php 
}
?>
</div>
