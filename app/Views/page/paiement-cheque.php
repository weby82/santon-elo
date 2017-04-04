<?php 
$navActive = "";

	$this->insert('partials/header', ["navActive" => $navActive]);
	$this->insert('partials/section-paiement-cheque');
	$this->insert('partials/footer');


// require_once('private/view/header.php');
// require_once('private/view/section-contact.php');
// require_once('private/view/footer.php');

?>