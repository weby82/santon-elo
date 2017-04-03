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
	 * Page d'actualité de l'admin
	 */
	public function evenements()
	{
	    $this->allowTo('admin');
		$this->show('page/admin-evenements');
	}

	
	/**
	 * Page de /admin/modifier/artiste/[i:id]
	 */
    public function modifierActualites($id)
    {
    	$this->allowTo('admin');
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
    				["id" => $id, "actualiteUpdateRetour" => $GLOBALS["actualiteUpdateRetour"]
    				]);
    }
    
    
	/**
	 * Page de /admin/artistes
	 */
	public function gererActualites()
	{
		$this->allowTo('admin');

		$GLOBALS["actualiteDeleteRetour"] = "";
		// Suppression d'artiste
		$idForm = $this->verifierSaisie("idForm");
	    if ($idForm == "actualiteDelete"){

	    	//actuver le code pour traiter le formulaire
	    	$this->actualiteDeleteTraitement();
	    }
		
		$this->show('page/admin-actualites', ["actualiteDeleteRetour" => $GLOBALS["actualiteDeleteRetour"] ]);
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
	

	public function creerEvenement()
	{
		$this->allowTo('admin');

		$GLOBALS["evenementCreateRetour"] = "";

		$idForm = $this->verifierSaisie("idForm");
		if($idForm == "evenementCreate")
		{
			$this->evenementCreateTraitement();
		}

		$this->show('page/admin-creation-evenement', ["evenementCreateRetour" => $GLOBALS["evenementCreateRetour"] ]);
	}


	 /**
	 * Page de /admin/modifier/artiste/[i:id]
	 */
    public function modifierEvenement($id)
    {
    	$this->allowTo('admin');
    	// Le paramètre $id est fourni par le Framework W en extrayant l'info depuis l'url [i:id]
    	$GLOBALS["evenementUpdateRetour"] = "";

		//Contoller 
		// Traitement du formulaire
		$idForm = $this->verifierSaisie("idForm");
		if ($idForm == "evenementUpdate")
		{
			// Activer le code pour traiter le formulaire
			$this->evenementUpdateTraitement();
		}

    	// View
    	// Afficher la page
    	$this->show("page/admin-modifier-evenement", 
    				["id" => $id, "evenementUpdateRetour" => $GLOBALS["evenementUpdateRetour"] 
    				]);
    }


    /**
	 * Page de /admin/artistes
	 */
	public function gererEvenements()
	{
		// SECURITE
		// SEULEMENT LES ROLES admin PEUVENT VOIR CETTE PAGE
		$this->allowTo('admin');

	    // CONTROLLER
	    // TRAITEMENT DU FORMULAIRE
	    $GLOBALS["evenementDeleteRetour"] = "";
	    
	    // RECUPERER L'INFO idForm
	    $idForm = $this->verifierSaisie("idForm");
	    if ($idForm == "evenementDelete")
	    {
	    	 // ACTIVER LE CODE POUR TRAITER LE FORMULAIRE newsletter
	        $this->evenementDeleteTraitement();
	    }
		
		// ON TRANSMET A LA VUE DES VARIABLES DEPUIS LE CONTROLEUR AVEC UN TABLEAU ASSOCIATIF
		$this->show('page/admin-evenements', ["evenementDeleteRetour" => $GLOBALS["evenementDeleteRetour"] ]);
	}
}