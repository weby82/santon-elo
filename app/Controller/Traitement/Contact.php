<?php 

namespace Controller\Traitement;
use Controller\Recaptcha;
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


			// Je crée un objet de la class ReCaptcha avec ma clé secrete en parametre
			$captcha = new Recaptcha('6LeIMBsUAAAAACIMoHkDpf3ZUvDEsGDiynFlySG6');	
			

			// Si Ën retour du captcha j'ai la reponse False je n'envoi pas le formulaire.
			if($captcha->checkCode($_POST['g-recaptcha-response']) === false){

				$GLOBALS["contactRetour"] = "<span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Le captcha ne semble pas valide";
			}else{

				//envoie du message
				$mailDestinataire = "damien.bouvier@gmail.com";
				if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mailDestinataire)) // On filtre les serveurs qui présentent des bogues.
				{
					$passage_ligne = "\r\n";
				}
				else
				{
					$passage_ligne = "\n";
				}
				//=====Déclaration des messages au format texte et au format HTML.
				$message_txt = "Message de $prenom $nom." . $passage_ligne . "Email : $email" . $passage_ligne . "Objet du message : " . $sujet . $passage_ligne . $passage_ligne . $message;
				$message_html = "<html><head></head><body>Message de $prenom $nom<br /> Email : $email <br /><br /> Objet du message : $sujet <br /><br /> $message</body></html>";
				//==========
				 
				 
				//=====Création de la boundary.
				$boundary = "-----=".md5(rand());
				$boundary_alt = "-----=".md5(rand());
				//==========
				 
				//=====Définition du sujet.
				$sujet = "Contact depuis le site Santon Elo";
				//=========
				 
				//=====Création du header de l'e-mail.
				$header = "From: \"". $prenom ." ". $nom ."\"<".$email.">".$passage_ligne;
				$header.= "Reply-to: \"". $prenom ." ". $nom ."\"<".$email.">".$passage_ligne;
				$header.= "MIME-Version: 1.0".$passage_ligne;
				$header .= "X-Priority: 2".$passage_ligne;
				$header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
				//==========
				 
				//=====Création du message.
				$message = $passage_ligne."--".$boundary.$passage_ligne;
				$message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
				$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
				//=====Ajout du message au format texte.
				$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
				$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
				$message.= $passage_ligne.$message_txt.$passage_ligne;
				//==========
				 
				$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
				 
				//=====Ajout du message au format HTML.
				$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
				$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
				$message.= $passage_ligne.$message_html.$passage_ligne;
				//==========
				 
				//=====On ferme la boundary alternative.
				$message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
				//==========
				 
				 
				 
				$message.= $passage_ligne."--".$boundary.$passage_ligne;
				 
				
				//=====Envoi de l'e-mail.
				mail($mailDestinataire,$sujet,$message,$header);
				 
				//==========

				   
				
				// message pour l'utilisateur
				$GLOBALS["contactRetour"] = "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Merci $prenom, votre message a bien été envoyé !";

				// Je vide les champs du formulaire
				$nom = $prenom = $email = $message = $sujet = NULL;
                unset($_POST);


			} //end test captcha


		} //Si les champs ne sont pas tous rempli je fais le else

		else{
			// $GLOBALS["contactRetour"] = "Il manque des informations";
			$GLOBALS["contactRetour"] = "<span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Il manque des informations !";
		}




	}//function
} //class contact


 // $headers = "From: $email" . "\r\n" .
	// 		     'Reply-To: webmaster@example.com' . "\r\n" .
	// 		     'X-Mailer: PHP/' . phpversion();
			     
	// 		    mail(   "webmaster@mail.me", 
	// 		            "$Contacte depuis le site Santon Elo", 
	// 		            "$contenuMail",
	// 		            $headers );

?>