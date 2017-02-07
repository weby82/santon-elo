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

    <link rel="stylesheet" type="text/css" href="./assets/css/main.css">
</head>
<body>
   <!-- Création de l'en tête et du bandeau de navigation -->

    <header>
        <div class="container">
            <div class="navbar-header">
              <a class="navbar-brand" href="index.php">Santon Elo</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
                  

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
                       
                        <li><a href="#">Catégorie</a></li>
                        <li><a href="#">Actualités</a></li>

                        <li>
                            <a href="connexion.php">Evènements</a>
                        </li>
                        <li>
                            <a href="inscription.php">Livre d'or</a>
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