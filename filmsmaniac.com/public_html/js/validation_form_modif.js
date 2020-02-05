// *************************************************************
// Description :
// Ce fichier contient le code javascript de la validation du
//formulaire de modification d'un utilisateur.
//
// Créateur(s):
// Loïc Ndjoyi
//
// ************************************************************
//Validation du formulaire d'ajout-modif d'un membre
$(document).ready(function(){
$('#frmSubmit').validate({
	//Règles de validation
    rules: {
    	Nom: {
        required: true,
        minlength: 4,
      },
	  
      bday: {
        required: true,
        date: "Veuillez entre une date valide."
      },
	  
      passe: {
			required: true,
			minlength: 3
		},
		confPasse: {
			required: true,
			minlength: 3,
			equalTo: "#passe"
		},
	  
		Mail: {
        required: true,
        email: true
      },
	  
     
      Adresse: {
      	minlength: 15,
        required: true
      }
	  
    },
    messages: 
    {
    	Nom: 
      {
        required: "Le nom d'utilisateur est requis et ne doit pas être vide.",
        minlength: "Le nom d'utilisateur doit avoir un minimum de 4 caractères.",
      },
      bday: {
        required: "La date de naissance est requise et ne doit pas être vide.",
        date: "Le format de la date de naissance doit être MM/DD/YYYY",
      },
      passe: {
			required: "Le mot de passe est requis.",
			minlength: "Le mot de passe doit avoir un minimum de 3 caractères."
		},
		confPasse: {
			required: "La confirmation de mot de passe est requise.",
			minlength: "La confirmation de mot de passe doit avoir un minimum de 3 caractères.",
			equalTo: "Veuillez entrer le même mot de passe."
		},
		 Adresse: {
		      	minlength: "L'adresse doit avoir au moins 15 caractères.",
		        required: "L'adresse est requise."
		      },
      Mail: 
      {
        required: "L'adresse email est requise et ne doit pas être vide.",
        minlength: "L'adresse email doit avoir un minimum de 4 caractères."
      }
    },
		highlight: function(element) {
			$(element).closest('.control-group').addClass('has-error');
		},
		unhighlight: function(element) {
            $(element).closest('.control-group').removeClass('has-error').addClass('has-success');
        }
  });

});