window.addEventListener('load',init,false);

var index = 0;
var indexTempo=0;
var timer;
var image = document.getElementById("image");
var images = [];   

var elems = document.getElementsByClassName('vignettes');

for (i = 0; i < elems.length; i += 1) {
    var src = this.getAttribute('src');
    var alt = this.getAttribute('alt');
    tmp = {
        'src': src,
        'alt': alt
    };

    images.push(tmp);
}

//Fonction qui permet de lancer les événements au chargement du site à la page d'accueil.
function init()
{
	/*function createJSON() {
	    $("img[class=vignettes]").each(function() {

	        var src = $(this).attr("src");
	        var alt = $(this).attr("alt");

	        item = {}
	        item ["src"] = src;
	        item ["alt"] = alt;

	        images.push(item);
	    });
	 */
	//Boucle qui permet d'activer certains événements selon ce que l'utilisateur fait 
	//de son curseur.
	for(i=1;i<=document.getElementsByClassName("vignettes").length; i++)
	{
	  document.getElementById("vignette"+i).addEventListener('click',afficherGrandeImage,false);
	  document.getElementById("vignette"+i).addEventListener('mouseover',modelerVignette,false);
	  document.getElementById("vignette"+i).addEventListener('mouseout',enleverBordure,false);
	}
    //Conservation de l'état du diaporama enfin de l'arrêter au moment voulu grâce au resulat
    //conservé dans la variable timer.	
	timer = setInterval(changerImage, 1000);
	
	//Affiche de la première image et première vignette juste avant que le diaporama commence.
	document.getElementById("image").src = Object.values(images)[0];
	document.getElementById("vignettes").src = "img/petite/"+Object.values(images)[0].substring(28); 
	
	//Événement qui permet d'arrêter le diaporama au moment où l'utilisateur passe son curseur
	//sur l'image.
    document.getElementById("image").addEventListener('mouseover',arretDiaporama,false);
     
    //Événement qui permet de relancer le diaporama lorsque l'utilisateur enleve le curseur sur 
    //l'image.	
	document.getElementById("image").addEventListener('mouseout',init,false);
	
	//Événement qui permet que lors d'un clique sur une image de la visionneuse, on sera dirigé vers 
	//la page correspondante à l'image cliquée.
	document.getElementById("lien").addEventListener('click',lienVersPages,false);
}

//Fonction qui permet d'afficher les images dans la visionneuse en précisant le chemin de 
//l'image à afficher.
function afficherGrandeImage(e)
{
  document.getElementById("image").src = e.target.src;
}

//Fonction qui permet de mettre une bordure autours de la vignette de l'image qui est affichée
//maintenant et changer le curseur.
function modelerVignette(e)
{	
	document.getElementById(e.target.id).style.cursor = "pointer";	
	document.getElementById(e.target.id).style.border = "2px solid blue";  	
}

//Fonction qui permet de retirer la bordure mise à une vignette et de remettre la curseur à son 
//été initial.
function enleverBordure(e)
{
	document.getElementById(e.target.id).style.border = "none";	
	document.getElementById(e.target.id).style.cursor = "default";	 
}

//Fonction qui permet à ce que les images défilent l'une à la suite de l'autre pour créer un éffet
//de diaporama.
function changerImage()
{
   //Si l'index est suprérieur à 0 on enlève la bordure à la vignette qui la possède en ce moment
   if(index >=1)
   {	   
	 document.getElementById("vignette"+index).style.border = "none";     
   }
   else//Si l'index est égale à 0 on enlève la bordure mais pour la dernière vignette seulement vu
       //que le diaporama en ce moment va afficher la première image.
   {
	  document.getElementById("vignette"+images.length).style.border = "none"; 
   }
       
   document.getElementById("image").src = images[index].src;
   document.getElementById("image").alt = images[index].alt;
   document.getElementById("imgCpaq"+(index+1)).style.border = "2px solid blue"  
   
   //Condition qui permet de recommencer l'affichage des images, c'est-à-dire de poursuivre le diaporama
   //quand on est arrivé à la dernière image.
   if (index==images.length-1)
   {   
	 index = 0;	
   }
   else
   {
     index++; 
   } 	
}

//Fonction qui permet d'arrêter le diaporama.
function arretDiaporama()
{
	document.getElementById("image").style.cursor = "pointer";	
	clearInterval(timer);
}
//Fonction qui permet de faire le lien des images vers les pages auxquelles elles se rapportent. 
 function lienVersPages()
 {	
	var numeroPage = document.getElementById("image").alt;
	//Dans notre site nous avons pas une 4ème page pour le moment nous avons donc décidé
	//que si l'utilisateur clique sur la 4ème image le numéro de la page va demeurer 3 
	//comme s'il avait cliquer sur la 3ème image.
	var lien = "index.php?fiche_film=" + String(numeroPage);
	document.getElementById("lien").href = lien;		
 }