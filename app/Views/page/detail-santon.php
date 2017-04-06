
<?php
	$navActive = "categorie";


	$this->insert('partials/header', ["navActive" => $navActive, "categorie" => $categorie]);
	$this->insert('partials/section-detail-santon',  [ "categorie" => $categorie,"nomUrl" => $nomUrl, "navActive" => $navActive]);
	$this->insert('partials/footer');
	
?>
