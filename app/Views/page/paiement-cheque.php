<?php 
$navActive = "";

	$this->insert('partials/header', ["navActive" => $navActive]);
	$this->insert('partials/section-paiement-cheque');
	$this->insert('partials/footer');


?>