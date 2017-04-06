<?php

namespace Controller;

class AdminLiinaaController 
    extends FormController  // On hérite de la classe FormController 
                            
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
		//Securité
		$this->allowTo('admin');


		$GLOBALS["livreCreateRetour"] = "";
		// Récupérer l'info idForm
	    $idForm = $this->verifierSaisie("idForm");
	    if ($idForm == "livreCreate")
	    {
	        // Activer le code pour traiter le formulaire livreCreate
	        $this->livreCreateTraitement();
	    }
	    
		
		$this->show('page/admin-creer-livre', [ "livreCreateRetour" => $GLOBALS["livreCreateRetour"] ]);
	}



	// Modifier l'avis client
	public function modifierLivre($id){

		$this->allowTo('admin');

		$GLOBALS["livreUpdateRetour"] = "";

		// Récupérer l'info idForm
	    $idForm = $this->verifierSaisie("idForm");
	    if ($idForm == "livreUpdate")
	    {
	        // Activer le code pour traiter le formulaire livreUpdate
	        $this->livreUpdateTraitement();
	    }

		$this->show('page/admin-modifier-livre', ["id" => $id, "livreUpdateRetour" =>$GLOBALS["livreUpdateRetour"]]);
	}



	public function gererLivre()
	{
		$this->allowTo('admin');

		$GLOBALS["livreDeleteRetour"] = "";
		// Suppression d'un avis
		$idForm = $this->verifierSaisie("idForm");
	    if ($idForm == "livreDelete"){

	    	//activer le code pour traiter le formulaire
	    	$this->livreDeleteTraitement();
	    }
		
		$this->show('page/admin-livre', ["livreDeleteRetour" => $GLOBALS["livreDeleteRetour"] ]);
	}


}