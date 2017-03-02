	
	<main id="section-detail-santon">
		<div class="container">
			<div class="container-inner">
				<h2>Nativité</h2>
				<aside class="col-md-3 col-sm-12 col-nav-left">
					<nav>
						<h3>Catégories</h3></h3>
						<ul class="nav nav-pills nav-stacked">
							<li class="active">
								<a href="#">Nativité</a>
							</li>
							<li class="">
								<a href="#">Baptême</a>
							</li>
							<li class="">
								<a href="#">Anniversaire</a>
							</li>
							<li class="">
								<a href="#">Communion</a>
							</li>
							<li class="">
								<a href="#">Mariage</a>
							</li>
							<li class="">
								<a href="#">Commande personnalisée</a>
							</li>
						</ul>
					</nav>
				</aside>

				<?php    
			        /* FETCH ITEMS ACCORDING TO CATEGORIES CHOSEN BY USER */
			        if(isset($_GET['santon_id'])){
			            $choixSanton = $_GET['santon_id'];        
			            /* If you want to display all items click on ShareMyWeb Logo */
			            if($menuCategory =="main"){
			                $items = $database->find_by_query("SELECT * FROM santon");    
			            /* Categories accordingly */
			            }else{            
			                $items = $database->find_by_query("SELECT * FROM santon WHERE id='{$choixSanton}'");    
			            }
			        }else{
			            $items = $database->find_by_query("SELECT * FROM santon");    
			        }

			    ?>  
				<section class="col-md-9 col-sm-12 section-content">
					<figure class="col-md-4 col-sm-3 col-xs-12">
						<img src="./assets/img/santons/nativite/mouton.jpg">
					</figure>
					<div class="col-md-8 col-sm-9 col-xs-12 detail-santon">
						<h3>Santon 1</h3>
						<div id="description">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae, eligendi fugiat necessitatibus illo deleniti, dignissimos voluptates nam incidunt est impedit animi eum vel consectetur non nulla provident sunt, architecto deserunt.</p>
						</div>
						<p id="availability_statut">
							<span id="dispo-label">Disponibilité :</span>
							<span id="dispo-value"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> En stock</span>
							<span id="dispo-value"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Indisponible</span>				
						</p>
						<div class="detail-ajout-panier">
							<form id="buy-block" class="form-inline" action="" method="POST">
								<div class="quantite form-group">
									<label>Quantité</label>
									<input class="form-control" id="quantite-value" type="number" min="0" name="quantite">
								</div>
								<div class="prix form-group">
									<span class="prix-article">12</span><span class="euro"> €</span>
								</div>
								<div class="form-group pull-right bouton-panier">
									<button type="submit" class="ajout-panier btn btn-default">Ajouter au panier<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></button>
								</div>
								
							</form>
						</div>
					</div>
				</section>
			</div>
		</div>	
	
	</main>