<?php
// MES VARIABLES 
$navActive = "evenements";


$this->insert('partials/admin-header', ["navActive" => $navActive]);
$this->insert('partials/admin-section-modif-evenement', [ "id" => $id, "evenementUpdateRetour" => $evenementUpdateRetour ]);
$this->insert('partials/footer');

