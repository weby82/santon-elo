
<?php

	$navActive = "accueil";

	$this->insert('partials/admin-header', ["navActive" => $navActive]);
	$this->insert('partials/admin-section-login', ["loginRetour" => $loginRetour]);
	$this->insert('partials/footer');


?>
