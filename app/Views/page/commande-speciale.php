
<?php
	$navActive = "categorie";
	$categorie = "commande-speciale";
	$this->insert('partials/header', ["categorie" => $categorie, "navActive" => $navActive]);
	$this->insert('partials/section-commande-speciale', ["categorie" => $categorie, "navActive" => $navActive]);
	$this->insert('partials/footer');


?>
