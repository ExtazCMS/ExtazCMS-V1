<?php
class DATABASE_CONFIG {
    public $default = array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host' => 'localhost', // Hôte
        'login' => 'root', // Nom d'utilisateur
        'password' => 'changeme', // Mot de passe
        'database' => 'mydatabase', // Database
        'prefix' => 'extaz_',
        'encoding' => 'utf8',
    );
}