	<main>
		<div class="container">
			<div class="container-inner">
				<h2>Nativité</h2>
				<aside class="col-md-3 col-sm-12 col-nav-left">
					<nav>
						<h3>Catégories</h3></h3>
						<ul class="nav nav-pills nav-stacked">
							<li class="active">
								<a href="./categorie-santons.php?categorie=nativite">Nativité</a>
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
			        if(isset($_GET['categorie'])){
			            $menuCategory = $_GET['categorie'];        
			            /* If you want to display all items click on ShareMyWeb Logo */
			            if($menuCategory =="main"){
			                $items = $database->find_by_query("SELECT * FROM santon");    
			            /* Categories accordingly */
			            }else{            
			                $items = $database->find_by_query("SELECT * FROM santon WHERE categorie='{$menuCategory}'");    
			            }
			        }else{
			            $items = $database->find_by_query("SELECT * FROM santon");    
			        }

			    ?>  

				<section class="col-md-9 col-sm-12 section-content">
					<?php foreach($items as $item) { ?>
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 bloc-santon">
						<form class="item_form">
							<div class="bloc-santon-inner">
								<a href="detail-santon.php?santon_id=<?php echo $item["id"]; ?>" title="<?php echo $item["nom"]; ?>">
									<img src="<?php echo $item["photo"]; ?>" alt="santon <?php echo $item["nom"]; ?>">
								</a>
								<h3><a href="detail-santon.php?santon_id=<?php echo $item["id"]; ?>" title="<?php echo $item["nom"]; ?>"><?php echo $item["nom"]; ?></a></h3>
								<p class="prix-santon"><?php echo $item["prix"]; ?> €</p>
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
								<input name="item_id" type="hidden" value="<?php echo $item["id"]; ?>">
								<button type="submit" class="add_item_to_cart ajout-panier btn btn-default">
									Ajouter au panier<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
								</button>
								
							</div>
						</form>
					</div>
					<?php } ?>
					
				</section>
			</div>
		</div>	
		 <div class="push"></div>
	</main>
