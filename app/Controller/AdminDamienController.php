<?php

namespace Controller;

class AdminDamienController 
    extends FormController  // ON HERITE DE LA CLASSE FormController 
                            // QUI HERITE DE LA CLASSE W\Controller\Controller
{
  

    public function login()
	{


	    $GLOBALS["loginRetour"] = "";
	    
	    // RECUPERER L'INFO idForm
	    $idForm = $this->verifierSaisie("idForm");
	    if ($idForm == "login")
	    {
	        // ACTIVER LE CODE POUR TRAITER LE FORMULAIRE de login
	        $this->loginTraitement();
	    }
	    
		
		// ON TRANSMET A LA VUE DES VARIABLES DEPUIS LE CONTROLEUR AVEC UN TABLEAU ASSOCIATIF
		// LA CLE loginRetour VA ETRE TRANSFORME EN VARIABLE LOCALE $loginRetour
		$this->show('page/admin-login', [ "loginRetour" => $GLOBALS["loginRetour"] ]);
	}

	/**
	*Page de logout
	*/
	public function logout()
	{
		// On crée un objet de la classe \W\Security\AuthentificationModel
		$objetAuthentificationModel = new \W\Security\AuthentificationModel;
		//deconnexion de la session
		$objetAuthentificationModel->logUserOut();

		// On redirige vers la page de login
		$this->redirectToRoute("login");
	}


	/**
	 * Page de accueil de l'admin
	 */
	public function accueil()
	{
	   	//SECURITE
		//SEULEMENT LES ROLES ADMIN PEUVENT VOIR LA PAGE
		$this->allowTo('admin');

		$this->show('page/admin-accueil');
	}

	
	public function santonsDefault()
	{
	
		$this->redirectToRoute('admin_gerer_santons', ['categorie' => "nativite"]);
	}

	public function gererSantons($categorie)
	{
		$this->allowTo('admin');

		$GLOBALS["santonDeleteRetour"] = "";

		// Suppression de santon
		$idForm = $this->verifierSaisie("idForm");
	    if ($idForm == "santonDelete"){

	    	//activer le code pour traiter le formulaire
	    	$this->santonDeleteTraitement();
	    }
		
		$this->show('page/admin-categorie-santons', ["categorie" => $categorie, "santonDeleteRetour" => $GLOBALS["santonDeleteRetour"] ]);
	}

	public function ajouterSanton()
	{
		//SECURITE
		$this->allowTo('admin');


		$GLOBALS["santonCreateRetour"] = "";
		// RECUPERER L'INFO idForm
	    $idForm = $this->verifierSaisie("idForm");
	    if ($idForm == "santonCreate")
	    {
	        // ACTIVER LE CODE POUR TRAITER LE FORMULAIRE santonCreate
	        $this->santonCreateTraitement();
	    }
	    
		
		$this->show('page/admin-ajouter-santon', [ "santonCreateRetour" => $GLOBALS["santonCreateRetour"] ]);
	}

	public function updateSanton($id){

		$this->allowTo('admin');

		$GLOBALS["santonUpdateRetour"] = "";

		// RECUPERER L'INFO idForm
	    $idForm = $this->verifierSaisie("idForm");
	    if ($idForm == "santonUpdate")
	    {
	        // ACTIVER LE CODE POUR TRAITER LE FORMULAIRE santonUpdate
	        $this->santonUpdateTraitement();
	    }

		$this->show('page/admin-update-santon', ["id" => $id, "santonUpdateRetour" =>$GLOBALS["santonUpdateRetour"]]);
	}

}