
<?php

	$navActive = "evenements";


	$this->insert('partials/admin-header', ["navActive" => $navActive]);
	$this->insert('partials/admin-section-creation-evenement', ["evenementCreateRetour" => $evenementCreateRetour]);
	$this->insert('partials/footer');


?>
