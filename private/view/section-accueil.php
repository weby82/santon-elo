<!-- Création du main avec actualités et dernier ajouts -->
	<main>
		<section id="section-last-actu">
			<div class="container">
				<h2>Dernières Actualités</h2>
				<article class="col-md-4 col-sm-6 col-xs-12 articles-actu">
					<div class="article-inner">
						<img src="http://lorempixel.com/300/300/people/1/" alt="#">
						<h3>Titre</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo minima ex, culpa exercitationem fuga! Amet adipisci, unde modi temporibus, laborum quaerat in culpa aliquam cum, debitis eos, aspernatur quos ipsa.</p>
						<p class="lien-article"><a href="#!">Lire la suite</a></p>
					</div>
				</article>
				<article class="col-md-4 col-sm-6 col-xs-12 articles-actu">
					<div class="article-inner">
						<img src="http://lorempixel.com/300/300/people/2/" alt="#">
						<h3>Titre</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo minima ex, culpa exercitationem fuga! Amet adipisci, unde modi temporibus, laborum quaerat in culpa aliquam cum, debitis eos, aspernatur quos ipsa.</p>
						<p class="lien-article"><a href="#!">Lire la suite</a></p>
					</div>
				</article>
				<article class="col-md-4 col-sm-6 col-xs-12 articles-actu">
					<div class="article-inner">
						<img src="http://lorempixel.com/300/300/people/3/" alt="#">
						<h3>Titre</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo minima ex, culpa exercitationem fuga! Amet adipisci, unde modi temporibus, laborum quaerat in culpa aliquam cum, debitis eos, aspernatur quos ipsa.</p>
						<p class="lien-article"><a href="#!">Lire la suite</a></p>
					</div>
				</article>
			</div>
		</section>

		<section id="section-last-ajout">
			<div class="container">
				<h2>Derniers Ajout</h2>
		<?php

	// Requete SQL pour lire les info dans la table santon

// je recupere les info de la table santon

$requeteSQL = "SELECT * FROM santon ORDER BY date_ajout DESC LIMIT  0,8";

$tabToken = [];

// Envoyer la requete
$objetPDOStatement = envoyerRequeteSQL($requeteSQL, $tabToken);

// on  fait une boucle while pour recuperer les éléments
// while( $tabLigne = $objetPDOStatement->fetch() )

while ( $tabLigne = $objetPDOStatement->fetch()){

	// récuperer les colonne de chaque ligne

	$id 							= $tabLigne["id"];
	$nomSanton 						= $tabLigne["nom"];
	$categorieSanton				= $tabLigne["categorie"];
	$prixSanton						= $tabLigne["prix"];
	$photoSanton					= $tabLigne["photo"];
	$stockSanton					= $tabLigne["stock"];


	// Construire le code HTML
?>
					<article class="col-lg-3 col-md-3 col-sm-4 col-xs-12 bloc-santon">
						<form class="item_form">
							<div class="bloc-santon-inner">
								<a href="detail-santon.php?categorie=<?php echo $categorieSanton; ?>&santon_id=<?php echo $id; ?>" title="<?php echo $nomSanton; ?>">
									<img src="<?php echo $photoSanton; ?>" alt="santon <?php echo $nomSanton; ?>">
								</a>
								<h3><a href="detail-santon.php?categorie=<?php echo $categorieSanton; ?>&santon_id=<?php echo $id; ?>" title="<?php echo $item["nom"]; ?>"><?php echo $nomSanton; ?></a></h3>
								<p class="prix-santon"><?php echo $prixSanton; ?> €</p>
								<div class="item_disp_values">
	                                <div>Quantity:
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
				    <div class="item active">
				      <div class="temoignage">
					      <p>
					      Superbe réalisation, exactement ce qu'il me fallait !
					      Je la recommande vivement
					      </p>
					      <p class="nom-temoignage">
					      Monsieur Bob
					      </p>
				      </div>
				      <div class="carousel-caption">  
				      </div>
				    </div>
				    <div class="item">
				      <div class="temoignage">
					      <p>
					      J'ai commandé 4 santons, ils sont magnifique, j'adore sont travail. super détail 
					      </p>
					      <p class="nom-temoignage">
					      Madame Xavier
					      </p>
				      </div>
				      <div class="carousel-caption">
				      </div>
				    </div>
				    <div class="item">
				      <div class="temoignage">
					      <p>
					      Les santons sont très beau, j'ai fait une commande personnalisé pour mon mariage, je suis ravie
					      </p>
					      <p class="nom-temoignage">
					      Madame Houlala
					      </p>
				      </div>
				      <div class="carousel-caption">
				      </div>
				    </div>
				    <div class="item">
				      <div class="temoignage">
					      <p>
					      Superbe réalisation, exactement ce qu'il me fallait !
					      Je la recommande vivement
					      </p>
					      <p class="nom-temoignage">
					      Monsieur Youpi
					      </p>
				      </div>
				      <div class="carousel-caption">
				      </div>
				    </div>
				    
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