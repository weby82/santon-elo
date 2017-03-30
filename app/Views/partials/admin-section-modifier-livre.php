<main class="admin">
		<div class="container">
			<div class="container-inner">
				<h2>Modifier un avis client</h2>

<?php 

$objetGuestbookModel = new \Model\GuestbookModel;
$tabLigne = $objetGuestbookModel->find($id);

if (!empty($tabLigne))
{
    // RECUPERER LES COLONNES
    $id             = $tabLigne["id"];
    $nomClient      = $tabLigne["nom_client"];
    $description    = $tabLigne["description"];
    // AFFICHER LE CODE HTML
    echo
<<<CODEHTML

	<form class="formulaire" method="GET" action="">
							
							<!-- Formulaire -->
								<div class="group">
									<input type="text" name="nom" required ><span class="highlight"></span><span class="bar"></span>
							    	<label>Nom</label>
								</div>
								<div class="group">
									<textarea rows="5" name="description" required ></textarea><span class="highlight"></span><span class="bar"></span>
							    	<label>Avis du client</label>
								</div>
								<div class="group">
									<input type="text" name="date" required ><span class="highlight"></span><span class="bar"></span>
							    	<label>Date</label>
								</div>
														
								<button type="submit" class="btn btn-lg btn-default"> Ajouter</button>

								<input type="hidden" name="idForm" value="livreCreate">
								
							</form>

CODEHTML;

}
else
{
    // L'ID NE CORRESPOND A AUCUN ARTISTE DANS LA TABLE artistes
    echo "??????????";
}
 ?>


			</div>
		</div>
</main>