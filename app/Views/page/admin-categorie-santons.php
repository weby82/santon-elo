
<?php
	$navActive = "santon";

	$this->insert('partials/admin-header', ["navActive" => $navActive]);
	$this->insert('partials/admin-section-categorie', ["categorie" => $categorie, "navActive" => $navActive]);
	$this->insert('partials/footer');


    // require_once ("./private/view/header.php");
    // require_once ("./private/view/section-categorie.php");
    // require_once ("./private/view/footer.php");

?>
