 <main>
    <div class="container">
		<div class="container-inner">
		    <h2>Actualité</h2>
		    <section class="list-actualite">

<?php

	$objetActualiteModel = new \Model\ActualiteModel;
	
	$tabLigne = $objetActualiteModel->findAll("date", "DESC");
	$countArticle = 0;
	foreach($tabLigne as $index => $tabColonne) {
	
		$id = $tabColonne["id"];
		$titreLigneCourante = $tabColonne["titre"];
		$contenuLigneCourante = $tabColonne["contenu"];
		$photoLigneCourante = $tabColonne["photo"];

		$contenuLigneCourante = substr($contenuLigneCourante, 0, 500);
		$countArticle++;

		if($countArticle % 2 == 0){
			$pair = "pull-right";
			$offset = 3;
		}else{
			$pair ="";
			$offset = 2;
		}

		$urlPhoto = $this->assetUrl($photoLigneCourante);
 		
		$url = $this->url('vitrine_afficher_actualite', ['id' => $id]);
?>
		<article class="col-xs-12 col-xs-offset-0 col-md-8  col-md-offset-<?php echo $offset; ?>">
            <div class="list-actualite-inner">
                <figure class="col-md-4 col-xs-12 <?php echo $pair; ?>">
                    <img src="<?php echo $urlPhoto; ?>" alt="image 1" class="img-responsive img-circle">
                </figure>
                <div class="col-md-8 col-xs-12 article-detail">
                    <h3><?php echo $titreLigneCourante; ?></h3>
                    <p><?php echo $contenuLigneCourante; ?> ...</p>
                    <a class="readmore btn" href="<?php echo $url; ?>">Lire la suite</a>
                </div>
            </div>
        </article>
<?php

	}
?>
			</section>
		</div>
	</div>
</main>