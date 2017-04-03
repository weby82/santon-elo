
<?php

	$navActive = "livre";

	$this->insert('partials/admin-header', ["navActive" => $navActive]);
	$this->insert('partials/admin-section-livre',["navActive" => $navActive]);
	$this->insert('partials/footer');
?>
