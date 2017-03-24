 <main>
    <div class="container">
		<div class="container-inner">
		    <h2>Actualité</h2>
		    <section class="list-article">

<?php

	$objetArticleModel = new \Model\ActualiteModel;
	
	$tabLigne = $objetArticleModel->findAll("date", "DESC");
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
 		
		$url = $this->url('vitrine_afficher_actualite', ['id' => $id]);
?>
		<article>
            <div class="list-article-inner col-md-8 col-md-offset-<?php echo $offset; ?>" >
                <figure class="col-md-4 <?php echo $pair; ?>">
                    <img src="<?php echo $photoLigneCourante; ?>" alt="image 1" class="img-responsive img-circle">
                </figure>
                <div class="col-md-8 div-article">
                    <h3><?php echo $titreLigneCourante; ?></h3>
                    <p><?php echo $contenuLigneCourante; ?> ...</p>
                    <a class="readmore" href="<?php echo $url; ?>">Lire la suite</a>
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