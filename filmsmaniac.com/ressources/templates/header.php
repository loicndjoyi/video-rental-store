<?php
// L'utilisateur qui existe dans le fichier index.php
global $user;
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" xmlns:lang="fr">
<head>
<meta charset="UTF-8" />
<title>FilmsManiacs - La référence des films</title>
<link rel="stylesheet" href="../public_html/css/bootstrap.min.css" />
<link rel="stylesheet" href="../public_html/css/filmsmaniac.css" />
<!-- Include Font Awesome Stylesheet in Header -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" />

<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css"/>
  
</head>

<!-- The body of the page -->
<body>
	<header>
		<div id="header">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
					<?php
                if (! empty($user)) { ?>
						<button type="button" class="navbar-toggle collapsed"
							data-toggle="collapse"
							data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span> <span
								class="icon-bar"></span> <span class="icon-bar"></span> <span
								class="icon-bar"></span>
						</button>
						<?php } ?>
						<a class="navbar-brand" href="index.php">FilmsManiacs</a>
					</div>
					
		<?php
        
        if (! empty($user)) {
            
            // Variable de connexion nécessaire pour récupérér les information
            // des
            // pages.
            global $connexion;
            $toutesLesPages = $connexion->tousLesPages();
            $unePage = $toutesLesPages->fetchAll();
            $premierePage = array_shift($unePage);
            ?>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse"
						id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right">
							<li><a href="index.php?page=<?php echo $premierePage['Id'];?>"><?php echo $premierePage['Nom'];?></a></li>
        <?php
            
            // Si l'acces utilisateur est administrateur.
            if ($user->id_acces == 1) {
                // On se débarasse de la dernière page.
                array_pop($unePage);
                // Boucle sur les pages restantes.
                foreach ($unePage as $colonne) {
                    
                        $TitrePage = !empty($_SESSION['gestionUser']) && $colonne['Id'] == 3? "Modifier utilisateur": $colonne['Nom'];
                    ?>
           <li><a href="index.php?page=<?php echo $colonne['Id'];?>"><?php echo $TitrePage;?></a></li>
            <?php
                }
            }
            ?>
        <li class="dropdown"><a href="#" class="dropdown-toggle"
								data-toggle="dropdown" role="button" aria-haspopup="true"
								aria-expanded="false"><?php echo $user->Nom;?><span
									class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="deconnexion.php">Déconnexion</a></li>
								</ul></li>
						</ul>
					</div>
					<!-- /.navbar-collapse -->
						<?php }?>
				</div>
				<!-- /.container-fluid -->
			</nav>
		</div>
	</header>