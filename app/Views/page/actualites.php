<?php 
$navActive = "actualites";

$this->insert('partials/header', ["navActive" => $navActive]);
$this->insert('partials/section-liste-article');
$this->insert('partials/footer');

// require_once('private/view/header.php');
// require_once('private/view/section-liste-article.php');
// require_once('private/view/footer.php');

?>