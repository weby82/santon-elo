<?php

namespace Model;

// On va hériter de la classe Model du Framework W
use W\Model\Model;

// La mécanique du framework W va déduire à partir du nom de la classe
// Quel est le nom de la table correspondate (Camelcase => snake_case) NewsletterListeModel => newsletter_liste
class EvenementsModel extends Model{ // on fait l'héritage de la classe parente Model

	// On peut si besoin ajouter des méthodes qui vont faire des requetes SQL spécifique
	// Pour la table newsletter
} 