<?php
class DATABASE_CONFIG {
	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost', // Hôte
		'login' => 'root', // Nom d'utilisateur
		'password' => 'root', // Mot de passe
		'database' => 'extaz', // Database
		'prefix' => 'extaz_',
		'encoding' => 'utf8',
	);
}