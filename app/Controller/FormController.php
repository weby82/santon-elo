<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\NewsletterModel;
use \Model\ArtistesModel;

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


}