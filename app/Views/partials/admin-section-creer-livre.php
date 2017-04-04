	<?php
	
	?>
	<main class="admin">
		<div class="container">
			<div class="container-inner">
				<h2>Ajouter un avis client</h2>
				
					<section class="section-content" id="formAjoutlivre">

							<form class="formulaire" method="POST" action="">
							
							<!-- Message de retour -->
								<div class="retour">
									<?php echo $livreCreateRetour; ?>
								</div>

							<!-- Formulaire -->
								<div class="group">
									<input type="text" name="nom_client" required ><span class="highlight"></span><span class="bar"></span>
							    	<label>Nom</label>
								</div>
								<div class="group">
									<textarea rows="5" name="description" required ></textarea><span class="highlight"></span><span class="bar"></span>
							    	<label>Avis du client</label>
								</div>
														
								<button type="submit" class="btn btn-lg btn-default"> Ajouter</button>

								<input type="hidden" name="idForm" value="livreCreate">
								
							</form>	

					</section>

			</div> <!-- container-inner -->
		</div> <!-- container -->

		 <div class="push"></div>
	</main>
