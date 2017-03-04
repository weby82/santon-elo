    <?php
/* Start session in a header so you don't need to start it on each single page....maybe on some :p*/
if(session_status()==PHP_SESSION_NONE){session_start();}
/* Require / request database file with methods and actions to be performed */
require_once("private/database.php");    
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
    <title>Santon'Elo</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- Bootstrap -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="./assets/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="./assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./assets/js/mainJSscript.js"></script>
    
    <link rel="stylesheet" type="text/css" href="./assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/kelly.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/pier.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/liinaa.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/damien.css">
</head>
<body>
   <!-- Création de l'en tête et du bandeau de navigation -->
    <header>
        <div class="container">
            <div class="navbar-header">
              <a class="navbar-brand" href="index.php">Santon'Elo</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
                  

            <div class="dropdown navbar-right">
              <a href="#" class="shopping_cart_info btn btn-default" title="Shopping cart item total">             
                <i class='glyphicon glyphicon-shopping-cart' ></i>            
                <span id='items_in_shopping_cart'>
                    <?php 
                        /* If there are items in the basket display total of items, else display 'empty'*/
                        if(isset($_SESSION["items"])){   
                            if(count($_SESSION["items"]) > 0){
                                echo count($_SESSION["items"]);
                            }else{
                                echo "empty";
                            }
                        }else{
                            echo "empty";
                        }
                    ?>
                </span>
            </a>
            </div>
            <form class="navbar-form navbar-right" role="search">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Rechercher">
                <span class="input-group-btn">
                  <button class="btn btn-default" type="button">
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
                          <a href="index.php">Accueil</a>
                      </li>
                      <li <?php if($navActive == "categorie") { echo "class='active'"; }?>>
                          <div id="dropcategorie" class="dropdown">
                            <a href="#" class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                              Catégories
                              <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li <?php if($_REQUEST["categorie"] == "nativite") { echo "class='active'"; }?>>
                                    <a href="./categorie-santons.php?categorie=nativite">Noël/Natavité</a>
                                </li>
                                <li <?php if($_REQUEST["categorie"] == "bapteme") { echo "class='active'"; }?>>
                                    <a href="./categorie-santons.php?categorie=bapteme">Baptême</a>
                                </li>
                                <li <?php if($_REQUEST["categorie"] == "anniversaire") { echo "class='active'"; }?>>
                                    <a href="./categorie-santons.php?categorie=anniversaire">Anniversaire</a>
                                </li>
                                <li <?php if($_REQUEST["categorie"] == "communion") { echo "class='active'"; }?>>
                                    <a href="./categorie-santons.php?categorie=communion">Communion</a>
                                </li>
                                <li <?php if($_REQUEST["categorie"] == "mariage") { echo "class='active'"; }?>>
                                    <a href="./categorie-santons.php?categorie=mariage">Mariage</a>
                                </li>
                                <li <?php if($_REQUEST["categorie"] == "speciale") { echo "class='active'"; }?>>
                                    <a href="./categorie-santons.php?categorie=speciale">Commande spéciale</a>
                                </li>
                            </ul>
                          </div>
                      </li> 
                      <li <?php if($navActive == "actualites") { echo "class='active'"; }?>>
                        <a href="actualites.php">Actualités</a>
                      </li>
                      <li <?php if($navActive == "evenements") { echo "class='active'"; }?>>
                          <a href="">Evènements</a>
                      </li>
                      <li <?php if($navActive == "livre") { echo "class='active'"; }?>>
                          <a href="">Livre d'or</a>
                      </li>
                      <li <?php if($navActive == "contact") { echo "class='active'"; }?>>
                          <a href="contact.php">Contact</a>
                      </li>
                  </ul>
                </div>
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