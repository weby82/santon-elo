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

		<div class="clearfix">
			<div class="old-photo col-xs-3 col-md-1 group img-upload">
				<img class="" src="<?php echo $urlPhoto; ?>">
			</div>
			
			<div class="group">
				<input class="col-xs-9 col-md-11" type="file" name="photo">
			</div>

		</div>

		<div class="group form-group col-md-6 col-xs-12 ">
			<textarea  rows="7" type="text" name="contenu" id="contenu" required></textarea></span><span class="bar"></span>
			<label>Votre contenu</label>
		</div>

		<div class="form-group col-md-12 col-xs-12 text-right">
		    <button type="submit" class="btn btn-default">Modifier une actualité</button>
		</div>

		<input type="hidden" name="idForm" value="actualiteUpdate">
		
					
		<div class="retour">
			$actualiteUpdateRetour	
		</div>

	</form>
CODEHTML;
	}
