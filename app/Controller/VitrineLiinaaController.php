<?php

namespace Controller;

class VitrineLiinaaController 
    extends FormController  // ON HERITE DE LA CLASSE FormController 
                            // QUI HERITE DE LA CLASSE W\Controller\Controller
{
    // METHODE
    
	
	public function contact()
	{
		
		$this->show('page/contact');
	}




}