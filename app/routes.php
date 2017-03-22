<?php
	
	$w_routes = array(
		['GET', '/', 'VitrineDamien#accueil', 'vitrine_accueil'],

		//Page de contact
		['GET|POST', '/contact', 'VitrineLiinaa#contact', 'vitrine_contact'],

		//Liste santon d'une categorie
		['GET|POST', '/categorie/[:categorie]', 'VitrineDamien#categorie', 'vitrine_categorie'],


		// Detail d'un santon
		['GET|POST', '/categorie/[:categorie]/[:nomUrl]', 'VitrineDamien#santon', 'vitrine_afficher_santon'],

		// Liste des actualités
		['GET|POST', '/actualites', 'VitrineKelly#actualites', 'vitrine_actualites'],

		//Liste des evenements
		['GET|POST', '/evenements', 'VitrineKelly#evenements', 'vitrine_evenements'],

		// Livre d'or
		['GET|POST', '/livre', 'VitrineLiinaa#livre', 'vitrine_livre'],

		// Checkout
		['GET|POST', '/commander', 'VitrineDamien#commander', 'vitrine_commander'],

		//Affichage panier
		['GET|POST', '/panier', 'VitrineDamien#panier', 'vitrine_panier'],
	);