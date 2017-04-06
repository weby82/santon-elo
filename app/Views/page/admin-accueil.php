
<?php

	$navActive = "accueil";

	$this->insert('partials/admin-header', ["navActive" => $navActive]);
	$this->insert('partials/admin-section-accueil');
	$this->insert('partials/footer');


?>
