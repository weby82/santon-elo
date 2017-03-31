	<?php
	$this->insert('database'); 
	
	?>
	<main>
		<div class="container">
			<div class="container-inner">
				<h2>Commande speciale</h2>
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
                                <li <?php if(isset($categorie) && $categorie == "commande-speciale") { echo "class='active'"; }?>>
                                    <a href="<?php echo $this->url('vitrine_commande_speciale', ['categorie' => 'commande-speciale']); ?>">Commande spéciale</a>
                                </li>
						</ul>
					</nav>
				</aside>
				
			    

				<section class="col-md-9 col-sm-12 section-content">

					<div class="intro">
						<p>Je peux fabriquer des santons sur mesure, selon vos envies. Le prix et le délai de livraison dépend de la demande. Vous pouvez voir des exemples de créations sur cette page. <br />Veuillez décrire, dans le formulaire ci dessous, de façon précise ce que vous souhaitez et je vous recontacterai rapidement pour vous donnez un prix et un délai.</p>
					</div>
					
					<div id="gallery" style="display:none;">

					<?php    
				        /* FETCH ITEMS ACCORDING TO CATEGORIES CHOSEN BY USER */

				        $objetSantonModel = new \Model\SantonModel;
		
						$tabLigne = $objetSantonModel->findAllColumn("commande-speciale", "categorie");

						
						// on  fait une boucle foreach pour recuperer les éléments   

						foreach ($tabLigne as $key => $valeur) {
						$nom 		= $valeur["nom"];
						$photo 		= $valeur["photo"];

						$urlPhoto	= $this->assetUrl($photo);
					?>     
 
		
						<img alt="<?php echo $nom ?>" src="<?php echo $urlPhoto ?>"
							data-image="<?php echo $urlPhoto ?>">

					<?php } ?>
						
						
					</div>

					<form method="GET" class="formulaire">
						<!-- message de retour -->
						<div class="retour">
						<?php if (isset($GLOBALS["commandeSpecialRetour"])) echo $GLOBALS["commandeSpecialRetour"]; ?>
						</div>
						<div class="row">
		        			<div class="colonne-gauche col-md-6 col-xs-12 ">

								<div class="group colonne-gauche">
								    <input type="text" name="nom" id="nom" required >
								    <span class="highlight"></span>
								    <span class="bar"></span>
								    <label>Nom</label>
								</div>

								<div class="group colonne-gauche">
								    <input type="text" name="prenom" id="prenom" required >
								    <span class="highlight"></span>
								    <span class="bar"></span>
								    <label>Prénom</label>
								</div>

								<div class="group colonne-gauche">
								    <input type="email" name="email">
								    <span class="highlight"></span>
								    <span class="bar"></span>
								    <label>Email</label>
								</div>

								<div class="group colonne-gauche">
								    <input type="text" name="sujet" id="sujet" required >
								    <span class="highlight"></span>
								    <span class="bar"></span>
								    <label>Sujet</label>
								</div>

							</div> <!--colonne-gauche -->

							<div class="group form-group col-md-6 col-xs-12 ">
								<textarea rows="7" type="text" name="message" id="message" required></textarea>
								<span class="highlight"></span>
								<span class="bar"></span>
							    <label>Description de votre commande</label>
							</div>

							<div class="form-group col-md-12 col-xs-12 text-right">
								<button type="submit" class="btn btn-default">Envoyer</button>
							</div>

	  					</div>


 				 <!-- Côté traitement -->
						<input type="hidden" name="idForm" value="commandeSpecialForm">

					

					</form>
				</section>
			</div>
		</div>	
		 <div class="push"></div>
	</main>
