<?php
// Déconnexion
session_start ();
session_unset ();//Suppression des variables de session
session_destroy (); //Supression des données associées à la session
header ( "Location: index.php" );
?>