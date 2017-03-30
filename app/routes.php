<?php
	
	$w_routes = array(

		//////////////////////FRONT////////////////////////////
		['GET', '/', 'VitrineDamien#accueil', 'vitrine_accueil'],

		//Page de contact
		['GET|POST', '/contact', 'VitrineLiinaa#contact', 'vitrine_contact'],

		//Liste santon d'une categorie
		['GET|POST', '/categorie/[:categorie]', 'VitrineDamien#categorie', 'vitrine_categorie'],

		//Liste santon d'une categorie
		['GET|POST', '/categorie/', 'VitrineDamien#categorieDefault', 'vitrine_default_categorie'],


		// Detail d'un santon
		['GET|POST', '/categorie/[:categorie]/[:nomUrl]', 'VitrineDamien#santon', 'vitrine_afficher_santon'],

		// Liste des actualités
		['GET|POST', '/actualites', 'VitrineKelly#actualites', 'vitrine_actualites'],

		//Détail actualité
		['GET|POST', '/actualite/[:id]', 'VitrineKelly#actualite', 'vitrine_afficher_actualite'],

		//Liste des evenements
		['GET|POST', '/evenements', 'VitrineKelly#evenements', 'vitrine_evenements'],

		// Livre d'or
		['GET|POST', '/livre', 'VitrineLiinaa#livre', 'vitrine_livre'],

		// Checkout
		['GET|POST', '/commander', 'VitrineDamien#commander', 'vitrine_commander'],

		//Affichage panier
		['GET|POST', '/panier', 'VitrineDamien#panier', 'vitrine_panier'],


		///////////////////////////Backoffice//////////////////////////////

		// Page de login
		['GET|POST', '/admin/login', 'AdminDamien#login', 'login'],

		// Déconnexion / Logout
		['GET|POST', '/admin/logout', 'AdminDamien#logout', 'logout'],
		
		// Page d'accueil
		['GET|POST', '/admin/accueil', 'AdminDamien#accueil', 'admin_accueil'],
		
		//Modification / création / suppression des Santons
		['GET|POST', '/admin/santons/', 'AdminDamien#santonsDefault', 'admin_santons_default'],

		//Modification / suppression des Santons
		['GET|POST', '/admin/santons/[:categorie]', 'AdminDamien#gererSantons', 'admin_gerer_santons'],

		// création de Santon
		['GET|POST', '/admin/ajouter-santon', 'AdminDamien#ajouterSanton', 'admin_ajouter_santon'],



		['GET|POST', '/admin/liste/actualite', 'AdminKelly#actualites', 'admin_actualites'],

		['GET|POST', '/admin/actualites', 'AdminKelly#gererActualite', 'admin_gerer_actualites'],

		['GET|POST', '/admin/modifier/actualite', 'AdminKelly#modifierActualites', 'admin_modifier_actualites'],

		['GET|POST', '/admin/creer-actualite', 'AdminKelly#creerActualite', 'admin_creation_actualites'],

		// Liste des avis client
		['GET|POST', '/admin/livre', 'AdminLiinaa#livre', 'admin_livre'],
		// Création des avis client
		['GET|POST', '/admin/creer-livre', 'AdminLiinaa#creerLivre', 'admin_creer_livre'],
		// Modifier l'avis client
		['GET|POST', '/admin/modifier/livre', 'AdminLiinaa#modifierLivre', 'admin_modifier_livre'],
		// Modifier l'avis client
		['GET|POST', '/admin/modifier/livre', 'AdminLiinaa#modifierLivre', 'admin_modifier_livre'],

	);