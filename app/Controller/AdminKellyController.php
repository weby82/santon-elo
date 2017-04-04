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

}