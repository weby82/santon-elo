
<?php
	$navActive = "categorie";


	$this->insert('partials/header', ["navActive" => $navActive, "categorie" => $categorie]);
	$this->insert('partials/section-detail-santon',  [ "categorie" => $categorie,"nomUrl" => $nomUrl, "navActive" => $navActive]);
	$this->insert('partials/footer');
	
	// require_once('private/starter.php');
	// require_once ("./private/functions.php");
 //    require_once ("./private/view/header.php");
 //    require_once ("./private/view/section-detail-santon.php");
 //    require_once ("./private/view/footer.php");

?>
