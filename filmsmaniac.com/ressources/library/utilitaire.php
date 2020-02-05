<?php
//Configuration file
require_once(realpath(dirname(__FILE__) . "/../config.php"));

/**
 * @but Encapsuler la logique des templates dans une fonction afin de contrôler
 *      l'affichage de ceux-ci.
 * @param string $pFicContenu - Le fichier de contenu.
 * @param array $variables - Les variables qui vont être utilisées dans le fichier de contenu.
 */
function afficherPageAvecTemplates($pFicContenu, $variables = array())
{
	$pCheminFichier = TEMPLATES_PATH . "/" . $pFicContenu;
	 

	if (count($variables) > 0) {
		foreach ($variables as $key => $value) {
			if (strlen($key) > 0) {
				${$key} = $value;
			}
		}
	}

	//Inclut l'entête
	require_once(TEMPLATES_PATH . "/header.php");
	 
	echo "\t<div id=\"container\">\n";
	
	//Vérifie qu'il y a un fichier contenu demandé.
	if (file_exists($pCheminFichier)) {
	    
	    switch ($pFicContenu) {
	        case "/content.php":
	            require_once(TEMPLATES_PATH . "/visionneuse.php");
	            break;
	    
	        case "/form_connexion.php":
//	            require_once(TEMPLATES_PATH . "/form_ajout_user.php");
	        default:
	            break;
	    }
	    
		require_once($pCheminFichier);
	} else {
		//Si il n'y a pas de fichier contenu demandé.
		require_once(TEMPLATES_PATH . "/erreur404.php");
	}
	 
	// close content div
	echo "\t</div>\n";
	
	////Inclut le pied de page.
	require_once(TEMPLATES_PATH . "/footer.php");
}

/**
 * @but: Encrypte la chaîne reçu en paramètre dans la base de données.
 * @param string $pMotDePasse Chaîne à encrypter.
 * @return Mot de passe enctypté.
 */
function passwordEncryption ($pMotDePasse)
{
    // Plus compliqué de cette manière.
    // return password_hash($pMotDePasse, PASSWORD_DEFAULT);
    
    return sha1($pMotDePasse);
}

/**
 * @but: Inclure automatique un fichier portant le même
 * nom qu'une classe utilisé dans le code.
 */
function __autoload ($className)
{
    $file = CLASSES_PATH . '\\'. $className . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
}

/**
 * @but: Afficher un message de confirmation en cas d'erreur ou de réussite d'une
 * action effectuée par l'utilisateur.
 */
function afficherUnOuPlusieursMessages($pArrayMessages) {
    
      //Affichage de la division.
   /*  $nomClasse = strpos($pArrayMessages[0], "Erreur") !== false? "erreurs" : "reussi";
    
    echo "<div class=\"$nomClasse\"><ul>";

    for ($i = 0; $i < count($pArrayMessages); $i ++) {

        echo "<li>$pArrayMessages[$i]</li>";
    }
    echo "</ul></div>"; */
    $nomClasse = strpos($pArrayMessages[0], "Erreur") !== false? "alert alert-danger fade in" : "alert alert-success fade in";
    echo "<div class=\"$nomClasse\">" ;
    echo '<a href="#" class="close" data-dismiss="alert">&times;</a><ul>'; 
    for ($i = 0; $i < count($pArrayMessages); $i ++) {
    
        echo "<li>$pArrayMessages[$i]</li>";
    }
    echo "</ul></div>";
}

  /** easy image resize function
 * @param  $file - file name to resize
 * @param  $width - new image width
 * @param  $height - new image height
 * @param  $proportional - keep image proportional, default is no
 * @param  $output - name of the new file (include path if needed)
 * @param  $delete_original - if true the original image will be deleted
 * @param  $use_linux_commands - if set to true will use "rm" to delete the image, if false will use PHP unlink
 * @param  $quality - enter 1-100 (100 is best quality) default is 100
 * @return boolean|resource
 */

  function smart_resize_image($file,
                              $width              = 0, 
                              $height             = 0, 
                              $proportional       = false, 
                              $output             = 'file', 
                              $delete_original    = true, 
                              $use_linux_commands = false,
  							  $quality = 100
  		 ) {
      
    if ( $height <= 0 && $width <= 0 ) return false;
    if ( $file === null) return false;
    # Setting defaults and meta
    $info                         = getimagesize($file);
    $image                        = '';
    $final_width                  = 0;
    $final_height                 = 0;
    list($width_old, $height_old) = $info;
	$cropHeight = $cropWidth = 0;
    # Calculating proportionality
    if ($proportional) {
      if      ($width  == 0)  $factor = $height/$height_old;
      elseif  ($height == 0)  $factor = $width/$width_old;
      else                    $factor = min( $width / $width_old, $height / $height_old );
      $final_width  = round( $width_old * $factor );
      $final_height = round( $height_old * $factor );
    }
    else {
      $final_width = ( $width <= 0 ) ? $width_old : $width;
      $final_height = ( $height <= 0 ) ? $height_old : $height;
	  $widthX = $width_old / $width;
	  $heightX = $height_old / $height;
	  
	  $x = min($widthX, $heightX);
	  $cropWidth = ($width_old - $width * $x) / 2;
	  $cropHeight = ($height_old - $height * $x) / 2;
    }
    # Loading image to memory according to type
    switch ( $info[2] ) {
      case IMAGETYPE_JPEG:  $image = imagecreatefromjpeg($file);  break;
      case IMAGETYPE_GIF:   $image = imagecreatefromgif($file);  break;
      case IMAGETYPE_PNG:   $image = imagecreatefrompng($file);  break;
      default: return false;
    }
    
    
    # This is the resizing/resampling/transparency-preserving magic
    $image_resized = imagecreatetruecolor( $final_width, $final_height );
    if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
      $transparency = imagecolortransparent($image);
      $palletsize = imagecolorstotal($image);
      if ($transparency >= 0 && $transparency < $palletsize) {
        $transparent_color  = imagecolorsforindex($image, $transparency);
        $transparency       = imagecolorallocate($image_resized, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
        imagefill($image_resized, 0, 0, $transparency);
        imagecolortransparent($image_resized, $transparency);
      }
      elseif ($info[2] == IMAGETYPE_PNG) {
        imagealphablending($image_resized, false);
        $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
        imagefill($image_resized, 0, 0, $color);
        imagesavealpha($image_resized, true);
      }
    }
    imagecopyresampled($image_resized, $image, 0, 0, $cropWidth, $cropHeight, $final_width, $final_height, $width_old - 2 * $cropWidth, $height_old - 2 * $cropHeight);
	
	
    # Taking care of original, if needed
    if ( $delete_original ) {
      if ( $use_linux_commands ) exec('rm '.$file);
      else @unlink($file);
    }
    # Preparing a method of providing result
    switch ( strtolower($output) ) {
      case 'browser':
        $mime = image_type_to_mime_type($info[2]);
        header("Content-type: $mime");
        $output = NULL;
      break;
      case 'file':
        $output = $file;
      break;
      case 'return':
        return $image_resized;
      break;
      default:
      break;
    }
    
    # Writing image according to type to the output destination and image quality
    switch ( $info[2] ) {
      case IMAGETYPE_GIF:   imagegif($image_resized, $output);    break;
      case IMAGETYPE_JPEG:  imagejpeg($image_resized, $output, $quality);   break;
      case IMAGETYPE_PNG:
        $quality = 9 - (int)((0.9*$quality)/10.0);
        imagepng($image_resized, $output, $quality);
        break;
      default: return false;
    }
    return true;
  }
?>