	<main>
		<div class="container">
			<div class="container-inner">
				<h2>Création d'évènements</h2>
					<section class="section-content" id="formCreerEvenement">	
						<form method="POST" class="formulaire" enctype="multipart/form-data">
							<div class="retour">
								<?php echo $evenementCreateRetour; ?>
							</div>
							<div class="row">
		        			<div class="colonne-gauche col-md-6 col-xs-12 ">


		        			<div class="group colonne-gauche">
							    <input type="text" name="titre" id="titre" required ><span class="highlight"></span><span class="bar"></span>
							    <label>Titre</label>
							</div>

							<div class="group colonne-gauche">
							    <input type="text" name="lieu" id="lieu" required ><span class="highlight"></span><span class="bar"></span>
							    <label>Lieu</label>
							</div>

							<div class="group colonne-gauche">
							    <input type="date" name="date_event_start" id="debut" class="used" required ><span class="highlight"></span><span class="bar"></span>
							    <label>Date de début</label>
							</div>

							<div class="group colonne-gauche">
							    <input type="date" name="date_event_end" id="fin" class="used" required ><span class="highlight"></span><span class="bar"></span>
							    <label>Date de fin</label>
							</div>

							<div class="group">
							    <input type="file" name="photo" required>
							</div>

							</div>

							<div class="group form-group col-md-6 col-xs-12">
								<textarea rows="17" type="text" name="description" id="description" required class="hauteur-msg"></textarea>
								<span class="highlight"></span>
								<span class="bar"></span>
							    <label>Votre description</label>
							</div>
							
							</div>

							 <div class="form-group col-md-12 col-xs-12 text-right">
							  	<button type="submit" class="btn btn-default">Créer</button>
							 </div>

							</div>

	 				 <!-- Côté traitement -->
							<input type="hidden" name="idForm" value="evenementCreate">

						</form>
					</section>

			</div> <!-- container-inner -->
		</div> <!-- container -->
	</main>