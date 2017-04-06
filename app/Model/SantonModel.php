<?php

namespace Model;

// On va hériter de la classe Model du Framework W
use W\Model\Model;


class SantonModel extends Model{ // on fait l'héritage de la classe parente Model

	// Requete SQL specifique aux santons


	// permet de recuperer les données d'une colonne passé en parametre (valeur de la colonne, nom de la colonne)
	public function findColumn($valeurColonne, $colonne = "id")
	{
		$sql = 'SELECT * FROM ' . $this->table . ' WHERE ' . $colonne .'  = :valeurColonne LIMIT 1';
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':valeurColonne', $valeurColonne);
		$sth->execute();

		return $sth->fetch();
	}

	// Permet de recuperer toutes les lignes d'après une valeur de colonne
	public function findAllColumn($valeurColonne, $colonne = "id")
	{
		$sql = 'SELECT * FROM ' . $this->table . ' WHERE ' . $colonne .'  = :valeurColonne ';
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':valeurColonne', $valeurColonne);
		$sth->execute();

		return $sth->fetchAll();
	}


	// Permet de recupérer toutes les lignes d'aprés la valeur d'une colonne avec trie ordonné.
	public function findAllColumnTrier($valeurColonne, $colonne = "id", $orderBy = '', $orderDir = 'ASC', $limit = null, $offset = null)
	{
		$sql = 'SELECT * FROM ' . $this->table . ' WHERE ' . $colonne .'  = :valeurColonne ';

		if (!empty($orderBy)){

			//sécurisation des paramètres, pour éviter les injections SQL
			if(!preg_match('#^[a-zA-Z0-9_$]+$#', $orderBy)){
				die('Error: invalid orderBy param');
			}
			$orderDir = strtoupper($orderDir);
			if($orderDir != 'ASC' && $orderDir != 'DESC'){
				die('Error: invalid orderDir param');
			}
			if ($limit && !is_int($limit)){
				die('Error: invalid limit param');
			}
			if ($offset && !is_int($offset)){
				die('Error: invalid offset param');
			}

			$sql .= ' ORDER BY '.$orderBy.' '.$orderDir;
		}
        if($limit){
            $sql .= ' LIMIT '.$limit;
            if($offset){
                $sql .= ' OFFSET '.$offset;
            }
        }

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':valeurColonne', $valeurColonne);
		$sth->execute();

		return $sth->fetchAll();
	}


	
} 