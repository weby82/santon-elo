
<?php
	$navActive = "actualites";


	$this->insert('partials/header', ["navActive" => $navActive]);
	$this->insert('partials/section-detail-actualite',  ["id" => $id, "navActive" => $navActive]);
	$this->insert('partials/footer');
	
?>
