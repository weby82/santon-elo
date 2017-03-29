<?php

namespace Model;

// On va hériter de la classe Model du Framework W
use W\Model\Model;

// La mécanique du framework W va déduire à partir du nom de la classe
// Quel est le nom de la table correspondate (Camelcase => snake_case) NewsletterListeModel => newsletter_liste
class SantonModel extends Model{ // on fait l'héritage de la classe parente Model

	// On peut si besoin ajouter des méthodes qui vont faire des requetes SQL spécifique
	// Pour la table newsletter

	public function findColumn($valeurColonne, $colonne = "id")
	{
		$sql = 'SELECT * FROM ' . $this->table . ' WHERE ' . $colonne .'  = :valeurColonne LIMIT 1';
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':valeurColonne', $valeurColonne);
		$sth->execute();

		return $sth->fetch();
	}

	public function findAllColumn($valeurColonne, $colonne = "id")
	{
		$sql = 'SELECT * FROM ' . $this->table . ' WHERE ' . $colonne .'  = :valeurColonne ';
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':valeurColonne', $valeurColonne);
		$sth->execute();

		return $sth->fetchAll();
	}
} 