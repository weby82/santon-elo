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
    
    <link rel="stylesheet" type="text/css" href="<?php echo $this->assetUrl('css/main.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->assetUrl('css/kelly.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->assetUrl('css/pier.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->assetUrl('css/liinaa.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->assetUrl('css/damien.css') ?>">
</head>
<body>
   <!-- Création de l'en tête et du bandeau de navigation -->
    <header>
        <div class="container">
            <div class="navbar-header">
              <a class="navbar-brand" href="<?php echo $this->url('vitrine_accueil'); ?>">Santon'Elo</a>
            </div>
                      
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
                          <a href="<?php echo $this->url('admin_accueil'); ?>">Accueil</a>
                      </li>
                       <li <?php if($navActive == "santon") { echo "class='active'"; }?>>
                          <a href="<?php echo $this->url('admin_gerer_santons', ['categorie' => 'nativite']);?>">Santons</a>
                      </li>
                      <li <?php if($navActive == "actualites") { echo "class='active'"; }?>>
                        <a href="<?php echo $this->url('admin_actualites'); ?>">Actualités</a>
                      </li>
                      <li <?php if($navActive == "evenements") { echo "class='active'"; }?>>
                          <a href="<?php echo $this->url('admin_evenements'); ?>">Evènements</a>
                      </li>
                      <li <?php if($navActive == "livre") { echo "class='active'"; }?>>
                          <a href="<?php echo $this->url('admin_livre'); ?>">Livre d'or</a>
                      </li>

 <?php
  // si je suis connecté je vois que le lien de logout
  if (isset($w_user["id"]) && ($w_user["id"] > 0)):

?>
        <li><a href="<?php echo $this->url('logout'); ?>">Logout</a></li>
<?php
  else :
?>
        <li><a href="<?php echo $this->url('login'); ?>">Login</a></li>
<?php
  endif;
?>
                  </ul>
              </div>
          </div>
    </nav>