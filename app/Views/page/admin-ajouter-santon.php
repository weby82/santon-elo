
<?php
	$navActive = "santon";

	$this->insert('partials/admin-header', ["navActive" => $navActive]);
	$this->insert('partials/admin-section-ajouter-santon', [ "santonCreateRetour" => $santonCreateRetour ]);
	$this->insert('partials/footer');



?>
