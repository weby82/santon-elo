<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
    <title>Santon Elo</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- Bootstrap -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="./assets/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="./assets/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="./assets/css/liinaa.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/kelly.css">
</head>
<body>
   <!-- Création de l'en tête et du bandeau de navigation -->

    <header>
        <div class="container">
            <div class="navbar-header">
              <a class="navbar-brand" href="index.php">Santon Elo</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
                  

            <div class="dropdown navbar-right">
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <a id="panier" href="panier.php">Panier</a>
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
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

                          <li class="active">
                              <a href="index.php">Accueil</a>
                          </li>
                          <li>
                              <div id="dropcategorie" class="dropdown">
                                <a href="#" class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                  Catégories
                                  <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                  <li><a href="#">Noël/Natavité</a></li>
                                  <li><a href="#">Baptême</a></li>
                                  <li><a href="#">Anniversaire</a></li>
                                  <li><a href="#">Communion</a></li>
                                  <li><a href="#">Mariage</a></li>
                                  <li><a href="#">Commande spéciale</a></li>
                                </ul>
                              </div>
                          </li> 
                          <li><a href="#">Actualités</a></li>

                          <li>
                              <a href="">Evènements</a>
                          </li>
                          <li>
                              <a href="">Livre d'or</a>
                          </li>
                          <li>
                              <a href="contact.php">Contact</a>
                          </li>
                      </ul>
                    </div>
                </div>
            </div>
        </nav>
  
    </header>