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
	   	//SECURITE
		//SEULEMENT LES ROLES ADMIN PEUVENT VOIR LA PAGE
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
	public function modifierLivre($id)
    {
    	// Le paramètre $id est fourni par le Framework W en extrayant l'info depuis l'url [i:id]
    	$GLOBALS["livreUpdateRetour"] = "";

		//Contoller 
		// Traitement du formulaire
		$idForm = $this->verifierSaisie("idForm");
		if ($idForm == "livreUpdate")
		{
			// Activer le code pour traiter le formulaire
			$this->livreUpdateTraitement();
		}

    	// View
    	// Afficher la page
    	$this->show("page/admin-modifier-livre", 
    				["livreUpdateRetour" => $GLOBALS["livreUpdateRetour"] ]);
    }



}