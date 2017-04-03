	<?php
	
	?>
	<main class="admin">
		<div class="container">
			<div class="container-inner">
				<h2>Nativité</h2>
				<aside class="col-md-3 col-sm-12 col-nav-left">
					<nav>
						<h3>Catégories</h3>
						<ul class="nav nav-pills nav-stacked">
							<li <?php if(isset($categorie) && $categorie == "nativite") { echo "class='active'"; }?>>
                                    <a href="<?php echo $this->url('admin_gerer_santons', ['categorie' => 'nativite']); ?>">Noël/Natavité</a>
                                </li>
                                <li <?php if(isset($categorie) && $categorie == "bapteme") { echo "class='active'"; }?>>
                                    <a href="<?php echo $this->url('admin_gerer_santons', ['categorie' => 'bapteme']); ?>">Baptême</a>
                                </li>
                                <li <?php if(isset($categorie) && $categorie == "anniversaire") { echo "class='active'"; }?>>
                                    <a href="<?php echo $this->url('admin_gerer_santons', ['categorie' => 'anniversaire']); ?>">Anniversaire</a>
                                </li>
                                <li <?php if(isset($categorie) && $categorie == "communion") { echo "class='active'"; }?>>
                                    <a href="<?php echo $this->url('admin_gerer_santons', ['categorie' => 'communion']); ?>">Communion</a>
                                </li>
                                <li <?php if(isset($categorie) && $categorie == "mariage") { echo "class='active'"; }?>>
                                    <a href="<?php echo $this->url('admin_gerer_santons', ['categorie' => 'mariage']); ?>">Mariage</a>
                                </li>
                                <li <?php if(isset($categorie) && $categorie == "speciale") { echo "class='active'"; }?>>
                                    <a href="<?php echo $this->url('admin_gerer_santons', ['categorie' => 'commande-speciale']); ?>">Commande spéciale</a>
                                </li>
						</ul>
					</nav>
				</aside>
				<section class="col-md-9 col-sm-12 section-content">

					<a class="btn btn-default" href="<?php echo $this->url('admin_ajouter_santon'); ?>">
					 <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>  Ajouter un santon
					</a>

				<?php    
			        /* FETCH ITEMS ACCORDING TO CATEGORIES CHOSEN BY USER */

			        $objetSantonModel = new \Model\SantonModel;
	
					$tabLigne = $objetSantonModel->findAllColumn($categorie, "categorie");

					
					// on  fait une boucle foreach pour recuperer les éléments        

			    ?>  

					<div class="retour">
						<?php echo $santonDeleteRetour; ?>
					</div>
					<table class="table table-striped">
						<thead>
							<th>Photo</th>
							<th>Nom</th>
							<th>Prix</th>
							<th>ID</th>
							<th>Action</th>
						</thead>
						<tbody>
					<?php 
						foreach ($tabLigne as $key => $valeur) {
						$id 		= $valeur["id"];
						$nomUrl 	= $valeur["nom_url"];
						$nom 		= $valeur["nom"];
						$prix 		= $valeur["prix"];
						$photo 		= $valeur["photo"];
						$urlPhoto	= $this->assetUrl($photo);

						$hrefSupprimer  = "?idForm=santonDelete&id=$id";
						$hrefModifier   = $this->url("admin_update_santon", ["id" => $id]);
					?>
							<tr>
								<td><img class="table-img" src="<?php echo $urlPhoto; ?>" alt="<?php echo $nom; ?>"></td>
								<td><?php echo $nom; ?></td>
								<td><?php echo $prix; ?> €</td>
								<td><?php echo $id; ?></td>
								<td>
									<a href="<?php echo $hrefModifier; ?>" title="modifier"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
									<a href="<?php echo $hrefSupprimer; ?>" title="supprimer"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>

								</td>
								
								
								
							</tr>
					<?php } ?>
						</tbody>
					</table>
				</section>
			</div>
		</div>	
		 <div class="push"></div>
	</main>
