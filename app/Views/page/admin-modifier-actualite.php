<?php
// MES VARIABLES 
$navActive = "actualites";


$this->insert('partials/admin-header', ["navActive" => $navActive]);
$this->insert('partials/admin-section-modif-actualite', ["id" => $id, "actualiteUpdateRetour" => $actualiteUpdateRetour]);
$this->insert('partials/footer');

