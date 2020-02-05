<?php
global $user;

global $messages;

$messagesErreurs = array();

if (empty($user)) {
    array_push($messagesErreurs, "Vous devez être connecté pour accéder à la zone membre.");
    $_SESSION['message'] = $messagesErreurs;
    header('location: /TP1-LoicNdjoyi/filmsmaniac.com/public_html/index.php');
    exit();
}
?>
<div>
<form action="upload.php" method="post" enctype="multipart/form-data">
	<div>
		<input name="Nom" type="text" id="Nom" placeholder="Titre du film" required autofocus/>
	</div>
	<div>
		<textarea name="Description" class="form-control" rows = "3" required autofocus placeholder="Tapez la description..."></textarea>
	</div>
	<div id="frmFilm">
	<input type="file" name="fileToUpload" id="fileToUpload" required autofocus class='btn'>
	<input type="submit" value="Ajouter film" name="submit" class="btn btn-lg btn-primary btn-block">
	</div>
	
</form>
</div>
<?php
//Affichage d'une ou plusieurs erreurs.
if (!empty($messages)) {
    afficherUnOuPlusieursMessages($messages);
}
?>
