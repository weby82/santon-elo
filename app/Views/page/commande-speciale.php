
<?php
	$navActive = "categorie";
	$categorie = "commande-speciale";
	$this->insert('partials/header', ["categorie" => $categorie, "navActive" => $navActive]);
	$this->insert('partials/section-commande-speciale', ["categorie" => $categorie, "navActive" => $navActive]);
	$this->insert('partials/footer');


    // require_once ("./private/view/header.php");
    // require_once ("./private/view/section-categorie.php");
    // require_once ("./private/view/footer.php");

?>
