	<main>

		<div class="container">
			<div class="container-inner">
				<h2>Formulaire de contact</h2>
							
					<form method="POST" class="formulaire">
						<!-- message de retour -->
						<div class="retour">
							<?php if (isset($GLOBALS["contactRetour"])) echo $GLOBALS["contactRetour"]; ?>
						</div>
						<div class="row">
		        			<div class="colonne-gauche col-md-6 col-xs-12 ">

								<div class="group colonne-gauche">
								    <input type="text" name="nom" id="nom" required
								    		class="<?php if(isset($_POST['nom'])) echo 'used'; ?>"  
								    		value="<?php if(isset($_POST['nom'])) echo $_POST['nom']; ?>">
								    <span class="highlight"></span>
								    <span class="bar"></span>
								    <label>Nom</label>
								</div>

								<div class="group colonne-gauche">
								    <input type="text" name="prenom" id="prenom" required 
											class="<?php if(isset($_POST['prenom'])) echo 'used'; ?>"
								    		value="<?php if(isset($_POST['prenom'])) echo $_POST['prenom']; ?>">
								    <span class="highlight"></span>
								    <span class="bar"></span>
								    <label>Prénom</label>
								</div>

								<div class="group colonne-gauche">
								    <input type="email" name="email" 
								    		class="<?php if(isset($_POST['email'])) echo 'used'; ?>"
								    		value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
								    <span class="highlight"></span>
								    <span class="bar"></span>
								    <label>Email</label>
								</div>

								<div class="group colonne-gauche">
								    <input type="text" name="sujet" id="sujet" required 
								    		class="<?php if(isset($_POST['sujet'])) echo 'used'; ?>"
								    		value="<?php if(isset($_POST['sujet'])) echo $_POST['sujet']; ?>">
								    <span class="highlight"></span>
								    <span class="bar"></span>
								    <label>Sujet</label>
								</div>

							</div> <!--colonne-gauche -->

							<div class="group form-group col-md-6 col-xs-12 ">
								<textarea rows="7" type="text" name="message" id="message" required class="<?php if(isset($_POST['message'])) echo 'used'; ?>"><?php if(isset($_POST['message'])) echo $_POST['message']; ?></textarea>
								<span class="highlight"></span>
								<span class="bar"></span>
							    <label>Votre message</label>
							</div>
							

	  					</div>
						<div class="row">
							<div class="col-md-12">
								<div class="g-recaptcha" data-sitekey="6LeIMBsUAAAAAGjcirRyRPKc305449cDC7uLiLrd"></div>
							</div>

							<div class="submit col-md-12 text-right">
								<button type="submit" class="btn btn-default">Envoyer</button>
							</div>
						</div>

 				 <!-- Côté traitement -->
						<input type="hidden" name="idFormClasse" value="Contact">
						<input type="hidden" name="idFormMethode" value="contactTraitement">

					

					</form>


			</div> <!-- container-inner -->
		</div> <!-- container -->
	
</main>