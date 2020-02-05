<?php
global $resultatRequete;

global $contenuPageDemandee;

global $messages;

$userModifie = null;

// Affichage du titre de la page.
if (isset($_SESSION['gestionUser'])) {
    echo '<h1>Modifier un utilisateur</h1>';
    $userModifie = $_SESSION['gestionUser'];
    //unset($_SESSION['gestionUser']); Crée un ajout d'un nouvel utilisateur pour la modification.
} elseif (!empty($contenuPageDemandee)) {
    echo $contenuPageDemandee->Contenu;
}else{
    echo '<h1>Inscription</h1>';
}

?>

<form method="post" action="ajout_modif_user.php" id="frmSubmit">

<input type="hidden" name="Key" value='<?php if ($userModifie != null) {
    echo $userModifie->Id;
} ?>' />
	<div id="div_Nom" class="control-group">
		<input name="Nom" type="text" class="form-control" id="Nom"
			placeholder="Nom d'utilisateur..." required autofocus
			value="<?php

if ($userModifie != null) {
    echo $userModifie->Nom;
}
?>" />
	</div>
	<div id="div_passe" class="control-group">
		<input name="passe" type="password" class="form-control" id="passe"
			placeholder="Mot de passe..." required autofocus />
	</div>
	<div id="div_confPasse" class="control-group">
		<input name="confPasse" type="password" class="form-control"
			id="confPasse" placeholder="Confirmation mot de passe..." required
			autofocus />
	</div>
	<div class="control-group">
		<input name="bday" type="date" class="form-control" id="bday"
			value="<?php

if ($userModifie != null) {
    echo $userModifie->dateNaissance;
}
?>" />
	</div>
		<div id="div_Adresse" class="control-group">
		<input name="Adresse" type="text" class="form-control" id="Adresse"
			placeholder="Votre adresse..."
			value="<?php

if ($userModifie != null) {
    echo $userModifie->Adresse;
}
?>" />
	</div>
	<div id="div_NoTel" class="control-group">
		<input name="NoTel" type="text" class="form-control" id="NoTel"
			placeholder="418-123-1234"
			value="<?php

if ($userModifie != null) {
    echo $userModifie->NoTelephone;
}
?>" />
	</div>
	<div id="div_Mail" class="control-group">
		<input name="Mail" type="text" class="form-control" id="Mail"
			placeholder="email@email.com" required autofocus
			value="<?php

if ($userModifie != null) {
    echo $userModifie->Courriel;
}
?>" />
	</div>
	<div>
		<select name="acces" size="1" id="acces" class="form-control">
			<option
				value="" disabled selected hidden>Choisir l'accès</option>  
					<?php
    while ($acces = $resultatRequete->fetch()) {
        ;
        ?>
					     <option value="<?php echo $acces['id'];?>"
					     <?php
					     //Pour sélectionner par défaut la valeur de l'accès de l'utilisateur à modifier.
					     if ($userModifie != null && $userModifie->id_acces == $acces['id']) { ?>
					        selected="selected"
					     <?php 
					     ;}//Fin du IF.
					     ?>
					     ><?php echo $acces['nom']; ?></option>
					<?php } ?>
				</select>
	</div>
	  <!-- #messages is where the messages are placed inside -->
    <div class="form-group">
        <div class="col-md-9 col-md-offset-3">
            <div id="messages"></div>
        </div>
    </div>
	<div>
		<input type="submit" name="btnSoumettre" id="btnSoumettre"
			value="Soumettre" class="btn btn-lg btn-primary btn-block" />
	</div>
</form>
<?php
//Affichage d'une ou plusieurs erreurs.
if (!empty($messages)) {
    afficherUnOuPlusieursMessages($messages);
}
?>
