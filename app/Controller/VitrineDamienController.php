<?php

namespace Controller;

class VitrineDamienController 
    extends FormController  // ON HERITE DE LA CLASSE FormController 
                            // QUI HERITE DE LA CLASSE W\Controller\Controller
{
    // METHODE
    
	/**
	 * Page de accueil
	 */
	public function accueil()
	{
	   
		$this->show('page/index');
	}

	public function commander()
	{
	   
		$this->show('page/checkOut');
	}

	public function panier()
	{
	   
		$this->show('page/shoppingCartData');
	}

	
	/**
	 * Page des santons trié par categorie
	 */
	public function categorie($categorie)
	{
		
		$this->show('page/categorie-santons', ["categorie" => $categorie]);
	}

	/**
	 * Page par defaut des categorie si aucun n'est rentré dans l'url, on redirige vers la categorie Nativité
	 */
	public function categorieDefault()
	{
	
		$this->redirectToRoute('vitrine_categorie', ['categorie' => "nativite"]);
	}

	/**
	 * Page détail des santons
	 */
	public function santon($categorie, $nomUrl)
	{
		//mecanique du framwork W
		// On recupere la valeur du parametre de la route [:id] dans le parametre de la methode
		//debug
		//echo "Il faut afficher les détails de $id";
		// il faut transmettre l'ID pour récuperer les infos
		$this->show('page/detail-santon', ["categorie" => $categorie,
												
												"nomUrl" => $nomUrl
											]);
	}

	/**
	 * Page des commande special
	 */
	public function commandeSpeciale(){


	    $GLOBALS["commandeSpecialRetour"] = "";
	    
	    // RECUPERER L'INFO idForm
	    $idForm = $this->verifierSaisie("idForm");
	    if ($idForm == "commandeSpecialForm")
	    {
	        // ACTIVER LE CODE POUR TRAITER LE FORMULAIRE de commande special
	        $this->commandeSpecialFormTraitement();
	    }
	    

		$this->show('page/commande-speciale', ["commandeSpecialRetour" => $GLOBALS["commandeSpecialRetour"] 
											]);

	}


	/**
	 * Page paiement par cheque
	 */

	public function paiementCheque(){

	    $GLOBALS["paiementChequeRetour"] = "";
	    
	    // RECUPERER L'INFO idForm
	    $idForm = $this->verifierSaisie("idForm");
	    if ($idForm == "paiementChequeForm")
	    {
	        $this->paiementChequeFormTraitement();
	    }
	    

		$this->show('page/paiement-cheque', ["paiementChequeRetour" => $GLOBALS["paiementChequeRetour"] 
											]);

	}


}