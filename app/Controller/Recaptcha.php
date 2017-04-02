<?php
namespace Controller;

class Recaptcha{

	private $secret;

	function __construct($secret){
		$this->secret = $secret;
	}


	public function checkCode($code){

		if (empty($code)){
			return false;
		}

		$url = "https://www.google.com/recaptcha/api/siteverify?secret={$this->secret}&response=$code";

		if(function_exists('curl_version')){

			$curl = curl_init($url);

			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_TIMEOUT, 1);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Evite les problèmes, si le serveur est sécurisé
			$response = curl_exec($curl);

		}else{

		// Si curl n'est pas dispo, un bon vieux file_get_contents
        $response = file_get_contents($url);

		}

		if(empty($response) || is_null($response)){
			return false;
		}

		$json = json_decode($response);
		return $json->success;

	} //end methode checkcode
}//end Class

?>