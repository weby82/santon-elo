<?php

function envoyerRequeteSQL ($requeteSQL, $tabToken){
	$hostnameDB = $GLOBALS["hostnameDB"];
	$databaseDB = $GLOBALS["databaseDB"];
	$userDB		= $GLOBALS["userDB"];
	$passwordDB = $GLOBALS["passwordDB"];

	$dsn 		= "mysql:host=$hostnameDB;dbname=$databaseDB;charset=utf-8";

	try
	{
		$objetPDO	= new PDO($dsn, $userDB, $passwordDB);

		$objetPDO -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$objetPDOStatement = $objetPDO->prepare($requeteSQL);

		$objetPDOStatement -> execute($tabToken);

		$objetPDOStatement -> setFetchMode(PDO::FETCH_ASSOC);
	}
	catch (PDOException $e)
	{
		echo $e -> getMessage();
	}

	return $objetPDOStatement;

}

function verifierSaisie ($name){

	$valeurSaisie = "";

	if (isset($_REQUEST[$name]))
	{
		$valeurSaisie = $_REQUEST[$name];

		$valeurSaisie = strip_tags($valeurSaisie);

		$valeurSaisie = trim($valeurSaisie);
	}

	return $valeurSaisie;
}

function verifierEmail ($email){

	$resultat = false;

	if (($email != "") && (filter_var($email, FILTER_VALIDATE_EMAIL) !== false))
	{
		$resultat = true;
	}

	return $resultat;
}