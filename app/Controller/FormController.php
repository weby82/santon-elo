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
     function __construct ()
    {
        // CETTE METHODE SERA APPELEE PAR TOUTES LES ROUTES
        // CAR LA ROUTE PRECISE QUELLE CLASSE ET QUELLE METHODE APPELER
        // DONC LE FRAMEWORK W DOIT CREER UN OBJET DE CETTE CLASSE
        // AVANT D'ACTIVER LA METHODE
        // ET LES CLASSES DANS LES ROUTES HERITENT DE CETTE CLASSE
        // FormController
        // DONC LA METHODE __construct DE LA CLASSE FormController
        // EST AUSSI APPELEE A LA CREATION DE L'OBJET...
        
        // ON PEUT DONC AJOUTER ICI LE CODE QU'ON VEUT ACTIVER
        // POUR TOUTES LES ROUTES...
        
        // APPELER LE CONSTRUCTEUR DU parent
        // POUR CONTINUER A GARDER LA MECANIQUE DU FRAMEWORK W
        // parent::__construct();
        
        // TRAITEMENT DU FORMULAIRE
        $idFormClasse  = $this->verifierSaisie("idFormClasse");
        $idFormMethode = $this->verifierSaisie("idFormMethode");
        
        // UN PEU DE SECURITE...
        // JE VAIS COMPLETER LE CHEMIN VERS LE NAMESPACE DE LA CLASSE
        $idFormClasse  = "\Controller\Traitement\\$idFormClasse";
        
        if ( ($idFormClasse != "") && ($idFormMethode != "") )
        {
            // ON A UN FORMULAIRE A TRAITER
            // ON CHERCHE SI IL Y A UNE CLASSE AVEC LA METHODE DEMANDEE
            // http://php.net/manual/fr/function.method-exists.php
            if (method_exists($idFormClasse, $idFormMethode))
            {
                // ON PEUT APPELER LA METHODE
                // ON CREE UN OBJET
                // ET AVEC L'OBJET ON APPELLE LA METHODE
                
                // ASTUCE:
                // CREATION DYNAMIQUE D'OBJET
                // ET APPEL DYNAMIQUE A UNE METHODE
                // http://php.net/manual/fr/language.oop5.basic.php
                $objet = new $idFormClasse;
                // $this EST L'OBJET DE CLASSE FormController
                $objet->$idFormMethode($this);
            }
        }
        
    }
    
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


    // PAGINATION
    function calculerNombreLigne ($nomTable)
{
    $resultat = 0;
    
    // ON VA CALCULER LE NOMBRE DE LIGNE DANS LA TABLE $nomTable
    // https://sql.sh/fonctions/agregation/count
    $requeteSQL = "SELECT COUNT(id) FROM $nomTable";
    $tabToken = [];
    
    $objetPDOStatement = envoyerRequeteSQL($requeteSQL, $tabToken);
    // http://php.net/manual/fr/pdostatement.fetchcolumn.php
    $resultat = $objetPDOStatement->fetchColumn();
    $resultat = intval($resultat);
    
    return $resultat;
}


    // Verifier le champ d'upload
    function verifierUpload ($nameInput)
    {
    $cheminOK = "";
    
    // POUR LE MESSAGE DE RETOUR
    $idForm = $this->verifierSaisie("idForm");
    
    // CONTROLLER
    // VERIFIER SI IL Y A UN FICHIER UPLOADE
    // VERIFIER SI IL N'Y A PAS DE CODE D'ERREUR
    // VERIFIER LE SUFFIXE DU FICHIER 
    // (INTERDIRE .php, .asp, .jsp, etc...)
    // (AUTORISER CERTAINS SUFFIXES .jpeg, .jpg, .gif, .png, .svg, .pdf, .txt, .doc, .docx, .xls, .ppt, .pptx, .odt, .html, .css, .js, .ttf, .otf)
    // (ET NE PAS OUBLIER LES VARIANTES EN MAJUSCULES...)
    // FILTRER LE NOM DU FICHIER POUR ENLEVER LES CARACTERES BIZARRES POUR LES URLS
    // ON VA PRENDRE LA RESPONSABILITE DE SORTIR LE FICHIER DE SA QUARANTAINE
    // (IDEALEMENT IL FAUDRAIT PASSER LE FICHIER A TRAVERS UN ANTIVIRUS POUR DETECTER LES VIRUS :-/)
    // ET ON LE DEPLACE DANS LE DOSSIER assets/uploads/
    // (AVEC LE NOM FILTRE)
    
    // NOTE: 
    // POUR LES IMAGES, ON PEUT UTILISER DES FONCTIONS DE PHP
    // POUR CREER DES MINIATURES
    
    // EST-CE QUE LE TABLEAU $_FILES CONTIENT LA CLE $nameInput
    if (isset($_FILES[$nameInput]))
    {
        // EN HTML
        // <input type="file" name="upload" />
        // EN PHP
        $tabInfoFichierUploade = $_FILES[$nameInput];
        if (!empty($tabInfoFichierUploade))
        {
            $error = $tabInfoFichierUploade["error"];
            if ($error == 0)
            {
                // L'UPLOAD S'EST BIEN DEROULE
                // JE RECUPERE LES AUTRES INFOS
                $name       = $tabInfoFichierUploade["name"];
                $type       = $tabInfoFichierUploade["type"];
                $tmpName    = $tabInfoFichierUploade["tmp_name"];
                $size       = $tabInfoFichierUploade["size"];
                $categorie  = $_POST["categorie"];
                
                if ($size < 10 * 1024 * 1024) // 10 MEGAOCTETS
                {
                    // OK EN DESSOUS DE LA TAILLE LIMITE
                    // ON VERIFIE L'EXTENSION
                    // http://php.net/manual/fr/function.pathinfo.php
                    $extension = pathinfo($name, PATHINFO_EXTENSION);
                    // METTRE L'EXTENSION EN MINUSCULES
                    // http://php.net/manual/fr/function.strtolower.php
                    $extension = strtolower($extension);
                    
                    // IL FAUT VERIFIER SI L'EXTENSION EST AUTORISEE
                    $tabExtensionOK = 
                    [ 
                        "jpeg", "jpg", "gif", "png", "svg"
                        
                    ];
                    
                    // http://php.net/manual/fr/function.in-array.php
                    if (in_array($extension, $tabExtensionOK))
                    {
                        // OK EXTENSION AUTORISEE
                        // ON EST PRET A DEPLACER LE FICHIER DANS SON DOSSIER assets/uploads
                        // http://php.net/manual/fr/function.preg-replace.php
                        // TOUS LES CARACTERES QUI NE SONT DES LETTRES ENTRE a et z ou entre A et Z ou entre 0 et 9 ou qui ne sont -, _, .
                        // ALORS IL FAUT REMPLACER PAR LE CARACTERE "" (EN FAIT LES SUPPRIMER)
                        $nameOK     =  preg_replace("/[^a-zA-Z0-9-_\.]/", "", $name);


                        $cheminAssets = $this->assetUrl();
                        $cheminPhotoUrl = $cheminAssets . "img/santons/" . $categorie ."/";  
                        $cheminOK   = $cheminPhotoUrl . $nameOK;
                        
                        // TRANSFORMER LE CHEMIN OK EN MINUSCULES
                        $cheminOK = strtolower($cheminOK);
                        
                        // ON SORT LE FICHIER DE SA QUARANTAINE
                        // http://php.net/manual/fr/function.move-uploaded-file.php
                        move_uploaded_file($tmpName, $cheminOK);
                        
                    }
                    else
                    {
                        // KO
                        // EXTENSION NON AUTORISEE
                        $GLOBALS["santonCreateRetour"] = "EXTENSION NON CONFORME";
                    }
                }
                else 
                {
                    // KO
                    // FICHIER TROP VOLUMINEUX
                    $GLOBALS["santonCreateRetour"] = "FICHIER TROP VOLUMINEUX";
                }
            }
        }
    }
        
    return $cheminOK;
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

    // Création de santon
    public function santonCreateTraitement(){
        // Récupérer les infos du formulaire
        $nom          = $this->verifierSaisie("nom"); 
        $nomUrl       = $this->verifierSaisie("nom_url"); 
        $categorie    = $this->verifierSaisie("categorie"); 
        $photo        = $this->verifierUpload("photo"); 
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