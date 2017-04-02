	<main>
		<div class="container">
			<div class="container-inner">
				<h2>Création d'actualités</h2>
					<section class="section-content" id="formCreerActualite">	
					
						<form method="POST" class="formulaire" enctype="multipart/form-data">
							<div class="retour">
								<?php echo $actualiteCreateRetour; ?>
							</div>							
		        			<div class="group">
							    <input type="text" name="titre" id="titre" required ><span class="highlight"></span><span class="bar"></span>
							    <label>Titre</label>
							</div>
							<div class="group">
							    <input type="file" name="photo" required>
							</div>
							<div class="group">							
								<textarea rows="5" name="contenu" required ></textarea><span class="highlight"></span><span class="bar"></span>
						    	<label>Votre contenu</label>
							</div>						

							<button type="submit" class="btn btn-default btn-admin-actu">Créer</button>		
							<input type="hidden" name="idForm" value="actualiteCreate">

						</form>
					</section>

			</div> <!-- container-inner -->
		</div> <!-- container -->
	</main>