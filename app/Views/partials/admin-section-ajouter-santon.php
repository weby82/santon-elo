	<?php
	
	?>
	<main class="admin">
		<div class="container">
			<div class="container-inner">
				<h2>Ajouter un santon</h2>
				
				<section class="section-content" id="formAjoutSanton">

					
					 
						<form class="formulaire" method="POST" action="" enctype="multipart/form-data">
							<div class="retour">
								<?php echo $santonCreateRetour; ?>
							</div>
							<div class="group">
								<input type="text" name="nom" required ><span class="highlight"></span><span class="bar"></span>
						    	<label>Nom</label>
							</div>
							<div class="group input-nom-url">
								<input type="text" name="nom_url" required ><span class="highlight"></span><span class="bar"></span>
						    	<label>URL (pas d'espace ni d'accent)</label>
							</div>
							<div class="group">
								<input type="text" name="prix" required ><span class="highlight"></span><span class="bar"></span>
						    	<label>Prix</label>
							</div>
							<div class="group">
								<select class="form-control" name="categorie">
									<option value="nativite">Nativité</option>
									<option value="bapteme">Baptême</option>
									<option value="anniversaire">Anniversaire</option>
									<option value="communion">Communion</option>
									<option value="mariage">Mariage</option>
									<option value="commande-speciale">Commande spéciale</option>
								</select>
							</div>
							<div class="group">
							<!-- Temporaire, a remplacer par un upload -->
								<input type="file" name="photo" required placeholder="Ajouter une photo" />
							</div>
							<div class="group">							
								<textarea rows="5" name="description" required ></textarea><span class="highlight"></span><span class="bar"></span>
						    	<label>Description</label>
							</div>
							<button type="submit" class="btn btn-lg btn-default"> Ajouter</button>
							<input type="hidden" name="idForm" value="santonCreate">
							
						</form>
					</div>

				
				</section>
			</div>
		</div>	
		 <div class="push"></div>
	</main>
