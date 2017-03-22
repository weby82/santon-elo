	<?php
	$this->insert('database'); 
	
	?>
	<main>
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
			        /* FETCH ITEMS ACCORDING TO CATEGORIES CHOSEN BY USER */
			       
			        $database = new MySQLDatabase();
			        if(isset($categorie)){
			        	
			            $menuCategory = $categorie; 

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
					<?php 
						foreach($items as $item) { 
						$id = $item["id"];
						$nomUrl = $item["nom_url"];
					?>
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 bloc-santon">
						<form class="item_form">
							<div class="bloc-santon-inner">
								<a href="<?php echo $this->url('vitrine_afficher_santon', [ 'categorie' => $categorie, 'nomUrl' => $nomUrl ]);?>" title="<?php echo $item["nom"]; ?>">
									<img src="<?php echo $item["photo"]; ?>" alt="santon <?php echo $item["nom"]; ?>">
								</a>
								<h3><a href="<?php echo $this->url('vitrine_afficher_santon', [ 'categorie' => $categorie, 'nomUrl' => $nomUrl ]);?>" title="<?php echo $item["nom"]; ?>" title="<?php echo $item["nom"]; ?>"><?php echo $item["nom"]; ?></a></h3>
								<p class="prix-santon"><?php echo $item["prix"]; ?> €</p>
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
