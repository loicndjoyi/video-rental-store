 <?php
// Utilisateur connecté.
global $user;
// La variable qui contient la requête de tous les films.
global $resultatRequete;
// La variable qui contient la requête de la page.
global $contenuPageDemandee;

global $messages;

$messagesErreurs = array();

if (empty($user)) {
    array_push($messagesErreurs, "Vous devez être connecté pour accéder à la zone membre.");
    $_SESSION['message'] = $messagesErreurs;
    header('location: /TP1-LoicNdjoyi/filmsmaniac.com/public_html/index.php');
    exit();
}

// Affichage du titre de la page.
echo $contenuPageDemandee->Contenu;


?>
	<!-- Le bouton de recherche-->
			<form method="get" id="searchbox" action="">
				<input id="search" type="text"
					placeholder="Entrer votre recherche..."> <input id="submit"
					type="submit" value="Recherche" class='btn'>
				<div id="lstUtilisateurs"></div>
			</form>

<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
			
			<table class="table">
	<tbody>
		<tr>
			<th>Nom :</th>
			<th>Date de naissance :</th>
			<th>Adresse :</th>
			<th>No. Téléphone :</th>
			<th>Courriel :</th>
			<th>accès :</th>
			<th>action :</th>
		</tr>
	<?php

while ($lesUsers = $resultatRequete->fetchObject("user")) {
    ?>
    <tr>
			<td><?php echo $lesUsers->Nom; ?></td>
			<td><?php echo $lesUsers->dateNaissance; ?></td>
			<td><?php echo $lesUsers->Adresse; ?></td>
			<td><?php echo $lesUsers->NoTelephone; ?></td>
			<td><?php echo $lesUsers->Courriel; ?></td>
			<td><?php $acces = $lesUsers->id_acces == 1? 'Admin': 'Membre';  echo $acces; ?></td>
			<td><form action="ajout_modif_user.php" method="post"> 
			<input type="hidden" name="Key" value='<?php echo $lesUsers->Id; ?>' />
			<input type='submit' name='btnModifier' value='Modifier' class='btn'/>
			<input type='submit' name='btnSuppression' id='btnSuppression' value='Supprimer' class='btn' onclick="return confirm('&Ecirc;tes-vous sûr de vouloir supprimer ?')"/>
			</form>
			</td>

		</tr>
    <?php }?>
</tbody>
</table>
			
			</div>
		</div>
	</div>
</div>

<?php
if (!empty($messages)) {
    afficherUnOuPlusieursMessages($messages);
}
?>