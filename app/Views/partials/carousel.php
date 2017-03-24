
	<!--Création du Carousel -->
	<div class="row">
		<div id="carousel-accueil" class="carousel slide" data-ride="carousel">
		  <!-- Indicators -->
		  <ol class="carousel-indicators">
		    <li data-target="#carousel-accueil" data-slide-to="0" class="active"></li>
		    <li data-target="#carousel-accueil" data-slide-to="1"></li>
		    <li data-target="#carousel-accueil" data-slide-to="2"></li>
		    <li data-target="#carousel-accueil" data-slide-to="3"></li>
		  </ol>

		  <!-- Wrapper for slides -->
		  <div class="carousel-inner" role="listbox">

<?php
$objetCarouselModel = new \Model\CarouselModel;
	
$tabLigne = $objetCarouselModel->findAll("id", "DESC", 4, 0);

// on  fait une boucle foreach pour recuperer les éléments
foreach ($tabLigne as $index => $tabColonne) {

	// récuperer les colonne de chaque ligne
	$id 			= $tabColonne["id"];
	$photo			= $tabColonne["photo"];
	$nom			= $tabColonne["nom"];
	$urlPhoto		= $this->assetUrl($photo);
	


	// Construire le code HTML
?>

		    <div class="item <?php if($id == 1){ echo 'active';} ?>">
		      <img src="<?php echo $urlPhoto ?>" alt="<?php echo $nom ?>">
		      <div class="carousel-caption">
		      </div>
		    </div>
<?php
}
?>	   
		    
		  </div>

		  <!-- Controls -->
		  <a class="left carousel-control" href="#carousel-accueil" role="button" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control" href="#carousel-accueil" role="button" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
		</div>
	</div>