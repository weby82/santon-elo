<?php

namespace Controller;

class AdminDamienController 
    extends FormController  // ON HERITE DE LA CLASSE FormController 
                            // QUI HERITE DE LA CLASSE W\Controller\Controller
{
    // METHODE
    


    public function login()
	{

		// CONTROLLER
	    // TRAITEMENT DU FORMULAIRE
	    $GLOBALS["loginRetour"] = "";
	    
	    // RECUPERER L'INFO idForm
	    $idForm = $this->verifierSaisie("idForm");
	    if ($idForm == "login")
	    {
	        // ACTIVER LE CODE POUR TRAITER LE FORMULAIRE newsletter
	        $this->loginTraitement();
	    }
	    
	    // VIEW
		// LA METHODE show EST DEFINIE 
		// DANS LA CLASSE PARENTE Controller
		// ON ACTIVE LA PARTIE VIEW
		
		// ON TRANSMET A LA VUE DES VARIABLES DEPUIS LE CONTROLEUR AVEC UN TABLEAU ASSOCIATIF
		// LA CLE newsletterRetour VA ETRE TRANSFORME EN VARIABLE LOCALE $newsletterRetour
		$this->show('page/admin-login', [ "loginRetour" => $GLOBALS["loginRetour"] ]);
	}

	/**
	*Page de logout
	*/
	public function logout()
	{
		// On crée un objet de la classe \W\Security\AuthentificationModel
		$objetAuthentificationModel = new \W\Security\AuthentificationModel;
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
	
		$this->redirectToRoute('vitrine_categorie', ['categorie' => "nativite"]);
	}

	public function gererSantons($categorie)
	{
		$this->allowTo('admin');

		$GLOBALS["santonDeleteRetour"] = "";
		// Suppression d'artiste
		$idForm = $this->verifierSaisie("idForm");
	    if ($idForm == "santonDelete"){

	    	//actuver le code pour traiter le formulaire
	    	$this->santonDeleteTraitement();
	    }
		
		$this->show('page/admin-categorie-santons', ["categorie" => $categorie, "santonDeleteRetour" => $GLOBALS["santonDeleteRetour"] ]);
	}

	public function ajouterSanton()
	{
		//SECURITE
		//SEULEMENT LES ROLES ADMIN PEUVENT VOIR LA PAGE
		$this->allowTo('admin');


		$GLOBALS["santonCreateRetour"] = "";
		// RECUPERER L'INFO idForm
	    $idForm = $this->verifierSaisie("idForm");
	    if ($idForm == "santonCreate")
	    {
	        // ACTIVER LE CODE POUR TRAITER LE FORMULAIRE artisteCreate
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
	        // ACTIVER LE CODE POUR TRAITER LE FORMULAIRE artisteCreate
	        $this->santonUpdateTraitement();
	    }

		$this->show('page/admin-update-santon', ["id" => $id, "santonUpdateRetour" =>$GLOBALS["santonUpdateRetour"]]);
	}

}