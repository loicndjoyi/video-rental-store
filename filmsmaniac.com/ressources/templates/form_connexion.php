<?php
global $user;
$messagesErreurs = array();

global $messages;

if (!empty($user)) {
    array_push($messagesErreurs, "La page demandée n'est pas accessible.");
    $_SESSION['message'] = $messagesErreurs;
    header('location: /TP-LoicNdjoyi/filmsmaniac.com/public_html/index.php');
    exit();
}
?>
<div class="wrapper">
<form method="post" action="connexion.php" class="form-signin">
<?php 
global $pageConnexion;
echo $pageConnexion->Contenu;
?>
	<div>
		<input type="text" class="form-control"
			name="nomUsager" id="nomUsager" placeholder="Nom d'utilisateur"
			required autofocus <?php
// La valeur qui va être affichée.
$valeur = "";
if (isset($_POST['nomUsager'])) {
    
    $valeur = $_POST['nomUsager'];
} elseif (isset($_COOKIE['c_NomUsager'])) {
    $valeur = $_COOKIE['c_NomUsager'];
}
// On pré-rempli le champs avec le nom d'utilisateur si il est sauvegardé en
// cookie
// ou en session.
echo 'value="' . $valeur . '"';
?> />
	</div>
	<div>
		<input type="password" class="form-control"
			name="motPasse" id="motPasse" placeholder="Mot de passe" required autofocus/>
	</div>
	<div id="cookie">
		<!-- Checkbox pour le cookie -->
		<input type="checkbox" name="checked_garderLogin" id="garderLogin"
			value="g"/> <label for="garderLogin">Garder mon identifiant</label>
	</div>
	<div>

		<input type="submit" name="btnConnexion" id="btnConnexion"
			value="Connexion" class="btn btn-lg btn-primary btn-block"/>
	</div>
	<?php
//Affichage d'une ou plusieurs erreurs.
if (!empty($messages)) {
    afficherUnOuPlusieursMessages($messages);
}
?>
</form>


</div>