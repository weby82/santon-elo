<!-- Création du main avec actualités et dernier ajouts -->
	<main>
		<section id="section-last-actu">
			<div class="container">
				<h2>Dernières Actualités</h2>
<?php
$objetActuModel = new \Model\ActualiteModel;
	
$tabLigneActu = $objetActuModel->findAll("date", "DESC", 3, 0);

// on  fait une boucle foreach pour recuperer les éléments

foreach ($tabLigneActu as $index => $tabColonneActu) {

	// récuperer les colonne de chaque ligne

	$idActu 			= $tabColonneActu["id"];
	$titreActu 			= $tabColonneActu["titre"];
	$contenuActu		= $tabColonneActu["contenu"];
	$photoActu			= $tabColonneActu["photo"];

	$urlPhoto			= $this->assetUrl($photoActu);
	
	$urlActu = $this->url('vitrine_afficher_actualite', ['id' => $idActu]);

	// Construire le code HTML
?>
				<article class="col-md-4 col-sm-6 col-xs-12 articles-actu">
					<div class="article-inner">
						<img src="<?php echo $urlPhoto ?>" alt="#">
						<div class="desc-actu">
							<h3><?php echo $titreActu ?></h3>
							<p><?php echo $contenuActu ?></p>
							<p class="lien-article"><a class="btn btn-default" href="<?php echo $urlActu ?>">Lire la suite</a></p>
						</div>
					</div>
				</article>
<?php
}
?>
			</div>
		</section>

		<section id="section-last-ajout">
			<div class="container">
				<h2>Derniers Ajout</h2>
		<?php

	// Requete SQL pour lire les info dans la table santon

// je recupere les info de la table santon

$objetSantonModel = new \Model\SantonModel;
	
$tabLigne = $objetSantonModel->findAll("date_ajout", "DESC", 8, 0);

// on  fait une boucle foreach pour recuperer les éléments

foreach ($tabLigne as $index => $tabColonne) {

	// récuperer les colonne de chaque ligne

	$id 							= $tabColonne["id"];
	$nomSanton 						= $tabColonne["nom"];
	$categorieSanton				= $tabColonne["categorie"];
	$prixSanton						= $tabColonne["prix"];
	$photoSanton					= $tabColonne["photo"];

	$urlPhotoSanton			= $this->assetUrl($photoSanton);

	// Construire le code HTML
?>
					<article class="col-lg-3 col-md-3 col-sm-4 col-xs-12 bloc-santon">
						<form class="item_form">
							<div class="bloc-santon-inner">
								<a href="detail-santon.php?categorie=<?php echo $categorieSanton; ?>&santon_id=<?php echo $id; ?>" title="<?php echo $nomSanton; ?>">
									<img src="<?php echo $urlPhotoSanton; ?>" alt="santon <?php echo $nomSanton; ?>">
								</a>
								<h3><a href="detail-santon.php?categorie=<?php echo $categorieSanton; ?>&santon_id=<?php echo $id; ?>" title="<?php echo $item["nom"]; ?>"><?php echo $nomSanton; ?></a></h3>
								<p class="prix-santon"><?php echo $prixSanton; ?> €</p>
								<div class="item_disp_values">
	                                <div>Quantité:
	                                    <select name="item_qty">
	                                        <?php
	                                            // Choose itemquantity
	                                            $maxQty=10;
	                                            for($i=1;$i<=$maxQty;$i++){
	                                                echo "<option value='{$i}'>$i</option>";
	                                            }
	                                        ?>
	                                    </select>
	                                </div>
                                </div>
								<input name="item_id" type="hidden" value="<?php echo $id; ?>">
								<button type="submit" class="add_item_to_cart ajout-panier btn btn-default">
									Ajouter au panier<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
								</button>
								
							</div>
						</form>
					</article>
<?php } // fin boucle ?>

				</div>
		</section>

		<section id="section-temoignage">
			<!--Création du Carousel -->
			<div class="container">
				<div id="carousel-temoignage" class="carousel slide" data-ride="carousel">
				  <!-- Indicators -->
				  <ol class="carousel-indicators">
				    <li data-target="#carousel-temoignage" data-slide-to="0" class="active"></li>
				    <li data-target="#carousel-temoignage" data-slide-to="1"></li>
				    <li data-target="#carousel-temoignage" data-slide-to="2"></li>
				    <li data-target="#carousel-temoignage" data-slide-to="3"></li>
				  </ol>

				  <!-- Wrapper for slides -->
				  <div class="carousel-inner" role="listbox">
<?php

	// Requete SQL pour lire les info dans la table guestBook

// je recupere les info de la table guestBook

$objetLivreModel = new \Model\GuestbookModel;
	
$tabLigne = $objetLivreModel->findAll("date", "DESC", 4, 0);

// on  fait une boucle foreach pour recuperer les éléments
$countLivre = 0;
foreach ($tabLigne as $index => $tabColonneLivre) {

	// récuperer les colonne de chaque ligne

	$id 							= $tabColonneLivre["id"];
	$nomLivre 						= $tabColonneLivre["nom_client"];
	$descriptionLivre				= $tabColonneLivre["description"];

	$countLivre++;

	



	// Construire le code HTML
?>
				    <div class="item <?php if($countLivre == 1) echo "active"; ?>">
				      <div class="temoignage">
					      <p>
					      <?php echo $descriptionLivre  ?>
					      </p>
					      <p class="nom-temoignage">
					      <?php echo $nomLivre  ?>
					      </p>
				      </div>
				      <div class="carousel-caption">  
				      </div>
				    </div>
<?php
}
?>
				   
				    
				  </div>

				  <!-- Controls -->
				  <!-- <a class="left carousel-control" href="#carousel-temoignage" role="button" data-slide="prev">
				    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				    <span class="sr-only">Previous</span>
				  </a>
				  <a class="right carousel-control" href="#carousel-temoignage" role="button" data-slide="next">
				    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				    <span class="sr-only">Next</span>
				  </a> -->
				</div>
			</div>
		</section>
		
	</main>