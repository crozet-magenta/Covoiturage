<?php

/**
* mini orm
*/
class Model
{
    static public $PDO;

    public function connect()
    {
        $host  = Config::get('Database.Host');
        $pass  = Config::get('Database.Pass');
        $user  = Config::get('Database.User');
        $dbase = Config::get('Database.Database');
        
        try {
            $dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbase, $user, $pass);
        } catch (PDOException $e) {
            trigger_error('Unable to connect to database : ' . $e->getMessage(), E_USER_ERROR);
        }
    }

    
}