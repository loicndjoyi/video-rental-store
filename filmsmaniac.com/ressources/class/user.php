<?php
/**
* @author: Loïc Ndjoyi
* @but: Classe représentant un utilisateur.
*/
class user implements Serializable{

	public $Id;
	public $Nom;
	public $Mot_de_Passe;
	public $dateNaissance;
	public $Adresse;
	public $NoTelephone;
	public $Courriel;
	public $id_acces;
	
	public function __construct() {
	}
 /**
  * {@inheritDoc}
  * @see Serializable::serialize()
  */
 public function serialize() {
  // TODO: Auto-generated method stub
    return serialize(array(
            'id' =>$this->Id, 'nom' =>$this->Nom, 'bday' =>$this->dateNaissance, 'adresse'=>$this->Adresse, 
            'notel'=>$this->NoTelephone, 'courriel'=>$this->Courriel, 'acces' =>$this->id_acces));
 }

 /**
  * {@inheritDoc}
  * @see Serializable::unserialize()
  */
 public function unserialize($pSerialized) {
  // TODO: Auto-generated method stub
    $donnees = unserialize($pSerialized);
    $this->Id = $donnees['id'];
    $this->Nom = $donnees['nom'];
    $this->dateNaissance = $donnees['bday'];
    $this->Adresse = $donnees['adresse'];
    $this->NoTelephone = $donnees['notel'];
    $this->Courriel = $donnees['courriel'];
    $this->id_acces = $donnees['acces'];
 }

}
?>