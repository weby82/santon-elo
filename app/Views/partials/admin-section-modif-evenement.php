<main class="admin">
	<div class="container">
		<div class="container-inner">
			<h2>Modifier un évènement</h2>
				
			<section class="section-content" id="formCreerActualite">
			
				
	<?php

	$objetEvenementsModel = new \Model\EvenementsModel;
	
	$tabLigne = $objetEvenementsModel->find($id);

	if(!empty($tabLigne)) {
	
		$id          = $tabLigne["id"];
		$titre       = $tabLigne["titre"];	
		$lieu        = $tabLigne["lieu"];	
		$dateStart   = $tabLigne["date_event_start"];	
		$dateEnd     = $tabLigne["date_event_end"];	
		$description = $tabLigne["description"];
		$photo       = $tabLigne["photo"];

		$urlPhoto = $this->assetUrl($photo);		

	?>

	<form method="POST" class="formulaire" enctype="multipart/form-data">
		<div class="retour">
		 	<?php echo $evenementUpdateRetour ?>
		</div>
		<div class="group">
			<input type="text" class="used" name="titre" id="titre" required value="<?php echo $titre ?>" ><span class="highlight"></span><span class="bar"></span>
			<label>Titre</label>
		</div>
		<div class="group colonne-gauche">
			<input type="text" class="used" name="lieu" id="lieu" required value="<?php echo $lieu ?>"><span class="highlight"></span><span class="bar"></span>
			<label>Lieu</label>
		</div>
		<div class="group">
			<input type="date" class="used" name="date_event_start" id="debut" required value="<?php echo $dateStart ?>"><span class="highlight"></span><span class="bar"></span>
			<label>Date de début</label>
		</div>

		<div class="group">
			<input type="date" class="used" name="date_event_end" id="fin" required value="<?php echo $dateEnd ?>"><span class="highlight"></span><span class="bar"></span>
			<label>Date de fin</label>
		</div>

		<div class="clearfix">
			<div class="old-photo col-xs-3 col-md-1 group img-upload">
				<img src="<?php echo $urlPhoto ?>">
			</div>
			<div class="group">
			<input type="file" class="col-xs-9 col-md-11" name="photo">
			</div>
		</div>		
		<div class="group">
			<textarea rows="5" type="text" name="description" required class="used"><?php echo $description ?></textarea><span class="highlight"></span><span class="bar"></span>
			<label>Votre description</label>
		</div>

		<button type="submit" class="btn btn-lg btn-default">Modifier</button>

	<!-- Côté traitement -->
	<input type="hidden" name="oldPath" value="<?php echo $photo ?>">
	<input type="hidden" name="id" value="<?php echo $id ?>">
	<input type="hidden" name="idForm" value="evenementUpdate">

</form>

<?php
	}
	else
	{
		echo "<span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Actualité non trouvée";
	}
?>

			</section>
			</div>
		</div>	
	<div class="push"></div>
</main>