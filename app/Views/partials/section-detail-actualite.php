<main id="section-detail-santon">
		<div class="container">
			<div class="container-inner">
				<h2>Actualité</h2>
				<section class="detail-article">
	<?php

	$objetActualiteModel = new \Model\ActualiteModel;
	
	$tabLigne = $objetActualiteModel->find($id);

	if(!empty($tabLigne)) {
	
		$idLigneCourante = $tabLigne["id"];
		$titreLigneCourante = $tabLigne["titre"];
		$contenuLigneCourante = $tabLigne["contenu"];
		$photoLigneCourante = $tabLigne["photo"];

		$contenuLigneCourante = substr($contenuLigneCourante, 0, 500);

		echo
<<<CODEHTML
		<article>
            <div class="list-article-inner col_md-8 col-md-offset-3">
                <figure class="col-md-3">
                    <img src="$photoLigneCourante" alt="image 1" class="img-responsive img-circle">
                </figure>
                <div class="col-md-9 div-article">
                    <h3>$titreLigneCourante</h3>
                    <p>$contenuLigneCourante ...</p>
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
					
				