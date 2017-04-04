<!-- <?php //$this->layout('layout', ['title' => 'Perdu ?']) ?>

<?php //$this->start('main_content'); ?>
<h1>404. Perdu ?</h1>
<?php //$this->stop('main_content'); ?>
 -->



<?php
	$navActive = "livre";


	$this->insert('partials/header', ["navActive" => $navActive]);
	$this->insert('partials/section-404');
	$this->insert('partials/footer');
	
	// require_once('private/starter.php');
	// require_once ("./private/functions.php");
 //    require_once ("./private/view/header.php");
 //    require_once ("./private/view/section-detail-santon.php");
 //    require_once ("./private/view/footer.php");

?>
