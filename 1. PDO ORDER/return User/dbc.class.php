<?php

class Dbc {	

	private $server = "localhost";
	private $username = "root";
	private $password = "";
	private $database = "return_user";

	protected function connect(){

		header('Access-Control-Allow-Origin: *'); 
		header("Access-Control-Allow-Credentials: true");
		header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
		header('Access-Control-Max-Age: 1000');
		header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

		$dns = "mysql:host=" . $this->server . ";dbname=" . $this->database;
		$pdo = new PDO($dns, $this->username, $this->password);
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

		return $pdo;
	}
	
}