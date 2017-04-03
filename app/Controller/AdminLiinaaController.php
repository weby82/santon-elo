<?php

namespace Controller;

class AdminLiinaaController 
    extends FormController  // ON HERITE DE LA CLASSE FormController 
                            // QUI HERITE DE LA CLASSE W\Controller\Controller
{
    // METHODE
    
	// Page admin du guestbook
	public function livre()
	{
		//seul l'admin peut voir cette page
		$this->allowTo('admin');

		$this->show('page/admin-livre');
	}


    
	// Ajouter un avis client
	public function creerLivre()
	{
		//SECURITE
		//SEULEMENT LES ROLES ADMIN PEUVENT VOIR LA PAGE
		$this->allowTo('admin');


		$GLOBALS["livreCreateRetour"] = "";
		// RECUPERER L'INFO idForm
	    $idForm = $this->verifierSaisie("idForm");
	    if ($idForm == "livreCreate")
	    {
	        // ACTIVER LE CODE POUR TRAITER LE FORMULAIRE artisteCreate
	        $this->livreCreateTraitement();
	    }
	    
		
		$this->show('page/admin-creer-livre', [ "livreCreateRetour" => $GLOBALS["livreCreateRetour"] ]);
	}



	// Modifier l'avis client
	public function modifierLivre($id){

		$this->allowTo('admin');

		$GLOBALS["livreUpdateRetour"] = "";

		// RECUPERER L'INFO idForm
	    $idForm = $this->verifierSaisie("idForm");
	    if ($idForm == "livreUpdate")
	    {
	        // ACTIVER LE CODE POUR TRAITER LE FORMULAIRE artisteCreate
	        $this->livreUpdateTraitement();
	    }

		$this->show('page/admin-modifier-livre', ["id" => $id, "livreUpdateRetour" =>$GLOBALS["livreUpdateRetour"]]);
	}



	public function gererLivre($id)
	{
		$this->allowTo('admin');

		$GLOBALS["livreDeleteRetour"] = "";
		// Suppression d'artiste
		$idForm = $this->verifierSaisie("idForm");
	    if ($idForm == "livreDelete"){

	    	//actuver le code pour traiter le formulaire
	    	$this->livreDeleteTraitement();
	    }
		
		$this->show('page/admin-livre', ["categorie" => $categorie, "livreDeleteRetour" => $GLOBALS["livreDeleteRetour"] ]);
	}


}