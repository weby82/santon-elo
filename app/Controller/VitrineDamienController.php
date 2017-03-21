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

	
	public function categorie($categorie)
	{
		//mecanique du framwork W
		// On recupere la valeur du parametre de la route [:id] dans le parametre de la methode
		//debug
		//echo "Il faut afficher les détails de $id";
		// il faut transmettre l'ID pour récuperer les infos
		$this->show('page/categorie-santons', ["categorie" => $categorie]);
	}

	public function santon($categorie, $id)
	{
		//mecanique du framwork W
		// On recupere la valeur du parametre de la route [:id] dans le parametre de la methode
		//debug
		//echo "Il faut afficher les détails de $id";
		// il faut transmettre l'ID pour récuperer les infos
		$this->show('page/detail-santon', ["categorie" => $categorie,
												"id" => $id
											]);
	}

}