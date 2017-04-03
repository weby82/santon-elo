<!-- Création du main avec actualités et dernier ajouts -->
	<main class="admin">
		<section id="admin-accueil">
			<div class="container">
				<h2>Administration - Accueil</h2>

				<div class="row bloc-menu">
					<div class="col-md-3 col-xs-6">
						<a class="btn-block" href="<?php echo $this->url('admin_gerer_santons', ['categorie' => 'nativite']); ?>" title="Modifier les santons">
							Modifier les santons
						</a>
					</div>
					<div class="col-md-3 col-xs-6">
						<a class="btn-block" href="<?php echo $this->url('admin_actualites'); ?>" title="Modifier les actualités">
							Modifier les actualités
						</a>
					</div>
					<div class="col-md-3 col-xs-6">
						<a class="btn-block" href="<?php echo $this->url('admin_evenements'); ?>" title="Modifier les évènements">
							Modifier les évènements
						</a>
					</div>
					<div class="col-md-3 col-xs-6">
						<a class="btn-block" href="" title="Modifier le livre d'or">
							Modifier le livre d'or
						</a>
					</div>
				</div>

			</div>
		</section>

	
		
	</main>