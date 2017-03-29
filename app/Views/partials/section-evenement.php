 <main>
    <div class="container">
		<div class="container-inner">
		    <h2>Evènement</h2>
		    <section class="list-evenement">

<?php

	$objetEvenementsModel = new \Model\EvenementsModel;
	
	$tabLigne = $objetEvenementsModel->findAll("date_publication", "DESC");
	$countEvenement = 0;
	foreach($tabLigne as $index => $tabColonne) {
	
		$idLigneCourante          = $tabColonne["id"];
		$titreLigneCourante       = $tabColonne["titre"];
		$lieuLigneCourante        = $tabColonne["lieu"];
		$dateStartLigneCourante   = $tabColonne["date_event_start"];
		$dateEndLigneCourante     = $tabColonne["date_event_end"];
		$descriptionLigneCourante = $tabColonne["description"];
		$photoLigneCourante       = $tabColonne["photo"];

		$descriptionLigneCourante = substr($descriptionLigneCourante, 0, 500);
		$countEvenement++;

		if($countEvenement % 2 == 0){
			$pair = "pull-right";
			$offset = 3;
		}else{
			$pair ="";
			$offset = 2;
		}

		$urlPhoto = $this->assetUrl($photoLigneCourante);

		// Mettre les dates format français
		$phpDateStart = strtotime( $dateStartLigneCourante );
		$dateStartLigneCourante = date( 'd-m-Y', $phpDateStart );

		$phpDateEnd = strtotime( $dateEndLigneCourante );
		$dateEndLigneCourante = date( 'd-m-Y', $phpDateEnd );


		echo
<<<CODEHTML
		<article>
            <div class="list-evenement-inner col-md-8 col-md-offset-2" >
                <figure class="col-md-4 $pair">
                    <img src="$urlPhoto" alt="image 1" class="img-responsive img-circle">
                </figure>
                <div class="col-md-8 div-evenement">
                    <h3>$titreLigneCourante</h3>
                    <div class="calendrier">
	                    <span>A $lieuLigneCourante</span> 
	                    <span>du $dateStartLigneCourante</span>
	                    <span>au $dateEndLigneCourante</span>
                    </div>
                    <p>$descriptionLigneCourante</p>
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