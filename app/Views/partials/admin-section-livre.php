	<?php
	
	?>
	<main class="admin">
		<div class="container">
			<div class="container-inner">
				<h2>Avis client</h2>

				<section class="col-sm-12 section-content">

					<a class="btn btn-default" href="<?php echo $this->url('admin_creer_livre'); ?>">
					 <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>  Ajouter un avis client
					</a>

				<?php    

			        $objetGuestbookModel = new \Model\GuestbookModel;
	
					$tabLigne = $objetGuestbookModel->findAll("date", "DESC");
					       

			    ?>  
					
					<div class="retour">
						<?php echo $livreDeleteRetour; ?>
					</div>
				
					<table class="table table-striped">
						<thead>
							<th>Nom du client</th>
							<th>Avis du client</th>
							<th>Date</th>
							<th>ID</th>
							<th>Action</th>
						</thead>
						<tbody>
					<?php
					// on  fait une boucle foreach pour recuperer les éléments 
						foreach ($tabLigne as $key => $valeur) {
						$id 			= $valeur["id"];
						$nomClient 		= $valeur["nom_client"];
						$description 	= $valeur["description"];
						$date 			=$valeur["date"];
						$hrefSupprimer  = "?idForm=livreDelete&id=$id";

						$phpDate = strtotime( $date );
                    	$dateLigne = date( 'd-m-Y', $phpDate );
					?>
							<tr>
								<td><?php echo $nomClient; ?></td>
								<td><?php echo $description; ?></td>
								<td><?php echo $dateLigne ?></td>
								<td><?php echo $id; ?></td>
								<td>
									<a href="<?php echo $this->url('admin_modifier_livre', ['id' => $id]); ?>" title="modifier"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
									<a href="<?php echo $hrefSupprimer; ?>" title="supprimer" class="delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>

								</td>
								
								
								
							</tr>
					<?php } ?>
						</tbody>
					</table>
				</section>
			</div>
		</div>	
	</main>
