
<?php
	$navActive = "categorie";

	$this->insert('partials/header', ["categorie" => $categorie, "navActive" => $navActive]);
	$this->insert('partials/section-categorie', ["categorie" => $categorie, "navActive" => $navActive]);
	$this->insert('partials/footer');


?>
