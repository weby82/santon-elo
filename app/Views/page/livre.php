
<?php
	$navActive = "livre";


	$this->insert('partials/header', ["navActive" => $navActive]);
	$this->insert('partials/section-livre');
	$this->insert('partials/footer');
	
?>
