<?php 

namespace Controller\Traitement;

class Contact{

	function contactTraitement($formController){

		// Récupération des informations du formulaire de contact
		$nom			= $formController->verifierSaisie("nom");
		$prenom			= $formController->verifierSaisie("prenom");
		$email			= $formController->verifierSaisie("email");
		$sujet			= $formController->verifierSaisie("sujet");
		$message		= $formController->verifierSaisie("message");

		// Sécurité
		if ( $formController->verifierEmail($email)
										&& ($nom != "")
										&& ($prenom != "")
										&& ($sujet != "")
										&& ($message != "") ){
		
		{

			// message pour l'utilisateur
		$GLOBALS["contactRetour"] = "Merci $nom";
		}

		else{
			$GLOBALS["contactRetour"] = "Il manque des informations";
		}




	}//function
} //class contact

?>