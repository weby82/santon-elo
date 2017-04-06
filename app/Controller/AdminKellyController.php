<?php

namespace Controller;

class AdminKellyController 
    extends FormController  
                            
{   /**
	 * Page d'actualité de l'admin
	 */
	public function actualites()
	{
	    $this->allowTo('admin');
		$this->show('page/admin-actualites');
	}

	/**
	 * Page des évènements de l'admin
	 */
	public function evenements()
	{
	    $this->allowTo('admin');
		$this->show('page/admin-evenements');
	}

	
	/**
	 * Page de /admin/modifier/actualite/[:id]
	 */
    public function modifierActualites($id)
    {
    	$this->allowTo('admin');
    	// Le paramètre $id est fourni par le Framework W en extrayant l'info depuis l'url [:id]
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
	 * Page de /admin/liste/actualite
	 */
	public function gererActualites()
	{
		$this->allowTo('admin');

		$GLOBALS["actualiteDeleteRetour"] = "";
		// Suppression des actualités
		$idForm = $this->verifierSaisie("idForm");
	    if ($idForm == "actualiteDelete"){

	    	//activer le code pour traiter le formulaire
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
	 * Page de /admin/modifier/evenement/[:id]
	 */
    public function modifierEvenement($id)
    {
    	$this->allowTo('admin');
    	// Le paramètre $id est fourni par le Framework W en extrayant l'info depuis l'url [:id]
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
	 * Page de /admin/evenements
	 */
	public function gererEvenements()
	{
		// Securite
		$this->allowTo('admin');

	    $GLOBALS["evenementDeleteRetour"] = "";
	    
	    // Récupérer l'info idForm
	    $idForm = $this->verifierSaisie("idForm");
	    if ($idForm == "evenementDelete")
	    {
	        $this->evenementDeleteTraitement();
	    }
		
		$this->show('page/admin-evenements', ["evenementDeleteRetour" => $GLOBALS["evenementDeleteRetour"] ]);
	}
}