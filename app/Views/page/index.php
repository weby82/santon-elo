
<?php

	$navActive = "accueil";

	$this->insert('partials/header', ["navActive" => $navActive]);
	$this->insert('partials/carousel');
	$this->insert('partials/section-accueil');
	$this->insert('partials/footer');


?>
