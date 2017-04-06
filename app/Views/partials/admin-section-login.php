<!-- Création du main avec actualités et dernier ajouts -->
	<main class="admin">
		<section id="admin-login">
			<div class="container">
				<div class="login-block col-md-4 col-md-offset-4 col-xs-12 col-xs-offset-0">
					<div class="login-block-inner">
						<h2>Connexion</h2>
						<form class="formulaire" method="POST" action="">
							<div class="retour">
								<?php echo $loginRetour; ?>
							</div>
							<div class="group">
								<input type="text" name="identifiant" required><span class="highlight"></span><span class="bar"></span>
						    	<label>Email ou nom d'utilisateur</label>
						    </div>
							<div class="group">
								<input type="password" name="password" required><span class="highlight"></span><span class="bar"></span>
						    	<label>Mot de passe</label>
						    </div>
							<div>
								<button class="btn btn-default btn-lg btn-block" type="submit"> Me connecter</button>
							</div>
							<input type="hidden" name="idForm" value="login">
						</form>
					</div>
				</div>
			</div>
		</section>

	
		
	</main>