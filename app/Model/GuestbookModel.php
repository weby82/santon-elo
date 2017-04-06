<?php

namespace Model;

// On va hériter de la classe Model du Framework W
use W\Model\Model;

class GuestbookModel extends Model{ // on fait l'héritage de la classe parente Model

	public function findColumn($valeurColonne, $colonne = "id")
	{
		$sql = 'SELECT * FROM ' . $this->table . ' WHERE ' . $colonne .'  = :valeurColonne LIMIT 1';
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':valeurColonne', $valeurColonne);
		// $sth->execute();

		return $sth->fetch();
	}

	public function findAllColumn($valeurColonne, $colonne = "id")
	{
		$sql = 'SELECT * FROM ' . $this->table . ' WHERE ' . $colonne .'  = :valeurColonne ';
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':valeurColonne', $valeurColonne);
		// $sth->execute();

		return $sth->fetchAll();
	}
} 