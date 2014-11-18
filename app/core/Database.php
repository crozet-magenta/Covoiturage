<?php

/**
* mini orm
*/
class Database
{
    static public $PDO;

    /**
     * connect to the database and store the connexion in $PDO.
     * credentials are retrieved from the config file
     *
     * @return void
     */
    static public function connect()
    {
        $host  = Config::get('Database.Host');
        $pass  = Config::get('Database.Pass');
        $user  = Config::get('Database.User');
        $dbase = Config::get('Database.Database');
        
        try {
            self::$PDO = new PDO('mysql:host=' . $host . ';dbname=' . $dbase, $user, $pass);
            self::$PDO->exec('SET NAMES utf8');
        } catch (PDOException $e) {
            trigger_error('Unable to connect to database : ' . $e->getMessage(), E_USER_ERROR);
        }
    }

    /**
     * closes the active connexion to the database
     * @return void
     */
    static public function disconnect()
    {
        self::$PDO = null;
    }
    
}