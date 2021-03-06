	
	<main id="section-detail-santon">
		<div class="container">
			<div class="container-inner">
				<h2>Nativité</h2>
				<aside class="col-md-3 col-sm-12 col-nav-left">
					<nav>
						<h3>Catégories</h3>
						<ul class="nav nav-pills nav-stacked">
							<li <?php if(isset($categorie) && $categorie == "nativite") { echo "class='active'"; }?>>
                                <a href="<?php echo $this->url('vitrine_categorie', ['categorie' => 'nativite']); ?>">Noël/Natavité</a>
                            </li>
                            <li <?php if(isset($categorie) && $categorie == "bapteme") { echo "class='active'"; }?>>
                                <a href="<?php echo $this->url('vitrine_categorie', ['categorie' => 'bapteme']); ?>">Baptême</a>
                            </li>
                            <li <?php if(isset($categorie) && $categorie == "anniversaire") { echo "class='active'"; }?>>
                                <a href="<?php echo $this->url('vitrine_categorie', ['categorie' => 'anniversaire']); ?>">Anniversaire</a>
                            </li>
                            <li <?php if(isset($categorie) && $categorie == "communion") { echo "class='active'"; }?>>
                                <a href="<?php echo $this->url('vitrine_categorie', ['categorie' => 'communion']); ?>">Communion</a>
                            </li>
                            <li <?php if(isset($categorie) && $categorie == "mariage") { echo "class='active'"; }?>>
                                <a href="<?php echo $this->url('vitrine_categorie', ['categorie' => 'mariage']); ?>">Mariage</a>
                            </li>
                            <li <?php if(isset($categorie) && $categorie == "speciale") { echo "class='active'"; }?>>
                                <a href="<?php echo $this->url('vitrine_categorie', ['categorie' => 'speciale']); ?>">Commande spéciale</a>
                            </li>
						</ul>
					</nav>
				</aside>


				<?php
	// Boucle pour récupérer les ligne de la table annonce
	// construire le code html pour afficher les infos

	// Requete SQL pour lire les info dans la table annonce

//$idsanton = $_REQUEST["santon_id"];

// je recupere les info de la table utilisateur et d'annonce grace à la jointure INNER JOIN

//$requeteSQL = "SELECT * FROM santon  WHERE id = :idsanton ";
//$tabToken = [":idsanton" => $idsanton];

// Envoyer la requete

$objetSantonModel = new \Model\SantonModel;
	
$tabLigne = $objetSantonModel->findColumn($nomUrl, "nom_url");

//$objetPDOStatement = envoyerRequeteSQL($requeteSQL, $tabToken);

// on ne fait pas une boucle while
// while( $tabLigne = $objetPDOStatement->fetch() )
// car on veut seulement savoir si il y a une ligne sélectionnée

if(!empty($tabLigne)){

	// récuperer les colonne de chaque ligne

	$idSanton 						= $tabLigne["id"];
	$nomSanton 						= $tabLigne["nom"];
	$descriptionSanton				= $tabLigne["description"];
	$categorieSanton				= $tabLigne["categorie"];
	$prixSanton						= $tabLigne["prix"];
	$photoSanton					= $tabLigne["photo"];

	$urlPhoto			= $this->assetUrl($photoSanton);

		
}
	// Construire le code HTML
?>
				<section class="col-md-9 col-sm-12 section-content">
					<div class="img-bulle col-md-4 col-sm-3 col-xs-12">
						<figure>
							<img src="<?php echo $urlPhoto ?>" class="img-detail-santon">
						</figure>
					</div>
					<div class="col-md-8 col-sm-9 col-xs-12 detail-santon">
						<h3><?php echo $nomSanton ?></h3>
						<div id="description">
							<p><?php echo $descriptionSanton ?></p>
						</div>
						
						<div class="detail-ajout-panier">
							<form id="buy-block" class="item_form form-inline" action="" method="POST">
								<div class="quantite form-group col-md-5">
									<label>Quantité</label>
									<select name="item_qty" class="form-control">
	                                        <?php
	                                            // Choose itemquantity
	                                            $maxQty=10;
	                                            for($i=1;$i<=$maxQty;$i++){
	                                                echo "<option value='{$i}'>$i</option>";
	                                            }
	                                        ?>
	                                    </select>
									
								</div>
								<div class="prix form-group col-md-2">
									<span class="prix-article"><?php echo $prixSanton ?></span><span class="euro"> €</span>
								</div>
								<div class="form-group pull-right bouton-panier col-md-5">
									<input name="item_id" type="hidden" value="<?php echo $idSanton; ?>">
									<button type="submit" class="ajout-panier btn btn-default">Ajouter au panier<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></button>
								</div>
								
							</form>
						</div>
					</div>
				</section>
			</div>
		</div>	
	
	</main>