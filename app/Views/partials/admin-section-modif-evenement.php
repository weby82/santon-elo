<main>
	<section id="admin-actualite">
		<div class="container">
			<h2>Modification d'un évènement</h2>
			
				
	<?php

	$objetEvenementModel = new \Model\EvenementModel;
	
	$tabLigne = $objetEvenementModel->find($id);

	if(!empty($tabLigne)) {
	
		$id = $tabLigne["id"];
		$titre = $tabLigne["titre"];
		$description = $tabLigne["contenu"];
		$photoLigneCourante = $tabLigne["photo"];

		$contenuLigneCourante = substr($contenuLigneCourante, 0, 500);

		echo 
<<<CODEHTML	
	<form method="GET" class="formulaire">
		<div class="row">
		    <div class="colonne-gauche col-md-6 col-xs-12 ">

		        <div class="group colonne-gauche">
					<input type="text" name="titre" id="titre" required ><span class="highlight"></span><span class="bar"></span>
					<label>Titre</label>
				</div>

				<div class="group colonne-gauche">
					<input type="text" name="lieu" id="lieu" required ><span class="highlight"></span><span class="bar"></span>
					<label>Lieu</label>
				</div>

				<div class="group colonne-gauche">
					<input type="date" name="debut" id="debut" required ><span class="highlight"></span><span class="bar"></span>
					<label>Date de début</label>
				</div>

				<div class="group colonne-gauche">
					<input type="date" name="fin" id="fin" required ><span class="highlight"></span><span class="bar"></span>
					<label>Date de fin</label>
				</div>

				<div class="group colonne-gauche">
					<input type="text" name="photo" id='photo'><span class="highlight"></span><span class="bar"></span>
					<label>Photo</label>
				</div>

			</div>

			<div class="group form-group col-md-6 col-xs-12">
				<textarea rows="17" type="text" name="description" id="description" required class="hauteur-msg"></textarea>
				<span class="highlight"></span>
				<span class="bar"></span>
				<label>Votre description</label>
			</div>
							
		</div>

		<div class="form-group col-md-12 col-xs-12 text-right">
			<button type="submit" class="btn btn-default">Créer</button>
		</div>

	</div>

	<!-- Côté traitement -->
	<input type="hidden" name="idForm" value="evenementCreate">

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