<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\SantonModel;

class FormController extends Controller
{
    // METHODE
    
    // EN HTML
    // <input name="toto" />
    // EN PHP
    // $toto = verifierSaisie("toto");

    public function verifierSaisie ($name)
    {
        $valeurSaisie = ""; // AU DEBUT ON A LA CHAINE VIDE
        
        // http://php.net/manual/fr/reserved.variables.request.php
        // JE VERIFIE SI L'INFO EST PRESENTE
        if (isset($_REQUEST[$name]))
        {
            // ALORS JE LA STOCKE DANS UNE VARIABLE PHP
            $valeurSaisie = $_REQUEST[$name];
            
            // FILTRER LA VALEUR POUR SE PROTEGER UN PEU
            
            // ENLEVER LES BALISES HTML ET PHP
            // http://php.net/manual/fr/function.strip-tags.php
            $valeurSaisie = strip_tags($valeurSaisie);
            
            // ENLEVER LES ESPACES VIDES AU DEBUT ET A LA FIN
            // http://php.net/manual/fr/function.trim.php
            $valeurSaisie = trim($valeurSaisie);
            
            // http://php.net/manual/fr/function.ctype-alpha.php
            // http://php.net/manual/fr/function.str-replace.php
            // http://php.net/manual/fr/function.preg-replace.php
            
        }
        
        // RENVOIE LA VALEUR DE $valeurSaisie
        return $valeurSaisie;
    
    }

    // CONTRAINTES
    // FORMAT D'UN EMAIL (nom@domaine.suffixe)
    function verifierEmail ($email)
    {
        $resultat = false;
        
        // http://php.net/manual/en/function.filter-var.php
        if ( ($email != "") && (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) )
        {
            $resultat = true;
        }
        
        return $resultat;
    }

    public function ajouterLigneTable ()
    {
        // A FAIRE PLUS TARD
    }

    public function newsletterTraitement ()
    {
        // CONTROLLER
        // IL FAUT TRAITER LE FORMULAIRE DE NEWSLETTER
        // RECUPERER LES INFOS
        $email = $this->verifierSaisie("email");
        
        // SECURITE
        // VERIFIER SI L'EMAIL EST CORRECT
        if ($this->verifierEmail($email))
        {
            // OK
            // ENREGISTRER L'EMAIL
            // JE VAIS UTILISER LA BASE DE DONNEES MYSQL
            // JE VEUX ENREGISTRER DANS LA TABLE newsletter
            // LA VALEUR $email SERA DANS LA COLONNE "email"
            $dateInscription = date("Y-m-d H:i:s");
            
            // ON DELEGUE LE TRAVAIL A UNE FONCTION DU MODEL
            // LE TABLEAU ASSOCIATIF PERMET A PHP D'ASSOCIER LES TOKENS AUX VALEURS
            // LE PLUS SIMPLE EST D'APPELER LES TOKENS AVEC LE MEME NOM QUE LA COLONNE
            // COLONNE => toto => TOKEN => :toto
            //$this->ajouterLigneTable("newsletter", [ "email" => $email, "date" => $dateInscription ]);
                
            // AVEC LE FRAMEWORK W
            // ON VA STOCKER L'EMAIL ET LA DATE DANS LA TABLE newsletter
            //On va passer par un objet de la partie Modele
            // Pour se connecter à la table MYSQL newsletter
            //il faut utiliser un objet de la classe NewsletterModel
            // Ne pas oublier d'ajouter use Model\NewsletterModel
            $objetNewsletterModel = new NewsletterModel;
            // On utilise un tableau associatif insert(array $data, )
            $objetNewsletterModel->insert(["email" => $email, "dateInscription" => $dateInscription]);
            // ENVOYER UN EMAIL
            // POUR PREVENIR LE WEBMASTER
            // ...
            
            $GLOBALS["newsletterRetour"] = "MERCI DE VOTRE INSCRIPTION ($email)";
            
        }
        else 
        {
            // KO
            $GLOBALS["newsletterRetour"] = "ENTREZ UN EMAIL VALIDE";
        }
    
        
    }

    public function artisteCreateTraitement(){
        // Récupérer les infos du formulaire
        $nom            = $this->verifierSaisie("nom"); 
        $genreArt       = $this->verifierSaisie("genreArt"); 
        $cheminImage    = $this->verifierSaisie("cheminImage"); 
        $bio            = $this->verifierSaisie("bio"); 
        //vérifier si les infos sont correcte
        if(($nom != "") && ($genreArt != "") && ($cheminImage != "") && ($bio != "")){

             //si ok on ajoute une ligne dans la table artiste
            //avec le framwork W
            //je dois créer un objet de la classe ArtistesModel
            //(car la table mysql s'appel artistes)
            //ne pas oublier de rajouter use \Model\ArtistesModel
            $objetArtistesModel = new ArtistesModel;
            //on peu utiliser la méthode insert
            $objetArtistesModel->insert(["nom" => $nom, 
                                        "genreArt" => $genreArt, 
                                        "cheminImage" => $cheminImage, 
                                        "bio" => $bio
                                        ]);

            //Message de retour
            $GLOBALS["artisteCreateRetour"] = "Artiste $nom Ajouté";
        }
        else{
            //Message de retour
            $GLOBALS["artisteCreateRetour"] = "Information manquante";
        }
       
    }


    public function artisteUpdateTraitement(){
        // Récupérer les infos du formulaire
        $id             = $this->verifierSaisie("id");
        $nom            = $this->verifierSaisie("nom"); 
        $genreArt       = $this->verifierSaisie("genreArt"); 
        $cheminImage    = $this->verifierSaisie("cheminImage"); 
        $bio            = $this->verifierSaisie("bio"); 
        //vérifier si les infos sont correcte
        // transformer $id en nombre entier
        $id = intval($id);
        if(($id > 0) && ($nom != "") && ($genreArt != "") && ($cheminImage != "") && ($bio != "")){

             //si ok on ajoute une ligne dans la table artiste
            //avec le framwork W
            //je dois créer un objet de la classe ArtistesModel
            //(car la table mysql s'appel artistes)
            //ne pas oublier de rajouter use \Model\ArtistesModel
            $objetArtistesModel = new ArtistesModel;
            //on peu utiliser la méthode insert
            $objetArtistesModel->update(["nom"          => $nom, 
                                        "genreArt"      => $genreArt, 
                                        "cheminImage"   => $cheminImage, 
                                        "bio"           => $bio
                                        ], $id);

            //Message de retour
            //avec affichage lien vers la fiche //generateUrl permet de generer l'url de la route dans une methode
            $GLOBALS["artisteUpdateRetour"] = "Artiste Modifié. Voir la fiche de <a href='". $this->generateUrl('vitrine_afficher_artiste', ["id" => $id])."'>$nom</a>";
        }
        else{
            //Message de retour
            $GLOBALS["artisteUpdateRetour"] = "Information manquante";
        }
       
    }

    public function artisteDeleteTraitement(){
        // Récuperer l'id
        $id = $this->verifierSaisie("id");

        // Il faut que l'id soit un nombre superieur à 0
        //SECURITE : Convertir $id en nombre
        $id = intval($id);

        if ($id > 0){

            // ON Va deleguer à un objet de la classe ArtisteModel
            //le travail de supprimer la ligne correspondante à l'ID
            //Vérifier qu'on a fait le use au debut du fichier
            $objetArtistesModel = new ArtistesModel;
            $objetArtistesModel->delete($id);

            $GLOBALS["artisteDeleteRetour"] = "Artiste Supprimer";
        }else{

            $GLOBALS["artisteDeleteRetour"] = "ERREUR SUR L'ID DE L'ARTISTE A SUPPRIMER";
        }

    }

    //SETTER
    function setVar($nomVariable,$valeurVariable){
        $this->tabVariableView[$nomVariable] = $valeurVariable;
    }

   // METHODE
    // Je surcharge la methode show() de la classe parent Controller
    public function show($file, array $data = array()){
        
        //incluant le chemin vers nos vues
        $engine = new \League\Plates\Engine(self::PATH_VIEWS);

        //charge nos extensions (nos fonctions personnalisées)
        $engine->loadExtension(new \W\View\Plates\PlatesExtensions());

        $app = getApp();

        // Rend certaines données disponibles à tous les vues
        // accessible avec $w_user & $w_current_route dans les fichiers de vue
        $engine->addData(
            [
                'w_user'          => $this->getUser(),
                'w_current_route' => $app->getCurrentRoute(),
                'w_site_name'     => $app->getConfig('site_name'),
            ]
        );

        // Je peux ajouter des variables qui seront disponible dans tout les fichier view
        // $this->tabVariableView = [
        //                     "var1" => date("Y"),
        //                     ];
        
        // $this->setVar("var1", date('Y'));

        //$engine->addData($this->tabVariableView);

        // On peut ajouter des fonctions supplementaire dans la partie view
        // $engine->registerFunction('afficherDate', function(){
        //     echo date("Y");
        // });

        $engine->registerFunction('afficherVarGlob', function($nomVar){
            if (isset($GLOBALS["$nomVar"])){echo $GLOBALS["$nomVar"];};
        });


        // Retire l'éventuelle extension .php
        $file = str_replace('.php', '', $file);

        // Affiche le template
        echo $engine->render($file, $data);
        die();
    }

    public function loginTraitement(){

        // REcuperer les infos du formulaire

        $identifiant = $this->verifierSaisie("identifiant");
        $password = $this->verifierSaisie("password");

        //securite
        if (($identifiant != "") && ($password != "")){

            //on crée un objet de la classe \W\Security\AuthentificationModel
            //ce qui nous permet d'utiliser la methode isValidLoginInfo
            $objetAuthentificationModel = new \W\Security\AuthentificationModel;

            $idUser = $objetAuthentificationModel->isValidLoginInfo($identifiant, $password);

            if($idUser > 0){

                // recuperer les infos de l'utilisateur
                //requete base de donnée pour les recuperer
                //je crée un objet de la classe \W\Model\UsersModel
                $objetUsersModel = new \W\Model\UsersModel;
                // je retrouve les infos de la ligne grace à la colonne ID
                // La classe UsersModel herite de la classe Model je peu donc faire un find pour recupeerr les infos
                $tabUser = $objetUsersModel->find($idUser);

                // Je vais ajouter des infos dans la session
                $objetAuthentificationModel->logUserIn($tabUser);

                // recuperer l'username
                $username = $tabUser["username"];


                $GLOBALS["loginRetour"] = "Bienvenue $username";

                $this->redirectToRoute("admin_accueil");
            }
            else{
                 $GLOBALS["loginRetour"] = "Identifiant incorrects ";
            }
        }else{

            $GLOBALS["loginRetour"] = "Identifiant incorrects ";
        }
    }


    public function santonCreateTraitement(){
        // Récupérer les infos du formulaire
        $nom          = $this->verifierSaisie("nom"); 
        $nomUrl       = $this->verifierSaisie("nom_url"); 
        $categorie    = $this->verifierSaisie("categorie"); 
        $photo        = $this->verifierSaisie("photo"); 
        $description  = $this->verifierSaisie("description");
        $dateAjout     = date("Y-m-d H:i:s");
        //vérifier si les infos sont correcte
        if(($nom != "") && ($nomUrl != "") && ($photo != "") && ($description != "")){

             //si ok on ajoute une ligne dans la table artiste
            //avec le framwork W
            //je dois créer un objet de la classe ArtistesModel
            //(car la table mysql s'appel artistes)
            //ne pas oublier de rajouter use \Model\ArtistesModel
            $objetSantonModel = new SantonModel;
            //on peu utiliser la méthode insert
            $objetSantonModel->insert(["nom" => $nom, 
                                        "nom_url" => $nomUrl, 
                                        "categorie" => $categorie, 
                                        "photo" => $photo,
                                        "description" => $description,
                                        "date_ajout" => $dateAjout
                                        ]);

            //Message de retour
            $GLOBALS["santonCreateRetour"] = "<p class='bg-success'>Santon $nom Ajouté</p>";
        }
        else{
            //Message de retour
            $GLOBALS["santonCreateRetour"] = "Information manquante";
        }
       
    }


    public function actualiteCreateTraitement(){
       // Récupérer les infos du formulaire
       $titre    = $this->verifierSaisie("titre"); 
       $contenu  = $this->verifierSaisie("contenu"); 
       $photo    = $this->verifierSaisie("photo"); 
       $date     = date("Y-m-d H:i:s"); 
       //vérifier si les infos sont correcte
       if(($titre != "") && ($contenu != "") && ($photo != "") && ($date != "")){

            //si ok on ajoute une ligne dans la table artiste
            //avec le framwork W
            //je dois créer un objet de la classe ArtistesModel
            //(car la table mysql s'appel artistes)
            //ne pas oublier de rajouter use \Model\ArtistesModel
            $objetActualiteModel = new ActualiteModel;
            //on peu utiliser la méthode insert
            $objetActualiteModel->insert(["titre"   => $titre, 
                                          "contenu" => $contenu, 
                                          "photo"   => $photo, 
                                          "date"    => $date
                                        ]);

            //Message de retour
            $GLOBALS["actualiteCreateRetour"] = "Actualite $titre Ajouté";
        }
        else{
            //Message de retour
            $GLOBALS["actualiteCreateRetour"] = "Information manquante";
        }
       
    }

         // Admin pour les actualités
    public function actualiteUpdateTraitement(){
        // Récupérer les infos du formulaire
        $titre       = $this->verifierSaisie("titre"); 
        $contenu     = $this->verifierSaisie("contenu"); 
        $photo       = $this->verifierSaisie("photo"); 
        $date        = $this->verifierSaisie("date"); 
        //vérifier si les infos sont correcte
        // transformer $id en nombre entier
        $id = $this->verifierSaisie("id");
        $id = intval($id);


        if(($id > 0) && ($titre != "") && ($contenu != "") && ($photo != "") && ($date != "")){

             //si ok on ajoute une ligne dans la table artiste
            //avec le framwork W
            //je dois créer un objet de la classe ArtistesModel
            //(car la table mysql s'appel artistes)
            //ne pas oublier de rajouter use \Model\ArtistesModel
            $objetActualiteModel = new ActualiteModel;
            //on peu utiliser la méthode insert
            $objetActualiteModel->update(["titre"    => $titre, 
                                          "contenu"  => $contenu, 
                                          "photo"    => $photo, 
                                          "date"     => $date
                                        ], $id);

            //Message de retour
            //avec affichage lien vers la fiche //generateUrl permet de generer l'url de la route dans une methode
            $GLOBALS["actualiteUpdateRetour"] = "Actualité Modifié ($titre)";
        }
        else{
            //Message de retour
            $GLOBALS["actualiteUpdateRetour"] = "Information(s) manquante(s)";
        }
       
    }

    public function actualiteDeleteTraitement(){
        // Récuperer l'id
        $id = $this->verifierSaisie("id");

        // Il faut que l'id soit un nombre superieur à 0
        //SECURITE : Convertir $id en nombre
        $id = intval($id);

        if ($id > 0){

            // ON Va deleguer à un objet de la classe ArtisteModel
            //le travail de supprimer la ligne correspondante à l'ID
            //Vérifier qu'on a fait le use au debut du fichier
            $objetActualiteModel = new ActualiteModel;
            $objetActualiteModel->delete($id);

            $GLOBALS["actualiteDeleteRetour"] = "Actualité Supprimer";
        }else{

            $GLOBALS["actualiteDeleteRetour"] = "ERREUR SUR L'ID DE L'ACTUALITE A SUPPRIMER";
        }

    }


    // Admin pour les évènements
    public function evenementCreateTraitement(){
        // Récupérer les infos du formulaire
        $titre         = $this->verifierSaisie("titre"); 
        $lieu          = $this->verifierSaisie("lieu"); 
        $dateStart     = $this->verifierSaisie("date_event_start"); 
        $dateEnd       = $this->verifierSaisie("date_event_end"); 
        $description   = $this->verifierSaisie("description"); 
        $photo         = $this->verifierSaisie("photo"); 
        $date          = $this->verifierSaisie("date_publication"); 

        //vérifier si les infos sont correcte
        if(($titre != "") 
            && ($lieu != "") 
                && ($dateStart != "") 
                    && ($dateEnd != "") 
                        && ($description != "") 
                            && ($photo != "") 
                                && ($date != "")){

             //si ok on ajoute une ligne dans la table artiste
            //avec le framwork W
            //je dois créer un objet de la classe ArtistesModel
            //(car la table mysql s'appel artistes)
            //ne pas oublier de rajouter use \Model\ArtistesModel
            $objetEvenementsModel = new EvenementsModel;
            //on peu utiliser la méthode insert
            $objetEvenementsModel->insert(["titre"            => $titre, 
                                          "lieu"             => $lieu, 
                                          "date_event_start" => $dateStart,
                                          "date_event_end"   => $dateEnd,
                                          "photo"            => $photo, 
                                          "date_publication"             => $date
                                        ]);

            //Message de retour
            $GLOBALS["evenementCreateRetour"] = "Evenement $titre Ajouté";
        }
        else{
            //Message de retour
            $GLOBALS["evenementCreateRetour"] = "Information manquante";
        }
       
    }

    public function evenementUpdateTraitement(){
        // Récupérer les infos du formulaire
        $id              = $this->verifierSaisie("id");
        $titre           = $this->verifierSaisie("titre"); 
        $lieu            = $this->verifierSaisie("lieu");
        $dateStart       = $this->verifierSaisie("date_event_start"); 
        $dateEnd         = $this->verifierSaisie("date_event_end"); 
        $description      = $this->verifierSaisie("description"); 
        $photo            = $this->verifierSaisie("photo"); 
        $date             = $this->verifierSaisie("date_publication"); 

        //vérifier si les infos sont correcte
        // transformer $id en nombre entier
        $id = intval($id);
        if(($id > 0) 
            && ($titre != "") 
                && ($lieu != "")
                    && ($dateStart != "")
                        && ($dateEnd != "")
                            && ($description != "") 
                                && ($photo != "") 
                                    && ($date != "")){

             //si ok on ajoute une ligne dans la table artiste
            //avec le framwork W
            //je dois créer un objet de la classe ArtistesModel
            //(car la table mysql s'appel artistes)
            //ne pas oublier de rajouter use \Model\ArtistesModel
            $objetEvenementsModel = new EvenementsModel;
            //on peu utiliser la méthode insert
            $objetEvenementsModel->update(["titre"                => $titre,
                                           "lieu"                 => $lieu,
                                           "date_event_start"     => $dateStart,
                                           "date_event_end"       => $dateEnd, 
                                           "description"          => $description, 
                                           "photo"                => $photo, 
                                           "date_publication"     => $date
                                        ], $id);

            //Message de retour
            //avec affichage lien vers la fiche //generateUrl permet de generer l'url de la route dans une methode
            $GLOBALS["evenementUpdateRetour"] = "Evènement Modifié. Voir la fiche de <a href='". $this->generateUrl('vitrine_evenements', ["id" => $id])."'>$titre</a>";
        }
        else{
            //Message de retour
            $GLOBALS["evenementUpdateRetour"] = "Information manquante";
        }
       
    }

    public function evenementDeleteTraitement(){
        // Récuperer l'id
        $id = $this->verifierSaisie("id");

        // Il faut que l'id soit un nombre superieur à 0
        //SECURITE : Convertir $id en nombre
        $id = intval($id);

        if ($id > 0){

            // ON Va deleguer à un objet de la classe ArtisteModel
            //le travail de supprimer la ligne correspondante à l'ID
            //Vérifier qu'on a fait le use au debut du fichier
            $objetEvenementModel = new EvenementModel;
            $objetEvenementModel->delete($id);

            $GLOBALS["evenementDeleteRetour"] = "Evènement Supprimer";
        }else{

            $GLOBALS["evenementDeleteRetour"] = "ERREUR SUR L'ID DE L'EVENEMENT A SUPPRIMER";
        }

    }

}