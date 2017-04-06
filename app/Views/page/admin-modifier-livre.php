<?php
// MES VARIABLES 
$navActive = "livre";


$this->insert('partials/admin-header', ["navActive" => $navActive]);
$this->insert('partials/admin-section-modifier-livre', [ "id" => $id, "livreUpdateRetour" => $livreUpdateRetour]);
$this->insert('partials/footer');


