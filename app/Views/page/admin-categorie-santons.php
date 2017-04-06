
<?php
	$navActive = "santon";

	$this->insert('partials/admin-header', ["navActive" => $navActive]);
	$this->insert('partials/admin-section-categorie', ["categorie" => $categorie, "navActive" => $navActive, "santonDeleteRetour" => $santonDeleteRetour]);
	$this->insert('partials/footer');


?>
