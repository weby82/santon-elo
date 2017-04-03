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

		//Commande special
		['GET|POST', '/commande-speciale', 'VitrineDamien#commandeSpeciale', 'vitrine_commande_speciale'],

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

		['GET|POST', '/admin/modifier-santon/[:id]', 'AdminDamien#updateSanton', 'admin_update_santon'],



		// Page d'actualité côté admin 
		['GET|POST', '/admin/liste/actualite', 'AdminKelly#actualites', 'admin_actualites'],

		// Suppression des actualités
		['GET|POST', '/admin/actualites', 'AdminKelly#gererActualites', 'admin_gerer_actualites'],

		// Modification des actualités
		['GET|POST', '/admin/modifier/actualite/[:id]', 'AdminKelly#modifierActualites', 'admin_modifier_actualites'],

		// Création des actualités
		['GET|POST', '/admin/creer-actualite', 'AdminKelly#creerActualite', 'admin_creation_actualites'],

		// Page d'évènement côté admin
		['GET|POST', '/admin/liste/evenement', 'AdminKelly#evenements', 'admin_evenements'],

		// Création des évènements
		['GET|POST', '/admin/creer-evenement', 'AdminKelly#creerEvenement', 'admin_creation_evenements'],

		// Modifiacation/update des évènements
		['GET|POST', '/admin/modifier/evenement/[:id]', 'AdminKelly#modifierEvenement',	'admin_modifier_evenement'],

		['GET|POST', '/admin/evenements', 'AdminKelly#gererEvenements',	'admin_gerer_evenements'],


	);