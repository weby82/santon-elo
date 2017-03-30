<?php
// MES VARIABLES 
$navActive = "evenements";


// AVEC LE FRAMEWORK W
// LE MOTEUR DE TEMPLATE S'APPUIE SUR LA LIBRAIRIE PLATES
// http://platesphp.com/
// http://platesphp.com/templates/nesting/

// ATTENTION: PAS DE .php A LA FIN
$this->insert('partials/header', [ "titre" => $titre ]);
$this->insert('partials/admin-section-modif-evenement', [ "id" => $id, "evenementUpdateRetour" => $evenementUpdateRetour ]);
$this->insert('partials/footer');

