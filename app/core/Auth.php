<?php

/**
* Authentification class
*/
class Auth
{
    
    static public function attempt($email, $pass)
    {
        Database::connect();
        if (!Users::existEmail($email)) return false;
        if (password_verify($pass, Users::getPassword($email))){
            $_SESSION['loggedUser'] = Users::getUser($email);
            Database::Disconnect();
            return true;
        }
        Database::Disconnect();
        return false; 
    }
}