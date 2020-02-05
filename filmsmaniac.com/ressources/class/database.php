<?php

/**
 * @author: Loïc Ndjoyi
 * @but: Classe de connexion à la base de données.
 */
class database
{

    private $connexion;

    private $dbNom;

    private $dbHote;

    private $dbUtilisateur;

    private $dbMotDePasse;

    public function setdbNom ($valeur)
    {
        $this->dbNom = $valeur;
    }

    public function setdbHote ($valeur)
    {
        $this->dbHote = $valeur;
    }

    public function setdbUtilisateur ($valeur)
    {
        $this->dbUtilisateur = $valeur;
    }

    public function setdbMotDePasse ($valeur)
    {
        $this->dbMotDePasse = $valeur;
    }

    /**
     * @but: Créer une nouvelle instance la classe database en fonction des
     * paramètres reçus.
     * @Param: string $pdbNom Nom de la base de données.
     * @Param: string $pdbHote Nom de l'hôte.
     * @Param: string $pdbUtilisateur Nom de l'utilisateur.
     * @Param: string $pdbMotDePasse Mot de passe de l'utilisateur.
     */
    public function __construct ($pdbNom, $pdbHote, $pdbUtilisateur, 
            $pdbMotDePasse)
    {
        $this->setdbNom($pdbNom);
        $this->setdbHote($pdbHote);
        $this->setdbMotDePasse($pdbMotDePasse);
        $this->setdbUtilisateur($pdbUtilisateur);
    }

    /**
     * @but: Créer la connexion la base de données.
     */
    public function connect ()
    {
        try {
            $this->connexion = new PDO(
                    "mysql:host=$this->dbHote;dbname=$this->dbNom", 
                    $this->dbUtilisateur, $this->dbMotDePasse, 
                    array(
                            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                    ));
            
            // Activation de la gestion d'erreurs de connexionla bd.
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, 
                    PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            
            exit(
                    "Erreur lors de la connexion à la BD :<br />\n" .
                             $e->getMessage() . "");
        }
    }

    /*
     * @but: Obtenir le film dont l'identifiant est reçu en paramètre.
     * @Param: int $pIdFilm Identifiant du film.
     * @Return: Un film si réussi.
     */
    public function chercherUnePage ($pIdPage)
    {
        if ($this->connexion == null) {
            // Va afficher un message d'erreur et terminer le script.
            exit(
                    "Erreur. Impossible d'obtenir une page sans connexion à la base de données.");
        }
        try {
            $query = $this->connexion->prepare(
                    'SELECT * FROM pages WHERE Id = :identifiant');
            // Lie les paramètres aux valeurs.
            $query->bindValue(':identifiant', $pIdPage, PDO::PARAM_INT);
            $query->setFetchMode(PDO::FETCH_CLASS, "page");
            $query->execute();
            $page = $query->fetch();
        } catch (PDOException $e) {
            exit(
                    "Erreur lors de l'exécution de la requête SQL :<br />\n" .
                             $e->getMessage() . "<br />requête = SELECT");
        }
        
        // Fermeture du curseur.
        $query->closeCursor ();
        return $page;
    }

    /**
     * @but: Obtenir l'utilisateur dont le nom d'utilisateur et le mot de passe
     * sont reçu en paramètre.
     * @Param: string $plogin Nom d'utilisateur.
     * @Param: string $pMotDePasse Mot de passe de l'utilisateur.
     * @Return: Un film si réussi.
     */
    public function chercherUtilisateur ($plogin)
    {
        if ($this->connexion == null) {
            // Va afficher un message d'erreur et terminer le script.
            exit(
                    "Erreur. Impossible d'obtenir l'utilisateur sans connexion à la base de données.");
        }
        try {
            $query = $this->connexion->prepare(
                    'SELECT * FROM users WHERE Nom = :login');
            // Lie les paramètres aux valeurs.
            $query->bindValue(':login', $plogin, PDO::PARAM_STR);
            $query->setFetchMode(PDO::FETCH_CLASS, "user");
            $query->execute();
            $user = $query->fetch();
        } catch (PDOException $e) {
            exit(
                    "Erreur lors de l'exécution de la requête SQL :<br />\n" .
                             $e->getMessage() . "<br />requête = SELECT");
        }
        // Fermeture du curseur.
        $query->closeCursor ();
        return $user;
    }
    
    
    /**
    * @but: Obtenir l'utilisateur dont le nom d'utilisateur et le mot de passe
    * sont reçu en paramètre.
    * @Param: string $plogin Nom d'utilisateur.
     * @Param: string $pMotDePasse Mot de passe de l'utilisateur.
         * @Return: Un film si réussi.
         */
    public function chercherUtilisateurAvecId ($pId)
         {
             if ($this->connexion == null) {
                 // Va afficher un message d'erreur et terminer le script.
                 exit(
                         "Erreur. Impossible d'obtenir l'utilisateur sans connexion à la base de données.");
             }
             try {
                 $query = $this->connexion->prepare(
                         'SELECT * FROM users WHERE Id = :id');
                 // Lie les paramètres aux valeurs.
                 $query->bindValue(':id', $pId, PDO::PARAM_INT);
                 $query->setFetchMode(PDO::FETCH_CLASS, "user");
                 $query->execute();
                 $user = $query->fetch();
             } catch (PDOException $e) {
                 exit(
                         "Erreur lors de l'exécution de la requête SQL :<br />\n" .
                         $e->getMessage() . "<br />requête = SELECT");
             }
             // Fermeture du curseur.
             $query->closeCursor ();
             return $user;
    }

    /*
     * @but: Obtenir le film dont l'identifiant est reçu en paramètre.
     * @Param: int $pIdFilm Identifiant du film.
     * @Return: Un film si réussi.
     */
    public function chercherFilm ($pIdFilm)
    {
        if ($this->connexion == null) {
            // Va afficher un message d'erreur et terminer le script.
            exit(
                    "Erreur. Impossible d'obtenir le film sans connexion à la base de données.");
        }
        try {
            $query = $this->connexion->prepare(
                    'SELECT * FROM films WHERE Id = :identifiant');
            // Lie les paramètres aux valeurs.
            $query->bindValue(':identifiant', $pIdFilm, PDO::PARAM_INT);
            $query->setFetchMode(PDO::FETCH_CLASS, "film");
            $query->execute();
            $film = $query->fetch();
        } catch (PDOException $e) {
            exit(
                    "Erreur lors de l'exécution de la requête SQL :<br />\n" .
                             $e->getMessage() . "<br />requête = SELECT");
        }
        // Fermeture du curseur.
        $query->closeCursor ();
        return $film;
    }

    /*
     * @but: Obtenir tous les types utilisateurs contenu dans la base de données.
     * @Return: True si réussi.
     */
    public function tousLesTypesAcces ()
    {
        if ($this->connexion == null) {
            // Va afficher un message d'erreur et terminer le script.
            exit(
                    "Erreur. Impossible d'obtenir les types d'accès sans connexion à la base de données.");
        }
        $query = $this->connexion->prepare(
                'SELECT * FROM acces ORDER BY id');
        $query->execute();
        
        return $query;
    }
    
    /*
     * @but: Obtenir tous les pages contenu dans la base de données.
     * @Return: True si réussi.
     */
    public function tousLesPages ()
    {
        if ($this->connexion == null) {
            // Va afficher un message d'erreur et terminer le script.
            exit(
                    "Erreur. Impossible d'obtenir les pages sans connexion à la base de données.");
        }
        $query = $this->connexion->prepare(
                'SELECT * FROM pages ORDER BY id');
        $query->execute();
    
        return $query;
    }
    
    /*
     * @but: Obtenir tous les films contenu dans la base de données.
     * @Return: True si réussi.
     */
    public function tousLesUtilisateurs ()
    {
        if ($this->connexion == null) {
            // Va afficher un message d'erreur et terminer le script.
            exit(
                    "Erreur. Impossible d'obtenir les utilisateurs sans connexion à la base de données.");
        }
        try {
            $query = $this->connexion->prepare(
                    'SELECT * FROM users ORDER BY id');
            $query->execute();
        } catch (PDOException $e) {
            exit(
                    "Erreur lors de l'exécution de la requête SQL :<br />\n" .
                    $e->getMessage() . "<br />requête = SELECT");
        }
        return $query;
    }
    
    /*
     * @but: Obtenir le(s) membre(s) correspondant au champs de recherche.
     * @Return: True si réussi.
     */
    public function LesUtilisateursViaAjax($pChampRecherche)
    {
        if ($this->connexion == null) {
            // Va afficher un message d'erreur et terminer le script.
            exit(
                    "Erreur. Impossible d'obtenir les utilisateurs sans connexion à la base de données.");
        }
        try {
            $query = $this->connexion->prepare(
                    'SELECT users.Id, users.Nom, users.dateNaissance, users.Adresse, users.NoTelephone, users.Courriel, 
                    acces.nom FROM users INNER JOIN acces ON acces.id = users.id_acces 
		WHERE users.Nom LIKE :champRecherche ORDER BY acces.nom, users.Nom');
            
            $query->bindValue(':champRecherche', '%' . $pChampRecherche . '%' , PDO::PARAM_STR);
            $query->setFetchMode(PDO::FETCH_OBJ);
            $query->execute();
        } catch (PDOException $e) {
            exit(
                    "Erreur lors de l'exécution de la requête SQL :<br />\n" .
                    $e->getMessage() . "<br />requête = SELECT");
        }
        return $query;
    }

    /*
     * @but: Obtenir tous les films contenu dans la base de données.
     * @Return: True si réussi.
     */
    public function tousLesFilms ()
    {
        if ($this->connexion == null) {
            // Va afficher un message d'erreur et terminer le script.
            exit(
                    "Erreur. Impossible d'obtenir les films sans connexion à la base de données.");
        }
        try {
            $query = $this->connexion->prepare(
                    'SELECT * FROM films ORDER BY id');
            $query->execute();
        } catch (PDOException $e) {
            exit(
                    "Erreur lors de l'exécution de la requête SQL :<br />\n" .
                             $e->getMessage() . "<br />requête = SELECT");
        }
        return $query;
    }
    
    /*
     * @but: Obtenir toutes les images des films contenu dans la base de données pour la visionneuse.
     * @Return: True si réussi.
     */
    public function ImagesVisionneuse($pOffset){
        
        if ($this->connexion == null) {
            // Va afficher un message d'erreur et terminer le script.
            exit(
                    "Erreur. Impossible d'obtenir les images des films de la visionneuse sans connexion à la base de données.");
        }
        try {
            $query = $this->connexion->prepare(
                    'SELECT Id, Nom, Image FROM films ORDER BY id DESC LIMIT 0, :offset');
            $query->bindValue(':offset', $pOffset , PDO::PARAM_INT);
            $query->setFetchMode(PDO::FETCH_OBJ);
            $query->execute();
        } catch (PDOException $e) {
            exit(
                    "Erreur lors de l'exécution de la requête SQL :<br />\n" .
                    $e->getMessage() . "<br />requête = SELECT");
        }
        return $query;
    }

    /**
     * ***********************************************
     * INSERTS
     * ************************************************
     */
    /*
     * @but: Ajouter un utilisateur dans la base de données.
     * @Param: user $pUser Un objet utilisateur.
     * @Return: True si réussi.
     */
    public function ajouterUtilisateur (user $pUser)
    {
        if ($this->connexion == null) {
            // Va afficher un message d'erreur et terminer le script.
            exit(
                    "Erreur. Impossible d'ajouter l'utilisateur $pUser->Nom sans connexion à la base de données.");
        }
        try {
            $query = $this->connexion->prepare(
                    'INSERT INTO users (Nom, Mot_de_Passe, dateNaissance, Adresse, NoTelephone, Courriel, id_acces)
								VALUES(:nom, :mdp, :bday, :adresse, :noTel, :courriel, :acces)');
            $query->bindValue(':nom', $pUser->Nom, PDO::PARAM_STR);
            $query->bindValue(':mdp', $pUser->Mot_de_Passe, PDO::PARAM_STR);
            $query->bindValue(':bday', $pUser->dateNaissance, PDO::PARAM_STR);
            $query->bindValue(':adresse', $pUser->Adresse, PDO::PARAM_STR);
            $query->bindValue(':noTel', $pUser->NoTelephone, PDO::PARAM_STR);
            $query->bindValue(':courriel', $pUser->Courriel, PDO::PARAM_STR);
            $query->bindValue(':acces', $pUser->id_acces, PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $e) {
            exit(
                    "Erreur lors de l'exécution de la requête SQL :<br />\n" .
                             $e->getMessage() . "<br />requête = INSERT");
        }
        $resultat = $query ? "L'ajout de $pUser->Nom a été effectuée avec succès." :
        "L'ajout de $pUser->Nom n'a pas été effectuée.";
        // Fermeture du curseur.
        $query->closeCursor ();
        return $resultat;
    }

    /*
     * @but: Ajouter un film dans la base de données.
     * @Param: film $pFilm Un objet film.
     * @Return: True si réussi.
     */
    public function ajouterFilm (film $pFilm)
    {
        if ($this->connexion == null) {
            // Va afficher un message d'erreur et terminer le script.
            exit(
                    "Erreur. Impossible d'ajouter le film $pFilm->Nom sans connexion à la base de données.");
        }
        try {
            $query = $this->connexion->prepare(
                    'INSERT INTO films (Nom, Description, Image)
								VALUES(:nom, :desc, :img)');
            $query->bindValue(':nom', $pFilm->Nom, PDO::PARAM_STR);
            $query->bindValue(':desc', $pFilm->Description, PDO::PARAM_STR);
            $query->bindValue(':img', $pFilm->Image, PDO::PARAM_STR);
            $query->execute();
        } catch (PDOException $e) {
            exit(
                    "Erreur lors de l'exécution de la requête SQL :<br />\n" .
                             $e->getMessage() . "<br />requête = INSERT");
        }
        $resultat = $query ? "L'ajout du film $pFilm->Nom a été effectuée avec succès." :
        "Erreur. L'ajout du $pFilm->Nom n'a pas été effectuée.";
        
        // Fermeture du curseur.
        $query->closeCursor ();
        return $resultat;
    }

    /**
     * ***********************************************
     * UPDATES
     * ************************************************
     */
    /*
     * @but: Modifier un utilisateur dans la base de données.
     * @Param: user $pUser Un objet utilisateur.
     */
    public function modifierUtilisateur (user $pUser)
    {
        if ($this->connexion == null) {
            // Va afficher un message d'erreur et terminer le script.
            exit(
                    "Erreur. Impossible de modifier l'utilisateur $pUser->Nom sans connexion à la base de données.");
        }
        try {
            $query = $this->connexion->prepare(
                    'UPDATE users SET Nom = :nom, Mot_de_Passe = :mdp, dateNaissance = :bday, Adresse = :adresse,
                    NoTelephone = :noTel, Courriel = :courriel, id_acces = :acces 
                    WHERE Id = :id');
            
            $query->bindValue(':nom', $pUser->Nom, PDO::PARAM_STR);
            $query->bindValue(':mdp', $pUser->Mot_de_Passe, PDO::PARAM_STR);
            $query->bindValue(':bday', $pUser->dateNaissance, PDO::PARAM_STR);
            $query->bindValue(':adresse', $pUser->Adresse, PDO::PARAM_STR);
            $query->bindValue(':noTel', $pUser->NoTelephone, PDO::PARAM_STR);
            $query->bindValue(':courriel', $pUser->Courriel, PDO::PARAM_STR);
            $query->bindValue(':acces', $pUser->id_acces, PDO::PARAM_INT);
            $query->bindValue(':id', $pUser->Id, PDO::PARAM_INT);
            $retour = $query->execute();
        } catch (PDOException $e) {
            exit(
                    "Erreur lors de l'exécution de la requête SQL :<br />\n" .
                             $e->getMessage() . "<br />requête = Update");
        }
        $resultat = $retour && $query->rowCount() !== 0 ? "La modification de l'utilisateur $pUser->Nom a été effectuée avec succès." :
        "Erreur. La modification de l'utilisateur $pUser->Nom n'a pas été effectuée.";
        
        // Fermeture du curseur.
        $query->closeCursor ();
        return $resultat;
    }

    /*
     * @but: Modifier un film dans la base de données.
     * @Param: film $pFilm Un objet film.
     */
    public function modifierFilm (film $pFilm)
    {
        if ($this->connexion == null) {
            // Va afficher un message d'erreur et terminer le script.
            exit(
                    "Erreur. Impossible d'ajouter le film $pFilm->Nom sans connexion à la base de données.");
        }
        try {
            $query = $this->connexion->prepare(
                    'UPDATE films SET Nom = :nom, SET Description = :desc, SET Image = :img
                    WHERE Id = :id');
            
            $query->bindValue(':nom', $pFilm->Nom, PDO::PARAM_STR);
            $query->bindValue(':desc', $pFilm->Description, PDO::PARAM_STR);
            $query->bindValue(':img', $pFilm->Image, PDO::PARAM_STR);
            $query->bindValue(':id', $pFilm->Id, PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $e) {
            exit(
                    "Erreur lors de l'exécution de la requête SQL :<br />\n" .
                             $e->getMessage() . "<br />requête = INSERT");
        }
         $resultat = $query ? "La modification du film $pFilm->Nom a été effectuée avec succès." :
        "Erreur. La modification $pFilm->Nom n'a pas été effectuée.";
         
         // Fermeture du curseur.
         $query->closeCursor ();
        return $resultat;
    }

    /**
     * ***********************************************
     * DELETES
     * ************************************************
     */
    
    /*
     * @but: supprimer un utilisateur contenu dans la base de données.
     * @Param: film $pFilm Un objet user.
     */
    public function supprimerUtilisateur (user $pUser)
    {
        if ($this->connexion == null) {
            // Va afficher un message d'erreur et terminer le script.
            exit(
                    "Erreur. Impossible de supprimer l'utilisateur $pUser->Nom sans connexion à la base de données.");
        }
        try {
            $query = $this->connexion->prepare('DELETE FROM users WHERE Id = :id');
            $query->bindValue(':id', $pUser->Id, PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $e) {
            exit(
                    "Erreur lors de l'exécution de la requête SQL :<br />\n" .
                             $e->getMessage() . "<br />requête = DELETE");
        }
         $resultat = $query ? "La suppression de l'utilisateur $pUser->Nom a été effectuée avec succès." :
        "Erreur. La suppression de l'utilisateur $pUser->Nom n'a pas été effectuée.";
         
         // Fermeture du curseur.
         $query->closeCursor ();
        return $resultat;
    }

    /*
     * @but: supprimer un film contenu dans la base de données.
     * @Param: film $pFilm Un objet film.
     */
    public function supprimerFilm (film $pFilm)
    {
        if ($this->connexion == null) {
            // Va afficher un message d'erreur et terminer le script.
            exit(
                    "Erreur. Impossible de supprimer le film $pFilm->Nom sans connexion à la base de données.");
        }
        try {
            $query = $this->connexion->prepare('DELETE FROM films WHERE Id = :id');
            $query->bindValue(':id', $pFilm->Id, PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $e) {
            exit(
                    "Erreur lors de l'exécution de la requête SQL :<br />\n" .
                    $e->getMessage() . "<br />requête = DELETE");
        }
         $resultat = $query ? "La suppression du film $pFilm->Nom a été effectuée avec succès." :
        "Erreur. La suppression $pFilm->Nom n'a pas été effectuée.";
         
         // Fermeture du curseur.
         $query->closeCursor ();
        return $resultat;
    }
}
?>

