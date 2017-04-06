
<?php

	$navActive = "actualites";

	$this->insert('partials/admin-header', ["navActive" => $navActive]);
	$this->insert('partials/admin-section-actualites',["navActive" => $navActive, "actualiteDeleteRetour" => $actualiteDeleteRetour]);
	$this->insert('partials/footer');


?>
