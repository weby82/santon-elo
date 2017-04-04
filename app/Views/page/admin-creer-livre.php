
<?php
	$navActive = "livre";

	$this->insert('partials/admin-header', ["navActive" => $navActive]);
	$this->insert('partials/admin-section-creer-livre', [ "livreCreateRetour" => $livreCreateRetour ]);
	$this->insert('partials/footer');

?>
