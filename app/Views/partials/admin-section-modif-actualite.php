<main>
	<section id="admin-actualite">
		<div class="container">
			<h2>Modification d'une actualité</h2>
			
				
	<?php

	$objetActualiteModel = new \Model\ActualiteModel;
	
	$tabLigne = $objetActualiteModel->find($id);

	if(!empty($tabLigne)) {
	
		$id = $tabLigne["id"];
		$titreLigneCourante = $tabLigne["titre"];
		$contenuLigneCourante = $tabLigne["contenu"];
		$photoLigneCourante = $tabLigne["photo"];

		$contenuLigneCourante = substr($contenuLigneCourante, 0, 500);

		echo 
<<<CODEHTML
	<form method="GET" class="formulaire">

	    <div class="colonne-gauche col-md-6 col-xs-12 ">
			<div class="group colonne-gauche">
		    <input type="text" name="titre" id="titre" required ><span class="highlight"></span><span class="bar"></span>
			<label>Titre</label>
		</div>

		<div class="group colonne-gauche">
			<input type="text" name="photo" id='photo'><span class="highlight"></span><span class="bar"></span>
			<label>Photo</label>
		</div>

		<div class="group form-group col-md-6 col-xs-12 ">
			<textarea  rows="7" type="text" name="contenu" id="contenu" required></textarea></span><span class="bar"></span>
			<label>Votre contenu</label>
		</div>

		<div class="form-group col-md-12 col-xs-12 text-right">
		    <button type="submit" class="btn btn-default">Modifier une actualité</button>
		</div>

		<input type="hidden" name="idForm" value="actualiteUpdate">
		<input type="hidden" name="id" value="$id">
						
		<div class="retour">
			$actualiteUpdateRetour	
		</div>

	</form>
CODEHTML;
	}
	else
	{
		echo "Actualité non trouvée";
	}
	?>

		</div>
	</section>
</main>