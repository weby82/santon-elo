<?php
// MES VARIABLES 
$navActive = "actualites";


// AVEC LE FRAMEWORK W
// LE MOTEUR DE TEMPLATE S'APPUIE SUR LA LIBRAIRIE PLATES
// http://platesphp.com/
// http://platesphp.com/templates/nesting/

// ATTENTION: PAS DE .php A LA FIN
$this->insert('partials/admin-header', ["navActive" => $navActive]);
$this->insert('partials/admin-section-modif-actualite', ["id" => $id, "actualiteUpdateRetour" => $actualiteUpdateRetour]);
$this->insert('partials/footer');

