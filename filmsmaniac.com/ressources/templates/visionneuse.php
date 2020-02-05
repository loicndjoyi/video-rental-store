<?php
global $ImagesVisionneuse;

$lesImages = $ImagesVisionneuse->fetchAll();
?>
 <h1>Bienvenue sur notre site</h1>
 <h2> Les nouveautés</h2>
  <div class="container">
 <div id="slides">
<?php 
foreach ($lesImages as $image)
{
?>			
	    <a href="fiche_film.php?fiche=<?php echo $image->Id;?>"><img src="../public_html/img/grandes/<?php echo $image->Image;?>" 
	    alt="Vignette du film: <?php echo $image->Nom;?>"></a>					
    <?php 
}
    ?>	
    </div>
    </div>