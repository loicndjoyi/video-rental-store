<?php
//Variable de configuration qui sera utilis� pour la conception
$config = array(
		//Store database credentials or other data pertaining.
		"db" => array(
        	"db1" => array(
            	"dbname" => "tp1_loicndjoyi",
            	"dbUsername" => "garneau",
            	"dbPassword" => "qwerty123",
            	"dbHost" => "127.0.0.1"
        	)
        ),
		//Commonly used paths to various resources for the site.
		"paths" => array(
				"images" => array(
				        //Ne fonctionne pas si on ajoute des dossiers supplémentaire comme parent en local
				        "grandes" => $_SERVER["DOCUMENT_ROOT"] . "TP-LoicNdjoyi/filmsmaniac.com/public_html/img/grandes/",
						"petites" => $_SERVER["DOCUMENT_ROOT"] . "TP-LoicNdjoyi/filmsmaniac.com/public_html/img/petites/"
				),
		        "css" => $_SERVER["DOCUMENT_ROOT"] . "/css/",
		        "js" =>$_SERVER["DOCUMENT_ROOT"] . "/js/"
		)			
);

/*
 * Constants for heavily used paths makes things a lot easier.
 */
defined ( "LIBRARY_PATH" ) or define ( "LIBRARY_PATH", realpath ( dirname ( __FILE__ ) . '/library/' ) );

defined ( "TEMPLATES_PATH" ) or define ( "TEMPLATES_PATH", realpath ( dirname ( __FILE__ ) . '/templates/' ) );

defined ( "CLASSES_PATH" ) or define ( "CLASSES_PATH", realpath ( dirname ( __FILE__ ) . '/class/' ) );

/**
 * Ne fonctionne pas.
 * 
 * 

defined ( "IMG_PETITES" ) or define ( "IMG_PETITES", realpath ( dirname ( __FILE__ ) . '/petites/' ) );
 */


/*
    Error reporting.
    STRICT messages provide suggestions that can help ensure the best 
    interoperability and forward compatibility of your code.
*/
ini_set("error_reporting", "true");
error_reporting(E_ALL|E_STRCT);

?>