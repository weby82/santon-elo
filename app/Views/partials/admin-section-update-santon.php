	<?php
	
	?>
	<main class="admin">
		<div class="container">
			<div class="container-inner">
				<h2>Modifier un santon</h2>
				
				<section class="section-content" id="formAjoutSanton">

<?php 
	// On va chercher les info depuis la table artistes
	// avec le framework W 
	// on va passer par la class ArtistesModel
	$objetSantonModel = new \Model\SantonModel;
	// findAll retourne un tableau de tableau (ligne + colonne)
	$tabLigne = $objetSantonModel->find($id);

	//debug
	//print_r($tabLigne);
	// Si j'ai bien un tableau avec dees infos

	if(!empty($tabLigne)){
		//récupérer les colonne
		$id 			= $tabLigne["id"];
		$nomUrl 		= $tabLigne["nom_url"];
		$nom 			= $tabLigne["nom"];
		$prix 			= $tabLigne["prix"];
		$categorie 		= $tabLigne["categorie"];
		$photoActuel 	= $tabLigne["photo"];
		$description 	= $tabLigne["description"];
		$urlPhoto		= $this->assetUrl($photoActuel);

	    // Afficher le code html
?>
					
					 
						<form class="formulaire" method="POST" action="" enctype="multipart/form-data">
							<div class="retour">
								<?php echo $santonUpdateRetour; ?>
							</div>
							<div class="group">
								<input class="used" type="text" name="nom" required value="<?php echo $nom ?>"><span class="highlight"></span><span class="bar"></span>
						    	<label>Nom</label>
							</div>
							<div class="group input-nom-url">
								<input class="used" type="text" name="nom_url" required value="<?php echo $nomUrl ?>"><span class="highlight"></span><span class="bar"></span>
						    	<label>URL (pas d'espace ni d'accent)</label>
							</div>
							<div class="group">
								<input class="used" type="text" name="prix" required value="<?php echo $prix ?>"><span class="highlight"></span><span class="bar"></span>
						    	<label>Prix</label>
							</div>
							<div class="group">
								<select class="form-control used" name="categorie">
									<option value="nativite" <?php if($categorie == "nativite") echo "selected" ?>>Nativité</option>
									<option value="bapteme" <?php if($categorie == "bapteme") echo "selected" ?>>Baptême</option>
									<option value="anniversaire"  <?php if($categorie == "anniversaire") echo "selected" ?>>Anniversaire</option>
									<option value="communion" <?php if($categorie == "communion") echo "selected" ?>>Communion</option>
									<option value="mariage" <?php if($categorie == "mariage") echo "selected" ?>>Mariage</option>
									<option value="commande-speciale" <?php if($categorie == "commande-speciale") echo "selected" ?>>Commande spéciale</option>
								</select>
								<label>Catégorie</label>
							</div>
							<div class="group img-upload clearfix">
								<div class="old-photo col-xs-3 col-md-1">
									<img class="" src="<?php echo $urlPhoto; ?>">
								</div>
							<!-- Temporaire, a remplacer par un upload -->
								<input class="col-xs-9 col-md-11" type="file" name="photo" placeholder="Ajouter une photo" />
							</div>
							<div class="group">							
								<textarea class="used" rows="5" name="description" required ><?php echo $description ?></textarea><span class="highlight"></span><span class="bar"></span>
						    	<label>Description</label>
							</div>
							<button type="submit" class="btn btn-lg btn-default"> Modifier</button>
							<input type="hidden" name="oldPath" value="<?php echo $photoActuel; ?>">
							<input type="hidden" name="id" value="<?php echo $id ?>">
							<input type="hidden" name="idForm" value="santonUpdate">
							
						</form>
<?php

	}else{
		// l'id ne correspond a aucun artiste
		echo "<span class='glyphicon glyphicon-alert' aria-hidden='true'></span> Santon non trouvé";
	}
	
?>
				
				</section>
			</div>
		</div>	
		 <div class="push"></div>
	</main>
