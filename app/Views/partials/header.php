    <?php
/* Start session in a header so you don't need to start it on each single page....maybe on some :p*/
if(session_status()==PHP_SESSION_NONE){session_start();}
/* Require / request database file with methods and actions to be performed */
//require_once("../database.php");  
 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
    <title>Santon'Elo</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- Bootstrap -->
    <link href="<?php echo $this->assetUrl('css/bootstrap.min.css') ?>" rel="stylesheet">
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo $this->assetUrl('js/jquery.min.js') ?>"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo $this->assetUrl('js/bootstrap.min.js') ?>"></script>
    <script type="text/javascript">
      var cheminPanier = "<?php echo $this->url('vitrine_panier')?>";
    </script>
    <script type="text/javascript" src="<?php echo $this->assetUrl('js/mainJSscript.js') ?>"></script>
    
    <!-- Include Unite Gallery core files -->
    <script src='<?php echo $this->assetUrl('js/unitegallery.min.js') ?>' type='text/javascript'  ></script>
    <link  href='<?php echo $this->assetUrl('css/unite-gallery.css') ?>' rel='stylesheet' type='text/css' />
        
    <!-- include Unite Gallery Theme Files -->
        
    <script src='<?php echo $this->assetUrl('js/ug-theme-tilesgrid.js') ?>' type='text/javascript'></script>

    <link rel="stylesheet" type="text/css" href="<?php echo $this->assetUrl('css/main.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->assetUrl('css/kelly.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->assetUrl('css/liinaa.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->assetUrl('css/damien.css') ?>">
    
    <!-- Google webfont -->
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:300,400,700" rel="stylesheet">

    <!-- Recaptcha -->
    <script src='https://www.google.com/recaptcha/api.js'></script>

    <!-- Script pour la gallery Unite -->
    <script type="text/javascript">
        
        jQuery(document).ready(function(){
          
          jQuery("#gallery").unitegallery({
            gallery_theme: "tilesgrid",

            tile_width: 180,            //tile width
            tile_height: 180,
            gallery_width:"100%",
            grid_num_rows:1,
            theme_navigation_type: "bullets"
          });
        });
        
        </script>
</head>
<body>
   <!-- Création de l'en tête et du bandeau de navigation -->
    <header>
        <div class="container">
            <div class="navbar-header">
              <a class="navbar-brand" href="<?php echo $this->url('vitrine_accueil'); ?>">Santon'Elo</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
                  

            <div class="navbar-right cart-btn">
              <a href="#" class="shopping_cart_info btn btn-default" title="Shopping cart item total">             
                <i class='glyphicon glyphicon-shopping-cart' ></i>            
                <span id='items_in_shopping_cart'>
                    <?php 
                        /* If there are items in the basket display total of items, else display 'empty'*/
                        if(isset($_SESSION["items"])){   
                            if(count($_SESSION["items"]) > 0){
                                echo count($_SESSION["items"]);
                            }else{
                                echo "0";
                            }
                        }else{
                            echo "0";
                        }
                    ?>
                </span>
            </a>
            </div>
            <form class="navbar-form navbar-right" role="search">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Rechercher">
                <span class="input-group-btn">
                  <button class="btn btn-default recherche" type="button">
                    <span class="glyphicon glyphicon-search"></span>
                  </button>
                </span>
              </div>
            </form>
        </div>
        
        
    </header>

    <nav class="navbar navbar-default">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
              </div>
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav nav-justified">

                      <li <?php if($navActive == "accueil") { echo "class='active'"; }?>>
                          <a href="<?php echo $this->url('vitrine_accueil'); ?>">Accueil</a>
                      </li>
                      <li <?php if($navActive == "categorie") { echo "class='active'"; }?>>
                          <div id="dropcategorie" class="dropdown">
                            <a href="#" class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                              Catégories
                              <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li <?php if(isset($categorie) && $categorie == "nativite") { echo "class='active'"; }?>>
                                    <a href="<?php echo $this->url('vitrine_categorie', ['categorie' => 'nativite']); ?>">Noël/Natavité</a>
                                </li>
                                <li <?php if(isset($categorie) && $categorie == "bapteme") { echo "class='active'"; }?>>
                                    <a href="<?php echo $this->url('vitrine_categorie', ['categorie' => 'bapteme']); ?>">Baptême</a>
                                </li>
                                <li <?php if(isset($categorie) && $categorie == "anniversaire") { echo "class='active'"; }?>>
                                    <a href="<?php echo $this->url('vitrine_categorie', ['categorie' => 'anniversaire']); ?>">Anniversaire</a>
                                </li>
                                <li <?php if(isset($categorie) && $categorie == "communion") { echo "class='active'"; }?>>
                                    <a href="<?php echo $this->url('vitrine_categorie', ['categorie' => 'communion']); ?>">Communion</a>
                                </li>
                                <li <?php if(isset($categorie) && $categorie == "mariage") { echo "class='active'"; }?>>
                                    <a href="<?php echo $this->url('vitrine_categorie', ['categorie' => 'mariage']); ?>">Mariage</a>
                                </li>
                                <li <?php if(isset($categorie) && $categorie == "commande-speciale") { echo "class='active'"; }?>>
                                    <a href="<?php echo $this->url('vitrine_commande_speciale', ['categorie' => 'commande-speciale']); ?>">Commande spéciale</a>
                                </li>
                            </ul>
                          </div>
                      </li> 
                      <li <?php if($navActive == "actualites") { echo "class='active'"; }?>>
                        <a href="<?php echo $this->url('vitrine_actualites'); ?>">Actualités</a>
                      </li>
                      <li <?php if($navActive == "evenements") { echo "class='active'"; }?>>
                          <a href="<?php echo $this->url('vitrine_evenements'); ?>">Evènements</a>
                      </li>
                      <li <?php if($navActive == "livre") { echo "class='active'"; }?>>
                          <a href="<?php echo $this->url('vitrine_livre'); ?>">Livre d'or</a>
                      </li>
                      <li <?php if($navActive == "contact") { echo "class='active'"; }?>>
                          <a href="<?php echo $this->url('vitrine_contact'); ?>">Contact</a>
                      </li>
                  </ul>
              </div>
          </div>
    </nav>
  
 <!-- Holds shopping cart info with selected items -->
    <div class="shopping_cart_holder">
        <a href="#" class="close_shopping_cart_holder" ><span class='glyphicon glyphicon-remove' ></span></a>
        <h3>Votre Panier</h3>
        <div id="shopping_cart_output">
        </div>
    </div>
    
    <!--    Display Item here-->
    <div class="item_display_holder"></div>

    <!-- Display info about cart update in the middle of the screen -->
    <div id='cart_update_info'></div>