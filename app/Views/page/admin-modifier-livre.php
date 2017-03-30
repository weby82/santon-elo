<?php
// MES VARIABLES 
$navActive = "livre";


// AVEC LE FRAMEWORK W
// LE MOTEUR DE TEMPLATE S'APPUIE SUR LA LIBRAIRIE PLATES
// http://platesphp.com/
// http://platesphp.com/templates/nesting/

// ATTENTION: PAS DE .php A LA FIN
$this->insert('partials/header', ["navActive" => $navActive]);
$this->insert('partials/admin-section-modif-livre', ["id" => $id, "livreUpdateRetour" => $livreUpdateRetour]);
$this->insert('partials/footer');

