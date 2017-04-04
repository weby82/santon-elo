
<?php

	$navActive = "actualite";

	$this->insert('partials/admin-header', ["navActive" => $navActive]);
	$this->insert('partials/admin-section-actualites',["navActive" => $navActive, "actualiteDeleteRetour" => $actualiteDeleteRetour]);
	$this->insert('partials/footer');

	// require_once('private/starter.php');
	// require_once('private/functions.php');
 //    require_once ("./private/view/header.php");
 //    require_once ("./private/view/carousel.php");
 //    require_once ("./private/view/section-accueil.php");
 //    require_once ("./private/view/footer.php");

?>
