<?php
global $ImagesVisionneuse;

$lesImages = $ImagesVisionneuse->fetchAll();

?>
<div>
<div id="grandeImage" >
   <a id= "lien" href="">
			   <img  href="" id="image" src="" width="800" height="400" alt="" title="Image" />
	</a>
</div>			
<div id="bloc_vignettes">
    <ul id="vignettes">
<?php 
foreach ($lesImages as $image)
{
?>			
	    <li><img id="vignette<?php echo $image->Id;?>" src="../public_html/img/grandes/<?php echo $image->Image;?>"
					 alt="<?php echo $image->Id;?>" height="60" width="80" title="Vignette du film: <?php echo $image->Nom;?> class="vignettes"/>
		</li>					
    <?php 
}
    ?>	
        </ul>		
</div>
</div>