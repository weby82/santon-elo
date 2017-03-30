	<main>
		<div class="container">
			<div class="container-inner">
				<h2>Création d'actualités</h2>
					<section class="section-content" id="formCreerActualite">	
						<form method="GET" class="formulaire">
							<div class="retour">
								<?php echo $actualiteCreateRetour; ?>
							</div>
							<div class="row">
		        			<div class="colonne-gauche col-md-6 col-xs-12 ">
							

		        			<div class="group colonne-gauche">
							    <input type="text" name="titre" id="titre" required ><span class="highlight"></span><span class="bar"></span>
							    <label>Titre</label>
							</div>

							<div class="group colonne-gauche">
							    <input type="text" name="photo" id='photo'><span class="highlight"></span><span class="bar"></span>
							    <label>Photo</label>
							</div>

							<div class="group form-group">							
								<textarea rows="5" name="contenu" required ></textarea><span class="highlight"></span><span class="bar"></span>
						    	<label>Votre contenu</label>
							</div>
							
							</div>

							 <div class="form-group col-md-12 col-xs-12 text-center">
							  	<button type="submit" class="btn btn-default btn-admin-actu">Créer</button>
							 </div>

							</div>

	 				 <!-- Côté traitement -->
							<input type="hidden" name="idForm" value="actualiteCreate">

						</form>
					</section>

			</div> <!-- container-inner -->
		</div> <!-- container -->
	</main>