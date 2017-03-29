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

			// message pour l'utilisateur
			// $GLOBALS["contactRetour"] = "<p class='bg-success'>Merci $prenom, votre message est bien envoyé !</p>";
			$GLOBALS["contactRetour"] = "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Merci $prenom, votre message a bien été envoyé !</p>";
		}

		else{
			// $GLOBALS["contactRetour"] = "Il manque des informations";
			$GLOBALS["contactRetour"] = "<span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Il manque des informations !</p>";
		}




	}//function
} //class contact


//envoie du message
// if (count($_REQUEST) > 0)
// {
//     // RECUPERER LES INFOS DU FORMULAIRE
//     $email = $_REQUEST["email"];
    
//     // STOCKER L'INFO DANS UN FICHIER
//     file_put_contents("../../newsletter.csv", "$email\n", FILE_APPEND);

//     $headers = 'From: webmaster@example.com' . "\r\n" .
//      'Reply-To: webmaster@example.com' . "\r\n" .
//      'X-Mailer: PHP/' . phpversion();
     
//     mail(   "webmaster@mail.me", 
//             "nouveau inscrit à la newsletter", 
//             "$email s'est inscrit",
//             $headers );
// }

?>