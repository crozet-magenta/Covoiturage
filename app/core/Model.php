<?php

/**
* mini orm
*/
class Model
{
       
    public function __construct($host, $database, $user, $pass)
    {
        try {
            $dbh = new PDO('mysql:host=' . $host . ';dbname=' . $database, $user, $pass);
        } catch (PDOException $e) {
            trigger_error('Unable to connect to database : ' . $e->getMessage(), E_USER_ERROR);
        }
    }

    
}