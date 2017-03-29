	<main>
		<div class="container">
			<div class="container-inner">
				<h2>Création d'actualités</h2>
					<section class="section-content" id="formCreerActualite">	
						<form method="GET" class="formulaire">

		        			<div class="group colonne-gauche ">
							    <input type="text" name="titre" id="titre" required ><span class="highlight"></span><span class="bar"></span>
							    <label>Titre</label>
							</div>

							<div class="group colonne-gauche">
							    <input type="text" name="photo" id='photo'><span class="highlight"></span><span class="bar"></span>
							    <label>Photo</label>
							</div>

							<div class="group form-group col-md-6 col-xs-12 ">
								  <textarea  rows="7" type="text" name="contenu" id="contenu" required></textarea></span><span class="bar"></span>
							    <label>Votre contenu</label>
							</div>

							 <div class="form-group col-md-12 col-xs-12 text-right">
							  	<button type="submit" class="btn btn-default">Créer</button>
							 </div>

	 				 <!-- Côté traitement -->
							<input type="hidden" name="idForm" value="actualiteCreate">

						</form>
					</section>

			</div> <!-- container-inner -->
		</div> <!-- container -->
	
</main>