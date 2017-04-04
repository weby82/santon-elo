<!-- Création du main avec actualités et dernier ajouts -->
	<main>
		<div class="container">
			<h2>Livre d'or</h2>
<?php
$objetGuestbookModel = new \Model\GuestbookModel;
	
$tabLigneGuestbook = $objetGuestbookModel->findAll("date", "DESC");
$countGuestbook = 0;

// on  fait une boucle foreach pour recuperer les éléments

foreach ($tabLigneGuestbook as $index => $tabColonneGuestbook) {

	// récuperer les colonne de chaque ligne

	$idGuestbook 		= $tabColonneGuestbook["id"];
	$nomClient 			= $tabColonneGuestbook["nom_client"];
	$description		= $tabColonneGuestbook["description"];
	$date				= $tabColonneGuestbook["date"];


	$description = substr($description, 0, 500);
	$countGuestbook++;

		if($countGuestbook % 2 == 0){
			$pair = "pull-right";
			$offset = 3;
			$speech ="speech";
		}else{
			$pair ="";
			$speech="speech-right";
			$offset = 2;
		}

	// Mettre les dates format français
		$phpDate = strtotime( $date );
		$date = date( 'd-m-Y', $phpDate );
	
	// Construire le code HTML
?>
			<section id="section-temoignage-or">
				<div class="item-or">
					<div class="temoignage-or col-xs-12 col-xs-offset-0 col-md-8 col-md-offset-2 <?php echo $pair . " " . $speech ?>">
						<h4><?php echo $nomClient ?></h4>
						<p class="description-temoignage-or"><?php echo $description ?></p>
						<p class="date-temoignage-or"><?php echo $date ?></p>
					</div>
				</div>
			</section>

<?php 
}
?>
		</div>
	</main>