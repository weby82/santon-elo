
<?php

	$navActive = "accueil";

	$this->insert('partials/header', ["navActive" => $navActive]);
	$this->insert('partials/carousel');
	$this->insert('partials/section-accueil');
	$this->insert('partials/footer');

	// require_once('private/starter.php');
	// require_once('private/functions.php');
 //    require_once ("./private/view/header.php");
 //    require_once ("./private/view/carousel.php");
 //    require_once ("./private/view/section-accueil.php");
 //    require_once ("./private/view/footer.php");

?>
