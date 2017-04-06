
<?php

	$navActive = "actualites";


	$this->insert('partials/admin-header', ["navActive" => $navActive]);
	$this->insert('partials/admin-section-creation-actualite', ["actualiteCreateRetour" => $actualiteCreateRetour]);
	$this->insert('partials/footer');


?>
