<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\SantonModel;
use W\View\Plates\PlatesExtensions;
use \Model\GuestbookModel;
use \Model\ActualiteModel;
use \Model\EvenementsModel;
use Controller\Recaptcha;

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
    function verifierUploadSanton ($nameInput)
    {
    $cheminOK = "";
    $cheminUrlOk = "";
    
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


                        $cheminPhotoUrl = "img/santons/" . $categorie ."/";
                        $cheminMovePhoto = "assets/img/santons/" . $categorie ."/";
                        // $cheminAssets = new PlatesExtensions;
                        // $cheminAssetUrl = $cheminAssets->assetUrl();
                          
                        // $cheminOK   = $cheminAssetUrl . $nameOK;

                        // url pour le chemin vers le dossier pour le deplacement de l'image
                         $cheminMoveOK   = $cheminMovePhoto . $nameOK;

                         // url pour la base de donnée
                         $cheminUrlOk   =  $cheminPhotoUrl . $nameOK;
                        
                        // TRANSFORMER LE CHEMIN OK EN MINUSCULES
                        $cheminUrlOk = strtolower($cheminUrlOk);
                        $cheminMoveOK = strtolower($cheminMoveOK);
                        
                        // ON SORT LE FICHIER DE SA QUARANTAINE
                        // http://php.net/manual/fr/function.move-uploaded-file.php
                        move_uploaded_file($tmpName, $cheminMoveOK);
                        
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
        
    return $cheminUrlOk;
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

    // Front - form de commande special

    public function commandeSpecialFormTraitement(){

        // Récupération des informations du formulaire de contact
        $nom            = $this->verifierSaisie("nom");
        $prenom         = $this->verifierSaisie("prenom");
        $email          = $this->verifierSaisie("email");
        $sujet          = $this->verifierSaisie("sujet");
        $message        = $this->verifierSaisie("message");

        // Sécurité
        if ( $this->verifierEmail($email)
                                        && ($nom != "")
                                        && ($prenom != "")
                                        && ($sujet != "")
                                        && ($message != "") ){

            
            // Je crée un objet de la class ReCaptcha avec ma clé secrete en parametre
            $captcha = new Recaptcha('6LeIMBsUAAAAACIMoHkDpf3ZUvDEsGDiynFlySG6');   
            
            // Si Ën retour du captcha j'ai la reponse False je n'envoi pas le formulaire.
            if($captcha->checkCode($_POST['g-recaptcha-response']) === false){

                $GLOBALS["commandeSpecialRetour"] = "<span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Le captcha ne semble pas valide";
                return false;
            }else{ // Le captcha est valide

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
                $sujet = "Commande spéciale depuis le site Santon Elo";
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
            // $GLOBALS["contactRetour"] = "<p class='bg-success'>Merci $prenom, votre message est bien envoyé !</p>";
            $GLOBALS["commandeSpecialRetour"] = "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Merci $prenom, votre message a bien été envoyé !";

                // Je vide les champs du formulaire
                $nom = $prenom = $email = $message = $sujet = NULL;
                unset($_POST);
            }
        }

        else{
            // $GLOBALS["contactRetour"] = "Il manque des informations";
            $GLOBALS["commandeSpecialRetour"] = "<span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Il manque des informations !";
        }

    }
    

     // Front - form de commande special

    public function paiementChequeFormTraitement(){

        // Récupération des informations du formulaire de contact
        $nom            = $this->verifierSaisie("nom");
        $prenom         = $this->verifierSaisie("prenom");
        $email          = $this->verifierSaisie("email");
        $tel            = $this->verifierSaisie("tel");
        $adresse        = $this->verifierSaisie("adresse");
        $codePostal     = $this->verifierSaisie("codePostal");
        $ville          = $this->verifierSaisie("ville");
        $sujet          = $this->verifierSaisie("sujet");
        $detailCommande = $this->verifierSaisie("detailCommande");
        $commentaire    = $this->verifierSaisie("commentaire");

        // Sécurité
        if ( $this->verifierEmail($email)
                                        && ($nom != "")
                                        && ($prenom != "")
                                        && ($tel != "")
                                        && ($adresse != "")
                                        && ($codePostal != "")
                                        && ($ville != "")
                                        && ($detailCommande != "") ){

            
            // Je crée un objet de la class ReCaptcha avec ma clé secrete en parametre
            $captcha = new Recaptcha('6LeIMBsUAAAAACIMoHkDpf3ZUvDEsGDiynFlySG6');   
            
            // Si Ën retour du captcha j'ai la reponse False je n'envoi pas le formulaire.
            if($captcha->checkCode($_POST['g-recaptcha-response']) === false){

                $GLOBALS["paiementChequeRetour"] = "<span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Le captcha ne semble pas valide";
                return false;
            }else{ // Le captcha est valide

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
                $message_txt = "Commande de $prenom $nom avec un paiement par chèque" . $passage_ligne . "Email : $email" . $passage_ligne . "Tel : $tel" . $passage_ligne . "Adresse : " . $passage_ligne . "$adresse" . $passage_ligne . "$codePostal $ville" . $passage_ligne . $passage_ligne . "Objet du message : " . $sujet . $passage_ligne . $passage_ligne . $detailCommande . $passage_ligne . $passage_ligne . $commentaire;
                $message_html = "<html><head></head><body>Commande de $prenom $nom avec un paiement par chèque<br /><b>Email</b> : $email <br /><b>Tel : $tel</b><br /><b>Adresse : </b><br />$adresse <br />$codePostal $ville<br /><br /> <b>Objet du message : </b>$sujet <br /><br /> <b>Commande :</b><br />$detailCommande <br /><br /><b>Commentaire :</b><br />$commentaire</body></html>";
                //==========
                 
                 
                //=====Création de la boundary.
                $boundary = "-----=".md5(rand());
                $boundary_alt = "-----=".md5(rand());
                //==========
                 
                //=====Définition du sujet.
                $sujet = "Commande depuis le site Santon Elo";
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
            // $GLOBALS["contactRetour"] = "<p class='bg-success'>Merci $prenom, votre message est bien envoyé !</p>";
            $GLOBALS["paiementChequeRetour"] = "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Merci $prenom, votre commande a bien été envoyé ! Vous recevrez rapidement une réponse !";

                // Je vide les champs du formulaire
                $nom = $prenom = $email = $message = $sujet = NULL;
                unset($_POST);
            }
        }

        else{
            // $GLOBALS["contactRetour"] = "Il manque des informations";
            $GLOBALS["paiementChequeRetour"] = "<span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Il manque des informations !";
        }

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
        $prix         = $this->verifierSaisie("prix"); 
        $categorie    = $this->verifierSaisie("categorie"); 
        $star         = $this->verifierSaisie("star"); 
        $photo        = $this->verifierUploadSanton("photo"); 
        $description  = $this->verifierSaisie("description");
        $dateAjout    = date("Y-m-d H:i:s");
        //vérifier si les infos sont correcte
        if(($nom != "") && ($nomUrl != "") && ($prix != "") && ($photo != "") && ($description != "")){

             //si ok on ajoute une ligne dans la table artiste
            //avec le framwork W
            //je dois créer un objet de la classe ArtistesModel
            //(car la table mysql s'appel artistes)
            //ne pas oublier de rajouter use \Model\ArtistesModel
            $objetSantonModel = new SantonModel;
            //on peu utiliser la méthode insert
            $objetSantonModel->insert(["nom" => $nom, 
                                        "nom_url" => $nomUrl, 
                                        "prix" => $prix, 
                                        "categorie" => $categorie, 
                                        "star" => $star, 
                                        "photo" => $photo,
                                        "description" => $description,
                                        "date_ajout" => $dateAjout
                                        ]);

            //Message de retour
           $GLOBALS["santonCreateRetour"] = "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Santon $nom Ajouté";
        }
        else{
            //Message de retour
            $GLOBALS["santonCreateRetour"] = "<span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Information manquante";
        }
       
    }

     public function santonUpdateTraitement(){
        // Récupérer les infos du formulaire
        $id             = $this->verifierSaisie("id");
        $nom          = $this->verifierSaisie("nom"); 
        $nomUrl       = $this->verifierSaisie("nom_url"); 
        $prix           = $this->verifierSaisie("prix"); 
        $categorie    = $this->verifierSaisie("categorie");
        $star         = $this->verifierSaisie("star");    
        $oldPhotoPath    = $this->verifierSaisie("oldPath"); 
        $photo        = $this->verifierUploadSanton("photo"); 
        $description  = $this->verifierSaisie("description");
        $dateAjout     = date("Y-m-d H:i:s");
        //vérifier si les infos sont correcte
        if(($nom != "") && ($nomUrl != "") && ($prix != "") && (($photo != "") || ($oldPhotoPath != "")) && ($description != "")){

             //si ok on ajoute une ligne dans la table artiste
            //avec le framwork W
            //je dois créer un objet de la classe ArtistesModel
            //(car la table mysql s'appel artistes)
            //ne pas oublier de rajouter use \Model\ArtistesModel
            $objetSantonModel = new SantonModel;
            //on peu utiliser la méthode insert

            if($photo != ""){
            $objetSantonModel->update(["nom" => $nom, 
                                        "nom_url" => $nomUrl, 
                                        "prix" => $prix, 
                                        "categorie" => $categorie, 
                                        "star" => $star,
                                        "photo" => $photo,
                                        "description" => $description,
                                        "date_ajout" => $dateAjout
                                        ], $id);
            }else{
                $objetSantonModel->update(["nom" => $nom, 
                                        "nom_url" => $nomUrl, 
                                        "prix" => $prix, 
                                        "categorie" => $categorie, 
                                        "star" => $star,
                                        "photo" => $oldPhotoPath,
                                        "description" => $description,
                                        "date_ajout" => $dateAjout
                                        ], $id);
            }

            //Message de retour
           $GLOBALS["santonUpdateRetour"] = "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Santon $nom Modifié";
        }
        else{
            //Message de retour
            $GLOBALS["santonUpdateRetour"] = "<span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Information manquante";
        }
       
    }

    public function santonDeleteTraitement(){
        // Récuperer l'id
        $id = $this->verifierSaisie("id");

        // Il faut que l'id soit un nombre superieur à 0
        //SECURITE : Convertir $id en nombre
        $id = intval($id);

        if ($id > 0){

            // ON Va deleguer à un objet de la classe ArtisteModel
            //le travail de supprimer la ligne correspondante à l'ID
            //Vérifier qu'on a fait le use au debut du fichier
            $objetsantonModel = new SantonModel;
            $objetsantonModel->delete($id);

            $GLOBALS["santonDeleteRetour"] = "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Santon Supprimé";
        }else{

            $GLOBALS["santonDeleteRetour"] = "<span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Erreur sur l'id du Santon à supprimer";
        }

    }



    public function actualiteCreateTraitement(){
       // Récupérer les infos du formulaire
       $titre    = $this->verifierSaisie("titre"); 
       $contenu  = $this->verifierSaisie("contenu"); 

       $photo        = $this->verifierUploadActualite("photo"); 
       $dateAjout     = date("Y-m-d H:i:s"); 
      
       //vérifier si les infos sont correcte
       if(($titre != "") && ($contenu != "") && ($photo != "")){

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
                                          "date"    => $dateAjout
                                        ]);

            //Message de retour
            $GLOBALS["actualiteCreateRetour"] = "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Actualite $titre créée";
        }
        else{
            //Message de retour
            $GLOBALS["actualiteCreateRetour"] = "<span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Information manquante";
        }
       
    }

     // Verifier le champ d'upload
    function verifierUploadActualite ($nameInput)
    {
    $cheminOK = "";
    $cheminUrlOk = "";
    
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


                        $cheminPhotoUrl = "img/actualites/";
                        $cheminMovePhoto = "assets/img/actualites/";
                        // $cheminAssets = new PlatesExtensions;
                        // $cheminAssetUrl = $cheminAssets->assetUrl();
                          
                        // $cheminOK   = $cheminAssetUrl . $nameOK;

                        // url pour le chemin vers le dossier pour le deplacement de l'image
                         $cheminMoveOK   = $cheminMovePhoto . $nameOK;

                         // url pour la base de donnée
                         $cheminUrlOk   =  $cheminPhotoUrl . $nameOK;
                        
                        // TRANSFORMER LE CHEMIN OK EN MINUSCULES
                        $cheminUrlOk = strtolower($cheminUrlOk);
                        $cheminMoveOK = strtolower($cheminMoveOK);
                        
                        // ON SORT LE FICHIER DE SA QUARANTAINE
                        // http://php.net/manual/fr/function.move-uploaded-file.php
                        move_uploaded_file($tmpName, $cheminMoveOK);
                        
                    }
                    else
                    {
                        // KO
                        // EXTENSION NON AUTORISEE
                        $GLOBALS["actualiteCreateRetour"] = "EXTENSION NON CONFORME";
                    }
                }
                else 
                {
                    // KO
                    // FICHIER TROP VOLUMINEUX
                    $GLOBALS["actualiteCreateRetour"] = "FICHIER TROP VOLUMINEUX";
                }
            }
        }
    }
     return $cheminUrlOk;
}

         // Admin pour les actualités
    public function actualiteUpdateTraitement(){
        // Récupérer les infos du formulaire
        $id           = $this->verifierSaisie("id");
        $titre        = $this->verifierSaisie("titre"); 
        $contenu      = $this->verifierSaisie("contenu"); 
        $photo        = $this->verifierUploadActualite("photo"); 
        $oldPhotoPath = $this->verifierSaisie("oldPath"); 
        $date         = date("Y-m-d H:i:s");
        //vérifier si les infos sont correcte
        // transformer $id en nombre entier

        if(($id > 0) && ($titre != "") && ($contenu != "") && (($photo != "") || ($oldPhotoPath != "")) && ($date != "")){

             //si ok on ajoute une ligne dans la table artiste
            //avec le framwork W
            //je dois créer un objet de la classe ArtistesModel
            //(car la table mysql s'appel artistes)
            //ne pas oublier de rajouter use \Model\ArtistesModel
            $objetActualiteModel = new ActualiteModel;
            //on peu utiliser la méthode insert

            if($photo != ""){
             $objetActualiteModel->update(["titre"    => $titre, 
                                          "contenu"  => $contenu, 
                                          "photo"    => $photo, 
                                          "date"     => $date
                                        ], 
                                        $id);
            }else{
                $objetActualiteModel->update(["titre" => $titre, 
                                          "contenu"   => $contenu, 
                                          "photo"     => $oldPhotoPath, 
                                          "date"      => $date
                                        ], 
                                        $id);
            }

            //Message de retour
            //avec affichage lien vers la fiche //generateUrl permet de generer l'url de la route dans une methode
            $GLOBALS["actualiteUpdateRetour"] = "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Actualité $titre Modifiée";
        }
        else{
            //Message de retour
            $GLOBALS["actualiteUpdateRetour"] = "<span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Information manquante";
        }
       
    }

    public function actualiteDeleteTraitement(){
        // Récuperer l'id
        $id = $this->verifierSaisie("id");

        // Il faut que l'id soit un nombre superieur à 0
        //SECURITE : Convertir $id en nombre
        $id = intval($id);

        if ($id > 0){

            // ON Va deleguer à un objet de la classe ActualiteModel
            //Vérifier qu'on a fait le use au debut du fichier
            $objetactualiteModel = new ActualiteModel;
            $objetactualiteModel->delete($id);

            $GLOBALS["actualiteDeleteRetour"] = "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Actualité Supprimée";
        }else{

            $GLOBALS["actualiteDeleteRetour"] = "<span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Erreur sur l'id de l'actualité à supprimer";
        }

    }


    // Admin pour les évènements
    public function evenementCreateTraitement(){
        // Récupérer les infos du formulaire
        $titre         = $this->verifierSaisie("titre"); 
        $lieu          = $this->verifierSaisie("lieu"); 
        $dateStart    = $this->verifierSaisie("date_event_start"); 
        $dateEnd      = $this->verifierSaisie("date_event_end"); 
        $description   = $this->verifierSaisie("description"); 

        $photo         = $this->verifierUploadEvenement("photo"); 
        $date          = date("Y-m-d H:i:s"); 

        //vérifier si les infos sont correcte
        if(($titre != "") 
            && ($lieu != "") 
                && ($dateStart != "") 
                    && ($dateEnd != "") 
                        && ($description != "") 
                            && ($photo != "")){

             //si ok on ajoute une ligne dans la table artiste
            //avec le framwork W
            //je dois créer un objet de la classe ArtistesModel
            //(car la table mysql s'appel artistes)
            //ne pas oublier de rajouter use \Model\ArtistesModel
            $objetEvenementsModel = new EvenementsModel;
            //on peu utiliser la méthode insert
            $objetEvenementsModel->insert(["titre"           => $titre, 
                                          "lieu"             => $lieu, 
                                          "date_event_start" => $dateStart,
                                          "date_event_end"   => $dateEnd,
                                          "description"      => $description,
                                          "photo"            => $photo, 
                                          "date_publication" => $date
                                        ]);

            //Message de retour
            $GLOBALS["evenementCreateRetour"] = "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Evenement $titre Ajouté";
        }
        else{
            //Message de retour
            $GLOBALS["evenementCreateRetour"] = "<span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Information manquante";
        }
       
    }


function verifierUploadEvenement ($nameInput)
    {
    $cheminOK = "";
    $cheminUrlOk = "";
    
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


                        $cheminPhotoUrl = "img/evenements/";
                        $cheminMovePhoto = "assets/img/evenements/";
                        // $cheminAssets = new PlatesExtensions;
                        // $cheminAssetUrl = $cheminAssets->assetUrl();
                          
                        // $cheminOK   = $cheminAssetUrl . $nameOK;

                        // url pour le chemin vers le dossier pour le deplacement de l'image
                         $cheminMoveOK   = $cheminMovePhoto . $nameOK;

                         // url pour la base de donnée
                         $cheminUrlOk   =  $cheminPhotoUrl . $nameOK;
                        
                        // TRANSFORMER LE CHEMIN OK EN MINUSCULES
                        $cheminUrlOk = strtolower($cheminUrlOk);
                        $cheminMoveOK = strtolower($cheminMoveOK);
                        
                        // ON SORT LE FICHIER DE SA QUARANTAINE
                        // http://php.net/manual/fr/function.move-uploaded-file.php
                        move_uploaded_file($tmpName, $cheminMoveOK);
                        
                    }
                    else
                    {
                        // KO
                        // EXTENSION NON AUTORISEE
                        $GLOBALS["evenementCreateRetour"] = "EXTENSION NON CONFORME";
                    }
                }
                else 
                {
                    // KO
                    // FICHIER TROP VOLUMINEUX
                    $GLOBALS["evenementCreateRetour"] = "FICHIER TROP VOLUMINEUX";
                }
            }
        }
    }
     return $cheminUrlOk;
}

    public function evenementUpdateTraitement(){
        // Récupérer les infos du formulaire

        $id           = $this->verifierSaisie("id");
        $titre        = $this->verifierSaisie("titre"); 
        $lieu         = $this->verifierSaisie("lieu");
        $dateStart    = $this->verifierSaisie("date_event_start");
        $dateEnd      = $this->verifierSaisie("date_event_end");  
        $description  = $this->verifierSaisie("description"); 
        $oldPhotoPath = $this->verifierSaisie("oldPath"); 
        $photo        = $this->verifierUploadEvenement("photo"); 
        $date         = date("Y-m-d H:i:s");  
        
        if(($id > 0) && ($titre != "") && ($lieu != "") && ($dateStart != "") && ($dateEnd != "") && ($description != "") && (($photo != "") || ($oldPhotoPath != "")) 
            && ($date != "")){

             //si ok on ajoute une ligne dans la table artiste
            //avec le framwork W
            //je dois créer un objet de la classe ArtistesModel
            //(car la table mysql s'appel artistes)
            //ne pas oublier de rajouter use \Model\ArtistesModel
            $objetEvenementsModel = new EvenementsModel;
            //on peu utiliser la méthode insert
            if($photo != ""){
                $objetEvenementsModel->update(["titre"                => $titre,
                                               "lieu"                 => $lieu,
                                               "date_event_start"     => $dateStart,
                                               "date_event_end"       => $dateEnd, 
                                               "description"          => $description, 
                                               "photo"                => $photo, 
                                               "date_publication"     => $date
                                            ], $id);
            }else{
               $objetEvenementsModel->update(["titre"                => $titre,
                                               "lieu"                 => $lieu,
                                               "date_event_start"     => $dateStart,
                                               "date_event_end"       => $dateEnd, 
                                               "description"          => $description, 
                                               "photo"                => $oldPhotoPath, 
                                               "date_publication"     => $date
                                            ], $id); 
            }
            //Message de retour
            //avec affichage lien vers la fiche //generateUrl permet de generer l'url de la route dans une methode
            $GLOBALS["evenementUpdateRetour"] = "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Evènement $titre Modifié";
        }
        else{
            //Message de retour
            $GLOBALS["evenementUpdateRetour"] = "<span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Information manquante";
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
            $objetEvenementsModel = new EvenementsModel;
            $objetEvenementsModel->delete($id);

            $GLOBALS["evenementDeleteRetour"] = "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Evènement Supprimé";
        }else{

            $GLOBALS["evenementDeleteRetour"] = "<span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Erreur sur l'id de l'évènement à supprimer";
        }

    }

    // Création d'un avis client (livre)
    public function livreCreateTraitement(){
        // Récupérer les infos du formulaire 
        $nom_client      = $this->verifierSaisie("nom_client"); 
        $description     = $this->verifierSaisie("description");
        $date            = date("Y-m-d");
        //vérifier si les infos sont correcte
        if(($nom_client != "") && ($description != "")){

             //si ok on ajoute une ligne dans la table artiste
            //avec le framwork W
            //je dois créer un objet de la classe ArtistesModel
            //(car la table mysql s'appel artistes)
            //ne pas oublier de rajouter use \Model\ArtistesModel
            $objetLivreModel = new GuestbookModel;
            //on peu utiliser la méthode insert
            $objetLivreModel->insert([  "nom_client"    => $nom_client, 
                                        "description"   => $description, 
                                        "date"          => $date
                                    ]);

            //Message de retour
           $GLOBALS["livreCreateRetour"] = "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Avis de $nom_client ajouté";
        }
        else{
            //Message de retour
            $GLOBALS["livreCreateRetour"] = "<span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Des informations sont manquantes";
        }
       
    }


    public function livreUpdateTraitement(){
        // Récupérer les infos du formulaire
        $id             = $this->verifierSaisie("id");
        $nomClient      = $this->verifierSaisie("nom_client"); 
        $description    = $this->verifierSaisie("description");
        $date           = $this->verifierSaisie("date");
        //vérifier si les infos sont correcte
        if(($id > 0) && ($nomClient != "") && ($description != "") && ($date != "")){

             //si ok on ajoute une ligne dans la table artiste
            //avec le framwork W
            //je dois créer un objet de la classe ArtistesModel
            //(car la table mysql s'appel artistes)
            //ne pas oublier de rajouter use \Model\ArtistesModel
            $objetGuestbookModel = new GuestbookModel;
            //on peu utiliser la méthode insert

           $objetGuestbookModel->update(["nom_client"       => $nomClient,
                                        "description"       => $description,
                                        "date"              => $date
                                        ], $id);
            

            //Message de retour
           $GLOBALS["livreUpdateRetour"] = "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Avis $nomClient Modifié";
        }
        else{
            //Message de retour
            $GLOBALS["livreUpdateRetour"] = "<span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Information manquante";
        }
       
    }


    public function livreDeleteTraitement(){
        // Récuperer l'id
        $id = $this->verifierSaisie("id");

        // Il faut que l'id soit un nombre superieur à 0
        //SECURITE : Convertir $id en nombre
        $id = intval($id);

        if ($id > 0){

            // ON Va deleguer à un objet de la classe ArtisteModel
            //le travail de supprimer la ligne correspondante à l'ID
            //Vérifier qu'on a fait le use au debut du fichier
            $objetLivreModel = new GuestbookModel;
            $objetLivreModel->delete($id);

            $GLOBALS["livreDeleteRetour"] = "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Avis Supprimé";
        }else{

            $GLOBALS["livreDeleteRetour"] = "<span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Erreur sur l'id du Santon à supprimer";
        }

    }

}