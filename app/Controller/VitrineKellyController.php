<?php

namespace Controller;

class VitrineKellyController 
    extends FormController  // ON HERITE DE LA CLASSE FormController 
                            // QUI HERITE DE LA CLASSE W\Controller\Controller
{
    // METHODE
    
	
	public function actualites()
	{
		//mecanique du framwork W
		// On recupere la valeur du parametre de la route [:id] dans le parametre de la methode
		//debug
		//echo "Il faut afficher les détails de $id";
		// il faut transmettre l'ID pour récuperer les infos
		$this->show('page/actualites');
	}

	public function actualite($id)
	{
		$this->show('page/detail-actualite', ["id" => $id]);
	}

	public function evenements()
	{
		$this->show('page/evenements');
	}

}