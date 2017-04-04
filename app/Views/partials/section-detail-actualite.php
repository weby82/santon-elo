<main id="section-detail-santon">
		<div class="container">
			<div class="container-inner">
			
				
	<?php

	$objetActualiteModel = new \Model\ActualiteModel;
	
	$tabLigne = $objetActualiteModel->find($id);

	if(!empty($tabLigne)) {
	
		$idLigneCourante = $tabLigne["id"];
		$titreLigneCourante = $tabLigne["titre"];
		$contenuLigneCourante = $tabLigne["contenu"];
		$photoLigneCourante = $tabLigne["photo"];

		$contenuLigneCourante = substr($contenuLigneCourante, 0, 500);

		$urlPhoto = $this->assetUrl($photoLigneCourante);

		echo
<<<CODEHTML
	<h2>$titreLigneCourante</h2>
		<section class="detail-actualite">
		<article>
            <div class="list-detail-actualite-inner">
            	<div class="col-md-4 img-bulle">
	                <figure>
	                    <img src="$urlPhoto" alt="image 1" class="img-responsive img-circle img-actualite">
	                </figure>
                </div>
                <div class="col-md-8 div-actualite">
                    <p>$contenuLigneCourante</p>
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
					
				
