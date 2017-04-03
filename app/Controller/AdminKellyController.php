<?php

namespace Controller;

class AdminKellyController 
    extends FormController  // ON HERITE DE LA CLASSE FormController 
                            // QUI HERITE DE LA CLASSE W\Controller\Controller
{
    // METHODE
    
	/**
	 * Page d'actualité de l'admin
	 */
	public function actualites()
	{
	    $this->allowTo('admin');
		$this->show('page/admin-actualites');
	}

	
	/**
	 * Page de /admin/modifier/artiste/[i:id]
	 */
    public function modifierActualites($id)
    {
    	// Le paramètre $id est fourni par le Framework W en extrayant l'info depuis l'url [i:id]
    	$GLOBALS["actualiteUpdateRetour"] = "";

		//Contoller 
		// Traitement du formulaire
		$idForm = $this->verifierSaisie("idForm");
		if ($idForm == "actualiteUpdate")
		{
			// Activer le code pour traiter le formulaire
			$this->actualiteUpdateTraitement();
		}

    	// View
    	// Afficher la page
    	$this->show("page/admin-modifier-actualite", 
    				["actualiteUpdateRetour" => $GLOBALS["actualiteUpdateRetour"] ]);
    }
    
    
	/**
	 * Page de /admin/artistes
	 */
	public function gererActualite()
	{
		// SECURITE
		// SEULEMENT LES ROLES admin PEUVENT VOIR CETTE PAGE
		$this->allowTo('admin');

	    // CONTROLLER
	    // TRAITEMENT DU FORMULAIRE
	    $GLOBALS["actualiteDeleteRetour"] = "";
	    
	    // RECUPERER L'INFO idForm
	    $idForm = $this->verifierSaisie("idForm");

	    if ($idForm == "actualiteDelete")
	    {
	    	 // ACTIVER LE CODE POUR TRAITER LE FORMULAIRE newsletter
	        $this->actualiteDeleteTraitement();
	    }
		
		// ON TRANSMET A LA VUE DES VARIABLES DEPUIS LE CONTROLEUR AVEC UN TABLEAU ASSOCIATIF
		$this->show('page/admin-actualites');
	}


	public function creerActualite()
	{
		$this->allowTo('admin');

		$GLOBALS["actualiteCreateRetour"] = "";

		$idForm = $this->verifierSaisie("idForm");
		if($idForm == "actualiteCreate")
		{
			$this->actualiteCreateTraitement();
		}

		$this->show('page/admin-creation-actualite', ["actualiteCreateRetour" => $GLOBALS["actualiteCreateRetour"] ]);
	}

}