
<?php
	$navActive = "santon";

	$this->insert('partials/admin-header', ["navActive" => $navActive]);
	$this->insert('partials/admin-section-update-santon', [ "id" => $id, "santonUpdateRetour" => $santonUpdateRetour ]);
	$this->insert('partials/footer');


?>
