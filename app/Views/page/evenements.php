<?php 
$navActive = "evenements";

$this->insert('partials/header', ["navActive" => $navActive]);
$this->insert('partials/section-evenement');
$this->insert('partials/footer');

?>