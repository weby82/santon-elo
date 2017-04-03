<main class="admin">
	<div class="container">
		<div class="container-inner">
			<h2>Modifier une actualité</h2>
				
			<section class="section-content" id="formCreerActualite">

			
				
	<?php

	$objetActualiteModel = new \Model\ActualiteModel;
	
	$tabLigne = $objetActualiteModel->find($id);

	if(!empty($tabLigne)) {
	
		$id = $tabLigne["id"];
		$titreLigneCourante = $tabLigne["titre"];
		$contenuLigneCourante = $tabLigne["contenu"];
		$photoLigneCourante = $tabLigne["photo"];


		$urlPhoto = $this->assetUrl($photoLigneCourante);

	?>

	<form method="POST" class="formulaire" action="" enctype="multipart/form-data">
		<div class="retour">
			<?php echo $actualiteUpdateRetour; ?>
		</div>

	    <div class="group">
		    <input type="text" name="titre" required value="<?php echo $titreLigneCourante; ?>" class="used"><span class="highlight"></span><span class="bar"></span>
			<label>Titre</label>
		</div>
		<div class="group img-upload clearfix">
			<div class="old-photo col-xs-3 col-md-1">
				<img class="" src="<?php echo $urlPhoto; ?>">
			</div>

			<input class="col-xs-9 col-md-11" type="file" name="photo" >
		</div>
		<div class="group">
			<textarea  rows="5" type="text" name="contenu" id="contenu" required  class="used"><?php echo $contenuLigneCourante; ?></textarea></span><span class="bar"></span>
			<label>Votre contenu</label>
		</div>

		<button type="submit" class="btn btn-lg btn-default">Modifier</button>

		<input type="hidden" name="idForm" value="actualiteUpdate">
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<input type="hidden" name="oldPath" value="<?php echo $photoLigneCourante; ?>">

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