<?php

if (isset $_REQUEST("idForm"))
{
	$idCategorie = $_REQUEST("idForm");

	$requeteSQL = "SELECT nom, prix, img 
				   FROM santon
				   WHERE categorie = :categorie";

	$tabToken =	[ ":categorie" => $idCategorie ];

	$Santons = envoyerRequeteSQL($requeteSQL, $tabToken);

	

}