<?php

namespace Controller;

class AdminDamienController 
    extends FormController  // ON HERITE DE LA CLASSE FormController 
                            // QUI HERITE DE LA CLASSE W\Controller\Controller
{
    // METHODE
    
	/**
	 * Page de accueil de l'admin
	 */
	public function accueil()
	{
	   
		$this->show('page/admin-accueil');
	}

	

}