<?php

	$navActive = "evenements";

	$this->insert('partials/admin-header', ["navActive" => $navActive]);

	$this->insert('partials/admin-section-evenements',["navActive" => $navActive, "evenementDeleteRetour" =>$evenementDeleteRetour]);

	$this->insert('partials/footer');

?>
