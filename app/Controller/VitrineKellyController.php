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

		 // public function actualiteCreateTraitement(){
   //      // Récupérer les infos du formulaire
   //      $titre    = $this->verifierSaisie("titre"); 
   //      $contenu  = $this->verifierSaisie("contenu"); 
   //      $photo    = $this->verifierSaisie("photo"); 
   //      $date     = $this->verifierSaisie("date"); 
   //      //vérifier si les infos sont correcte
   //      if(($titre != "") && ($contenu != "") && ($photo != "") && ($date != "")){

   //           //si ok on ajoute une ligne dans la table artiste
   //          //avec le framwork W
   //          //je dois créer un objet de la classe ArtistesModel
   //          //(car la table mysql s'appel artistes)
   //          //ne pas oublier de rajouter use \Model\ArtistesModel
   //          $objetActualiteModel = new ActualiteModel;
   //          //on peu utiliser la méthode insert
   //          $objetActualiteModel->insert(["titre"   => $titre, 
   //                                        "contenu" => $contenu, 
   //                                        "photo"   => $photo, 
   //                                        "date"    => $date
   //                                      ]);

   //          //Message de retour
   //          $GLOBALS["actualiteCreateRetour"] = "Actualite $titre Ajouté";
   //      }
   //      else{
   //          //Message de retour
   //          $GLOBALS["actualiteCreateRetour"] = "Information manquante";
   //      }
       
   //  }

	// public function actualiteUpdateTraitement(){
 //        // Récupérer les infos du formulaire
 //        $id          = $this->verifierSaisie("id");
 //        $titre       = $this->verifierSaisie("titre"); 
 //        $contenu     = $this->verifierSaisie("contenu"); 
 //        $photo       = $this->verifierSaisie("photo"); 
 //        $date        = $this->verifierSaisie("date"); 
 //        //vérifier si les infos sont correcte
 //        // transformer $id en nombre entier
 //        $id = intval($id);
 //        if(($id > 0) && ($titre != "") && ($contenu != "") && ($photo != "") && ($date != "")){

 //             //si ok on ajoute une ligne dans la table artiste
 //            //avec le framwork W
 //            //je dois créer un objet de la classe ArtistesModel
 //            //(car la table mysql s'appel artistes)
 //            //ne pas oublier de rajouter use \Model\ArtistesModel
 //            $objetActualiteModel = new ActualiteModel;
 //            //on peu utiliser la méthode insert
 //            $objetActualiteModel->update(["titre"    => $titre, 
 //                                          "contenu"  => $contenu, 
 //                                          "photo"    => $photo, 
 //                                          "date"     => $date
 //                                        ], $id);

 //            //Message de retour
 //            //avec affichage lien vers la fiche //generateUrl permet de generer l'url de la route dans une methode
 //            $GLOBALS["actualiteUpdateRetour"] = "Actualité Modifié. Voir la fiche de <a href='". $this->generateUrl('vitrine_actualites', ["id" => $id])."'>$titre</a>";
 //        }
 //        else{
 //            //Message de retour
 //            $GLOBALS["actualiteUpdateRetour"] = "Information manquante";
 //        }
       
 //    }

	 // public function actualiteDeleteTraitement(){
  //       // Récuperer l'id
  //       $id = $this->verifierSaisie("id");

  //       // Il faut que l'id soit un nombre superieur à 0
  //       //SECURITE : Convertir $id en nombre
  //       $id = intval($id);

  //       if ($id > 0){

  //           // ON Va deleguer à un objet de la classe ArtisteModel
  //           //le travail de supprimer la ligne correspondante à l'ID
  //           //Vérifier qu'on a fait le use au debut du fichier
  //           $objetActualiteModel = new ActualiteModel;
  //           $objetActualiteModel->delete($id);

  //           $GLOBALS["actualiteDeleteRetour"] = "Actualite Supprimer";
  //       }else{

  //           $GLOBALS["actualiteDeleteRetour"] = "ERREUR SUR L'ID DE L'ACTUALITE A SUPPRIMER";
  //       }

  //   }



	// 	 public function evenementCreateTraitement(){
 //        // Récupérer les infos du formulaire
 //        $titre         = $this->verifierSaisie("titre"); 
 //        $lieu          = $this->verifierSaisie("lieu"); 
 //        $dateStart     = $this->verifierSaisie("date_event_start"); 
 //        $dateEnd       = $this->verifierSaisie("date_event_end"); 
 //        $description   = $this->verifierSaisie("description"); 
 //        $photo         = $this->verifierSaisie("photo"); 
 //        $date          = $this->verifierSaisie("date_publication"); 

 //        //vérifier si les infos sont correcte
 //        if(($titre != "") 
 //        	&& ($lieu != "") 
 //        		&& ($dateStart != "") 
 //        			&& ($dateEnd != "") 
 //        				&& ($description != "") 
 //        					&& ($photo != "") 
 //        						&& ($date != "")){

 //             //si ok on ajoute une ligne dans la table artiste
 //            //avec le framwork W
 //            //je dois créer un objet de la classe ArtistesModel
 //            //(car la table mysql s'appel artistes)
 //            //ne pas oublier de rajouter use \Model\ArtistesModel
 //            $objetEvenementsModel = new EvenementsModel;
 //            //on peu utiliser la méthode insert
 //            $objetEvenementsModel->insert(["titre"            => $titre, 
 //                                          "lieu"             => $lieu, 
 //                                          "date_event_start" => $dateStart,
 //                                          "date_event_end"   => $dateEnd,
 //                                          "photo"            => $photo, 
 //                                          "date_publication"             => $date
 //                                        ]);

 //            //Message de retour
 //            $GLOBALS["evenementCreateRetour"] = "Evenement $titre Ajouté";
 //        }
 //        else{
 //            //Message de retour
 //            $GLOBALS["evenementCreateRetour"] = "Information manquante";
 //        }
       
 //    }

	// public function evenementUpdateTraitement(){
 //        // Récupérer les infos du formulaire
 //        $id          	 = $this->verifierSaisie("id");
 //        $titre     	     = $this->verifierSaisie("titre"); 
 //        $lieu      		 = $this->verifierSaisie("lieu");
 //        $dateStart 		 = $this->verifierSaisie("date_event_start"); 
 //        $dateEnd 		 = $this->verifierSaisie("date_event_end"); 
 //        $description      = $this->verifierSaisie("description"); 
 //        $photo            = $this->verifierSaisie("photo"); 
 //        $date             = $this->verifierSaisie("date_publication"); 

 //        //vérifier si les infos sont correcte
 //        // transformer $id en nombre entier
 //        $id = intval($id);
 //        if(($id > 0) 
 //        	&& ($titre != "") 
 //        		&& ($lieu != "")
 //        			&& ($dateStart != "")
 //        				&& ($dateEnd != "")
 //        					&& ($description != "") 
 //        						&& ($photo != "") 
 //        							&& ($date != "")){

 //             //si ok on ajoute une ligne dans la table artiste
 //            //avec le framwork W
 //            //je dois créer un objet de la classe ArtistesModel
 //            //(car la table mysql s'appel artistes)
 //            //ne pas oublier de rajouter use \Model\ArtistesModel
 //            $objetEvenementsModel = new EvenementsModel;
 //            //on peu utiliser la méthode insert
 //            $objetEvenementsModel->update(["titre"                => $titre,
 //            							   "lieu"                 => $lieu,
 //            							   "date_event_start"     => $dateStart,
 //            							   "date_event_end"       => $dateEnd, 
 //                                           "description"          => $description, 
 //                                           "photo"                => $photo, 
 //                                           "date_publication"     => $date
 //                                        ], $id);

 //            //Message de retour
 //            //avec affichage lien vers la fiche //generateUrl permet de generer l'url de la route dans une methode
 //            $GLOBALS["evenementUpdateRetour"] = "Evènement Modifié. Voir la fiche de <a href='". $this->generateUrl('vitrine_evenements', ["id" => $id])."'>$titre</a>";
 //        }
 //        else{
 //            //Message de retour
 //            $GLOBALS["evenementUpdateRetour"] = "Information manquante";
 //        }
       
 //    }

	//  public function evenementDeleteTraitement(){
 //        // Récuperer l'id
 //        $id = $this->verifierSaisie("id");

 //        // Il faut que l'id soit un nombre superieur à 0
 //        //SECURITE : Convertir $id en nombre
 //        $id = intval($id);

 //        if ($id > 0){

 //            // ON Va deleguer à un objet de la classe ArtisteModel
 //            //le travail de supprimer la ligne correspondante à l'ID
 //            //Vérifier qu'on a fait le use au debut du fichier
 //            $objetEvenementModel = new EvenementModel;
 //            $objetEvenementModel->delete($id);

 //            $GLOBALS["evenementDeleteRetour"] = "Evènement Supprimer";
 //        }else{

 //            $GLOBALS["evenementDeleteRetour"] = "ERREUR SUR L'ID DE L'EVENEMENT A SUPPRIMER";
 //        }

 //    }


}