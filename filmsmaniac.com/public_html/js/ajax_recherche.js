// *************************************************************
// Description :
// Ce fichier contient le code ajax pour la barre de recherche
//
// Créateur(s):
// Loïc Ndjoyi
//
// ************************************************************

// Objet XMLHttpRequest.
var xhr, http;

var iNbInput = 3;

// Tableau qui contiendra les personnes répondants au critère (variable globale)
var objUtilisateurs;

// Ajout d'un gestionnaire d'événements lors de la soumission du formulaire.
window.addEventListener('DOMContentLoaded', init, false);

function init() {
	$('search').addEventListener('keyup', afficherInfosUtilisateursAjax, false);
	$('search').addEventListener('click', afficherListeUtilisateurs, false);
	$('submit').addEventListener('click', afficherListeCherche, false);
	// pour empêcher que Enter soumette le formulaire
	$('searchbox').addEventListener('submit', function(e){e.preventDefault();}, false);
	
	$('lstUtilisateurs').className = "afficher";
}

function afficherListeUtilisateurs() {
	$('lstUtilisateurs').className = "afficher";	
}
	
// Fonction appelée pour tenter de récupérer et d'afficher les informations
// d'un membre avec AJAX.
function afficherInfosUtilisateursAjax() {
	
	if ($('search').value.length >= iNbInput) {
		
		// Annuler la requête précédente s'il y a lieu car une nouvelle requête est
		// lancée à chaque keyup et on ne veut pas les résultats du keyup précédent
		if(xhr)
			xhr.abort();
		
		// Création de l'objet XMLHttpRequest.
		xhr = new XMLHttpRequest();

		// Fonction JavaScript à exécuter lorsque l'état de la requête HTTP change.
		xhr.addEventListener('readystatechange',afficherInfosUtilisateursAjaxCallback,false);
		
		// URL pour la requête HTTP avec AJAX (inclut le paramètre).
		var URL = 'ajax_recherche.php?search=' + encodeURIComponent($('search').value.trim());
		
		// Préparation de la requête HTTP-GET en mode asynchrone (true).
		xhr.open('GET', URL, true);
		
		// Envoie de la requête au serveur en lui passant null (aucun contenu);
		// lorsque la requête changera d'état; la fonction "afficherInfoMembreMembreAJAX_callback" sera appelée.
		xhr.send(null);
	}
	

}  // Fin de "afficherInfosUtilisateursAjax"

// Callback de la requête AJAX qui demande et affiche les informations d'un membre.
function afficherInfosUtilisateursAjaxCallback() {
	// La requête AJAX est-elle complétée (readyState=4) ?
	if ( xhr.readyState == 4 ) {

		// Réactivation des contrôles du formulaire.
		$('search').disabled = false;
		
		// Variable indiquant s'il y a une erreur jusqu'à présent.
		var erreur = false;

		// La requête AJAX est-elle complétée avec succès (status=200) ?
		if ( xhr.status != 200 ) {
			// Affichage du message d'erreur.
			var msgErreur = 'Erreur (code=' + xhr.status + '): La requête HTTP n\'a pu être complétée.';
			$('msg-erreur').textContent = msgErreur;
			erreur = true;
		} else {
			// Création de l'objet JavaScript à partir de l'expression JSON.
			// *** Notez l'utilisation de "responseText".
			try { 
				objUtilisateurs = JSON.parse( xhr.responseText );
			} catch (e) {
				//alert('ERREUR: La réponse AJAX n\'est pas une expression JSON valide.'); POP UP Énervant!!!
				erreur = true;
			}

			if (!erreur) {
				// Y a-t-il eu une erreur côté serveur ?
				if ( objUtilisateurs.erreur ) {
					// Affichage du message d'erreur.
					var msgErreur = 'Erreur: ' + objUtilisateurs.erreur.message;
					$('msg-erreur').textContent = msgErreur;
					
					// vider la liste déroulante
					while ($('lstUtilisateurs').firstChild) $('lstUtilisateurs').removeChild($('lstUtilisateurs').firstChild);
					
				} else {
					
					// ajout d'une liste dans la div#lstUtilisateurs
					var divListe = $('lstUtilisateurs');
					
					// vider la liste déroulante
					while (divListe.firstChild) divListe.removeChild(divListe.firstChild);
				
					var elemListe = document.createElement('ul');
					divListe.appendChild(elemListe);
					
					// ajout des informations des utilisateurs dans la liste
					for (i=0;i<objUtilisateurs.length;i++) {
						var elem = document.createElement('li');
						elem.textContent = objUtilisateurs[i].id +', ' + objUtilisateurs[i].Nom 
						+', ' + objUtilisateurs[i].categorie;
					
						// ajout d'un événement qui permettra de faire une action lorsqu'on clique 
						// sur un des items de la liste
						elem.addEventListener('click',ModifierItemSelectionne,false);
						
						elemListe.appendChild(elem);
					}
				}
			}
		}
	}
}  // Fin de "afficherInfosUtilisateursAjaxCallback" 

// Fonction affichant les infos des items cherchés lorsqu l'utilisateur appuie sur le bouton recherche.
function afficherListeCherche(){

var element = document.getElementsByTagName("td");

	//On vide la liste de départ.
	for (i = element.length - 1; i >= 0 ; i--)
		{
			//liste.doc.getElementById("provinces").options[i] = null;
			element[i].parentNode.removeChild(element[i]);

		}
		var liste = $('lstUtilisateurs');

		var elementTbody = document.getElementsByTagName("tbody")[0];

		//On charge la liste avec le nouveau contenu.
			for (i=0;i<objUtilisateurs.length;i++) {

				var obj = objUtilisateurs[i].id +', ' + objUtilisateurs[i].Nom +', ' + objUtilisateurs[i].DateNaissance + ', ' +
						 objUtilisateurs[i].Adresse + ', ' + objUtilisateurs[i].NoTelephone +', ' +
						 objUtilisateurs[i].Courriel +', ' + objUtilisateurs[i].categorie;

						var objSplited = obj.split(',');

				var elemTr = document.createElement('tr');

				for(j=1;j<objSplited.length;j++){

						var elemTd = document.createElement('td');

						elemTd.textContent = objSplited[j];

						elemTr.appendChild(elemTd);
				}
				
				var elementTdForm = document.createElement('td');
				
				var eForm = document.createElement('form');
				
				eForm.action = "ajout_modif_user.php";
				
				eForm.method = "post";
				
				var eInputHidden = document.createElement('input');
				
				eInputHidden.type = "hidden";
				
				eInputHidden.name = "Key";
				
				eInputHidden.value = objSplited[0];
				
				eInputHidden.className  = "btn";
				
				eForm.appendChild(eInputHidden);
				
				
				var eInputModifier = document.createElement('input');
				
				eInputModifier.type = "submit";
				
				eInputModifier.name = "btnModifier";
				
				eInputModifier.value = "Modifier";
				
				eInputModifier.className  = "btn";
				
				eForm.appendChild(eInputModifier);
				
				
				var eInputSupp = document.createElement('input');
				
				eInputSupp.type = "submit";
				
				eInputSupp.name = "btnSupprimer";
				
				eInputSupp.value = "Supprimer";
				
				eInputSupp.className  = "btn";
				
				eForm.appendChild(eInputSupp);
				
				elementTdForm.appendChild(eForm);

				elemTr.appendChild(elementTdForm);

					elementTbody.appendChild(elemTr);

					}

					var divListe = $('lstUtilisateurs');
					
					// vider la liste déroulante
					while (divListe.firstChild) divListe.removeChild(divListe.firstChild);
				}


	// Fonction affichant les infos de l'item sélectionné dans la page de modification.
function ModifierItemSelectionne(e) {
	
	var persSelectionnee = e.target.textContent;

	var tabInfosPers = persSelectionnee.split(',');
	
	var params = 'btnModifier='+encodeURIComponent('Modifier') + '&Key=' +
	encodeURIComponent(tabInfosPers[0].trim()) + "";
	
	if(http)
		http.abort();
	
	// Création de l'objet XMLHttpRequest.
	http = new XMLHttpRequest();
	
	// Fonction JavaScript à exécuter lorsque l'état de la requête HTTP change.
	http.addEventListener('readystatechange',ChargerPageModification,false);

	// URL pour la requête HTTP avec AJAX (inclut le paramètre).
	var URL = 'ajout_modif_user.php';
	
	// Préparation de la requête HTTP-GET en mode asynchrone (true).
	http.open('POST', URL, true);
	
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	// Envoie de la requête au serveur en lui passant null (aucun contenu);
	// lorsque la requête changera d'état; la fonction "afficherInfoMembreMembreAJAX_callback" sera appelée.
	http.send(params);
	
}

function ChargerPageModification(){
	
	if(http.status != 200){
		window.location = "index.php?page=3";
	}
}