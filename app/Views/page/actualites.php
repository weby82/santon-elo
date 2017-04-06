<?php 
$navActive = "actualites";

$this->insert('partials/header', ["navActive" => $navActive]);
$this->insert('partials/section-liste-actualite');
$this->insert('partials/footer');


?>