	<main>

		<div class="container">
			<div class="container-inner">
				<h2>Formulaire de contact</h2>
							
					<form method="GET" class="formulaire">

	        			<div class="colonne-gauche col-md-6 col-xs-12 ">
						  <div class="group colonne-gauche">
						    <input type="text" name="nom" id="nom" required ><span class="highlight"></span><span class="bar"></span>
						    <label>Nom</label>
						  </div>

						  <div class="group colonne-gauche">
						    <input type="text" name="prenom" id="prenom" required ><span class="highlight"></span><span class="bar"></span>
						    <label>Prénom</label>
						  </div>

						  <div class="group colonne-gauche">
						    <input type="email"><span class="highlight"></span><span class="bar"></span>
						    <label>Email</label>
						  </div>

						  <div class="group colonne-gauche">
						    <input type="text" name="sujet" id="sujet" required ><span class="highlight"></span><span class="bar"></span>
						    <label>Sujet</label>
						  </div>
						</div> <!--colonne-gauche -->

						  <div class="group form-group col-md-6 col-xs-12 ">
							  <textarea  rows="7" type="text" name="message" id="message" required></textarea></span><span class="bar"></span>
						    <label>Votre message</label>
						  </div>

						  <div class="form-group col-md-12 col-xs-12 text-right">
						  	<button type="submit" class="btn btn-default">Envoyer</button>
						  </div>

  


 				 <!-- Côté traitement -->
						<input type="hidden" name="idFormClasse" value="Contact">
						<input type="hidden" name="idFormMethode" value="contactTraitement">

					<!-- message de retour -->
						<div class="retour">
	<?php if (isset($GLOBALS["contactRetour"])) echo $GLOBALS["contactRetour"]; ?>
						</div>

					</form>

			</div> <!-- container-inner -->
		</div> <!-- container -->
	
</main>