 // *************************************************************
// Description :
// Ce fichier contient les paramètres de fonctionnement de la 
// visionneuse à l'aide de jquery.
//Initialement j'avais écrit un code pour la visionneuse en utilisant
//du javascript pur mais au vu de mon architecture plus complexe, il
//était plus difficile d'arriver à un résultat fonctionnel. Vu que vous
//avez permis l'utilisation de jquery, j'ai pu obtenir un résultat concluant.
//
// Créateur(s):
// Loïc Ndjoyi
//
// ************************************************************ 
$(function() {
      $('#slides').slidesjs({
        width: 740,
        height: 528,
        play: {
          active: true,
          auto: true,
		  pauseOnHover: true,
		  autoControls: true,
          interval: 4000,
          swap: true
        }
      });
    });