 <main>
    <div class="container">
		<div class="container-inner">
		    <h2>Actualité</h2>
		    <section class="list-article">

<?php

	$objetSantonModel = new \Model\ActualiteModel;
	
	$tabLigne = $objetSantonModel->findAll("date", "DESC");

	foreach($tabLigne as $index => $tabColonne) {
	
		$idLigneCourante = $tabColonne["id"];
		$titreLigneCourante = $tabColonne["titre"];
		$contenuLigneCourante = $tabColonne["contenu"];
		$photoLigneCourante = $tabColonne["photo"];

		$contenuLigneCourante = substr($contenuLigneCourante, 0, 500);

		echo
<<<CODEHTML
		<article>
            <div class="list-article-inner">
                <figure class="col-md-4">
                    <img src="$photoLigneCourante" alt="image 1" class="img-responsive">
                </figure>
                <div class="col-md-8 div-article">
                    <h3>$titreLigneCourante</h3>
                    <p>$contenuLigneCourante ...</p>
                    <a class="readmore" href="#">Lire la suite</a>
                </div>
            </div>
        </article>
CODEHTML;

	}
?>
			</section>
		</div>
	</div>
</main>