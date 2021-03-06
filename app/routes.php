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

		//Paiement apr chèque
		['GET|POST', '/paiement/cheque', 'VitrineDamien#paiementCheque', 'vitrine_paiement_cheque'],


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
		['GET|POST', '/admin/santon/ajouter', 'AdminDamien#ajouterSanton', 'admin_ajouter_santon'],

		['GET|POST', '/admin/santon/modifier/[:id]', 'AdminDamien#updateSanton', 'admin_update_santon'],


		// Page d'actualité côté admin 
		['GET|POST', '/admin/liste/actualite', 'AdminKelly#gererActualites', 'admin_actualites'],


		// Modification des actualités
		['GET|POST', '/admin/modifier/actualite/[:id]', 'AdminKelly#modifierActualites', 'admin_modifier_actualites'],

		// Création des actualités
		['GET|POST', '/admin/creer-actualite', 'AdminKelly#creerActualite', 'admin_creation_actualites'],


		// Page d'évènement côté admin
		['GET|POST', '/admin/liste/evenement', 'AdminKelly#gererEvenements', 'admin_evenements'],


		// Création des évènements
		['GET|POST', '/admin/creer-evenement', 'AdminKelly#creerEvenement', 'admin_creation_evenements'],

		// Modification/update des évènements
		['GET|POST', '/admin/modifier/evenement/[:id]', 'AdminKelly#modifierEvenement',	'admin_modifier_evenement'],

		// Suppression des évènements
		['GET|POST', '/admin/evenements', 'AdminKelly#gererEvenements',	'admin_gerer_evenement'],

		// Liste des avis client
		['GET|POST', '/admin/livre', 'AdminLiinaa#gererLivre', 'admin_livre'],
		// Création des avis client
		['GET|POST', '/admin/creer-livre', 'AdminLiinaa#creerLivre', 'admin_creer_livre'],
		// Modifier l'avis client
 		['GET|POST',	'/admin/modifier/livre/[:id]', 'AdminLiinaa#modifierLivre',	'admin_modifier_livre'],

	);