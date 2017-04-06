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
    
     function __construct ()
    {
        // Traitement du formulaire
        $idFormClasse  = $this->verifierSaisie("idFormClasse");
        $idFormMethode = $this->verifierSaisie("idFormMethode");
        
        $idFormClasse  = "\Controller\Traitement\\$idFormClasse";
        
        if ( ($idFormClasse != "") && ($idFormMethode != "") )
        {
            if (method_exists($idFormClasse, $idFormMethode))
            {
                // On crée un objet avec lequel on appelle la méthode
                $objet = new $idFormClasse;
                // $this est l'objet de la classe FormController
                $objet->$idFormMethode($this);
            }
        }
        
    }
    public function verifierSaisie ($name)
    {
        $valeurSaisie = ""; 
        
        // Je vérifie que l'info est présente
        if (isset($_REQUEST[$name]))
        {
            // Donc je la stocke dans une variable php
            $valeurSaisie = $_REQUEST[$name];
            
            // Filtrer la valeur pour se protéger un peu
            
            // Enlever les balises html et php
            $valeurSaisie = strip_tags($valeurSaisie);
            
            // Enlever les espaces vides au début et à la fin
            $valeurSaisie = trim($valeurSaisie);            
        }
        
        // Renvoie la $valeurSaisie
        return $valeurSaisie;
    
    }

    // Contraintes
    // Format de l'email (nom@domaine.suffixe)
    function verifierEmail ($email)
    {
        $resultat = false;
        
        if ( ($email != "") && (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) )
        {
            $resultat = true;
        }
        
        return $resultat;
    }


    // Verifier le champ d'upload
    function verifierUploadSanton ($nameInput)
    {
    $cheminOK = "";
    $cheminUrlOk = "";
    
    // Message de retour
    $idForm = $this->verifierSaisie("idForm");
    
    // CONTROLLER
    //Vérifier s'il y a un fichier à charger
      
    // Est-ce que le tableau $_FILES contient la clé $nameInput
    if (isset($_FILES[$nameInput]))
    {    
        $tabInfoFichierUploade = $_FILES[$nameInput];
        if (!empty($tabInfoFichierUploade))
        {
            $error = $tabInfoFichierUploade["error"];
            if ($error == 0)
            {
                // Récupérations des infos
                $name       = $tabInfoFichierUploade["name"];
                $type       = $tabInfoFichierUploade["type"];
                $tmpName    = $tabInfoFichierUploade["tmp_name"];
                $size       = $tabInfoFichierUploade["size"];
                $categorie  = $_POST["categorie"];

                
                if ($size < 10 * 1024 * 1024) // 10 MEGAOCTETS
                {
                    // En dessous de la taille limite on vérifie l'extension
                    $extension = pathinfo($name, PATHINFO_EXTENSION);
                    // Mettre l'extension en minuscule
                    $extension = strtolower($extension);
                    
                    // Vérifier si l'extension est autorisée
                    $tabExtensionOK = 
                    [ 
                        "jpeg", "jpg", "gif", "png", "svg"
                        
                    ];
                    
                    if (in_array($extension, $tabExtensionOK))
                    {
                        // Remplacement des caractères qui ne sont pas des lettres entre a et z ou entre A et Z ou entre 0 et 9 ou qui ne sont -, _, .
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
                        
                        // Transformer le chemin ok en minuscule
                        $cheminUrlOk = strtolower($cheminUrlOk);
                        $cheminMoveOK = strtolower($cheminMoveOK);
                        
                        move_uploaded_file($tmpName, $cheminMoveOK);
                        
                    }
                    else
                    {                    
                        // Extension non autorisée
                        $GLOBALS["santonCreateRetour"] = "EXTENSION NON CONFORME";
                    }
                }
                else 
                {                   
                    // Fichier trop volumineux
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
            $GLOBALS["commandeSpecialRetour"] = "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Merci $prenom, votre message a bien été envoyé !";

                // Je vide les champs du formulaire
                $nom = $prenom = $email = $message = $sujet = NULL;
                unset($_POST);
            }
        }

        else{
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
                                        && ($detailCommande != "")){

            
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
                $message_html = "<html><head></head><body>Commande de $prenom $nom avec un paiement par chèque<br /><b>Email</b> : $email <br /><b>Tel : $tel</b><br /><b>Adresse : </b><br />$adresse <br />$codePostal $ville<br /><br /> <b>Objet du message : </b>$sujet <br /><br /><pre style='font-size:14px;'>$detailCommande </pre><br /><br /><b>Commentaire :</b><br />$commentaire</body></html>";
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

                //=====Création du header pour le client de l'e-mail.
                $header2 = "From: \"Santon Elo\"<".$mailDestinataire.">".$passage_ligne;
                $header2.= "Reply-to: \"Santon Elo\"<".$mailDestinataire.">".$passage_ligne;
                $header2.= "MIME-Version: 1.0".$passage_ligne;
                $header2 .= "X-Priority: 2".$passage_ligne;
                $header2.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
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

                // ENvoi d'une copie du mail au client
                mail($email,"Votre commande de Santon",$message,$header2);
                 
                //==========



            // message pour l'utilisateur
            $GLOBALS["paiementChequeRetour"] = "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Merci $prenom, votre commande a bien été envoyé ! Vous recevrez rapidement une réponse !";

                // je vide le panier en detruisant la session
                session_destroy();
                // Je vide les champs du formulaire
                $nom = $prenom = $email = $message = $sujet = NULL;
                unset($_POST);
            }
        }

        else{
            $GLOBALS["paiementChequeRetour"] = "<span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Il manque des informations !";
        }

    }



    public function loginTraitement(){

        // Récuperer les infos du formulaire
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

            //Création d'un objet de la classe SantonModel
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

            //Création d'un objet de la classe SantonModel
            $objetSantonModel = new SantonModel;

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

            // On va deleguer à un objet de la classe SantonModel le travail de supprimer la ligne correspondante à l'ID
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

            //Création d'un objet de la classe ActualiteModel
            $objetActualiteModel = new ActualiteModel;
            
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
    
    
    if (isset($_FILES[$nameInput]))
    {
        $tabInfoFichierUploade = $_FILES[$nameInput];
        if (!empty($tabInfoFichierUploade))
        {
            $error = $tabInfoFichierUploade["error"];
            if ($error == 0)
            {
                // Récupération des infos
                $name       = $tabInfoFichierUploade["name"];
                $type       = $tabInfoFichierUploade["type"];
                $tmpName    = $tabInfoFichierUploade["tmp_name"];
                $size       = $tabInfoFichierUploade["size"];

                
                if ($size < 10 * 1024 * 1024) // 10 MEGAOCTETS
                {
                    // Vérification de l'extension
                    $extension = pathinfo($name, PATHINFO_EXTENSION);
                    // Mettre l'extension en minuscule
                    $extension = strtolower($extension);
                    
                    // Vérifier si l'extension est autorisée
                    $tabExtensionOK = 
                    [ 
                        "jpeg", "jpg", "gif", "png", "svg"
                        
                    ];
                    
                    if (in_array($extension, $tabExtensionOK))
                    {
                        // Remplacement des caractères qui ne sont pas des lettres entre a et z ou entre A et Z ou entre 0 et 9 ou qui ne sont -, _, .
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
                        
                        // Transformer le chemin ok en minuscule 
                        $cheminUrlOk = strtolower($cheminUrlOk);
                        $cheminMoveOK = strtolower($cheminMoveOK);
                        
                        move_uploaded_file($tmpName, $cheminMoveOK);
                        
                    }
                    else
                    {
                        // Extension non autorisée
                        $GLOBALS["actualiteCreateRetour"] = "EXTENSION NON CONFORME";
                    }
                }
                else 
                {
                    // Fichier trop volumineux
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

            // Création de l'objet de la classe ActualiteModel
            $objetActualiteModel = new ActualiteModel;

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

            // On va deleguer à un objet de la classe ActualiteModel
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

            // Création de l'objet de la classe EvenementModel
            $objetEvenementsModel = new EvenementsModel;

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
    
    // Message de retour
    $idForm = $this->verifierSaisie("idForm");
    
    
    // Est-ce que le tableau $_FILES contient la clé $nameInput
    if (isset($_FILES[$nameInput]))
    {
       
        $tabInfoFichierUploade = $_FILES[$nameInput];
        if (!empty($tabInfoFichierUploade))
        {
            $error = $tabInfoFichierUploade["error"];
            if ($error == 0)
            {
                // Je récupère les autre infos
                $name       = $tabInfoFichierUploade["name"];
                $type       = $tabInfoFichierUploade["type"];
                $tmpName    = $tabInfoFichierUploade["tmp_name"];
                $size       = $tabInfoFichierUploade["size"];

                
                if ($size < 10 * 1024 * 1024) // 10 MEGAOCTETS
                {
                    // Vérification de l'extension
                    $extension = pathinfo($name, PATHINFO_EXTENSION);
                    // Mettre l'exension en minuscule
                    $extension = strtolower($extension);
                    
                    // Vérifier si l'extension est autorisée
                    $tabExtensionOK = 
                    [ 
                        "jpeg", "jpg", "gif", "png", "svg"
                        
                    ];
                    
                    if (in_array($extension, $tabExtensionOK))
                    {
                        // Remplacement des caractères qui ne sont pas des lettres entre a et z ou entre A et Z ou entre 0 et 9 ou qui ne sont -, _, .
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
                        
                        // Transformer le chemin ok en minuscule
                        $cheminUrlOk = strtolower($cheminUrlOk);
                        $cheminMoveOK = strtolower($cheminMoveOK);
                        
                        move_uploaded_file($tmpName, $cheminMoveOK);
                        
                    }
                    else
                    {
                        
                        // Extension non autorisée
                        $GLOBALS["evenementCreateRetour"] = "EXTENSION NON CONFORME";
                    }
                }
                else 
                {
                    // Fichier trop volumineux
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

            // Création d'un objet de la classe EvenementModel
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

            // On va deleguer à un objet de la classe EvenementModel le travail de supprimer la ligne correspondante à l'ID
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

            // Création d'un objet de la classe GuestbookModel
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

            // Création d'un objet de la classe GuestbookModel
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

            // On va deleguer à un objet de la classe EvenementModel le travail de supprimer la ligne correspondante à l'ID
            $objetLivreModel = new GuestbookModel;
            $objetLivreModel->delete($id);

            $GLOBALS["livreDeleteRetour"] = "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Avis Supprimé";
        }else{

            $GLOBALS["livreDeleteRetour"] = "<span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Erreur sur l'id du Santon à supprimer";
        }

    }

}