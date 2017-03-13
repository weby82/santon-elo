 <main>
    <div class="container">
		<div class="container-inner">
		    <h2>Actualité</h2>
		    <section class="list-article">

<?php

	$requeteSQL = "SELECT * FROM actualite";


	$tabToken =	[];

	$objetPDOStatement = envoyerRequeteSQL($requeteSQL, $tabToken);

	while ($tabLigne = $objetPDOStatement->fetch())
	{
		$idLigneCourante = $tabLigne["id"];
		$titreLigneCourante = $tabLigne["titre"];
		$contenuLigneCourante = $tabLigne["contenu"];
		$photoLigneCourante = $tabLigne["photo"];

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