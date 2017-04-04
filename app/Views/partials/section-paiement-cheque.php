	<main>

		<div class="container">
			<div class="container-inner">
				<h2>Commande par chèque</h2>
				<p>Pour payer par chèque, remplissez le formulaire ci-dessous et je vous recontacterez rapidement pour le détail du paiement</p>
							
					<form method="POST" class="formulaire" id="commandeCheque">
						<!-- message de retour -->
						<div class="retour">
							<?php if (isset($GLOBALS["paiementChequeRetour"])) echo $GLOBALS["paiementChequeRetour"]; ?>
						</div>
						<div class="row">
		        			<div class="col-md-6 col-xs-12 ">
								<div class="group">
								    <input type="text" name="nom" id="nom" required
								    		class="<?php if(isset($_POST['nom'])) echo 'used'; ?>"  
								    		value="<?php if(isset($_POST['nom'])) echo $_POST['nom']; ?>">
								    <span class="highlight"></span>
								    <span class="bar"></span>
								    <label>Nom</label>
								</div>
							</div>
							<div class="col-md-6 col-xs-12 ">
								<div class="group">
								    <input type="text" name="prenom" id="prenom" required
								   		 	class="<?php if(isset($_POST['prenom'])) echo 'used'; ?>"  
								    		value="<?php if(isset($_POST['prenom'])) echo $_POST['prenom']; ?>">
								    <span class="highlight"></span>
								    <span class="bar"></span>
								    <label>Prénom</label>
								</div>
							</div>
							<div class="col-md-6 col-xs-12 ">
								<div class="group">
								    <input type="email" name="email" required 
								    		class="<?php if(isset($_POST['email'])) echo 'used'; ?>"  
								    		value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
								    <span class="highlight"></span>
								    <span class="bar"></span>
								    <label>Email</label>
								</div>
							</div>
							<div class="col-md-6 col-xs-12 ">
								<div class="group">
								    <input type="text" name="tel" required
								    		class="<?php if(isset($_POST['tel'])) echo 'used'; ?>"  
								    		value="<?php if(isset($_POST['tel'])) echo $_POST['tel']; ?>">
								    <span class="highlight"></span>
								    <span class="bar"></span>
								    <label>Téléphone</label>
								</div>
							</div>
							<div class="col-md-12 col-xs-12 ">
								<div class="group">
								    <input type="text" name="adresse" required
								    		class="<?php if(isset($_POST['adresse'])) echo 'used'; ?>"  
								    		value="<?php if(isset($_POST['adresse'])) echo $_POST['adresse']; ?>">
								    <span class="highlight"></span>
								    <span class="bar"></span>
								    <label>Adresse</label>
								</div>
							</div>
							<div class="col-md-6 col-xs-12 ">
								<div class="group">
								    <input type="text" name="codePostal" required
								    		class="<?php if(isset($_POST['codePostal'])) echo 'used'; ?>"  
								    		value="<?php if(isset($_POST['codePostal'])) echo $_POST['codePostal']; ?>">
								    <span class="highlight"></span>
								    <span class="bar"></span>
								    <label>Code Postal</label>
								</div>
							</div>
							<div class="col-md-6 col-xs-12 ">
								<div class="group">
								    <input type="text" name="ville" required
								    		class="<?php if(isset($_POST['ville'])) echo 'used'; ?>"  
								    		value="<?php if(isset($_POST['ville'])) echo $_POST['ville']; ?>">
								    <span class="highlight"></span>
								    <span class="bar"></span>
								    <label>Ville</label>
								</div>
							</div>
							<div class="col-md-12 col-xs-12 ">
								<div class="group">
								    <input type="text" name="sujet" required
								    		class="used"  
								    		value="Commande avec paiement par chèque">
								    <span class="highlight"></span>
								    <span class="bar"></span>
								    <label>Sujet</label>
								</div>

							</div> 

							<div class="group form-group col-md-12 col-xs-12 ">
								<textarea rows="7" name="detailCommande" id="detailCommande" required class="used form-control" disabled>Santons commandés :<?php
										echo "\n";
										$total=0; 
										foreach($_SESSION["items"] as $item){
											echo "- ". $item["item_name"] . " x " . $item["item_qty"]. " = ". "€". sprintf("%.2f", ($item["item_price"] * $item["item_qty"])). "\n";
											$total += ($item["item_price"] * $item["item_qty"]);
										}
										echo "\nTotal = ". sprintf("%.2f",$total) . "€";
									?></textarea>
								<span class="highlight"></span>
								<span class="bar"></span>
							    <label>Votre Commande</label>
							</div>
							<div class="group form-group col-md-12 col-xs-12 ">
								<textarea rows="7" cols="40" name="commentaire" class="commentaire <?php if(isset($_POST['ville'])) echo 'used'; ?>"><?php if(isset($_POST['commentaire'])) echo $_POST['commentaire']; ?></textarea>
								<span class="highlight"></span>
								<span class="bar"></span>
							    <label>Commentaire</label>
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
						<input type="hidden" name="idForm" value="paiementChequeForm">

					</form>


			</div> <!-- container-inner -->
		</div> <!-- container -->
	
</main>