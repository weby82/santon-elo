
<?php
	$navActive = "categorie";

	$this->insert('partials/header', ["categorie" => $categorie, "navActive" => $navActive]);
	$this->insert('partials/section-categorie', ["categorie" => $categorie, "navActive" => $navActive]);
	$this->insert('partials/footer');


    // require_once ("./private/view/header.php");
    // require_once ("./private/view/section-categorie.php");
    // require_once ("./private/view/footer.php");

?>
