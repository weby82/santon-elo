<main class="admin">
		<div class="container">
			<div class="container-inner">
				<h2>Modifier un avis client</h2>

<?php 

$objetGuestbookModel = new \Model\GuestbookModel;
$tabLigne = $objetGuestbookModel->find($id);

if(!empty($tabLigne)){
		//récupérer les colonne
		$id 			= $tabLigne["id"];
		$nomClient 		= $tabLigne["nom_client"];
		$description 	= $tabLigne["description"];
		$date 			= $tabLigne["date"];

	    // Afficher le code html
?>
					
					 
						<form class="formulaire" method="GET" action="">

							<div class="retour">
								<?php echo $livreUpdateRetour; ?>
							</div>

							<div class="group">
								<input class="used" type="text" name="nom_client" required value="<?php echo $nomClient ?>"><span class="highlight"></span><span class="bar"></span>
						    	<label>Nom du client</label>
							</div>
							<div class="group">
								<input class="used" type="text" name="date" required value="<?php echo $date ?>"><span class="highlight"></span><span class="bar"></span>
						    	<label>Date</label>
							</div>
							<div class="group">							
								<textarea class="used" rows="5" name="description" required ><?php echo $description ?></textarea><span class="highlight"></span><span class="bar"></span>
						    	<label>Avis du client</label>
							</div>
							<button type="submit" class="btn btn-lg btn-default"> Modifier</button>
							<input type="hidden" name="id" value="<?php echo $id ?>">
							<input type="hidden" name="idForm" value="livreUpdate">
							
						</form>
<?php

	}else{
		// l'id ne correspond a aucun artiste
		echo "<span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Avis non trouvé";
	}
	
?>


			</div>
		</div>
</main>